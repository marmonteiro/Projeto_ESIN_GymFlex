<?php
session_start();
require_once("database/init.php");
require_once("database/login.php");


try {

  // vai buscar dados do formulário
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  if ($user = loginSuccess($email, $password)) { //se o login for bem sucedido
    $_SESSION['email'] = $email;
    $membro = fetchNomeandIDByEmail($email);
    $_SESSION['id'] = $membro['id'];
    $_SESSION['nome'] = $membro['nome'];

    header('Location: area_cliente.php');
    exit();

  } else { // login falhado
    $_SESSION['msg'] = 'E-mail ou Password incorretos!';
  }

} catch (PDOException $e) {
  $_SESSION['msg'] = 'Erro: ' . $e->getMessage();
}

header('Location: login.php');
?>