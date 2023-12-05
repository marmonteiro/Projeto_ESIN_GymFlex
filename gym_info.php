<?php
session_start();

$dbh = new PDO('sqlite:sql/gymflex.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$msg = $_SESSION['msg'];
unset($_SESSION['msg']);

$nome_ginasio = $_GET['nome_ginasio'];

function fetchGymInfoById($id_ginasio)
{
    global $dbh;
    $stmt = $dbh->prepare('
    SELECT * FROM Ginasio WHERE nome = ?
    ');

    $stmt = $dbh->prepare('SELECT * FROM Ginasio WHERE nome = ?' );
    $stmt->execute(array($id_ginasio));
    $infoGinasio = $stmt->fetch(PDO::FETCH_ASSOC);
    return $infoGinasio;

}

function fetchNutPTByGymId($id_ginasio)
{
    global $dbh;
    $stmt = $dbh->prepare('
    SELECT Pessoa.nome AS nome_pessoa, Nutricionista.*
    FROM Ginasio 
    INNER JOIN Funcionario ON Ginasio.id = Funcionario.ginasio
    INNER JOIN Pessoa ON Funcionario.id_pessoa = Pessoa.id
    INNER JOIN Nutricionista ON Funcionario.id = Nutricionista.id_funcionario
    WHERE Ginasio.id = ?
');

    $stmt->execute(array($id_ginasio));
    $nomesNutPT = $stmt->fetch(PDO::FETCH_ASSOC);
    return $nomesNutPT;

}


try {
    $dbh = new PDO('sqlite:sql/gymflex.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $infoGinasio = fetchGymInfoById($nome_ginasio);

    $nome_ginasio = $infoGinasio['nome'];
    $morada_ginasio = $infoGinasio['morada'];
    $telefone_ginasio = $infoGinasio['nr_telefone'];
    $email_ginasio = $infoGinasio['email'];
    $mapa_ginasio = $infoGinasio['mapa'];

    $nomesNutPT = fetchNutPTByGymId($nome_ginasio);

    var_dump($nomesNutPT);
    


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
    <link rel="stylesheet" href="clubesv4.2.css"> 
</head>
<body>
    <header>
        <a href="paginicial.html">
            <img id="logo" src="imagens/gymflex_logo.svg" alt="Logotipo">
        </a>
        <h1><?php echo $nome_ginasio ?></h1>
    </header>

    <?php if (isset($_SESSION['email'])) { ?>
        <a href="action_logout.php" class="button">Logout</a>
        <a href="area_cliente.php" class="button">Área de Cliente</a>
    <?php } else { ?>
        <a href="registo.php" class="inscreva-se">Inscreva-se</a>
        <a href="login.php" id="signup">Login: área de cliente</a>
    <?php } ?>

    <div class="club-info">
        <p><?php echo $nome_ginasio ?></p>
        <p>Morada: <?php echo $morada_ginasio ?> </p>
        <p>Contacto telefónico: <?php echo $telefone_ginasio ?> </p>
        <p>Email:<?php echo $email_ginasio ?> </p> 
        <img class="mapa" src="<?php echo $mapa_ginasio ?>" alt="Mapa GymFlex Aveiro"> 
    </div>

    <div>
        <p>A nossa equipa:</p>
    <table>
        <tr>
            <td>
                <p>Nutricionistas:</p>
                <ul>
                    <li>Nutricionista 1</li>
                    <li>Nutricionista 2</li>
                    <!-- Adicionar mais nutricionistas conforme necessário -->
                </ul>
            </td>
            <td>
                <p>Personal Trainers:</p>
                <ul>
                    <li>PT 1</li>
                    <li>PT 2</li>
                    <!-- Adicionar mais Personal Trainers conforme necessário -->
                </ul>
            </td>
        </tr>
    </table>

    </div>
    
    
  <!-- <div class="caracteristicastexto">
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
  </div> -->

  <!-- !!!!!Meter imagens na base de dados -->
  <!--<div class="comochegar">
    <p>Como chegar:</p>
  </div>
  <img class="mapa" src="imagens/gymflexporto.png" alt="Mapa GymFlex Porto"> -->
  


  
  <!-- <div class="horarios">
      <p> Horário do ginásio: </p>
      <ul>
        <li>Sábados das 9h às 21h.</li>
        <li>2ª Feira a 6ª Feira das 7h às 23h.</li>
        <li>Domingos e Feriados das 9h às 18h.</li>
    </ul>
      <p> Clube aberto todo o ano, exceto a 25 de dezembro e 1 de janeiro. </p>
      <p> Todas as atividades encerram 30 minutos antes do encerramento do Clube. </p>
  </div>-->

  <footer>
      <p>Qualquer dúvida não hesite em contactar, teremos uma equipa ao seu dispor.</p> 
      <p>&copy; GymFlex, 2023</p>
  </footer> 

</body>
</html>
