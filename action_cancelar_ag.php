<?php
session_start();
require_once("database/init.php");
require_once("database/area_cliente.php");

if (isset($_SESSION['id']) && isset($_POST['inscricao_id'])) {
    include("database/cancelar_inscricao_ag.php");
    header('Location: minhas_ag.php');
    exit();
} else {
    header('Location: minhas_ag.php');
    exit();
}


?>