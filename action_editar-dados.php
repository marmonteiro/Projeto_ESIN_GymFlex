<?php
session_start();
require_once("database/init.php");
require_once("database/area_cliente.php");
require_once("database/editar-dados.php");

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}



try {


    UpdatePessoa($_POST['email'], $_POST['nome'], $_POST['morada'], $_POST['nr_telemovel'], $_SESSION['id']);


    UpdateMembro($_POST['altura'], $_POST['peso'], $_POST['nr_cartao'], $_SESSION['id']);


    $imc = $_POST['peso'] / ($_POST['altura'] / 100 * $_POST['altura'] / 100);
    UpdateIMC($imc, $_SESSION['id']);



    header('Location: area_cliente.php');
    exit();


    if (strlen($nome) < 3) {
        $_SESSION['msg'] = 'Nome inválido.';
        header('Location: registo.php');
        die();
    }

    if (strlen($nr_telemovel) != 9) {
        $_SESSION['msg'] = 'Número de telemóvel inválido.';
        header('Location: registo.php');
        die();
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($pwd == hash('sha256', $_POST["password"])) {

            include("database/editar-dados.php");
            header('Location: area_cliente.php');
            exit();

        } else {
            $_SESSION['msg'] = 'Password inválida.';
            header('Location: editar-dados.php');
            exit();
        }
    }


} catch (PDOException $e) {
    $error_msg = $e->getMessage();
    if (strpos($error_msg, 'UNIQUE constraint failed: Pessoa.email')) {
        $_SESSION['msg'] = 'E-mail já está registado!';
    } elseif (strpos($error_msg, 'UNIQUE constraint failed: Pessoa.nif')) {
        $_SESSION['msg'] = 'NIF já está registado!';
    } else {
        $_SESSION['msg'] = "Alteração falhou! ($error_msg)";
    }
    header('Location: editar-dados.php');
}
?>