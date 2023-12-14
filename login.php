<?php
session_start();
require_once("database/init.php");


$msg = $_SESSION['msg'];
unset($_SESSION['msg']);

if (isset($_SESSION['email'])) {
  header('Location: area_cliente.php');
  exit();
}

try {

} catch (PDOException $e) {
  $error_msg = $e->getMessage();
}
include("templates/header_tpl.php");
include("templates/login_tpl.php");
include("templates/footer_tpl.php");
?>