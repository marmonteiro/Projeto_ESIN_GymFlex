<?php
session_start();
require_once("database/init.php");
require_once("database/inscricao_ag.php");


try {
    
    
    $registosExistentes = VerificacaoInscAulaGrupo($_SESSION['id'], $_POST['aula_id']);

    if ($registosExistentes > 0) {
        $_SESSION['msg'] = 'Já estás registado nesta aula!';
        header('Location: inscricao_ag.php');
        exit();
    }
    else { 

    IncrementoQntdMembros($_POST['aula_id']);
    
    InscricaoAG($_SESSION['id'], $_POST['aula_id']);
    $_SESSION['msg'] = 'Inscrição realizada com sucesso!';


    header('Location: inscricao_ag.php');

    exit();
    
    }


} catch (PDOException $e) {
    
    $_SESSION['msg'] = 'Erro: ' . $e->getMessage();
}


header('Location: inscricao_ag.php');
exit();

?>