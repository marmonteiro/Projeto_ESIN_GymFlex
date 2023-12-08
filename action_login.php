<?php
require_once("database/init.php");
session_start();

// vai buscar dados do formulário
$email = $_POST['email'];
$password = $_POST['password'];


// verificar se a combinacao email/password existe na base de dados
function loginSuccess($email, $password)
{
  global $dbh;
  $stmt = $dbh->prepare('
    SELECT Membro.*
    FROM Membro
    INNER JOIN Pessoa ON Membro.id = Pessoa.id
    WHERE Pessoa.email = ? AND Membro.pwd = ?
');
  $stmt->execute(array($email, hash('sha256', $password)));
  return $stmt->fetch();
}

function fetchNomeandIDByEmail($email)
{ //Tendo o email, vai buscar o nome do user
  global $dbh;
  $stmt = $dbh->prepare('SELECT Membro.id, Pessoa.nome FROM Membro INNER JOIN Pessoa ON Membro.id = Pessoa.id WHERE Pessoa.email = ?');
  $stmt->execute(array($email));
  $membro = $stmt->fetch(PDO::FETCH_ASSOC);
  return $membro;

}


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