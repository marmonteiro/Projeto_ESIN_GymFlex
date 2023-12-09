<?php 
$title = 'Editar Senha';
require_once 'database/init.php';
if(!isset($_SESSION["email"])){
    header(''); 
}
require_once 'src/components/layout_top.php'; 

include('edit-password_tpl.php');
require_once 'src/components/layout_bottom.php'; 
?>