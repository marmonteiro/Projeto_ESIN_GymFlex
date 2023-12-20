<?php
session_start();
require_once("database/init.php");
require_once("database/inscricao_ag.php");

try {
    
    
    $registosExistentes = VerificacaoInscAulaGrupo($membro_id, $_POST['aula_id']);

    if ($registosExistentes > 0) {
        $_SESSION['msg'] = 'Já estás registado nesta aula!';
        header('Location: inscricao_ag.php');
        exit();
    }
    else { 

    IncrementoQntdMembros($_POST['aula_id']);
    
    InscricaoAG($_SESSION['id'], $_POST['aula_id']);

    $_SESSION['msg'] = 'Inscrição realizada com sucesso!';

     //re-calculo da quantidade de aulas de grupo disponiveis
     $quantidade_ag = fetchQuantidadeAGByEmail($_SESSION['email']);
     $NRinscricoes_ag = fetchNRInscricoesAGByEmail($_SESSION['email']);
     $disponiveis_ag = $quantidade_ag - $NRinscricoes_ag;
     $_SESSION['disponiveis_ag'] = $disponiveis_ag;


    header('Location: inscricao_ag.php');
    exit();
    
    }


} catch (PDOException $e) {
    $dbh->rollBack();
    $_SESSION['msg'] = 'Erro: ' . $e->getMessage();
}


header('Location: inscricao_ag.php');
exit();

?>