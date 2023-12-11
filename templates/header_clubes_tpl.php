<!DOCTYPE html>

<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymFlex</title>
    <link rel="stylesheet" href="css/estetica.css">
</head>

<body>
    <header>
        <a href="paginicial.php">
            <img id="logo" src="imagens/gymflex_logo.svg" alt="Logotipo">
        </a>
        <h1>
            <?php echo $nome_ginasio ?>
        </h1>
        <div class="barra">
            <a href="clubes.php" class="clubes">Clubes</a>
            <a href="planos.php" class="planos">Planos</a>
            <a href="aulasgrupo.php" class="info">Aulas de Grupo</a>
            <a href="ajuda.php" class="ajuda">Ajuda</a>
        </div>
    </header>

    <?php if (isset($_SESSION['email'])) { ?>
        <a href="action_logout.php" class="button">Logout</a>
        <a href="area_cliente.php" class="button">Área de Cliente</a>
    <?php } else { ?>
        <a href="registo.php" class="inscreva-se">Inscreva-se</a>
        <a href="login.php" id="signup">Login: área de cliente</a>
    <?php } ?> 