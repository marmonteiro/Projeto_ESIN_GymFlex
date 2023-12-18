<section id="area_login">
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

<?php if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) { ?>
  <p id="msg_erro">
    <?php echo $_SESSION['msg'] ?>
  </p>
  <?php unset($_SESSION['msg']);
} ?>


<section id="nao_membro">
  <p>Ainda não és membro? De que estás à espera?</p>
  <p id="registe_se"><a href="registo.php">Regista-te aqui!</a></p>
</section>