<?php
session_start();
require_once("database/init.php");

try {

    if (!isset($_SESSION['email'])) {
        header('Location: login.php');
        exit();
    }
    include("database/area_cliente.php");

    //vai buscar os detalhes do membro
    $user = fetchDetalhesMembroByEmail($_SESSION['email']);
    // calcula a idade do membro
    $idade = date_diff(date_create($data_nascimento), date_create('today'))->y;

    // calcula a data da próxima prestação
    function calculoProxPagamento($data_adesao)
    {
        $dia_adesao = date('d', strtotime($data_adesao)); // Dia da data de adesão
        $prox_pagam_form = strtotime("next month", strtotime($data_adesao));
        $mes_proxpagam = date('m', $prox_pagam_form); // Mês da próxima prestação
        $ano_proxpagam = date('Y', $prox_pagam_form); // Ano da próxima prestação
        $prox_pagam = $ano_proxpagam . '-' . $mes_proxpagam . '-' . $dia_adesao;
        return $prox_pagam;
    }

    $prox_pagam = calculoProxPagamento($user['data_adesao']);

    //calculo da quantidade de aulas de grupo disponiveis
    $quantidade_ag = fetchQuantidadeAGByEmail($_SESSION['email']);
    $NRinscricoes_ag = fetchNRInscricoesAGByEmail($_SESSION['email']);
    $disponiveis_ag = $quantidade_ag - $NRinscricoes_ag;
    $_SESSION['disponiveis_ag'] = $disponiveis_ag;


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

    //calcula a duração total dos treinos no ultimo mes
    $duracao_total = 0;
    $mes_atual = date('m');
    $ano_atual = date('Y');
    $treinos_por_mes = array();
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


} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
include("templates/header_tpl.php");
include("templates/area_cliente_tpl.php");
include("templates/footer_tpl.php");
?>