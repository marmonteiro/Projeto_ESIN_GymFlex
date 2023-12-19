<?php 
session_start();
require_once("database/init.php");

if (!isset($_SESSION['email'])) {
    header('Location: login.php'); 
    exit();
}

include("database/area_cliente.php");
include("templates/header_tpl.php");
include("templates/minhas_ag_tpl.php");
include("templates/footer_tpl.php");
?>