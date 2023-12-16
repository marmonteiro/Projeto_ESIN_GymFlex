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

    <header id="header_paginicial"> <!-- se sessão não iniciada -->
        <section id="main_header">
            <div>
                <a href="paginicial.php">
                    <img id="logo_paginicial" src="imagens/gymflex_logo.gif" alt="Logotipo">
                </a>
            </div>

            <div id="Membro_paginicial">
                <p><a id="torne_semembro" href="registo.php">Torne-se membro!<img src=imagens/peso_icon.png></a></p>
                <p id=jámembro>Já é membro? Inicie sessão <a href="login.php">aqui</a>.</p>
            </div>

        </section>

        <div class="barra">
            <a href="clubes.php" class="clubes">Clubes</a>
            <a href="planos.php" class="planos">Planos</a>
            <a href="aulasgrupo.php" class="info">Aulas de Grupo</a>
            <a href="ajuda.php" class="ajuda">Ajuda</a>
        </div>

        <?php if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) { ?>
            <p id="msg_erro">
                <?php echo $_SESSION['msg'] ?>
            </p>
            <?php unset($_SESSION['msg']);
        } ?>

    </header>