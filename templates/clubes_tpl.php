<h1>Clubes GymFlex</h1>
<h4> Escolha o clube mais perto de si e venha treinar connosco: </h4>
<div class="clubes">
    <?php foreach ($clubes as $clube): ?>
        <a href='gym_info.php?nome_ginasio=<?= $clube['nome'] ?>'>
            <img src=imagens/icons/local.png class="normal">
            <img src=imagens/icons/local_red.png class="red">
            <?= $clube['nome'] ?>
        </a><br>
    <?php endforeach; ?>
</div>