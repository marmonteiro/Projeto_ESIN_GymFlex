<?php
session_start();

$msg = $_SESSION['msg'];
unset($_SESSION['msg']);
?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clubes</title>
  <link rel="stylesheet" href="registo.css">
</head>

<body>
  <header>
    <a href="paginicial.html">
      <img id="logo" src="./imagens/gymflex_logo.svg" alt="Logotipo">
    </a>
  </header>
  <!--<nav id="menu">
  
  <input type="checkbox" id="hamburger"> 
  <label class="hamburger" for="hamburger"> </label>

</nav>-->

  <section id="registo">
    <h1>Registo</h1>
    <form action="action_registo.php" method="post">

      <section id="info_pessoal">
        <div>
          <input type="text" id="fullname" name="fullname" placeholder="Nome Completo" required>
        </div>
        <div>
          <input type="tel" id="phone" name="phone" placeholder="Nº Telemóvel" required>
        </div>
        <div>
          <input type="text" id="address" name="address" placeholder="Morada" required>
        </div>
        <div><label for="birthdate">Data de Nascimento: </label>
          <input type="date" id="birthdate" name="birthdate" required>
        </div>
        <div>
          <input type="text" id="nif" name="nif" placeholder="NIF" required>
        </div>
      </section>

      <section id="imc_calculation">
        <div>
          <input type="number" id="height" name="height" placeholder="Altura (cm)" required>
        </div>
        <div>
          <input type="number" id="weight" name="weight" placeholder="Peso (kg)" required>
        </div>
        <div>
          <!-- insert imc calculation here -->
        </div>
      </section>


      <section id="info_login">
        <div>
          <input type="email" id="email" name="email" placeholder="Email" required>
        </div>
        <div>
          <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
      </section>

      <section id="escolha_plano">
        <div>
          <p>Escolha o seu Plano:</p>
          <select id="plan" name="plan" required>
            <option value="" disabled selected>Selecione um plano</option>
            <option value="basico">Plano Básico</option>
            <option value="medio">Plano Médio</option>
            <option value="avancado">Plano Avançado</option>
          </select>
        </div>
      </section>

      <section id="termos_condicoes">
        <div>
          <input type="checkbox" id="termos" name="termos" required>
          <label for="termos">Li e aceito os <a href="termos_condicoes.html">Termos e Condições</a>.</label>
        </div>

        <div>
          <input type="submit" value="Registar">
        </div>
      </section>

    </form>
    <?php if (isset($msg)) { ?>
      <p>
        <?php echo $msg ?>
      </p>
    <?php } ?>

  </section>
  <footer>
    <p>Qualquer dúvida não hesite em contactar, teremos uma equipa ao seu dispor.</p>
    <p>Email: gymflex.geral@gmail.com</p>
    <p>Telemóvel: 923524352</p>
    <p>&copy; GymFlex, 2023</p>
  </footer>
</body>

</html>