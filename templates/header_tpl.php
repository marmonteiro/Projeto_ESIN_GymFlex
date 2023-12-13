<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clubes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Contrail+One&family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/estetica.css">
</head>

<body>
    <header>
        <a href="paginicial.php">
            <img id="logo" src="imagens/logo.gif" alt="Logotipo">
        </a>
        
        <!-- <h1>GymFlex: Diferentes clubes em diferentes cidades.</h1>
        <h2>Escolha a cidade mais perto de si e venha treinar connosco.</h2> -->

        <div class="navegacao">
            <a href="clubes.php" class="clubes">Clubes</a>
            <a href="planos.php" class="planos">Planos</a>
            <a href="aulasgrupo.php" class="info">Aulas de Grupo</a>
            <a href="ajuda.php" class="ajuda">Ajuda</a>
        </div>

        <div class="cliente">
        <?php 
            if (isset($_SESSION['email'])) { ?>  <!-- se sessão iniciada -->
                <a href="action_logout.php" class="button"><img src = imagens/logout.png>Logout</a>
                <a href="area_cliente.php" class="button"><img src = imagens/area_cliente.png>Área de Cliente</a>
                <p>Olá,
                    <?php echo $_SESSION['nome'] ?>!
                </p>
            <?php } else { ?> <!-- se sessão não iniciada -->
                <a href="registo.php" class="inscreva-se"><img src = imagens/area_cliente.png>Inscreva-se</a>
                <a href="login.php" id="signup"><img src = imagens/area_cliente.png>Login</a>
            <?php } ?>

        </div>
    </header>