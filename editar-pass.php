<?php 
$title = 'Editar Senha';
require_once 'database/init.php';

if(!isset($_SESSION["email"]))
require_once 'templates/header_tpl.php'; 

include('templates/editar-pass_tpl.php');
require_once 'templates/footer_tpl.php'; 
?>