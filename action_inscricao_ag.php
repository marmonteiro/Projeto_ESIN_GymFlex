<?php
session_start();
require_once("database/init.php");
require_once("database/inscricao_ag.php");
require_once("database/area_cliente.php");


try {
    
    $AulaSel = fetchDetalhesAula($_POST['aula_id']); 

    // Fetch all classes user is already registered for
    $AulasRegistadas = fetchAulasRegistadas($_SESSION['id']); 

    // Check if there are any conflicting classes
    foreach ($AulasRegistadas as $aula_reg) {
        if ($aula_reg['data'] === $AulaSel['data'] && $aula_reg['hora_inicio'] === $AulaSel['hora_inicio']) {
            $_SESSION['msg'] = 'Já se encontra registrado numa aula no mesmo dia e horário!';
            header('Location: inscricao_ag.php');
            exit();
        }
    }
    
    $registosExistentes = VerificacaoInscAulaGrupo($_SESSION['id'], $_POST['aula_id']);

    if ($registosExistentes > 0) {
        $_SESSION['msg'] = 'Já está registado nesta aula!';
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