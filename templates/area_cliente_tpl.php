<section id="Area_Cliente">
    <h1>Área de Cliente</h1>

    <?php if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) { ?>
        <p id="msg_erro">
            <?php echo $_SESSION['msg'] ?>
        </p>
        <?php unset($_SESSION['msg']);
    } ?>

    <h2>
        <?php
        if ($sexo === 'F') {
            echo "Bem-vinda, " . $nome;
        } elseif ($sexo === 'M') {
            echo "Bem-vindo, " . $nome;
        }
        ?>
    </h2>


    <div id="dados_pessoais">
        <h3>Dados Pessoais</h3>
        <div id="info_dados_pessoais">
            <div id="esquerda">
                <img src="imagens/membros/<?php echo $_SESSION['id'] ?>.png">
                <p data-label="Nome: ">
                    <?php echo $nome ?>
                </p>
                <p data-label="E-mail: ">
                    <?php echo $_SESSION["email"] ?>
                </p>
                <p data-label="Data de Nascimento: ">
                    <?php echo $data_nascimento ?>
                </p>
                <p data-label="Nº Telemóvel: ">
                    <?php echo $nr_telemovel ?>
                </p>
                <p data-label="Morada: ">
                    <?php echo $morada ?>
                </p>
                <p data-label="NIF: ">
                    <?php echo $nif ?>
                </p>
            </div>
            <div id="direita">
                <div id="alterar_dados">
                    <a href="alteracao_foto.php" class="button">Alterar Foto</a>
                    <a href="alteracao_dados.php" class="button">Alterar Dados</a>
                    <a href="editar-pass.php" class="button filled-button button-submit" type="button">Editar Senha</a>
                </div>
                <div id="dados_fisicos">
                    <p data-label="Idade: ">
                        <?php echo $idade ?> anos
                    </p>
                    <p data-label="Altura: ">
                        <?php echo $altura / 100 ?> m
                    </p>
                    <p data-label="Peso: ">
                        <?php echo $peso ?> kg
                    </p>
                    <p data-label="IMC: ">
                        <?php printf("%.1f", $imc) ?> %
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div id="dados_plano">
        <h3>O seu Plano GymFlex</h3>
        <p data-label="Tipo de Plano: ">
            <?php echo $tipo_plano ?>
        </p>
        <p data-label="Próxima Prestação: ">
            <?php echo $prox_pagam ?>
        </p>
        <p data-label="Data de Adesão: ">
            <?php echo $data_adesao ?>
        </p>
        <p data-label="Nutricionista: ">
            <?php echo $nutricionista_nome ?>
        </p>
        <p data-label="Personal Trainer: ">
            <?php echo $personaltrainer_nome ?>
        </p>

        <div>
            <?php if ($alteracaoPermitida) { ?>
                <a href="alteracao_plano.php" class="button">Alterar Plano</a>
            <?php } else { ?>
                <p">Só pode alterar o seu plano 2 meses após a última adesão.</p>
                <?php } ?>
        </div>
        <div>
            <a href="cancelamento.php" class="button">Cancelar Subscrição</a>
        </div>
    </div>

    <div id="insc_aulas_grupo">
        <h3> Inscrições em Aulas de Grupo </h3> 
        <div>
            <?php if ($_SESSION['disponiveis_ag'] > 1) { ?>
                <p>
                    Tens direito a mais
                    <?php echo $disponiveis_ag ?> aulas de grupo este mês.
                </p>
                <a href="inscricao_ag.php" class="button">Inscrever em Aulas de Grupo</a>
            <?php } elseif ($_SESSION['disponiveis_ag'] == 1) { ?>
                <p>
                    Tens direito a mais 1 aula de grupo este mês.
                </p>
                <a href="inscricao_ag.php" class="button">Inscrever em Aulas de Grupo</a>
            <?php } elseif ($_SESSION["disponiveis_ag"] < 1) { ?>
                <p data-label="Aulas de Grupo Disponíveis">
                    Não tens direito a mais aulas de grupo este mês.
                </p>
            <?php } ?>
        </div>
        <div>
        <a href="minhas_ag.php" class="button">As minhas Aulas de Grupo</a>
        </div>
    </div>

    <div id="reg_treinos">
        <h3> Registo de Treinos </h3>
        <div>
            <p>Ainda podes treinar mais
                <?php echo $tempo_treino_restante ?> hr este mês nos ginásios GymFlex.
            </p>
            <div>
                <a href="treinos.php" class="button">Os meus Treinos</a>
            </div>
        </div>
    </div>

</section>
