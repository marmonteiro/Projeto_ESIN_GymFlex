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
        <a href="gymflexporto.php" class="porto">GmyFlex Porto</a>
        <a href="gymflexaveiro.php" class="aveiro">GymFlex Aveiro</a>
        <a href="gymflexlisboa.php" class="lisboa">GymFlex Lisboa</a>
        <a href="gymflexmadeira.php" class="madeira">GymFlex Madeira</a>
        <a href="gymflexbraga.php" class="braga">GymFlex Braga</a>
        <a href="gymflexguimaraes.php" class="guimarães">GymFlex Guimarães</a>
    </div>

    <ul class="club-info">
        <li>
            <img class="club-logo" src="imagens/porto.png" alt="Ginásio Logo">
            <a href="gymflexporto.php">GymFlex Porto: Rua das Flores, nº26 <br>
                <!-- <span>Contacto telefónico: 923524352</span> <br>
                <span>Email: gymflex.porto@gmail.com</span> -->
            </a>
        </li>

        <li>
            <img class="club-logo" src="imagens/aveiro.png" alt="Ginásio Logo">
            <a href="gymflexaveiro.php">GymFlex Aveiro: Rua Mário Sacramento, nº 32 <br>
                <!-- <span>Contacto telefónico: 923524352</span> <br>
                <span>Email: gymflex.aveiro@gmail.com</span> -->
            </a>
        </li>

        <li>
            <img class="club-logo" src="imagens/lisboa.png" alt="Ginásio Logo">
            <a href="gymflexlisboa.php">GymFlex Lisboa: Travessa de Campo de Ourique, nº 6 <br>
                <!-- <span>Contacto telefónico: 923524352</span> <br>
                <span>Email: gymflex.lisboa@gmail.com</span> -->
            </a>
        </li>

        <li>
            <img class="club-logo" src="imagens/madeira.png" alt="Ginásio Logo">
            <a href="gymflexmadeira.php">GymFlex Madeira: Rua da Ajuda, nº 8 <br>
                <!-- <span>Contacto telefónico: 923524352</span> <br>
                <span>Email: gymflex.madeira@gmail.com</span> -->
            </a>
        </li>
        <li>
            <img class="club-logo" src="imagens/braga.png" alt="Ginásio Logo">
            <a href="gymflexbraga.php">GymFlex Braga: Rua Francisco Sanches, nº 12 <br>
                <!-- <span>Contacto telefónico: 923524352</span> <br>
                <span>Email: gymflex.madeira@gmail.com</span> -->
            </a>
        </li>
        <li>
            <img class="club-logo" src="imagens/guimaraes.png" alt="Ginásio Logo">
            <a href="gymflexguimaraes.php">GymFlex Guimarães: Rua 31 de janeiro, nº 8 <br>
                <!-- <span>Contacto telefónico: 923524352</span> <br>
                <span>Email: gymflex.madeira@gmail.com</span> -->
            </a>
        </li>
    </ul>
    <footer>
        <p>Qualquer dúvida não hesite em contactar, teremos uma equipa ao seu dispor.</p>
        <p>&copy; GymFlex, 2023</p>
    </footer>
</body>

</html>