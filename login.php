<?php
session_start();

$msg = $_SESSION['msg'];
unset($_SESSION['msg']);

try {
  $dbh = new PDO('sqlite:sql/gymflex.db');
  $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (PDOException $e) {
  $error_msg = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clubes</title>
  <link rel="stylesheet" href="login.css">
</head>

<body>
  <header>
    <a href="paginicial.html">
      <img id="logo" src="./imagens/gymflex_logo.svg" alt="Logotipo">
    </a>

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