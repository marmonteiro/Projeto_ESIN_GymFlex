<?php
require_once("database/init.php");
session_start();

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

try {
$dbh->beginTransaction();
$tipo_p = $_POST['tipo_p'];
$membro_id = $_SESSION['id'];

//Verifica se alteração é permitida
$user = fetchPlanoMembroByMembroID($membro_id);
$ha2Meses = date('Y-m-d', strtotime('-2 months'));
$alteracaoPermitida = strtotime($user['data_adesao']) <= strtotime($ha2Meses);
if (!$alteracaoPermitida) {
    header('Location: area_cliente.php');
    exit();
}

// Adiciona nova entrada na tabela Plano
$currentTimestamp = date('Y-m-d');

$stmt = $dbh->prepare('INSERT INTO Plano (membro, tipo_p, data_adesao) VALUES (?, ?, ?)');
$stmt->execute(array($membro_id, $tipo_p, $currentTimestamp));

$dbh->commit();


} catch (PDOException $e) {
    $_SESSION['msg'] = 'Erro: ' . $e->getMessage();
}

header('Location: area_cliente.php');
exit();

?>
