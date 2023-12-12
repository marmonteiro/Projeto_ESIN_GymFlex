<?php
require_once("database/init.php");
session_start();

$msg = $_SESSION['msg'];
unset($_SESSION['msg']);

if (isset($_SESSION['email'])) {
  header('Location: area_cliente.php');
  exit();
}

try {

} catch (PDOException $e) {
  $error_msg = $e->getMessage();
}
include("templates/header_ajuda_tpl.php");
?>

<!-- ESTE HEADER É PARA APAGAR
  <!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GymFlex</title>
  <link rel="icon" href="imagens/gymflex_logo_head.svg">
  <link rel="stylesheet" href="css/estetica.css">
</head>

<body>
  <header>
    <a href="paginicial.php">
      <img id="logo_login" src="imagens/gymflex_logo.svg" alt="Logotipo">
    </a>

    <div class="barra_login">
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
    <?php } ?>
  </header> --> 

  <section id="login">
    <h1>Área de Cliente</h1>
    <p>Por favor, introduza os seus dados de login para aceder à sua Área de Cliente.</p>
    <form action="action_login.php" method="post">
      <div>
        <input type="email" required name="email" placeholder="E-mail">
      </div>
      <div>
        <input type="password" required name="password" placeholder="Password">
      </div>
      <input type="submit" value="Login">
    </form>
  </section>

  <?php if (isset($msg)) { ?>
    <p id="msg_erro">
      <?php echo $msg ?>
    </p>
  <?php } ?>


  <section id="registo">
    <p>Ainda não és membro? De que estás à espera?</p>
    <p id="registe_se"><a href="registo.php">Regista-te aqui!</a></p>
    <br> Esqueceu-se da senha? <a href='pass-esquecida.php'> Clique aqui </a>
  </section>


  <?php 
      include("templates/footer_tpl.php");
  ?>

</body>

</html>