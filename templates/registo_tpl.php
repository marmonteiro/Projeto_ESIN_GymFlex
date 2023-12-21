<h1>Registo</h1>
<?php if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) { ?>
  <p id="msg_erro">
    <?php echo $_SESSION['msg'] ?>
  </p>
  <?php unset($_SESSION['msg']);
} ?>
<section id="area_registo">
<p>Por favor, preencha os seguintes campos para se registar como membro GymFlex.</p>
  <form action="action_registo.php" method="post" enctype="multipart/form-data">

    <section id="info_pessoal">
      <p>Informação Pessoal</p>
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

    <section id="foto_perfil">
      <p>Foto de Perfil</p>
      <div>
        <input type="file" id="profile_pic" name="profile_pic">
      </div>
    </section>

    <section id="imc_calculation">
      <p>Dados Físicos</p>
      <div>
        <input type="number" id="altura" name="altura" placeholder="Altura (cm)" min="1" required>
      </div>
      <div>
        <input type="number" id="peso" name="peso" placeholder="Peso (kg)" min="1" required>
      </div>
      <div id="sexo">
        <input type="radio" name="sexo" id="masculino" value="M">
        <label for="masculino">Masculino</label>
        <input type="radio" name="sexo" id="feminino" value="F">
        <label for="feminino">Feminino</label>
      </div>
    </section>


    <section id="info_login">
      <p>Dados de Login</p>
      <div>
        <input type="email" id="email" name="email" placeholder="Email" required>
      </div>
      <div>
        <input type="password" id="password" name="password" placeholder="Password" required>
      </div>
    </section>


    <section id="escolha_plano">
      <p>Escolha o seu Plano:</p>
      <div>
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
      <p>Insira o número do seu cartão de débito/crédito para pagamento mensal:</p>
      <div>
        <input type="text" id="nr_cartao" name="nr_cartao" placeholder="Nº Cartão de Crédito/Débito" required>
      </div>
    </section>



    <div id="termos_condicoes">
      <input type="checkbox" id="termos" name="termos" required>
      <label for="termos"> Li e aceito os <a href="termos_condicoes.php">Termos e Condições</a>.</label>
    </div>

    <div>
      <input type="submit" value="Registar">
    </div>
  </form>

</section>