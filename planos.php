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
    <title>Clubes</title>
    <link rel="stylesheet" href="clubesv4.2.css">
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

    <div class="planos">
        <div class="retangulo_planos">
            <p>Plano Básico</p>
            <ul>
                <li>1 aula de grupo por semana</li>
                <li>3 entradas por semana</li>
                <li>acesso.....</li>
            </ul>
            <p>Apenas por 9,99€/mês</p>
        </div>
        <div class="retangulo_planos">
            <p>Plano Intermédio</p>
            <ul>
                <li>1 aula de grupo por semana</li>
                <li>3 entradas por semana</li>
                <li>acesso.....</li>
            </ul>
            <p>Apenas por 9,99€/mês</p>
        </div>
        <div class="retangulo_planos">
            <p>Plano Avançado</p>
            <ul>
                <li>1 aula de grupo por semana</li>
                <li>3 entradas por semana</li>
                <li>acesso.....</li>
                <p>Apenas por 9,99€/mês</p>
            </ul>
        </div>
    </div>
    <footer>
        <p>Qualquer dúvida não hesite em contactar, teremos uma equipa ao seu dispor.</p>
        <p>&copy; GymFlex, 2023</p>
    </footer>
</body>