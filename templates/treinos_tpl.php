<form id="select_ano" action="treinos.php" method="GET">
    <h2>Registo de Treinos de
        <select id="ano" name="ano">
            <?php foreach ($anos as $ano) { ?>
                <option value="<?php echo $ano; ?>" <?php if ($ano == $ano_sel)
                       echo 'selected'; ?>>
                    <?php echo $ano; ?>
                </option>
            <?php } ?>
        </select>
        <input type="submit" value="Filtrar">
    </h2>
</form>
<div id="registo_treinos">
    <div id="meses">
        <?php foreach ($meses as $mes_num => $mes_nome) { ?>
            <p><a href='treinos.php?ano=<?php echo $_GET["ano"] ?>&mes=<?php echo $mes_num ?>'>
                    <?php echo $mes_nome ?>
                </a></p>
        <?php } ?>
    </div>

    <div>
        <?php
        $nome_mes_sel = $meses[$mes_sel]; ?>

        <h3> Registo de Treinos de
            <?php echo $nome_mes_sel ?>
        </h3>

        <div id="treinos_mes">
            <?php if (isset($treinos_por_mes[$mes_sel])) {
                foreach ($treinos_por_mes[$mes_sel] as $treino) { ?>
                    <details id="treino">
                        <summary>
                            <?php echo $treino['data'] ?>
                        </summary>
                        <p data-label="Entrada: ">
                            <?php echo $treino['hora_entrada'] ?>
                        </p>
                        <p data-label="Saída: ">
                            <?php echo $treino['hora_saida'] ?>
                        </p>
                        <p data-label="Duração: ">
                            <?php echo $treino['duracao_t'] ?> hr
                        </p>
                        <p>
                            <?php echo $treino['nome_ginasio'] ?>
                        </p>
                    </details>
                <?php }
            } else { ?>
                <p>Não há treinos registrados para este mês.</p>
            <?php } ?>
        </div>

    </div>

</div>