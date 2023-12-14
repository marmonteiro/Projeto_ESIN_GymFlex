<section id="registo">
  <h1>Registo</h1>
  <?php if (isset($msg)) { ?>
    <p>
      <?php echo $msg ?>
    </p>
  <?php } ?>
  <form action="action_registo.php" method="post">

    <section id="info_pessoal">
      <div>
        <input type="text" id="nome" name="nome" placeholder="Nome Completo" required>
      </div>
      <div>
        <input type="tel" id="nr_telemovel" name="nr_telemovel" placeholder="Nº Telemóvel (+351)" required>
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
        <input type="number" id="altura" name="altura" placeholder="Altura (cm)" min="1" required>
      </div>
      <div>
        <input type="number" id="peso" name="peso" placeholder="Peso (kg)" min="1" required>
      </div>
      <div>
        <input type="radio" name="sexo" value="M"> Masculino
        <input type="radio" name="sexo" value="F"> Feminino
        <input type="radio" name="sexo" value="O"> Outro
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
          <?php foreach ($tipo_p_info as $plano): ?>
            <?php $selected = (isset($_GET['plano_sel']) && $_GET['plano_sel'] === $plano['nome']) ? 'selected' : ''; ?>
            <option value="<?php echo $plano['nome']; ?>" <?php echo $selected; ?>>
              <?php echo $plano['nome'] . ' - ' . $plano['preco'] . '€'; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <input type="text" id="iban" name="iban" placeholder="IBAN" required>
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

</section>