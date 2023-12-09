<?php
  $dbh = new PDO('sqlite:sql/gymflex.db'); 
            
  $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  session_start();

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
