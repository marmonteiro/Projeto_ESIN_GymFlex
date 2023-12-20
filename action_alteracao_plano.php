<?php
session_start();
require_once("database/init.php");
require_once("database/registo.php");
require_once("database/login.php");
require_once ("database/alteracao_plano.php");

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

if ($tipo_p === 'Intermédio' || $tipo_p === 'Avançado') {
    // Dá o PT com menos clientes ao novo membro se o plano for Intermédio ou Avançado
    $atrPT = assignPT($dbh);

    // Update da tabela Membro com o PT
    $stmtPT = $dbh->prepare('UPDATE Membro SET personaltrainer = ? WHERE id = ?');
    $stmtPT->execute(array($atrPT, $_SESSION['id']));
}

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
