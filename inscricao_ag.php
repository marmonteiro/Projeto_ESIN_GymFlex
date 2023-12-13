<?php
session_start();
require_once("database/init.php");


if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['disponiveis_ag'] == 0) {
    header('Location: area_cliente.php');
    exit();
}

require_once("database/inscricao_ag.php");

try {
    global $dbh;

    if (!isset($_SESSION['email'])) {
        header('Location: login.php'); // Redirect to login if not logged in
        exit();
    }

    //calculo da quantidade de aulas de grupo disponiveis
    $quantidade_ag = fetchQuantidadeAGByEmail($_SESSION['email']);
    $inscricoes_ag = fetchInscricoesAGByEmail($_SESSION['email']);
    $disponiveis_ag = $quantidade_ag - $inscricoes_ag;
    $_SESSION['disponiveis_ag'] = $disponiveis_ag;

    
    //vai buscar todos os ginasios a base de dados
    $stmt = $dbh->prepare('SELECT id, nome FROM Ginasio');
    $stmt->execute();
    $ginasios = $stmt->fetchAll();

    foreach ($ginasios as $ginasio) {
        $nome_ginasio = $ginasio['nome'];
        $id_ginasio = $ginasio['id'];
    }


} catch (PDOException $e) {
    $_SESSION['msg'] = 'Erro: ' . $e->getMessage();
}
include ("templates/header_clubes_tpl.php");
include ("templates/inscricao_ag_tpl.php");
include ("templates/footer_tpl.php");
?>