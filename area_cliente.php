<?php
session_start();
try {
    $dbh = new PDO('sqlite:sql/gymflex.db', $email, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($_SESSION['email'])) {
        header('Location: login.php'); // Redirect to login if not logged in
        exit();
    }

    $stmt = $dbh->prepare('
    SELECT Pessoa.nome, Pessoa.data_nascimento, Pessoa.nr_telemovel, Pessoa.email, Pessoa.morada, Pessoa.nif,
        Membro.altura, Membro.peso, Membro.imc, Membro.nutricionista, Membro.personaltrainer, Membro.inscricoes_ag, Membro.sexo,
        Plano.data_adesao, Plano.tipo_p
        FROM Pessoa
        INNER JOIN Membro ON Membro.id = Pessoa.id
        INNER JOIN Plano ON Plano.membro = Pessoa.id
        WHERE Pessoa.email = ?
    ');
    $stmt->execute(array($_SESSION['email']));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Assuming you have stored these values in your Membro table
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

    // vai buscar os nomes do nutricionista e do personal trainer
    $stmtNutricionista = $dbh->prepare('SELECT nome FROM Pessoa WHERE id = ?');
    $stmtPersonalTrainer = $dbh->prepare('SELECT nome FROM Pessoa WHERE id = ?');

    $stmtNutricionista->execute([$nutricionista_id]);
    $stmtPersonalTrainer->execute([$personaltrainer_id]);

    $nutricionista_nome = $stmtNutricionista->fetchColumn();
    $personaltrainer_nome = $stmtPersonalTrainer->fetchColumn();

    $data_adesao_form = strtotime($data_adesao); // conversão da data de adesão de string para timestamp
    $prox_pagam_form = strtotime('+1 month', $data_adesao_form); // adição de 1 mês à data de adesão
    $prox_pagam = date('Y-m-d', $prox_pagam_form); // conversão da data de pagamento para string

} catch (PDOException $e) {
    //  connection errors
    echo "Connection failed: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymFlex</title>
    <link rel="icon" href="imagens/gymflex_logo_head.svg">
    <link rel="stylesheet" href="login.css">
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
    </header>

    <section id="Area_Cliente">
        <h1>Área de Cliente</h1>

        <h2>
            <?php
            if ($sexo === 'F') {
                echo "Bem-vinda de volta, " . $nome;
            } elseif ($sexo === 'M') {
                echo "Bem-vindo de volta, " . $nome;
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
            <p>Altura:
                <?php echo $altura/100 ?> m
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
            <button id='cancelar_plano'>Cancelar Plano</button>
        </div>

        <div>
            <a href="inscricao_ag.php" class="button">Inscrever em Aulas de Grupo</a>
        </div>




    </section>