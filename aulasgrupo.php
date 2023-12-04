<?php
session_start();
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    $email = null;
}
$msg = $_SESSION['msg'];
unset($_SESSION['msg']);
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymFlex</title>
    <link rel="icon" href="imagens/gymflex_logo_head.svg">
    <link rel="stylesheet" href="aulasgrupo.css">
</head>

<body>

    <header>
        <a href="paginicial.php">
            <img id="logo" src="imagens/gymflex_logo.svg" alt="Logotipo">
        </a>

        <div class="barra">
            <a href="clubes.php" class="clubes">Clubes</a>
            <a href="planos.php" class="planos">Planos</a>
            <a href="aulasgrupo.php" class="info">Aulas de Grupo</a>
            <a href="ajuda.php" class="ajuda">Ajuda</a>
        </div>

        <?php if (isset($_SESSION['email'])) { ?>
            <div> <a href="action_logout.php" class="button">Logout</a></div>
        <?php } else { ?>
            <a href="registo.php" class="inscreva-se">Inscreva-se</a>
            <a href="login.php" id="signup">Login: área de cliente</a>
        <?php } ?>
    </header>

    <div class="container">
        <h1>Aulas de Grupo</h1>
        <div class="classes">
            <div class="class">
                <img src="imagens/bodypump.jpeg" alt="BodyPump">
                <div class="overlay">
                    <p> Body Pump </p>
                </div>
            </div>
            <div class="class">
                <img src="imagens/cycling.jpeg" alt="cycling">
                <div class="overlay">
                    <p> Cycling </p>
                </div>
            </div>
            <div class="class">
                <img src="imagens/bodystep.jpeg" alt="bodystep">
                <div class="overlay">
                    <p> Body Step </p>
                </div>
            </div>
            <div class="class">
                <img src="imagens/pilates.jpeg" alt="pilates">
                <div class="overlay">
                    <p> Pilates </p>
                </div>
            </div>
            <div class="class">
                <img src="imagens/xpressabs.jpeg" alt="abs">
                <div class="overlay">
                    <p> Xpress abs</p>
                </div>
            </div>
            <div class="class">
                <img src="imagens/zumba.jpeg" alt="zumba">
                <div class="overlay">
                    <p> Zumba </p>
                </div>
            </div>
        </div>

        <div class="button-container">
            <a href="horários.html" class="button">Ver Horários</a>
            <div class="button-rectangle"></div>
        </div>
    </div>

    <footer>
        <p>Qualquer dúvida não hesite em contactar, teremos uma equipa ao seu dispor.</p>
        <p>Email: gymflex.geral@gmail.com</p>
        <p>Telemóvel: 923524352</p>
        <p>&copy; GymFlex, 2023</p>
    </footer>

</body>

</html>