<?php
require_once("database/init.php");
require_once('database/person.php');

$oldpassword = $_POST['Antiga'];
$newpassword = $_POST['Nova'];
$confirm_password = $_POST['Confirme'];


if (!loginSuccess($_SESSION['email'], $oldpassword)) {
  $_SESSION['msg'] = 'A senha antiga está incorreta.';
  header('Location: edit-password.php'); 
  die();
}

if (strlen($newpassword) < 8) {
  $_SESSION['msg'] = 'A senha deve ter pelo menos 8 caracteres.';
  header('Location: edit-password.php');
  die();
}

if ($newpassword != $confirm_password) {
  $_SESSION['msg'] = 'A senha não é igual.';
  header('Location: edit-password.php');
  die();
}

try {
  updatePassPersonByEmail($newpassword, $_SESSION['email']);
  header('Location: area_cliente.php');
} catch (PDOException $e) {
  $err_msg = $e->getMessage();

  $_SESSION['msg'] = "Não foi possível mudar a sua senha!($err_msg)";

  header('Location: edit-password.php');
}
?>