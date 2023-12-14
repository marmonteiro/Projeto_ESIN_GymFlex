<?php
session_start();
require_once("database/init.php");


// vai buscar dados do formulário
$email = $_POST['email'];
$password = $_POST['password'];

require_once("database/login.php");


// if email and password are correct, create session
try {
  
  if ($user = loginSuccess($email, $password)) {
    $_SESSION['email'] = $email;
    $membro = fetchNomeandIDByEmail($email);
    $_SESSION['id'] = $membro['id'];
    $_SESSION['nome'] = $membro['nome'];

    header('Location: area_cliente.php'); // login successful
    exit();

  } else { // login failed
    $_SESSION['msg'] = 'E-mail ou Password incorretos!';
  }

} catch (PDOException $e) {
  $_SESSION['msg'] = 'Error: ' . $e->getMessage();
}

header('Location: login.php');
?>