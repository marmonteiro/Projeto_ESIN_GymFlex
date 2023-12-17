<div class="classes">
    
<?php if (isset($aulas) && !empty($aulas)) : ?>
    <?php foreach ($aulas as $aula) : ?>
        <div class="class">
            <div class="image-container">
                <img src="<?php echo $aula['imagem_ag'] ?>" alt="<?php echo $aula['nome'] ?>">
            </div>
            <div class="info-container">
                <p> <?php echo $aula['nome'] ?></p>
                <p> Capacidade: <?php echo $aula['capacidade'] ?></p>
                <p> Dia da semana: <?php echo $aula['dia_semana'] ?></p>
                <p>Horário: <?php echo $aula['hora_inicio'] ?> - <?php echo $aula['hora_fim'] ?></p>
            </div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <p>Não existem aulas de grupo disponíveis de momento.</p>
<?php endif; ?>
</div>

<div class="mensagem">
    <p>Inscreve-te já como membro para puderes usufruir destas aulas</p>
    <a href="registo.php" class="inscreva-se"> Inscreve-te aqui! </a>
</div>