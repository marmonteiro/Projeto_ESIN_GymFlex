<?php
session_start();
require_once("database/init.php");

try {

    if (!isset($_SESSION['email'])) {
        header('Location: login.php'); // Redirect to login if not logged in
        exit();
    }

    include("database/area_cliente.php");

    $user = fetchDetalhesMembroByEmail($_SESSION['email']);

    $nome = $user['nome'];
    $data_nascimento = $user['data_nascimento'];
    $nr_telemovel = $user['nr_telemovel'];
    $morada = $user['morada'];
    $nif = $user['nif'];
    $altura = $user['altura'];
    $peso = $user['peso'];
    $imc = $user['imc'];
    $sexo = $user['sexo'];
    $tipo_plano = $user['tipo_p']; //tipo de plano atual
    $data_adesao = $user['data_adesao']; //ultima data de adesao
    $nutricionista_id = $user['nutricionista'];
    $personaltrainer_id = $user['personaltrainer'];
    $idade = date_diff(date_create($data_nascimento), date_create('today'))->y; // calcula a idade

    // vai buscar os nomes do nutricionista e do personal trainer
    $stmtNutricionista = $dbh->prepare('SELECT nome FROM Pessoa WHERE id = ?');
    $stmtPersonalTrainer = $dbh->prepare('SELECT nome FROM Pessoa WHERE id = ?');
    $stmtNutricionista->execute([$nutricionista_id]);
    $stmtPersonalTrainer->execute([$personaltrainer_id]);
    $nutricionista_nome = $stmtNutricionista->fetchColumn();
    $personaltrainer_nome = $stmtPersonalTrainer->fetchColumn();

    //calculo da proxima prestação
    $data_atual = time();
    $data_adesao_form = strtotime($data_adesao);
    $dia_adesao = date('d', $data_adesao_form); // dia da data de adesão
    $prox_pagam_form = strtotime("next month", $data_atual);
    $mes_proxpagam = date('m', $prox_pagam_form); // mês da próxima prestação
    $ano_proxpagam = date('Y', $prox_pagam_form); // ano da próxima prestação
    $prox_pagam = $ano_proxpagam . '-' . $mes_proxpagam . '-' . $dia_adesao;

    //calculo da quantidade de aulas de grupo disponiveis
    $quantidade_ag = fetchQuantidadeAGByEmail($_SESSION['email']);
    $inscricoes_ag = fetchInscricoesAGByEmail($_SESSION['email']);
    $disponiveis_ag = $quantidade_ag - $inscricoes_ag;
    $_SESSION['disponiveis_ag'] = $disponiveis_ag;

    //verifica se o membro pode alterar o plano (se já passaram 5 meses desde a adesão)
    $ha2Meses = date('Y-m-d', strtotime('-2 months'));
    $alteracaoPermitida = strtotime($data_adesao) <= strtotime($ha2Meses);

    //vai buscar info dos treinos
    $treinos = fetchTreinos($_SESSION['id']);
    //calcula a duração total dos treinos
    $duracao_total = 0;
    foreach ($treinos as $treino) {
        $duracao_total += $treino['duracao_t'];
    }

    //vai buscar o tempo de treino do plano
    $tempo_treino_plano = fetchTempoTreinosPlanoFromID($_SESSION['id']);
    $tempo_treino_plano = intval($tempo_treino_plano);

    //calcula o tempo de treino restante
    $tempo_treino_restante = $tempo_treino_plano - $duracao_total;



} catch (PDOException $e) {
    //  connection errors
    echo "Connection failed: " . $e->getMessage();
}
include("templates/header_ajuda_tpl.php");
include("templates/area_cliente_tpl.php");
include("templates/footer_tpl.php");
?>


