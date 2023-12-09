<?php
include("database/init.php");
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

function fetchPlanoMembroByMembroID($id) //vai buscar o plano atual do membro (data_adesao, tipo_p, preco)
{
    global $dbh;
    $stmt = $dbh->prepare('
    SELECT Plano.data_adesao, Plano.tipo_p, Tipo_p.preco
    FROM Plano
    INNER JOIN Tipo_p ON Plano.tipo_p = Tipo_p.nome
    WHERE Plano.membro = ?
    ORDER BY Plano.data_adesao DESC
    LIMIT 1
');
    $stmt->execute(array($id));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}
;


function fetchInfoTipoPlanosdif($planoAtual) //vai buscar os tipos de planos disponiveis (nome, preco) exceto o plano atual
{
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM Tipo_p WHERE nome != ?');
    $stmt->execute(array($planoAtual));
    $tipo_p_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $tipo_p_info;
}
;


try {

    $user = fetchPlanoMembroByMembroID($_SESSION['id']);

    $tipo_p_info = fetchInfoTipoPlanosdif($user['tipo_p']);

    $ha2Meses = date('Y-m-d', strtotime('-2 months'));
    $alteracaoPermitida = strtotime($user['data_adesao']) <= strtotime($ha2Meses);

    if (!$alteracaoPermitida) {
        header('Location: area_cliente.php');
        exit();
    }



} catch (PDOException $e) {
    $_SESSION['msg'] = 'Erro: ' . $e->getMessage();
}
include("templates/headerpaginicial_tpl.php");
?>

<div>
    <h1>Alteração de Plano</h1>
    <p>O teu plano atual é o Plano
        <?php echo $user['tipo_p']; ?>.
    </p>
    <p>Para qual plano desejas mudar?</p>

    <form action="action_alteracao_plano.php" method="post">
        <label for="tipo_p">Tipo de Plano</label>
        <select name="tipo_p" id="tipo_p" required>
            <option value="" selected>Selecione um plano</option>
            <?php foreach ($tipo_p_info as $plano) { ?>
                <option value="<?php echo $plano['nome']; ?>">
                    <?php echo $plano['nome'] . " - " . $plano['preco'] . "€"; ?>
                </option>
            <?php } ?>
        </select>
        <p>Não te esqueças que não poderás mudar o teu plano durante os primeiros 2 meses.</p>
        <input type="submit" value="Alterar">
    </form>

</div>