<?php ?>

<form id="select_ano" action="minhas_ag.php" method="GET">
    <h2>Inscrição em Aulas de Grupo de
        <select id="ano" name="ano">
            <?php foreach ($anos_inscricoes as $ano) { ?>
                <option value="<?php echo $ano; ?>" <?php if ($ano == $ano_sel)
                       echo 'selected'; ?>>
                    <?php echo $ano; ?>
                </option>
            <?php } ?>
        </select>
        <input type="submit" value="Filtrar">
    </h2>
</form>
<div id="resgisto_t_ag">
    <div id="meses">
        <?php foreach ($meses as $mes_num => $mes_nome) { ?>
            <p><a href='minhas_ag.php?ano=<?php echo $_GET["ano"] ?>&mes=<?php echo $mes_num ?>'>
                    <?php echo $mes_nome ?>
                </a></p>
        <?php } ?>
    </div>

    <div>
        <?php
        $nome_mes_sel = $meses[$mes_sel]; ?>

        <h3> Inscrições em Aulas de Grupo de
            <?php echo $nome_mes_sel ?>
        </h3>

        <div id="treinos_ag_mes">
            <?php if (isset($inscricoes_por_mes[$mes_sel])) {
                foreach ($inscricoes_por_mes[$mes_sel] as $inscricao) { ?>
                    <details id="treino_ag">
                        <summary>
                            <?php echo $inscricao['tipo_ag'] ?>
                        </summary>
                        <p>
                            <?php echo $inscricao['data'] ?>
                        </p>
                        <p data-label="Início: ">
                            <?php echo $inscricao['hora_inicio'] ?>
                        </p>
                        <p data-label="Fim: ">
                            <?php echo $inscricao['hora_fim'] ?>
                        </p>
                        <p data-label="Duração: ">
                            <?php echo $inscricao['duracao_ag'] ?> hr
                        </p>
                        <p>
                            <?php echo $treino['nome_ginasio'] ?>
                        </p>

                        <?php if ($inscricao['data']>date('Y-m-d')) { ?>
                            <form action="action_cancelar_ag.php" method="POST">
                                <input type="hidden" name="inscricao_id" value="<?php echo $inscricao['id'] ?>">
                                <input type="submit" value="Cancelar Inscrição">
                            </form>
                    </details>
                <?php } } 
            } else { ?>
                <p>Não se inscreveu em Aulas de Grupo este mês.</p>
            <?php } ?>
        </div>

    </div>

</div>