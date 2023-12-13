<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymFlex</title>
    <link rel="icon" href="imagens/gymflex_logo_head.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Contrail+One&family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/estetica.css">
</head>

<body>

    <header class="header_paginicial">
        <section class="grid">
            <div class="logo">
                <img id="logo" src="imagens/gymflex_logo.svg" alt="Logotipo">
            </div>
            <div class="Torne-seMembro">
                <p><a href="registo.php" class="inscreva-se">Torne-se membro!</a></p>
                <p id=jámembro>Já é membro? Inicie sessão <a href="login.php">aqui.</a></p>
            </div>
        </section>

        <div class="barra">
            <a href="clubes.php" class="clubes">Clubes</a>
            <a href="planos.php" class="planos">Planos</a>
            <a href="aulasgrupo.php" class="info">Aulas de Grupo</a>
            <a href="ajuda.php" class="ajuda">Ajuda</a>
        </div>

        <div>
            <?php
            if (isset($_SESSION['email'])) { ?> <!-- se sessão iniciada -->
                <a href="action_logout.php" class="button">Logout</a>
                <a href="area_cliente.php" class="button">Área de Cliente</a>
                <p>Olá,
                    <?php echo $_SESSION['nome'] ?>!
                </p>
            <?php } else { ?> <!-- se sessão não iniciada -->
                <a href="registo.php" class="inscreva-se">Inscreva-se</a>
                <a href="login.php" id="signup">Login: área de cliente</a>
            <?php }

            if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) { ?> <!-- se houver mensagem de erro -->
                <p>{$_SESSION['msg']}</p>"
                <?php unset($_SESSION['msg']);
            } ?>

        </div>
    </header>