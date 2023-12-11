<?php
require_once("database/init.php");
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['disponiveis_ag'] == 0) {
    header('Location: area_cliente.php');
    exit();
}


function fetchQuantidadeAGByEmail($email) { //quantidade_ag do ultimo plano
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

function fetchInscricoesAGByEmail($email) //inscricoes_ag (do mês atual)
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


function fetchAGByGinasio($ginasio) //vai buscar as aulas de grupo disponiveis no ginasio escolhido (id, data, qntd_membros, ginasio, tipo_ag, nome_tipo, capacidade_tipo, dia_semana, hora_inicio, hora_fim)
{
    global $dbh;
    $stmt = $dbh->prepare('
    SELECT a.id, a.data, a.qntd_membros, a.ginasio, a.tipo_ag,
           t.nome AS nome_tipo, t.capacidade AS capacidade_tipo,
           t.dia_semana, t.hora_inicio, t.hora_fim
    FROM Aulagrupo a
    INNER JOIN Tipo_ag t ON a.tipo_ag = t.nome
    WHERE a.ginasio = ?
');
    $stmt->execute(array($ginasio));
    $aulasDisponiveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $aulasDisponiveis;
}


try {
    global $dbh;

    if (!isset($_SESSION['email'])) {
        header('Location: login.php'); // Redirect to login if not logged in
        exit();
    }

    //calculo da quantidade de aulas de grupo disponiveis
    $quantidade_ag = fetchQuantidadeAGByEmail($_SESSION['email']);
    $inscricoes_ag = fetchInscricoesAGByEmail($_SESSION['email']);
    $disponiveis_ag = $quantidade_ag - $inscricoes_ag;
    $_SESSION['disponiveis_ag'] = $disponiveis_ag;

    
    //vai buscar todos os ginasios a base de dados
    $stmt = $dbh->prepare('SELECT id, nome FROM Ginasio');
    $stmt->execute();
    $ginasios = $stmt->fetchAll();
    foreach ($ginasios as $ginasio) {
        $nome_ginasio = $ginasio['nome'];
        $id_ginasio = $ginasio['id'];
    }


} catch (PDOException $e) {
    $_SESSION['msg'] = 'Erro: ' . $e->getMessage();
    include("templates/header_clubes_tpl.php");
}

?>

<!--<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymFlex</title>
    <link rel="icon" href="imagens/gymflex_logo_head.svg">
    <link rel="stylesheet" href="">
</head>

<body>
    <header>
        <a href="paginicial.php">
            <img id="logo" src="imagens/gymflex_logo.svg" alt="Logotipo">
        </a>
        <h1>GymFlex: Diferentes clubes em diferentes cidades</h1>

        <div class="barra">
            <a href="clubes.php" class="clubes">Clubes</a>
            <a href="planos.php" class="planos">Planos</a>
            <a href="aulasgrupo.php" class="info">Aulas de Grupo</a>
            <a href="ajuda.php" class="ajuda">Ajuda</a>
        </div>

        <?php if (isset($_SESSION['email'])) { ?>
            <a href="action_logout.php" class="button">Logout</a>
            <a href="area_cliente.php" class="button">Área de Cliente</a>
            <p>Olá,
                <?php echo $_SESSION['nome'] ?>!
            </p>
        <?php } else { ?>
            <a href="registo.php" class="inscreva-se">Inscreva-se</a>
            <a href="login.php" id="signup">Login: área de cliente</a>
        <?php } ?>


    </header> --> 

    <!-- Mostra os ginásios disponíveis -->

    <section id="inscricao_ag">
        <h1>Inscrição em Aulas de Grupo</h1>

        <?php if ($_SESSION["disponiveis_ag"] > 1) { ?>
        <p>Tens direito a mais
            <?php echo $_SESSION["disponiveis_ag"] ?> aulas de grupo este mês.
        </p>
        <?php } elseif ($_SESSION["disponiveis_ag"] == 1) {?>
        <p>Tens direito a mais 1 aula de grupo este mês.</p>
        <?php } ?>

        <?php if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
            echo "<p>{$_SESSION['msg']}</p>";
            unset($_SESSION['msg']);
        } ?>


        <form method="post" action="inscricao_ag.php">
            <label for="ginasio">Escolhe o clube mais perto de ti:</label>
            <select name='ginasio' id='ginasio'>

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
            <input type="submit" value="Selecionar">
        </form>



        <!-- Mostrar aulas disponíveis de acordo com o ginásio escolhido -->
        <?php
        $ginasio = $_POST['ginasio'];
        $aulasDisponiveis = fetchAGByGinasio($ginasio);

        if (isset($aulasDisponiveis) && !empty($aulasDisponiveis)) { ?>
            <h2>Aulas Disponíveis</h2>
            <ul>
                <?php foreach ($aulasDisponiveis as $aula) { ?>
                    <li>
                        <form method="post" action="action_inscricao_ag.php">
                            <input type="hidden" name="aula_id" value="<?php echo $aula['id']; ?>">
                            <p>Tipo de Aula:
                                <?php echo $aula['nome_tipo']; ?>
                            </p>
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
                <?php } ?>
            </ul>
        <?php } ?>


    </section>

</body>

</html>