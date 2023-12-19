<?php
session_start();
require_once("database/init.php");

if (!isset($_SESSION['email'])) {
    header('Location: login.php'); 
    exit();
}

include("database/area_cliente.php");

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($pwd == hash('sha256', $_POST["password"])) {

            include("database/alteracao_dados.php");
            header('Location: area_cliente.php');
            exit();

        } else {
            $_SESSION['msg'] = 'Password inválida.';
            header('Location: alteracao_dados.php');
            exit();
        }
    }
    
} catch (PDOException $e) {
    $error_msg = $e->getMessage();
    if (strpos($error_msg, 'UNIQUE constraint failed: Pessoa.email')) {
        $_SESSION['msg'] = 'E-mail já está registado!';
    }
    elseif (strpos($error_msg, 'UNIQUE constraint failed: Pessoa.nif')) {
        $_SESSION['msg'] = 'NIF já está registado!';
    }
    else {
        $_SESSION['msg'] = "Alteração falhou! ($error_msg)";
    }
    header('Location: alteracao_dados.php');
}
?>
