<?php
session_start();
require_once("database/init.php");
require_once("database/area_cliente.php");
require_once("database/inscricao_ag.php");

try {

    if (!isset($_SESSION['email'])) {
        header('Location: login.php');
        exit();
    }


    //vai buscar os detalhes do membro
    $user = fetchDetalhesMembroByEmail($_SESSION['email']);
    // calcula a idade do membro
    $idade = date_diff(date_create($user['data_nascimento']), date_create('today'))->y;

    // calcula a data da próxima prestação
    function calculoProxPagamento($data_adesao)
    {
        $data_atual = time();
        $data_adesao_form = strtotime($data_adesao);
        $dia_adesao = date('d', $data_adesao_form); // dia da data de adesão
        $prox_pagam_form = strtotime("next month", $data_atual);
        $mes_proxpagam = date('m', $prox_pagam_form); // mês da próxima prestação
        $ano_proxpagam = date('Y', $prox_pagam_form); // ano da próxima prestação
        $prox_pagam = $ano_proxpagam . '-' . $mes_proxpagam . '-' . $dia_adesao;
        return $prox_pagam;
    }

    $prox_pagam = calculoProxPagamento($user['data_adesao']);




    //verifica se o membro pode alterar o plano (se já passaram 5 meses desde a adesão)
    function calculoAlteracaoPermitida($data_adesao)
    {
        $ha2Meses = date('Y-m-d', strtotime('-2 months'));
        $alteracaoPermitida = strtotime($data_adesao) <= strtotime($ha2Meses); //será true se já passaram 2 meses desde a adesão
        return $alteracaoPermitida;
    }
    $alteracaoPermitida = calculoAlteracaoPermitida($user['data_adesao']);


    //vai buscar info dos treinos do membro
    $treinos = fetchTreinos($_SESSION['id']);
    //vai buscar o mes e ano selecionados, ou usa o mes e ano atuais
    $ano_sel = isset($_GET['ano']) ? $_GET['ano'] : date('Y');
    $mes_sel = isset($_GET['mes']) ? $_GET['mes'] : date('m');
    //vai buscar os treinos por mês
    $treinos_por_mes = array();
    foreach ($treinos as $treino) {
        $ano_treino = date('Y', strtotime($treino['data'])); // Obtém o ano do treino
        $mes_treino = date('m', strtotime($treino['data'])); // Obtém o mês do treino
        if ($ano_treino == $ano_sel && $mes_treino == $mes_sel) {
            if (!isset($treinos_por_mes[$mes_treino])) {
                $treinos_por_mes[$mes_treino] = array();
            }
            $treinos_por_mes[$mes_treino][] = $treino;
        }
    }

    //calcula a duração total dos treinos no ultimo mes
    $duracao_total = 0;
    $mes_atual = date('m');
    $ano_atual = date('Y');
    if (isset($treinos_por_mes[$mes_atual])) {
        foreach ($treinos_por_mes[$mes_atual] as $treino) {
            $mes_treino = date('m', strtotime($treino['data']));
            $ano_treino = date('Y', strtotime($treino['data']));

            if ($mes_treino == $mes_atual && $ano_treino == $ano_atual) {
                $duracao_total += $treino['duracao_t'];
            }
        }
    }

    //vai buscar o tempo de treino do plano
    $tempo_treino_plano = fetchTempoTreinosPlanoFromID($_SESSION['id']);
    $tempo_treino_plano = intval($tempo_treino_plano);

    //calcula o tempo de treino restante
    $tempo_treino_restante = $tempo_treino_plano - $duracao_total;

    //calculo da quantidade de aulas de grupo disponiveis
    $quantidade_ag = fetchQuantidadeAGByEmail($_SESSION['email']);
    $NRinscricoes_ag = fetchNRInscricoesAGByEmail($_SESSION['email']);
    $disponiveis_ag = $quantidade_ag - $NRinscricoes_ag;
    $_SESSION['disponiveis_ag'] = $disponiveis_ag;


} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
include("templates/header_tpl.php");
include("templates/area_cliente_tpl.php");
include("templates/footer_tpl.php");
?>