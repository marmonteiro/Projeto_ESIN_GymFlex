<?php
session_start();
require_once('database/init.php');
require_once('database/editar-pass.php');
require_once('database/login.php');


$oldpassword = $_POST['Antiga'];
$newpassword = $_POST['Nova'];
$confirm_password = $_POST['Confirme'];

if (!loginSuccess($_SESSION['email'], $oldpassword)) {
  $_SESSION['msg'] = 'A senha antiga está incorreta.';
  header('Location: editar-pass.php'); 
  die();
}

if ($oldpassword == $newpassword) {
  $_SESSION['msg'] = 'A senha nova é igual à antiga.';
  header('Location: editar-pass.php');
  die();
}

if (strlen($newpassword) < 8) {
  $_SESSION['msg'] = 'A senha deve ter pelo menos 8 caracteres.';
  header('Location: editar-pass.php');
  die();
}

if ($newpassword != $confirm_password) {
  $_SESSION['msg'] = 'A senha não é igual.';
  header('Location: editar-pass.php');
  die();
}


try {
  updatePassMembroByEmail($newpassword, $_SESSION['email']);
  $_SESSION['msg']='Password alterada com sucesso!';
  header('Location: area_cliente.php');

} catch (PDOException $e) {
  $err_msg = $e->getMessage();

  $_SESSION['msg'] = "Não foi possível mudar a sua senha!$err_msg";

  header('Location: editar-pass.php');
}
?>