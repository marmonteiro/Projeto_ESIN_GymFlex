<h3>Alteração de Dados</h3>
<p>Altere os dados que deseja e clique em "Alterar".</p>
<form action="action_alteracao_dados.php" method="post">
    
    <div id="alteracao_dados">
            
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?php echo $nome ?>" required>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo $email ?>" required>
                <label for="nif">NIF:</label>
                <input type="text" name="nif" id="nif" value="<?php echo $nif ?>" required>
                <label for="altura">Altura (cm):</label>
                <input type="number" name="altura" id="altura" value="<?php echo $altura ?>" required>
                <label for="peso">Peso (kg):</label>
                <input type="number" name="peso" id="peso" value="<?php echo $peso ?>" required>
                <label for="morada">Morada:</label>
                <input type="text" name="morada" id="morada" value="<?php echo $morada ?>" required>
                <label for="telemovel">Nº Telemóvel:</label>
                <input type="text" name="telemovel" id="telemovel" value="<?php echo $telemovel ?>" required>
                
            
    </div>
    <input type="submit" value="Alterar">
</form>