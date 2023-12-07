<?php
require_once("database/init.php");
session_start();

$msg = $_SESSION['msg'];
unset($_SESSION['msg']);

try {

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
  <link rel="icon" href="imagens/gymflex_logo_head.svg">
  <link rel="stylesheet" href="estetica.css">
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
  </header>

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
    <p id="registe_se"><a href="registo.html">Regista-te aqui!</a></p>
  </section>

  <footer>
    <p>Qualquer dúvida não hesite em contactar, teremos uma equipa ao seu dispor.</p>
    <p>Email: gymflex.geral@gmail.com</p>
    <p>Telemóvel: 923524352</p>
    <p>&copy; GymFlex, 2023</p>
  </footer>

</body>

</html>