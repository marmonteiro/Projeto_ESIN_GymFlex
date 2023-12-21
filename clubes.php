<?php
session_start();
require_once("database/init.php");
require_once("database/clubes.php");

$clubes = selectNomeFromGinasio($inscricao_id);

include("templates/header_tpl.php");
include("templates/clubes_tpl.php");
include("templates/footer_tpl.php");
?>