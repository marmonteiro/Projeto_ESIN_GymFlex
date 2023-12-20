<div id="alteracao_plano">
    <h1>Alteração de Plano</h1>
    <p>O seu plano atual é o <span class=bold >Plano
        <?php echo $user['tipo_p']; ?></span>.
    </p>
    <p>Para qual plano deseja mudar?</p>

    <form action="action_alteracao_plano.php" method="post">
        
        <select name="tipo_p" id="tipo_plano" required>
            <option value="" selected>Selecione um plano</option>
            <?php foreach ($tipo_p_info as $plano) { ?>
                <?php $selected = (isset($_GET['plano_sel']) && $_GET['plano_sel'] === $plano['nome']) ? 'selected' : ''; ?>
                <option value="<?php echo $plano['nome']; ?>"<?php echo $selected; ?>>
                    Plano <?php echo $plano['nome'] . ' - ' . $plano['preco'] . '€'; ?>
                </option>
            <?php } ?>
        </select>
        <p>Não se esqueça que não poderá alterar o seu plano durante os primeiros 2 meses.</p>
        <input type="submit" value="Alterar">
    </form>

</div>