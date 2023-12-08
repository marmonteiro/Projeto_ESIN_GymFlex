<?php
session_start();
require_once("database/init.php");

$msg = $_SESSION['msg'];
unset($_SESSION['msg']);

$aulas = array();
try {
    global $dbh;
    $stmt = $dbh->prepare('
        SELECT * FROM Tipo_ag 
        ORDER BY 
            CASE dia_semana 
                WHEN "Segunda-Feira" THEN 1
                WHEN "Terça-Feira" THEN 2
                WHEN "Quarta-Feira" THEN 3
                WHEN "Quinta-Feira" THEN 4
                WHEN "Sexta-Feira" THEN 5
                WHEN "Sábado" THEN 6
                ELSE 7
            END
    ');
    $stmt->execute();
    $aulas = $stmt->fetchAll();

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


<div class="mensagem">
    <p>Inscreve-te já como membro para puderes usufruir destas aulas</p>
    <a href="registo.php" class="button"> Inscreve-te aqui! </a>
</div>



<?php
include("templates/footer_tpl.php");
?>

</body>

</html>