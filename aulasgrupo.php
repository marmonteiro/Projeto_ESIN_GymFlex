<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="aulasgrupo.css">
</head>
<body>

    <header>
        <a href="paginicial.html">
            <img id="logo" src="imagens/gymflex_logo.svg" alt="Logotipo">
        </a>
    
        <div class="barra">
            <a href="clubes.html" class="clubes">Clubes</a>
            <a href="planos.html" class="serviços">Planos</a>
            <a href="aulasgrupo.html" class="info">Aulas de Grupo</a>
            <a href="info.html" class="info">Ajuda</a>
            <a href="register.php" class="inscreva-se">Inscreva-se</a>
            <a href="login.php" id="signup">Login: área de cliente</a>
        </div>
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
            <a href="horários.html" class="button">Ver Horários</a>
            <div class="button-rectangle"></div>
        </div>
    </div>
    
    <footer>
        <p>Qualquer dúvida não hesite em contactar, teremos uma equipa ao seu dispor.</p>
        <p>Email: gymflex.geral@gmail.com</p>
        <p>Telemóvel: 923524352</p>
        <p>&copy; GymFlex, <?php echo date("Y"); ?></p>
    </footer>

</body>
</html>
