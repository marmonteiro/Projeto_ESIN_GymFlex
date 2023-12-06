<?php
session_start();

$msg = $_SESSION['msg'];
unset($_SESSION['msg']);


try {
    $dbh = new PDO('sqlite:sql/gym_flex.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $dbh->prepare('SELECT nome, imagem_url FROM Ginasio');
    $stmt->execute();
    $clubes = $stmt->fetchAll();


} catch (PDOException $e) {
    $error_msg = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clubes</title>
    <link rel="stylesheet" href="clubesv4.2.css">
</head>

<body>
    <header>
        <a href="paginicial.php">
            <img id="logo" src="imagens/gymflex_logo.svg" alt="Logotipo">
        </a>
        <h1>GymFlex: Diferentes clubes em diferentes cidades.</h1>
        <h2>Escolha a cidade mais perto de si e venha treinar connosco.</h2>

        <div class="barra">
            <a href="clubes.php" class="clubes">Clubes</a>
            <a href="planos.php" class="planos">Planos</a>
            <a href="aulasgrupo.php" class="info">Aulas de Grupo</a>
            <a href="ajuda.php" class="ajuda">Ajuda</a>
        </div>

        <?php if (isset($_SESSION['email'])) { ?>
            <a href="action_logout.php" class="button">Logout</a>
            <a href="area_cliente.php" class="button">Área de Cliente</a>
        <?php } else { ?>
            <a href="registo.php" class="inscreva-se">Inscreva-se</a>
            <a href="login.php" id="signup">Login: área de cliente</a>
        <?php } ?>
    </header>


    <div class="clubes">
        <?php foreach ($clubes as $clube): ?>
            <a href='gym_info.php?nome_ginasio=<?= $clube['nome'] ?>'>
                <?= $clube['nome'] ?>
                <img src='<?= $clube['imagem_url'] ?>' alt='Clube Logo'>
            </a><br>
        <?php endforeach; ?>
    </div>

    
    </ul>
    <footer>
        <p>Qualquer dúvida não hesite em contactar, teremos uma equipa ao seu dispor.</p>
        <p>&copy; GymFlex, 2023</p>
    </footer>
</body>

</html>