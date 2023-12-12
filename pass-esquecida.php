<?php 
$title = 'Recuperação da Senha';

require_once 'database/init.php';
if(isset($_SESSION["email"])){
    header('Location: paginicial.php');
}
require_once 'src/components/headerpaginicial.php';
include('pass-esquecida_tpl.php');
require_once 'src/components/layout_bottom.php';?>