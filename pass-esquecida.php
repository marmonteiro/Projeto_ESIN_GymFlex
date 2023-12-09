<?php 
$title = 'Recuperação da Senha';

require_once 'database/init.php';
if(isset($_SESSION["email"])){
    header('Location: paginicial.php');
}
/* Ver que tipo de função é */require_once 'src/components/layout_top.php';
include('pass-esquecida_tpl.php');
/* Ver que tipo de função é */require_once 'src/components/layout_bottom.php';?>