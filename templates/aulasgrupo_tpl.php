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