<section id="Area_Cliente">
    <h1>Área de Cliente</h1>

    <?php if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
        echo "<p>{$_SESSION['msg']}</p>";
        unset($_SESSION['msg']);
    } ?>

    <h2>
        <?php
        if ($sexo === 'F') {
            echo "Bem-vinda, " . $nome;
        } elseif ($sexo === 'M') {
            echo "Bem-vindo, " . $nome;
        } else {
            echo "Bem-vind@, " . $nome;
        }
        ?>
    </h2>

    <div id="dados_pessoais">
        <h3>Dados Pessoais</h3>
        <p>Nome:
            <?php echo $nome ?>
        </p>
        <p>Data de Nascimento:
            <?php echo $data_nascimento ?>
        </p>
        <p>Nº Telemóvel:
            <?php echo $nr_telemovel ?>
        </p>
        <p>Morada:
            <?php echo $morada ?>
        </p>
        <p>NIF:
            <?php echo $nif ?>
        </p>
    </div>

    <div id="dados_fisicos">
        <h3>Dados Físicos</h3>
        <p>Idade:
            <?php echo $idade ?> anos
        </p>
        <p>Altura:
            <?php echo $altura / 100 ?> m
        </p>
        <p>Peso:
            <?php echo $peso ?> kg
        </p>
        <p>IMC:
            <?php printf("%.1f", $imc) ?>
        </p>
    </div>

    <div id="dados_plano">
        <h3>Dados do Plano</h3>
        <p>Tipo de Plano:
            <?php echo $tipo_plano ?>
        </p>
        <p>Próxima Prestação:
            <?php echo $prox_pagam ?>
        </p>
        <p>Data de Adesão:
            <?php echo $data_adesao ?>
        </p>
        <p>Nutricionista:
            <?php echo $nutricionista_nome ?>
        </p>
        <p>Personal Trainer:
            <?php echo $personaltrainer_nome ?>
        </p>
    </div>

    <div>
        <?php if ($alteracaoPermitida) { ?>
            <a href="alteracao_plano.php" class="button">Alterar Plano</a>
        <?php } else { ?>
            <p> Só podes alterar o teu plano 2 meses após a última adesão.</p>
        <?php } ?>
    </div>

    <div>
        <a href="cancelamento.php" class="button">Cancelar Subscrição</a>
    </div>


    <div>
        <h3> Inscrições em Aulas de Grupo</h3>
        <div>
            <?php if ($_SESSION['disponiveis_ag'] > 1) { ?>
                <p> Tens direito a mais
                    <?php echo $disponiveis_ag ?> aulas de grupo este mês.
                </p>
                <a href="inscricao_ag.php" class="button">Inscrever em Aulas de Grupo</a>
            <?php } elseif ($_SESSION['disponiveis_ag'] == 1) { ?>
                <p> Tens direito a mais 1 aula de grupo este mês.</p>
                <a href="inscricao_ag.php" class="button">Inscrever em Aulas de Grupo</a>
            <?php } elseif ($_SESSION["disponiveis_ag"] < 1) { ?>
                <p> Não tens direito a mais aulas de grupo este mês.</p>
            <?php } ?>
        </div>
        <p> enumerar inscricoes em aulas de grupo</p>
    </div>

    <div>
        <details>
        <summary>Registo de Treinos</summary>
        <p>Ainda podes treinar mais
            <?php echo $tempo_treino_restante ?> hr este mês nos ginásios GymFlex.
        </p>
        <?php
        foreach ($treinos as $treino) {
            echo "<p>Entrada: " . $treino['hora_entrada'] . "</p>";
            echo "<p>Saída: " . $treino['hora_saida'] . "</p>";
            echo "<p>Duração: " . $treino['duracao_t'] . " hr</p>";
            echo "<p>No ginásio: " . $treino['nome_ginasio'] . "</p>";
            echo "<hr>";
        }
        ?>
        </details>
    </div>

    


</section>