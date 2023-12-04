<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymFlex Porto</title>
    <link rel="stylesheet" href="clubesv4.2.css">
</head>
<body>
    <header>
        <a href="paginicial.html">
            <img id="logo" src="imagens/gymflex_logo.svg" alt="Logotipo">
        </a>
        <h1>GymFlex Guimarães</h1>
        <h2>O seu ginásio na cidade berço de Portugal.</h2>
        <h3>Situados na Rua do Bom Viver, esperamos a sua visita.</h3>
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
        <p>GymFlex Guimarães: Rua do Bom Viver, nº26</p>
        <p>Contacto telefónico: 923524352</p>
        <p>Email: gymflex.lisboa@gmail.com</p> 

    </div>
   <!-- <div class="club-info2">
        <p>Todos os serviços disponíveis neste ginásio:</p>
        <ul>
          <li>Treino autónomo</li>
          <li>Treino acompanhado (PT)</li>
          <li>Aulas de grupo</li>
          <li>Serviço de nutrição</li>
      </ul>
      </div>-->
    <!-- <img class="club-logo" src="guimaraes.png" alt="Ginásio Logo"> -->
     

    <div class="caracteristicastexto">
        <p>Características do clube:</p>
    </div>

    <div class="caracteristicas">
        <div class="retangulo">
            <img src="imagens/chuveiro.png" alt="Imagem 1">
            <p>Balneários com chuveiros</p>
        </div>
        <!--<div class="retangulo">
            <img src="imagens/cacifos.png" alt="Imagem 1">
            <p>Cacifos gratuitos</p>
        </div>-->
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
            <img src="imagens/nutrição.png" alt="Imagem 1">
            <p>Nutrição</p>
      </div>
    </div>

    <div class="comochegar">
        <p>Queres vir treinar connosco?</p>
        <!--<p>Consulta os diferentes planos disponíveis <a href="info.html">aqui</a>.</p>-->
        <p>Como chegar:</p>
    </div>
    <img class="mapa" src="imagens/gymflexguimaraes.png" alt="Mapa GymFlex Guimarães">
    
    <div class="horarios">
        <p> Horário do ginásio:</p>
        <ul>
            <li>Sábados das 9h às 21h.</li>
            <li>2ª Feira a 6ª Feira das 7h às 22h.</li>
            <li>Domingos e Feriados encerrados.</li>
        </ul>
        <p> Todas as atividades encerram 30 minutos antes do encerramento do Clube. </p>
    </div>

   <footer>
        <p>Qualquer dúvida não hesite em contactar, teremos uma equipa ao seu dispor.</p>
        <p>&copy; GymFlex, 2023</p>
    </footer> 
</body>
</html>