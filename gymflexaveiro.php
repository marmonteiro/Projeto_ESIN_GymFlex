
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
    <title>GymFlex Aveiro</title>
    <link rel="stylesheet" href="clubesv4.2.css"> 
</head>
<body>
    <header>
        <a href="paginicial.html">
            <img id="logo" src="imagens/gymflex_logo.svg" alt="Logotipo">
        </a>
        <h1>GymFlex Aveiro</h1>
        <h2>O seu ginásio na veneza portuguesa.</h2>
        <h3>Situados na Rua Mário Sacramento, esperamos a sua visita.</h3>
    </header>
    
    <!-- VER AQUI -->
    <?php if (isset($_SESSION['email'])) { ?>
        <a href="action_logout.php" class="button">Logout</a>
        <a href="area_cliente.php" class="button">Área de Cliente</a>
    <?php } else { ?>
        <a href="registo.php" class="inscreva-se">Inscreva-se</a>
        <a href="login.php" id="signup">Login: área de cliente</a>
    <?php } ?>

    <div class="club-info">
        <p>GymFlex Aveiro: Rua Mário Sacramento, nº 32</p>
        <p>Contacto telefónico: 923524352</p>
        <p>Email: gymflex.aveiro@gmail.com</p> 
    </div>

    <div class="caracteristicastexto">
        <p>Características do clube:</p>
    </div>

    <div class="caracteristicas">
        <div class="retangulo">
            <img src="imagens/chuveiro.png" alt="Imagem 1">
            <p>Balneários com chuveiros</p>
        </div>
        <div class="retangulo">
            <img src="imagens/cacifos.png" alt="Imagem 1">
            <p>Cacifos gratuitos</p>
        </div>
        <div class="retangulo">
            <img src="imagens/aulasgrupo.png" alt="Imagem 1">
            <p>Diferentes estúdios para aulas de grupo</p>
        </div>
        <div class="retangulo">
            <img src="imagens/cardio.png" alt="Imagem 1">
            <p>Zona de cardio</p>
        </div>
        <div class="retangulo">
            <img src="imagens/funcional.png" alt="Imagem 1">
            <p>Zona funcional</p>
        </div>
        <div class="retangulo">
            <img src="imagens/forca.png" alt="Imagem 1">
            <p>Zona de força</p>
        </div>
        <div class="retangulo">
            <img src="imagens/wifi.png" alt="Imagem 1">
            <p>Wi-fi</p>
        </div>
        <div class="retangulo">
              <img src="imagens/nutrição.png" alt="Imagem 1">
              <p>Nutrição</p>
        </div>
        <div class="retangulo">
             <img src="imagens/social.png" alt="Imagem 1">
             <p>Zona social</p>
        </div>
    </div>

    <div class="comochegar">
        <p>Queres vir treinar connosco?</p>
        <!--<p>Consulta os diferentes planos disponíveis <a href="info.html">aqui</a>.</p>-->
        <p>Como chegar:</p>
    </div>
    <img class="mapa" src="imagens/gymflexaveiro.png" alt="Mapa GymFlex Aveiro"> 
    
    <div class="horarios">
        <p> Horário do ginásio:</p>
        <ul>
            <li>Sábados das 9h às 21h.</li>
            <li>2ª Feira a 6ª Feira das 7h às 23h.</li>
            <li>Domingos e Feriados das 9h às 18h.</li>
        </ul>
        <p> Clube aberto todo o ano, exceto a 25 de dezembro e 1 de janeiro. </p>
        <p> Todas as atividades encerram 30 minutos antes do encerramento do Clube. </p>
    </div>

    <footer>
        <p>Qualquer dúvida não hesite em contactar, teremos uma equipa ao seu dispor.</p>
        <p>&copy; GymFlex, 2023</p>
    </footer>
</body>
</html>

