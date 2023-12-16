<?php
session_start();
require_once("database/init.php");


include ("database/fetchInfoTipoPlanos.php");

try {
    $tipo_p_info = fetchInfoTipoPlanos();
    foreach($tipo_p_info as $plano) {
        $nome_plano = $plano['nome'];
        $preco_plano = $plano['preco'];
        $tempo_treino_plano = $plano['tempo_treino'];
        $quantidade_ag_plano = $plano['quantidade_ag'];

    }

} catch (PDOException $e) {
    $_SESSION['msg'] = $e->getMessage();
}
include("templates/header_tpl.php");
include("templates/planos_tpl.php");
include("templates/footer_tpl.php");
?>