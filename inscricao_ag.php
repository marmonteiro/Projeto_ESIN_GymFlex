<?php
session_start();
require_once("database/init.php");
require_once("database/inscricao_ag.php");
require_once("database/organizacao_datas.php");


if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['disponiveis_ag'] == 0) {
    header('Location: area_cliente.php');
    exit();
}



try {
    

    //calculo da quantidade de aulas de grupo disponiveis
    $quantidade_ag = fetchQuantidadeAGByEmail($_SESSION['email']);
    $NRinscricoes_ag = fetchNRInscricoesAGByEmail($_SESSION['email']);
    $disponiveis_ag = $quantidade_ag - $NRinscricoes_ag;
    $_SESSION['disponiveis_ag'] = $disponiveis_ag;


    //vai buscar todos os ginasios a base de dados
    $ginasios = fetchAllGinasios ();

    foreach ($ginasios as $ginasio) {
        $nome_ginasio = $ginasio['nome'];
        $id_ginasio = $ginasio['id'];
    }
    



} catch (PDOException $e) {
    $_SESSION['msg'] = 'Erro: ' . $e->getMessage();
}
include ("templates/header_tpl.php");
include ("templates/inscricao_ag_tpl.php");
include ("templates/footer_tpl.php");
?>