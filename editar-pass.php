<?php 
$title = 'Editar Senha';
require_once 'database/init.php';

if(!isset($_SESSION["email"]))
require_once 'header_tpl.php'; 

include('editar-pass_tpl.php');
require_once 'footer_tpl.php'; 
?>