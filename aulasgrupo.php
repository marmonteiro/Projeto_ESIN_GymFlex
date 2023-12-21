<?php
session_start();
require_once("database/init.php");


$aulas = array();
try {

    require_once("database/aulasgrupo.php");
    $aulas = FetchAGOrderByDay();

    foreach ($aulas as $aula) {
        $nome_aulagrupo = $aula['nome'];
        $capacidade_aulaggrupo = $aula['capacidade'];
        $dia_semana = $aula['dia_semana'];
        $hora_inicio = $aula['hora_inicio'];
        $hora_fim = $aula['hora_fim'];
        $imagem_aulagrupo = $aula['imagem_ag'];
    }

} catch (PDOException $e) {
    $_SESSION['msg'] = $e->getMessage();
}

include("templates/header_tpl.php");
include("templates/aulasgrupo_tpl.php");
include("templates/footer_tpl.php");
?>
