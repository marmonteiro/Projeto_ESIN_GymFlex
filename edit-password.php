<?php 
$title = 'Editar Senha';
require_once 'src/components/init.php';
if(!isset($_SESSION["email"])){
    header('Location: index.php'); 
}
require_once 'src/components/layout_top.php'; 

include('edit-password_tpl.php');
require_once 'src/components/layout_bottom.php'; 
?>