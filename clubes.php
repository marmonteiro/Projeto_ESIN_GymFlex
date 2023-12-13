<?php
session_start();
require_once("database/init.php");

$msg = $_SESSION['msg'];
unset($_SESSION['msg']);


try {
    global $dbh;
    $stmt = $dbh->prepare('SELECT nome, imagem_url FROM Ginasio');
    $stmt->execute();
    $clubes = $stmt->fetchAll();


} catch (PDOException $e) {
    $error_msg = $e->getMessage();
}
include("templates/header_tpl.php");
include("templates/clubes_tpl.php");
include("templates/footer_tpl.php");
?>