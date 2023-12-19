<div class="aulas">
    
<?php if (isset($aulas) && !empty($aulas)) : ?>
    <?php foreach ($aulas as $aula) : ?>
        <div class="aula">
            <div class="image-container">
                <img src="<?php echo $aula['imagem_ag'] ?>" alt="<?php echo $aula['nome'] ?>">
            </div>
            <div class="info-container">
                <h3> <?php echo $aula['nome'] ?></h3>
                <p><?php echo $aula['dia_semana'] ?></p>
                <p><?php echo $aula['hora_inicio'] ?> - <?php echo $aula['hora_fim'] ?></p>
            </div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <p>Não existem aulas de grupo disponíveis de momento.</p>
<?php endif; ?>
</div>

<div class="mensagem">
    <p>Inscreve-te já como membro para puderes usufruir destas aulas</p>
    <a href="registo.php" class="button"> Inscreve-te aqui! </a>
</div>