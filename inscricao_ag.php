<?php
session_start();

$msg = $_SESSION['msg'];
unset($_SESSION['msg']);

$gym = $_POST['gym'];

function fetchInscricoesInfoByEmail($email)
{
    global $dbh;
    $stmt = $dbh->prepare('
    SELECT Membro.inscricoes_ag, Plano.data_adesao, Tipo_p.quantidade_ag
    FROM Membro
    INNER JOIN Pessoa ON Membro.id = Pessoa.id
    INNER JOIN Plano ON Plano.membro = Pessoa.id
    INNER JOIN Tipo_p ON Tipo_p.nome = Plano.tipo_p
    WHERE Pessoa.email = ?
    
');

    $stmt->execute(array($_SESSION['email']));
    $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);
    return $userDetails;
}

function fetchAGInfoByGym($gym)
{
    global $dbh;
    $stmt = $dbh->prepare('
    SELECT Aula_grupo.nome, Aula_grupo.hora, Aula_grupo.dia, Aula_grupo.duracao, Aula_grupo.limite, Aula_grupo.ginasio
    FROM Aula_grupo
    WHERE Aula_grupo.ginasio = ?
    ');

    $stmt->execute(array($gym));
    $gymInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    return $gymInfo;

}

try {
    $dbh = new PDO('sqlite:sql/gym_flex.db', $email, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($_SESSION['email'])) {
        header('Location: login.php'); // Redirect to login if not logged in
        exit();
    }

    $userDetails = fetchInscricoesInfoByEmail($_SESSION['email']);
    $inscricoes_ag = $userDetails['inscricoes_ag'];
    $data_adesao = $userDetails['data_adesao'];
    $quantidade_ag = $userDetails['quantidade_ag'];




} catch (PDOException $e) {
    //  connection errors
    echo "Connection failed: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
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
    </header>


    <section id="incricao_ag">
        <h1>Inscrição em Aulas de Grupo</h1>
        <p>Pode-se inscrever em mais
            <?php echo ($quantidade_ag - $inscricoes_ag) ?> aulas de grupo este mês.
        </p>

        <!-- Selecionar ginásio -->
        <form method="post" action="inscricao_ag.php">
            <label for="gym">Escolhe o clube mais perto de ti:</label>
            <select name="gym" id="gym">
                <option value="Porto">Porto</option>
                <option value="Amarante">Amarante</option>
                <option value="Madeira">Lisboa</option>
            </select>
            <input type="submit">
        </form>

        


</body>

</html>