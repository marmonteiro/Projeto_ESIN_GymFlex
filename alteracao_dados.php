<?php
session_start();
require_once("database/init.php");

if (!isset($_SESSION['email'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}
try {
    include("database/area_cliente.php");
    $user = fetchDetalhesMembroByEmail($_SESSION['email']);

}catch (PDOException $e) {
    $error_msg = $e->getMessage();
}

include("templates/header_tpl.php");
include("templates/alteracao_dados_tpl.php");
include("templates/footer_tpl.php");
?>