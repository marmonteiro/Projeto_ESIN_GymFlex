<?php
require_once('database/init.php');
require_once('database/person.php');

$to = $_POST["email"];
$subject = getNamePersonByEmail($to);

if ($subject === null OR !filter_var($to, FILTER_VALIDATE_EMAIL)){
    header("location: pass-esquecida-falha_tpl.php");
}
else {

  header("location: pass-esquecida-sucesso_tpl.php");
}
?>
