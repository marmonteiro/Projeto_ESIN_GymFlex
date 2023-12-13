<?php
session_start();
require_once("database/init.php");


try {
    
    $dbh->beginTransaction();

    $aula_id = $_POST['aula_id'];
    $membro_id = $_SESSION['id'];

    //separar aqui:

    // Verifica se o membro já está inscrito na aula de grupo
    $stmt = $dbh->prepare('SELECT COUNT(*) AS num_rows FROM Inscricao_ag WHERE membro = ? AND aulagrupo = ?');
    $stmt->execute(array($membro_id, $aula_id));
    $registo = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $registosExistentes = $registo['num_rows'];

    if ($registosExistentes > 0) {
        $_SESSION['msg'] = 'Já estás registado nesta aula!';
        header('Location: inscricao_ag.php');
        exit();
    }
    else { 

    // +1 qntd_membros na aula de grupo
    $stmt = $dbh->prepare('UPDATE Aulagrupo SET qntd_membros = qntd_membros + 1 WHERE id = ?');
    $stmt->execute(array($aula_id));


    // Entrada na tabela Inscricao_ag
    $stmt = $dbh->prepare('INSERT INTO Inscricao_ag (membro, aulagrupo) VALUES (?, ?)');
    $stmt->execute(array($membro_id, $aula_id));

    //separar aqui

    $dbh->commit();

    $_SESSION['msg'] = 'Inscrição realizada com sucesso!';}


} catch (PDOException $e) {
    $dbh->rollBack();
    $_SESSION['msg'] = 'Erro ao realizar inscrição: ' . $e->getMessage();
}


header('Location: inscricao_ag.php');
exit();

?>