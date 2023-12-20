<!-- Mostra os ginásios disponíveis -->

<section id="inscricao_ag">
    <h1>Inscrição em Aulas de Grupo</h1>

    <?php if ($_SESSION["disponiveis_ag"] > 1) { ?>
        <p id="intro">Tem direito a mais
            <?php echo $_SESSION["disponiveis_ag"] ?> aulas de grupo este mês.
        </p>
    <?php } elseif ($_SESSION["disponiveis_ag"] == 1) { ?>
        <p>Tem direito a mais 1 aula de grupo este mês.</p>
    <?php } ?>

    <?php if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) { ?>
        <p id="msg_erro">
            <?php echo $_SESSION['msg'] ?>
        </p>
        <?php unset($_SESSION['msg']);
    } ?>


    <form method="post" action="inscricao_ag.php">
        <label for="ginasio">Escolhe o clube mais perto de ti:</label>
        <select id='ginasio' name='ginasio'>

            <?php
            if (isset($ginasios) && !empty($ginasios)) {
                foreach ($ginasios as $ginasio) {
                    $nome_ginasio = $ginasio['nome'];
                    $id_ginasio = $ginasio['id'];
                    $selected = (isset($_POST['ginasio']) && $_POST['ginasio'] == $id_ginasio) ? 'selected' : '';
                    echo "<option value='$id_ginasio' $selected>$nome_ginasio</option>";
                }
            }
            ?>
        </select>
        <input type="submit" value="Selecionar" class="button">
    </form>



    <!-- Mostrar aulas disponíveis de acordo com o ginásio escolhido -->
    <?php
    $ginasio = $_POST['ginasio'];
    $aulasDisponiveis = fetchAGByGinasio($ginasio);

    if (isset($aulasDisponiveis) && !empty($aulasDisponiveis)) { ?>
        <h2>Aulas Disponíveis</h2>
        <ul>
            <?php foreach ($aulasDisponiveis as $aula) {
                if (strtotime($aula['data']) > time()) { ?> <!-- apenas mostra as aulas que ainda não aconteceram -->
                    <li>
                        <form method="post" action="action_inscricao_ag.php">
                            <input type="hidden" name="aula_id" value="<?php echo $aula['id']; ?>">
                            <h3>
                                <?php echo $aula['nome_tipo']; ?>
                            </h3>
                            <p>Dia:
                                <?php echo $aula['data'] . ' (' . $aula['dia_semana'] . ')'; ?>
                            </p>
                            <p>Hora:
                                <?php echo $aula['hora_inicio'] . ' - ' . $aula['hora_fim']; ?>
                            </p>
                            <?php if ($aula['capacidade_tipo'] - $aula['qntd_membros'] > 0) { ?>
                                <p>Vagas Disponíveis:
                                    <?php echo $aula['capacidade_tipo'] - $aula['qntd_membros']; ?>
                                </p>
                                <input type="submit" value="Inscrever">
                            <?php } else { ?>
                                <p>Não há mais vagas disponíveis.</p>
                            <?php } ?>
                        </form>
                    </li>
                <?php }
            } ?>
        </ul>
    <?php } ?>


</section>