<?php
session_start();
require_once("database/init.php");

try {

    if (!isset($_SESSION['email'])) {
        header('Location: login.php'); // Redirect to login if not logged in
        exit();
    }

    include("database/area_cliente.php");


} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
include("templates/header_tpl.php");
include("templates/editar-foto_tpl.php");
include("templates/footer_tpl.php");
?>
