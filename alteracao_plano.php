<?php
session_start();
include("database/init.php");

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}
include("database/alteracao_plano.php");


try {
    
    

    $user = fetchPlanoMembroByMembroID($_SESSION['id']);

    $tipo_p_info = fetchInfoTipoPlanosdif($user['tipo_p']);

    $ha2Meses = date('Y-m-d', strtotime('-2 months'));
    $alteracaoPermitida = strtotime($user['data_adesao']) <= strtotime($ha2Meses);

    if (!$alteracaoPermitida) {
        header('Location: area_cliente.php');
        exit();
    }



} catch (PDOException $e) {
    $_SESSION['msg'] = 'Erro: ' . $e->getMessage();
}
include("templates/header_tpl.php");
include("templates/alteracao_plano_tpl.php");
include("templates/footer_tpl.php");
?>
