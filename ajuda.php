<?php
session_start();

$msg = $_SESSION['msg'];
unset($_SESSION['msg']);
include("templates/header_ajuda_tpl.php");
include("templates/ajuda_tpl.php");
include("templates/footer_tpl.php");
?>
