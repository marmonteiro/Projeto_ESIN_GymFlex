<?php
require_once('src/components/init.php');
require_once('src/person.php');

$oldpassword = $_POST['Antiga'];
$newpassword = $_POST['Nova'];
$confirm_password = $_POST['Confirme'];

//if (sha1($oldpassword) != getPassPersonByEmail($_SESSION['email'])) {
if (!loginSuccess($_SESSION['email'], $oldpassword)) {
  $_SESSION['msg'] = 'A senha antiga está incorreta.';
  // var_dump($oldpassword, getPassPersonByEmail($_SESSION['email']));
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
  header('Location: profile.php');
} catch (PDOException $e) {
  $err_msg = $e->getMessage();

  $_SESSION['msg'] = "Não foi possível mudar a sua senha!($err_msg)";

  header('Location: edit-password.php');
}
?>