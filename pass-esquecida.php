<?php 
$title = 'Recuperação da Senha';

require_once 'database/init.php';
if(isset($_SESSION["email"])){
    header('Location: paginicial.php');
}
require_once 'templates/headerpaginicial_tpl.php';
include('templates/pass-esquecida_tpl.php');
require_once 'templates/footer_tpl.php';?>