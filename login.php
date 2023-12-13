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