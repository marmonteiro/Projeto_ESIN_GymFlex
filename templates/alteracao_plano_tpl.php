<div>
    <h1>Alteração de Plano</h1>
    <p>O teu plano atual é o Plano
        <?php echo $user['tipo_p']; ?>.
    </p>
    <p>Para qual plano desejas mudar?</p>

    <form action="action_alteracao_plano.php" method="post">
        <label for="tipo_p">Tipo de Plano</label>
        <select name="tipo_p" id="tipo_p" required>
            <option value="" selected>Selecione um plano</option>
            <?php foreach ($tipo_p_info as $plano) { ?>
                <option value="<?php echo $plano['nome']; ?>">
                    <?php echo $plano['nome'] . " - " . $plano['preco'] . "€"; ?>
                </option>
            <?php } ?>
        </select>
        <p>Não te esqueças que não poderás mudar o teu plano durante os primeiros 2 meses.</p>
        <input type="submit" value="Alterar">
    </form>

</div>