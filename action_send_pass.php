<?php
session_start();
require_once('database/init.php');
require_once('database/action_pass.php');

$to = $_POST["email"];
$subject = getNamePersonByEmail($to);

if ($subject === null OR !filter_var($to, FILTER_VALIDATE_EMAIL)){
    header("location: pass-esquecida-falha.php");
}
else {

  header("location: pass-esquecida-sucesso.php");
}
?>
