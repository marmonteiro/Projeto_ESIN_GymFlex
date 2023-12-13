<?php
require_once("database/init.php");
session_start();

$msg = $_SESSION['msg'];
unset($_SESSION['msg']);


try {
    global $dbh;
    $stmt = $dbh->prepare('SELECT nome, imagem_url FROM Ginasio');
    $stmt->execute();
    $clubes = $stmt->fetchAll();


} catch (PDOException $e) {
    $error_msg = $e->getMessage();
}
include("templates/header_tpl.php");
?>


    <div class="clubes">
        <?php foreach ($clubes as $clube): ?>
            <a href='gym_info.php?nome_ginasio=<?= $clube['nome'] ?>'>
                <?= $clube['nome'] ?>
                <img src='<?= $clube['imagem_url'] ?>' alt='Clube Logo'>
            </a><br>
        <?php endforeach;?>
    </div>

    
    </ul>
    <?php 
      include("templates/footer_tpl.php");
    ?>
 
</body>

</html>