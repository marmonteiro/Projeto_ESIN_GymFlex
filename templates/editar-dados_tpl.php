<h3> Editar os seus dados</h3>
<h4> Edite os dados que deseja e clique em "Alterar".</h4>
<p id="msg_erro"><?php echo $_SESSION['msg'] ; unset ($_SESSION['msg'])?></p>
<form action="action_editar-dados.php" method="post">

    <div id="editar_dados">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo $user['nome'] ?>" required>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $user['email'] ?>" required>
        <label for="altura">Altura (cm):</label>
        <input type="number" name="altura" id="altura" value="<?php echo  $user['altura'] ?>" min=1 required>
        <label for="peso">Peso (kg):</label>
        <input type="number" name="peso" id="peso" value="<?php echo $user['peso'] ?>" min=1 step=0.1 required>
        <label for="morada">Morada:</label>
        <input type="text" name="morada" id="morada" value="<?php echo $user['morada'] ?>" required>
        <label for="telemovel">Nº Telemóvel:</label>
        <input type="tel" id="nr_telemovel" name="nr_telemovel" value="<?php echo $user['nr_telemovel'] ?>" required>
        <label for="nr_cartao">Nº Cartão de Crédito/Débito:</label>
        <input type="text" name="nr_cartao" id="nr_cartao" value="<?php echo  $user['nr_cartao'] ?>" required>

        <label for="password">Confirme a Password:</label>
        <input type="password" name="password" id="password" required>


    </div>
    <input type="submit" class="button" value="Alterar">
</form>