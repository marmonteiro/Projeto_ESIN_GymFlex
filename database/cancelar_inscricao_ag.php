<?php
function cancelarInscricaoAG($inscricao_id)
{
    global $dbh;
    $stmt = $dbh->prepare('
        DELETE FROM Inscricao_ag
        WHERE id = ?
    ');
    $stmt->execute(array($inscricao_id));
}

//qntd_membros -1, utilizando o id da inscricao
function decrementarQntdMembros($inscricao_id)
{
    global $dbh;
    $stmt = $dbh->prepare('
        UPDATE Aulagrupo
        SET qntd_membros = qntd_membros - 1
        WHERE id = (
            SELECT aulagrupo
            FROM Inscricao_ag
            WHERE id = ?
        )
    ');
    $stmt->execute(array($inscricao_id));
}
 
cancelarInscricaoAG($_POST['inscricao_id']);
decrementarQntdMembros($_POST['inscricao_id']);

?>