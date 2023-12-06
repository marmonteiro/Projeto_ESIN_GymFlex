<?php
session_start();

$dbh = new PDO('sqlite:sql/gymflex.db');
$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$msg = $_SESSION['msg'];
unset($_SESSION['msg']);

$nome_ginasio = $_GET['nome_ginasio'];

function fetchGymInfoById($nome_ginasio)
{
    global $dbh;
    $stmt = $dbh->prepare('
    SELECT * FROM Ginasio WHERE nome = ?
    ');

    $stmt = $dbh->prepare('SELECT * FROM Ginasio WHERE nome = ?');
    $stmt->execute(array($nome_ginasio));
    $infoGinasio = $stmt->fetch(PDO::FETCH_ASSOC);
    return $infoGinasio;
}

function fetchNutByGym($nome_ginasio)
{
    global $dbh;
    $stmt = $dbh->prepare('
            SELECT pn.nome AS nome_nutricionista
            FROM Ginasio AS g
            LEFT JOIN Funcionario AS fn ON g.id = fn.ginasio
            LEFT JOIN Nutricionista AS n ON fn.id = n.id
            LEFT JOIN Pessoa AS pn ON n.id = pn.id
            WHERE g.nome = ?
        ');

    $stmt->execute(array($nome_ginasio));
    $nomeNut = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $nomeNut;
}

function fetchPTByGym($nome_ginasio)
{
    global $dbh;
    $stmt = $dbh->prepare('
            SELECT pn.nome AS nome_personaltrainer
            FROM Ginasio AS g
            LEFT JOIN Funcionario AS fn ON g.id = fn.ginasio
            LEFT JOIN PersonalTrainer AS pt ON fn.id = pt.id
            LEFT JOIN Pessoa AS pn ON pt.id = pn.id
            WHERE g.nome = ?
        ');

    $stmt->execute(array($nome_ginasio));
    $nomePT = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $nomePT;
}



try {
    $infoGinasio = fetchGymInfoById($nome_ginasio);

    $morada_ginasio = $infoGinasio['morada'];
    $telefone_ginasio = $infoGinasio['nr_telefone'];
    $email_ginasio = $infoGinasio['email'];
    $mapa_ginasio = $infoGinasio['mapa_url'];
    $imagem_ginasio = $infoGinasio['imagem_url'];

    $nomeNut = fetchNutByGym($nome_ginasio);
    $nomePT = fetchPTByGym($nome_ginasio);


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
    <link rel="stylesheet" href="">
</head>

<body>
    <header>
        <a href="paginicial.html">
            <img id="logo" src="imagens/gymflex_logo.svg" alt="Logotipo">
        </a>
        <h1>
            <?php echo $nome_ginasio ?>
        </h1>
    </header>

    <?php if (isset($_SESSION['email'])) { ?>
        <a href="action_logout.php" class="button">Logout</a>
        <a href="area_cliente.php" class="button">Área de Cliente</a>
    <?php } else { ?>
        <a href="registo.php" class="inscreva-se">Inscreva-se</a>
        <a href="login.php" id="signup">Login: área de cliente</a>
    <?php } ?>

    <div class="club-info">
        <p>
            <?php echo $nome_ginasio ?>
        </p>
        <p>Morada:
            <?php echo $morada_ginasio ?>
        </p>
        <p>Contacto telefónico:
            <?php echo $telefone_ginasio ?>
        </p>
        <p>Email:
            <?php echo $email_ginasio ?>
        </p>
        <img class="mapa" src="<?php echo $mapa_ginasio ?>" alt="Mapa GymFlex">
        <img class="imagem clube" src="<?php echo $imagem_ginasio ?>" alt="GymFlex Porto">
    </div>

    <div>
        <p>A nossa equipa:</p>
        <table>
            <tr>
                <td>
                    <p>Nutricionistas:</p>
                    <ul>
                        <?php if (!empty($nomeNut)): ?>
                            <?php foreach ($nomeNut as $nutricionista): ?>
                                <?php if (!empty($nutricionista['nome_nutricionista'])): ?>
                                    <li>
                                        <?php echo $nutricionista['nome_nutricionista']; ?>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>Nenhum nutricionista encontrado</li>
                        <?php endif; ?>
                    </ul>
                </td>
                <td>
                    <p>Personal Trainers:</p>
                    <ul>
                        <?php if (!empty($nomePT)): ?>
                            <?php foreach ($nomePT as $personaltrainer): ?>
                                <?php if (!empty($personaltrainer['nome_personaltrainer'])): ?>
                                    <li>
                                        <?php echo $personaltrainer['nome_personaltrainer']; ?>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>Nenhum personal trainer encontrado</li>
                        <?php endif; ?>
                    </ul>
                </td>
            </tr>
        </table>
    </div>

    <footer>
        <p>Qualquer dúvida não hesite em contactar, teremos uma equipa ao seu dispor.</p>
        <p>&copy; GymFlex, 2023</p>
    </footer>

</body>

</html>