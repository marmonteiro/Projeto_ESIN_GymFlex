<?php
session_start();
require_once("database/init.php");

$msg = $_SESSION['msg'];
unset($_SESSION['msg']);

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
        $imagem_aulagrupo = $aula['imagem_aulagrupo'];
    }

} catch (PDOException $e) {
    $error_msg = $e->getMessage();
}

include("templates/header_tpl.php");

?>
<div class="classes">
    <?php
    if (isset($aulas) && !empty($aulas)) {
        foreach ($aulas as $aula) {
            echo '<div class="class">';
            echo '<div class="image-container">';
            echo '<img src="' . $aula['imagem_ag'] . '" alt="' . $aula['nome'] . '">';
            echo '</div>';
            echo '<div class="info-container">';
            echo '<p>' . $aula['nome'] . '</p>';
            echo '<p> Capacidade: ' . $aula['capacidade'] . '</p>';
            echo '<p>Dia da semana: ' . $aula['dia_semana'] . '</p>';
            echo '<p>Horário: ' . $aula['hora_inicio'] . ' - ' . $aula['hora_fim'] . '</p>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>Não existem aulas de grupo disponíveis de momento.</p>';
    }
    ?>

</div>

<?php

include("templates/aulasgrupo_tpl.php");
include("templates/footer_tpl.php");
?>
