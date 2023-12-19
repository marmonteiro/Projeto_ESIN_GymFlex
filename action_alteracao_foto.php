<?php
session_start();
require_once("database/init.php");

if (!isset($_SESSION['email'])) {
    header('Location: login.php'); 
    exit();
}

include("database/area_cliente.php");

try {
    
    include("database/alteracao_foto.php");
    header('Location: area_cliente.php');
    exit();
    
} catch (PDOException $e) {
    $error_msg = $e->getMessage();
    
}