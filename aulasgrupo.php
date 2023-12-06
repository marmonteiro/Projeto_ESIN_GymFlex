<?php
session_start();

$msg = $_SESSION['msg'];
unset($_SESSION['msg']);


try {
    $dbh = new PDO('sqlite:sql/gymflex.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $dbh->prepare('SELECT nome, data_inicio, data_fim, imagem_aulagrupo FROM Tipo_ag');
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
                        if ($clubes->num_rows > 0) {
                            while ($row = $clubes->fetch_assoc()) {
                                echo '<div class="class">';
                                echo '<img src="' . $row["imagem_aulagrupo"] . '" alt="' . $row["nome"] . '">';
                                echo '<div class="overlay">';
                                echo '<p>' . $row["nome"] . '</p>';
                                echo '<p>Horário: ' . $row["hora_inicio"] . ' - ' . $row["hora_fim"] . '</p>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo "No classes found.";
                        }
            // Lista de aulas de grupo
            /* $aulas = array(
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
            } */
            ?> 
        </div>

        <div class="mensagem">
        <p>Inscreve-te já como membro para puderes usufruir destas aulas</p>
        <a href="registo.php" class="button"> Inscreve-te aqui! </a>
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