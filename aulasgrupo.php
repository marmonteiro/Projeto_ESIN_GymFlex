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
            <a href="action_logout.php" class="button">Logout</a>
            <a href="area_cliente.php" class="button">Área de Cliente</a>
        <?php } else { ?>
            <a href="registo.php" class="inscreva-se">Inscreva-se</a>
            <a href="login.php" id="signup">Login: área de cliente</a>
        <?php } ?>
    </header>

    <div class="container">
        <h1>Aulas de Grupo</h1>
        <div class="classes">
            <?php
            // Lista de aulas de grupo
            $aulas = array(
                array("imagem" => "imagens/bodypump.jpeg", "nome" => "Body Pump"),
                array("imagem" => "imagens/cycling.jpeg", "nome" => "Cycling"),
                array("imagem" => "imagens/bodystep.jpeg", "nome" => "Body Step"),
                array("imagem" => "imagens/pilates.jpeg", "nome" => "Pilates"),
                array("imagem" => "imagens/xpressabs.jpeg", "nome" => "Xpress abs"),
                array("imagem" => "imagens/zumba.jpeg", "nome" => "Zumba"),
            );

            // Exibição das aulas
            foreach ($aulas as $aula) {
                echo '<div class="class">';
                echo '<img src="' . $aula["imagem"] . '" alt="' . $aula["nome"] . '">';
                echo '<div class="overlay">';
                echo '<p>' . $aula["nome"] . '</p>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>

        <div class="button-container">
            <a href="horários.php" class="button">Ver Horários</a>
            <div class="button-rectangle"></div>
        </div>
    </div>

    <footer>
        <p>Qualquer dúvida não hesite em contactar, teremos uma equipa ao seu dispor.</p>
        <p>Email: gymflex.geral@gmail.com</p>
        <p>Telemóvel: 923524352</p>
        <p>&copy; GymFlex,
            <?php echo date("Y"); ?>
        </p>
    </footer>

</body>

</html>