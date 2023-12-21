<?php
session_start();
require_once("database/init.php");
require_once ("database/infoplanos.php");


try {
  $tipo_p_info = fetchInfoTipoPlanos();
  foreach ($tipo_p_info as $plano) {
    $nome_plano = $plano['nome'];
    $preco_plano = $plano['preco'];
  }

} catch (PDOException $e) {
  $_SESSION['msg'] = $e->getMessage();
}


include("templates/header_tpl.php");
include("templates/registo_tpl.php");
include("templates/footer_tpl.php");
?>