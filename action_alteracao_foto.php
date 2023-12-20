<?php
session_start();
require_once("database/init.php");

if (!isset($_SESSION['email'])) {
    header('Location: login.php'); 
    exit();
}

include("database/area_cliente.php");

try {
    
    require_once("database/alteracao_foto.php");
    guardarFotoPerfil ($_SESSION['id']);

    header('Location: area_cliente.php');
    exit();
    
} catch (PDOException $e) {
    $error_msg = $e->getMessage();
    
}