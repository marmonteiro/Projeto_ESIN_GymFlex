<h3>Alteração de Dados</h3>
<h4>Altere os dados que deseja e clique em "Alterar".</h4>
<p id="msg_erro"><?php echo $_SESSION['msg'] ; unset ($_SESSION['msg'])?></p>
<form action="action_alteracao_dados.php" method="post">

    <div id="alteracao_dados">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo $nome ?>" required>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $email ?>" required>
        <label for="altura">Altura (cm):</label>
        <input type="number" name="altura" id="altura" value="<?php echo $altura ?>" min=1 required>
        <label for="peso">Peso (kg):</label>
        <input type="number" name="peso" id="peso" value="<?php echo $peso ?>" min=1 step=0.1 required>
        <label for="morada">Morada:</label>
        <input type="text" name="morada" id="morada" value="<?php echo $morada ?>" required>
        <label for="telemovel">Nº Telemóvel:</label>
        <input type="tel" id="nr_telemovel" name="nr_telemovel" value="<?php echo $nr_telemovel ?>" required>
        <label for="nr_cartao">Nº Cartão de Crédito/Débito:</label>
        <input type="text" name="nr_cartao" id="nr_cartao" value="<?php echo $nr_cartao ?>" required>

        <label for="password">Confirme a Password:</label>
        <input type="password" name="password" id="password" required>


    </div>
    <input type="submit" class="button" value="Alterar">
</form>