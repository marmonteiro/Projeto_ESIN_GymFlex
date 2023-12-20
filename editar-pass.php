<?php 
session_start();
$title = 'Editar Senha';
require_once 'database/init.php';

if (!isset($_SESSION['email'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}


include("templates/header_tpl.php");
include("templates/editar-pass_tpl.php");
include("templates/footer_tpl.php");

?>