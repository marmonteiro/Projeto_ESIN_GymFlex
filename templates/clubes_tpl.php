<div class="clubes">
    <?php foreach ($clubes as $clube): ?>
        <a href='gym_info.php?nome_ginasio=<?= $clube['nome'] ?>'>
            <?= $clube['nome'] ?>
            <img src='<?= $clube['imagem_url'] ?>' alt='Clube Logo'>
        </a><br>
    <?php endforeach; ?>
</div>