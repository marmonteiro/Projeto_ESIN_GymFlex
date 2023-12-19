<div class="clubes">
    <?php foreach ($clubes as $clube): ?>
        <a href='gym_info.php?nome_ginasio=<?= $clube['nome'] ?>'>
            <img src=imagens/local.png class="normal">
            <img src=imagens/local_red.png class="red">
            <?= $clube['nome'] ?>
            <!-- <img src='<?= $clube['imagem_url'] ?>' alt='Clube Logo'> -->
        </a><br>
    <?php endforeach; ?>
</div>