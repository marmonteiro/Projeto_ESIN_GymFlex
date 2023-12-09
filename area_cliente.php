<?php
require_once("database/init.php");
session_start();

try {
    function fetchQuantidadeAGByEmail($email)
    { //quantidade_ag do ultimo plano
        global $dbh;
        $stmt = $dbh->prepare('
        SELECT Tipo_p.quantidade_ag
        FROM Plano
        INNER JOIN Membro ON Plano.membro = Membro.id
        INNER JOIN Tipo_p ON Plano.tipo_p = Tipo_p.nome
        INNER JOIN Pessoa ON Membro.id = Pessoa.id
        WHERE Pessoa.email = ?
        ORDER BY Plano.data_adesao DESC
        LIMIT 1
    ');
        $stmt->execute(array($email));
        $quantidade_ag = $stmt->fetchColumn();
        return $quantidade_ag;
    }

    function fetchInscricoesAGByEmail($email) //inscricoes_ag (do mes atual)
    {
        global $dbh;
        $stmt = $dbh->prepare('
        SELECT COUNT(Inscricao_ag.id) AS inscricoes_ag
        FROM Inscricao_ag
        INNER JOIN Membro ON Inscricao_ag.membro = Membro.id
        INNER JOIN Pessoa ON Membro.id = Pessoa.id
        INNER JOIN Aulagrupo ON Inscricao_ag.aulagrupo = Aulagrupo.id
        WHERE Pessoa.email = ?
        AND strftime("%Y-%m", Aulagrupo.data) = strftime("%Y-%m", "now")
    ');

        $stmt->execute(array($_SESSION['email']));
        $inscricoes_ag = $stmt->fetchColumn();
        return $inscricoes_ag;
    }


    global $dbh;
    if (!isset($_SESSION['email'])) {
        header('Location: login.php'); // Redirect to login if not logged in
        exit();
    }

    function fetchDetalhesMembroByEmail($email)
    {
        global $dbh;
        $stmt = $dbh->prepare('
        SELECT Pessoa.nome, Pessoa.data_nascimento, Pessoa.nr_telemovel, Pessoa.email, Pessoa.morada, Pessoa.nif,
            Membro.altura, Membro.peso, Membro.imc, Membro.nutricionista, Membro.personaltrainer, Membro.sexo,
            Plano.data_adesao, Plano.tipo_p
        FROM Pessoa
        INNER JOIN Membro ON Membro.id = Pessoa.id
        LEFT JOIN Plano ON Plano.membro = Membro.id
        WHERE Pessoa.email = ?
        AND Plano.id = (
            SELECT MAX(id)
            FROM Plano
            WHERE Plano.membro = Membro.id
        )
    ');
        $stmt->execute(array($email));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    };

    $user = fetchDetalhesMembroByEmail($_SESSION['email']);

    $nome = $user['nome'];
    $data_nascimento = $user['data_nascimento'];
    $nr_telemovel = $user['nr_telemovel'];
    $morada = $user['morada'];
    $nif = $user['nif'];
    $altura = $user['altura'];
    $peso = $user['peso'];
    $imc = $user['imc'];
    $sexo = $user['sexo'];
    $tipo_plano = $user['tipo_p']; //tipo de plano atual
    $data_adesao = $user['data_adesao']; //ultima data de adesao
    $nutricionista_id = $user['nutricionista'];
    $personaltrainer_id = $user['personaltrainer'];
    $idade = date_diff(date_create($data_nascimento), date_create('today'))->y; // calcula a idade

    // vai buscar os nomes do nutricionista e do personal trainer
    $stmtNutricionista = $dbh->prepare('SELECT nome FROM Pessoa WHERE id = ?');
    $stmtPersonalTrainer = $dbh->prepare('SELECT nome FROM Pessoa WHERE id = ?');
    $stmtNutricionista->execute([$nutricionista_id]);
    $stmtPersonalTrainer->execute([$personaltrainer_id]);
    $nutricionista_nome = $stmtNutricionista->fetchColumn();
    $personaltrainer_nome = $stmtPersonalTrainer->fetchColumn();

    //calculo da proxima prestação
    $data_atual = time();
    $data_adesao_form = strtotime($data_adesao);
    $dia_adesao = date('d', $data_adesao_form); // dia da data de adesão
    $prox_pagam_form = strtotime("next month", $data_atual);
    $mes_proxpagam = date('m', $prox_pagam_form); // mês da próxima prestação
    $ano_proxpagam = date('Y', $prox_pagam_form); // ano da próxima prestação
    $prox_pagam = $ano_proxpagam . '-' . $mes_proxpagam . '-' . $dia_adesao;

    //calculo da quantidade de aulas de grupo disponiveis
    $quantidade_ag = fetchQuantidadeAGByEmail($_SESSION['email']);
    $inscricoes_ag = fetchInscricoesAGByEmail($_SESSION['email']);
    $disponiveis_ag = $quantidade_ag - $inscricoes_ag;
    $_SESSION['disponiveis_ag'] = $disponiveis_ag;

    //verifica se o membro pode alterar o plano (se já passaram 5 meses desde a adesão)
    $ha2Meses = date('Y-m-d', strtotime('-2 months'));
    $alteracaoPermitida = strtotime($data_adesao) <= strtotime($ha2Meses);


} catch (PDOException $e) {
    //  connection errors
    echo "Connection failed: " . $e->getMessage();
}
include("templates/header_ajuda_tpl.php");
?>


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

</section>