<?php if (empty($inscricoes_ag)) { ?>
    <div class=empty>
        <h2>Ainda não possui aulas de grupo associadas à sua conta GymFlex.</h2>
        <a href="inscricao_ag.php" class="button">
            <div id="botao_icon"> <img src="imagens/icons/plus_icon.png">Inscrever em Aulas de Grupo
            </div>
        </a>
        <a href="area_cliente.php" class="button">
            <div id="botao_icon"> <img src="imagens/icons/area_cliente.png">Voltar à Área de Cliente
            </div>
        </a>
    </div>
<?php } else { ?>

    <form id="select_ano" action="minhas_ag.php" method="GET">
        <div id="filtrar_ano_titulo">
            <h2>Inscrição em Aulas de Grupo de
                <select id="ano" name="ano">
                    <?php foreach ($anos_inscricoes as $ano) { ?>
                        <option value="<?php echo $ano; ?>" <?php if ($ano == $ano_sel)
                               echo 'selected'; ?>>
                            <?php echo $ano; ?>
                        </option>
                    <?php } ?>
                </select>
                <button type="submit" class="button_submit" name="submit">
                    <span>Filtrar</span>
                    <img src="imagens/icons/filter_icon.png" alt="Filtrar">
                </button>
            </h2>
        </div>
    </form>

    <div id="resgisto_t_ag">
        <div id="meses">
            <?php foreach ($meses as $mes_num => $mes_nome) { ?>
                <p><a href='minhas_ag.php?ano=<?php echo $_GET["ano"] ?>&mes=<?php echo $mes_num ?>'>
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

                <h3> Inscrições em Aulas de Grupo de
                    <?php echo $nome_mes_sel ?>
                </h3>

                <div id="treinos_ag_mes">
                    <?php if (isset($inscricoes_por_mes[$mes_sel])) {
                        usort($inscricoes_por_mes[$mes_sel], 'compareDates'); //organiza cronologicamente
            
                        foreach ($inscricoes_por_mes[$mes_sel] as $inscricao) {
                            $isPastEvent = $inscricao['data'] < date('Y-m-d');
                            $class = $isPastEvent ? 'ocorrida' : ''; // Applica classe se aula já ocorreu
                            ?>

                            <details class="treino_ag" id="<? echo $class ?>">
                                <summary>
                                    <?php echo $inscricao['tipo_ag'] ?> (
                                    <?php echo $inscricao['data'] ?> )
                                </summary>
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
                                    <?php echo $inscricao['nome_ginasio'] ?>
                                </p>

                                <?php if ($inscricao['data'] > date('Y-m-d')) { ?>
                                    <form action="action_cancelar_ag.php" method="POST">
                                        <input type="hidden" name="inscricao_id" value="<?php echo $inscricao['id'] ?>">
                                        <button type="submit" class="button_submit" name="submit" value="Inscrever">
                                            <img src="imagens/icons/minus_icon.png" alt="Filtrar">
                                            <span>Cancelar Inscrição</span>
                                        </button>
                                    </form>

                                <?php } ?>
                            </details>
                        <? }
                    } else { ?>
                        <p>Não se inscreveu em Aulas de Grupo este mês.</p>
                    <?php } ?>
                </div>

            </div>
        <? } ?>


    </div>
<? } ?>