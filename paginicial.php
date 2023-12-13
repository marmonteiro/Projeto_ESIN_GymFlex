<?php
session_start();
if (isset($_SESSION['email']))
    include("templates/header_tpl.php");
else
    include("templates/headerpaginicial_tpl.php");
include("templates/paginicial_tpl.php");
include("templates/footer_tpl.php");
?>