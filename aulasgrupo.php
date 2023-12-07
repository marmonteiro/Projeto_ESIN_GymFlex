<?php
session_start();

$msg = $_SESSION['msg'];
unset($_SESSION['msg']);

$aulas = array();
try {
    $dbh = new PDO('sqlite:sql/gym_flex.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $dbh->prepare('SELECT * FROM Aulagrupo');
    $stmt->execute();
    $aulas = $stmt->fetchAll();


} catch (PDOException $e) {
    $error_msg = $e->getMessage();
}

foreach ($aulas as $aula){
    $nome_aulagrupo = $aula['nome'];
    $capacidade_aulaggrupo = $aula['capacidade'];
    $dia_semana = $aula['dia_semana'];
    $hora_inicio = $aula['hora_inicio'];
    $hora_fim = $aula['hora_fim'];
    $imagem_aulagrupo = $aula['imagem_aulagrupo'];
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymFlex</title>
    <link rel="icon" href="imagens/gymflex_logo_head.svg">
    <link rel="stylesheet" href="estetica.css">
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

    <div class="classes">
    <?php
    if (isset($aulas) && !empty($aulas)){
        foreach ($aulas as $aula) {
            echo '<div class="class">';
                echo '<div class="image-container">';
                    echo '<img src="' . $aula['imagem_aulagrupo'] . '" alt="' . $aula['nome'] . '">';
                echo '</div>';
             echo '<div class="info-container">';
                echo '<p>' . $aula['nome'] . '</p>';
                echo '<p> Capacidade:' .$aula['capacidade'] . '</p>';
                echo '<p>Dia da Semana:' .$aula['dia_semana'] . '</p>';
                echo '<p>Horário: ' . $aula['hora_inicio'] . ' - ' . $aula['hora_fim'] . '</p>';
             echo '</div>';
            echo '</div>';
        }
    }  else {
        echo 'No classes found.';
    }
    ?>
</div>


        <div class="mensagem">
        <p>Inscreve-te já como membro para puderes usufruir destas aulas</p>
        <a href="registo.php" class="button"> Inscreve-te aqui! </a>
    </div>
    <div class="mensagem">
        <p>Inscreve-te já como membro para puderes usufruir destas aulas</p>
        <a href="horários.php" class="button"> Inscreve-te aqui! </a>
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