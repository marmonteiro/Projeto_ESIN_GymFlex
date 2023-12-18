<?php 

try {

$dbh->beginTransaction();

$stmt = $dbh->prepare('UPDATE Pessoa SET nome = ?, morada = ?, nr_telemovel = ? WHERE id = ?');
$stmt->execute([$_POST['nome'], $_POST['morada'], $_POST['nr_telemovel'], $_SESSION['id']]);

$stmt = $dbh->prepare('UPDATE Membro SET altura = ?, peso = ?, nr_cartao = ?  WHERE id = ?');
$stmt->execute([$_POST['altura'], $_POST['peso'], $_POST['nr_cartao'], $_SESSION['id']]);

//update imc caso altura ou peso sejam alterados
$stmt = $dbh->prepare('UPDATE Membro SET imc = peso / (altura * altura) WHERE id = ?');
$stmt->execute([$_SESSION['id']]);

$dbh->commit();
header('Location: ../area_cliente.php');
exit();

} catch (PDOException $e) {
    $_SESSION['msg'] = 'Erro: ' . $e->getMessage();
}


exit();

?>