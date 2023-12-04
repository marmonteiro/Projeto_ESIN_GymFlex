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
    <a href="paginicial.php">
      <img id="logo" src="imagens/gymflex_logo.svg" alt="Logotipo">
    </a>

    <div class="barra">
      <a href="clubes.php" class="clubes">Clubes</a>
      <a href="planos.php" class="planos">Planos</a>
      <a href="aulasgrupo.php" class="info">Aulas de Grupo</a>
      <a href="ajuda.php" class="ajuda">Ajuda</a>
    </div>

    <?php if (isset($_SESSION['email'])) { ?>
      <div> <a href="action_logout.php" class="button">Logout</a></div>
    <?php } else { ?>
      <a href="registo.php" class="inscreva-se">Inscreva-se</a>
      <a href="login.php" id="signup">Login: área de cliente</a>
    <?php } ?>
  </header>


  <section id="registo">
    <h1>Registo</h1>
    <form action="action_registo.php" method="post">

      <section id="info_pessoal">
        <div>
          <input type="text" id="nome" name="nome" placeholder="Nome Completo" required>
        </div>
        <div>
          <input type="tel" id="nr_telemovel" name="nr_telemovel" placeholder="Nº Telemóvel" required>
        </div>
        <div>
          <input type="text" id="morada" name="morada" placeholder="Morada" required>
        </div>
        <div><label for="data_nascimento">Data de Nascimento: </label>
          <input type="date" id="data_nascimento" name="data_nascimento" required>
        </div>
        <div>
          <input type="text" id="nif" name="nif" placeholder="NIF" required>
        </div>
      </section>

      <section id="imc_calculation">
        <div>
          <input type="number" id="altura" name="altura" placeholder="Altura (cm)" required>
        </div>
        <div>
          <input type="number" id="peso" name="peso" placeholder="Peso (kg)" required>
        </div>
        <div>
          <input type="radio" name="sexo" value="M"> Masculino
          <input type="radio" name="sexo" value="F"> Feminino
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
          <select id="tipo_plano" name="tipo_plano" required>
            <option value="" disabled selected>Selecione um plano</option>
            <option value="Básico">Plano Básico</option>
            <option value="Intermédio">Plano Intermédio</option>
            <option value="Avançado">Plano Avançado</option>
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