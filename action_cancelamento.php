<?php
session_start();
require_once("database/init.php");


    try {
        // Apaga membro da tabela Pessoa
        $stmt = $dbh->prepare('DELETE FROM Pessoa WHERE id = ?');
        $stmt->execute([$_SESSION['id']]);

        // Apaga membro da tabela Membro
        $stmt = $dbh->prepare('DELETE FROM Membro WHERE id = ?');
        $stmt->execute([$_SESSION['id']]);

        // Apaga membro da tabela Plano
        $stmt = $dbh->prepare('DELETE FROM Plano WHERE membro = ?');
        $stmt->execute([$_SESSION['id']]);

        //Caso hajam inscrições em aulas de grupo, qntd_membros -1
        $stmt = $dbh->prepare('UPDATE Aulagrupo SET qntd_membros = qntd_membros - 1 WHERE id IN (SELECT aulagrupo FROM Inscricao_ag WHERE membro = ?)');
        $stmt->execute([$_SESSION['id']]);

        // Apaga membro da tabela Inscricao_ag
        $stmt = $dbh->prepare('DELETE FROM Inscricao_ag WHERE membro = ?');
        $stmt->execute([$_SESSION['id']]);


        session_destroy();
        header('Location: cancelado.php'); // Redireciona para a página de cancelamento
        exit();

    } catch (PDOException $e) {
        $_SESSION['msg'] = 'Erro: ' . $e->getMessage();
    }

?>
