<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymFlex</title>
    <link rel="shortcut icon" href="imagens/icons/gymflex_head.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Contrail+One&family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/estetica.css">
</head>

<body>
    <header>
        <div>
            <a href="paginicial.php">
                <img id="logo" src="imagens/icons/gymflex_logo.gif" alt="Logotipo">
            </a>
        </div>


        <div class="barra">
            <a href="clubes.php" class="clubes">Clubes</a>
            <a href="planos.php" class="planos">Planos</a>
            <a href="aulasgrupo.php" class="info">Aulas de Grupo</a>
            <a href="ajuda.php" class="ajuda">Ajuda</a>
        </div>

        <div class="cliente">
            <?php
            if (isset($_SESSION['email'])) { ?> <!-- se sessão iniciada -->
                <a id="logout" href="action_logout.php"><img src=imagens/icons/logout.png>Logout</a>
                <a id="areacliente" href="area_cliente.php"><img src=imagens/icons/area_cliente.png>Área de
                    Cliente</a>
                <div id=ola>
                    <img src="imagens/membros/<?= $_SESSION['id'] ?>.png">
                    <p>Olá,
                        <?php echo $_SESSION['nome'] ?>!
                    </p>
                </div>
            <?php } else { ?> <!-- se sessão não iniciada -->
                <a id="login_btn" href="login.php"><img src=imagens/icons/area_cliente.png>Login</a>
                <a id="torne_semembro" href="registo.php"><img src=imagens/icons/peso_icon.png>Torne-se Membro!</a>
            <?php } ?>

        </div>
    </header>