<?php if (empty($treinos)) { ?>
    <div class=empty>
        <h2>Ainda não possui treinos associados à sua conta GymFlex.</h2>
        <a href="area_cliente.php" class="button">
            <div id="botao_icon"> <img src="imagens/icons/area_cliente.png">Voltar à Área de Cliente
            </div>
        </a>
    </div>
<?php } else { ?>

    <form id="select_ano" action="treinos.php" method="GET">
        <div id="filtrar_ano_titulo">
            <h2>Registo de Treinos de
                <select id="ano" name="ano">
                    <?php foreach ($anos_treinos as $ano) { ?>
                        <option value="<?php echo $ano; ?>" <?php if ($ano == $ano_sel)
                               echo 'selected'; ?>>
                            <?php echo $ano; ?>
                        </option>
                    <?php } ?>
                </select>
                <button type="submit" class="button_submit" name="submit">
                    Filtrar
                    <img src="imagens/icons/filter_icon.png" alt="Filtrar">
                </button>
            </h2>
        </div>
    </form>

    <div id="resgisto_t_ag">
        <div id="meses">
            <?php foreach ($meses as $mes_num => $mes_nome) { ?>
                <p><a href='treinos.php?ano=<?php echo $_GET["ano"] ?>&mes=<?php echo $mes_num ?>'>
                        <?php echo $mes_nome ?>
                    </a></p>
            <?php } ?>
        </div>

        <?php if ((!isset($_GET['ano']))) { ?>
            <p>Por favor selecione um ano</p>
        <?php } elseif (isset($_GET['ano']) && (!isset($mes_sel))) { ?>
            <p>Por favor selecione um mês</p>
        <?php } else { ?>


            <div>
                <?php
                $nome_mes_sel = $meses[$mes_sel]; ?>

                <h3> Registo de Treinos de
                    <?php echo $nome_mes_sel ?>
                </h3>

                <div id="treinos_ag_mes">
                    <?php if (isset($treinos_por_mes[$mes_sel])) {
                        usort($treinos_por_mes[$mes_sel], 'compareDates'); //organiza cronologicamente
                        foreach ($treinos_por_mes[$mes_sel] as $treino) { ?>
                            <details class="treino_ag" id="ocorrida">
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
        <? } ?>

    </div>

<? } ?>