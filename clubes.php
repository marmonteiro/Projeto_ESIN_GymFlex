<?php
session_start();
require_once("database/init.php");


try {
    global $dbh;
    /*funcao parecida na inscricao_ag*/
    $stmt = $dbh->prepare('SELECT nome FROM Ginasio');
    $stmt->execute();
    $clubes = $stmt->fetchAll();


} catch (PDOException $e) {
    $_SESSION['msg'] = $e->getMessage();
}
include("templates/header_tpl.php");
include("templates/clubes_tpl.php");
include("templates/footer_tpl.php");
?>