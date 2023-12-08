<?php
session_start();

$msg = $_SESSION['msg'];
unset($_SESSION['msg']);
include("templates/headerpaginicial_tpl.php");
?>




<!--  ESTE HEADER VAI SER PARA APAGAR
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
        <h1>GymFlex: Diferentes clubes em diferentes cidades</h1>

        <div class="barra">
            <a href="clubes.php" class="clubes">Clubes</a>
            <a href="planos.php" class="planos">Planos</a>
            <a href="aulasgrupo.php" class="info">Aulas de Grupo</a>
            <a href="ajuda.php" class="ajuda">Ajuda</a>
        </div>

        <?php if (isset($_SESSION['email'])) { ?>
            <a href="action_logout.php" class="button">Logout</a>
            <a href="area_cliente.php" class="button">Área de Cliente</a>
            <p>Olá, <?php echo $_SESSION['nome'] ?>!</p>
        <?php } else { ?>
            <a href="registo.php" class="inscreva-se">Inscreva-se</a>
            <a href="login.php" id="signup">Login: área de cliente</a>
        <?php } ?>
    </header>  --> 

    <div class="escolherGymFlex">
        <p>Porquê o GymFlex?</p>
    </div>

    <div class="imagensiniciais">
        <div class="imagens">
            <img src="imagens/fidelizacao.png" alt="Imagem 1">
            <div class="textoimagensiniciais">
                <p> Sem Fidelização</p>
            </div>
        </div>
        <div class="imagens">
            <img src="imagens/horario.png" alt="Imagem 2">
            <div class="textoimagensiniciais">
                <p>Horário Alargado</p>
            </div>
        </div>
        <div class="imagens">
            <img src="imagens/TreinoPT.png" alt="Imagem 3">
            <div class="textoimagensiniciais">
                <p>Treino Acompanhado ou Autónomo</p>
            </div>
        </div>
        <div class="imagens">
            <img src="imagens/instalacoes.png" alt="Imagem 4">
            <div class="textoimagensiniciais">
                <p>Instalações</p>
            </div>
        </div>
    </div>
    <p>

    </p>

  <div class="caracteristicastexto">
      <p>Características dos nossos clubes:</p>
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
           <img src="imagens/nutricao.png" alt="Imagem 1">
           <p>Nutrição</p>
       </div>
       <div class="retangulo">
          <img src="imagens/social.png" alt="Imagem 1">
          <p>Zona social</p>
        </div>
  </div> 


  <div class="horarios">
      <p> Horário dos clubes: </p>
      <ul>
        <li>Sábados das 9h às 21h.</li>
        <li>2ª Feira a 6ª Feira das 7h às 22h.</li>
        <li>Domingos e Feriados das 9h às 18h.</li>
      </ul>
      <p> Clube aberto todo o ano, exceto a 25 de dezembro e 1 de janeiro. </p>
      <p> Todas as atividades encerram 30 minutos antes do encerramento do Clube. </p>
  </div>



   <?php 
      include("templates/footer_tpl.php");
    ?>

    <!-- FOOTER PARA APAGAR
    <footer>
        <p>Qualquer dúvida não hesite em contactar, teremos uma equipa ao seu dispor.</p>
        <p>Email: gymflex.geral@gmail.com</p>
        <p>Telemóvel: 923524352</p>
        <p>&copy; GymFlex, 2023</p>
    </footer>--> 
</body>

</html>