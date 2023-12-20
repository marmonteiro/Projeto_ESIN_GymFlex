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
                <img src="imagens/membros/<?php echo $_SESSION['id'] ?>.png" id="profile_pic">
                <p data-label="Nome: ">
                    <?php echo $user['nome'] ?>
                </p>
                <p data-label="E-mail:">
                    <?php echo $_SESSION["email"] ?>
                </p>
                <p data-label="Data de Nascimento: ">
                    <?php echo $user['data_nascimento'] ?>
                </p>
                <p data-label="Nº Telemóvel: ">
                    <?php echo $user['nr_telemovel'] ?>
                </p>
                <p data-label="Morada: ">
                    <?php echo $user['morada'] ?>
                </p>
                <p data-label="NIF: ">
                    <?php echo $user['nif'] ?>
                </p>
            </div>
            <div id="direita">
                <div id="alteracao_dados">

                    <a href="alteracao_foto.php" class="button">
                        <div id=botao_icon>
                            <img src="imagens/foto_icon.png">Alterar Foto
                        </div>
                    </a>
                    <a href="alteracao_dados.php" class="button">
                        <div id=botao_icon>
                            <img src="imagens/edit_icon.png">Alterar Dados
                        </div>
                    </a>
                    <div id=botao_icon>

                        <a href="editar-pass.php" class="button filled-button button-submit" type="button">
                            <div id=botao_icon>
                                <img src="imagens/lock_icon.png">Editar Senha
                            </div>
                        </a>

                    </div>
                </div>
                <div id="dados_fisicos">
                    <p data-label="Idade: ">
                        <?php echo $idade ?> anos
                    </p>
                    <p data-label="Altura: ">
                        <?php echo $user['altura'] / 100 ?> m
                    </p>
                    <p data-label="Peso: ">
                        <?php echo $user['peso'] ?> kg
                    </p>
                    <p data-label="IMC: ">
                        <?php printf("%.1f", $user['imc']) ?> %
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div id="dados_plano">
        <h3>O seu Plano GymFlex</h3>
        <p data-label="Tipo de Plano: ">
            <?php echo $user['tipo_p'] ?>
        </p>
        <p data-label="Próxima Prestação: ">
            <?php echo $prox_pagam ?>
        </p>
        <p data-label="Data de Adesão: ">
            <?php echo $user['data_adesao'] ?>
        </p>
        <p data-label="Nutricionista: ">
            <?php echo $user['nutricionista_nome'] ?>
        </p>
        <p data-label="Personal Trainer: ">
            <?php echo $user['personaltrainer_nome'] ?>
        </p>

        <div>
            <?php if ($alteracaoPermitida) { ?>
                <a href="alteracao_plano.php" class="button">
                    <div id=botao_icon>
                        <img src="imagens/change_icon.png">Alterar Plano
                    </div>
                </a>
            <?php } else { ?>
                <p">Só pode alterar o seu plano 2 meses após a última adesão.</p>
                <?php } ?>
        </div>
        <div>
            <a href="cancelamento.php" class="button">
                <div id="botao_icon">
                    <img src="imagens/x_icon.png">
                    Cancelar Subscrição
                </div>
            </a>
        </div>
    </div>

    <div id="insc_aulas_grupo">
        <h3> Inscrições em Aulas de Grupo </h3>
        <div>
            <?php if ($_SESSION['disponiveis_ag'] > 1) { ?>
                <p>
                    Tem direito a mais
                    <span class=bold><?php echo $disponiveis_ag ?> </span>aulas de grupo este mês.
                </p>
                <a href="inscricao_ag.php" class="button">
                    <div id="botao_icon"> <img src="imagens/plus_icon.png">Inscrever em Aulas de Grupo
                    </div>
                </a>

            <?php } elseif ($_SESSION['disponiveis_ag'] == 1) { ?>
                <p>
                    Tem direito a mais <span class=bold>1</span> aula de grupo este mês.
                </p>
                <a href="inscricao_ag.php" class="button">
                    <div id="botao_icon"> <img src="imagens/plus_icon.png">Inscrever em Aulas de Grupo
                    </div>
                </a>
            <?php } elseif ($_SESSION["disponiveis_ag"] < 1) { ?>
                <p>
                    Não tem direito a mais aulas de grupo este mês.
                </p>
            <?php } ?>
        </div>
        <div>
            <a href="minhas_ag.php" class="button">
                <div id="botao_icon"> <img src="imagens/group_icon.png"> As minhas Aulas de Grupo
                </div>
            </a>
        </div>
    </div>

    <div id="reg_treinos">
        <h3> Registo de Treinos </h3>
        <div>
            <p>Ainda pode treinar mais
                <span class=bold><?php echo $tempo_treino_restante ?></span> hr este mês nos ginásios GymFlex.
            </p>
            <div>
                <a href="treinos.php" class="button">
                    <div id="botao_icon"><img src="imagens/train_icon.png">
                        Os meus Treinos
                    </div>
                </a>
            </div>
        </div>
    </div>

</section>