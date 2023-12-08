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

    $stmt = $dbh->prepare('
    SELECT Pessoa.nome, Pessoa.data_nascimento, Pessoa.nr_telemovel, Pessoa.email, Pessoa.morada, Pessoa.nif,
        Membro.altura, Membro.peso, Membro.imc, Membro.nutricionista, Membro.personaltrainer, Membro.sexo,
        Plano.data_adesao, Plano.tipo_p
        FROM Pessoa
        INNER JOIN Membro ON Membro.id = Pessoa.id
        INNER JOIN Plano ON Plano.membro = Pessoa.id
        WHERE Pessoa.email = ?
    ');
    $stmt->execute(array($_SESSION['email']));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $nome = $user['nome'];
    $data_nascimento = $user['data_nascimento'];
    $nr_telemovel = $user['nr_telemovel'];
    $morada = $user['morada'];
    $nif = $user['nif'];
    $altura = $user['altura'];
    $peso = $user['peso'];
    $imc = $user['imc'];
    $sexo = $user['sexo'];
    $tipo_plano = $user['tipo_p'];
    $data_adesao = $user['data_adesao'];
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


} catch (PDOException $e) {
    //  connection errors
    echo "Connection failed: " . $e->getMessage();
}
include("templates/header_ajuda_tpl.php");
?>

<!-- <!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymFlex</title>
    <link rel="icon" href="imagens/gymflex_logo_head.svg">
    <link rel="stylesheet" href="css/estetica.css">
</head>

<body>

    <header>
        <a href="paginicial.php">
            <img id="logo" src="imagens/gymflex_logo.svg" alt="Logotipo">
        </a>

        <div class="barra">
            <a href="clubes.php" class="clubes">Clubes</a>
            <a href="planos.php" class="planos">Planos</a>
            <a href="aulasgrupo.php" class="info">Aulas de Grupo</a>
            <a href="ajuda.php" class="ajuda">Ajuda</a>
        </div>

        <?php if (isset($_SESSION['email'])) { ?>
            <a href="action_logout.php" class="button">Logout</a>
        <?php } else { ?>
            <a href="registo.php" class="inscreva-se">Inscreva-se</a>
            <a href="login.php" id="signup">Login: área de cliente</a>
        <?php } ?>
    </header> --> 

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
            <button id='alteração_plano'>Alterar Plano</button>
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