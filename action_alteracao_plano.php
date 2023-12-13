<?php
session_start();
require_once("database/init.php");

include ("database/action_alteracao_plano.php");

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
