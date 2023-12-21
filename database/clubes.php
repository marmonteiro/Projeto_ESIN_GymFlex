<?php

function selectNomeFromGinasio($inscricao_id) {
    global $dbh;
    $stmt = $dbh->prepare('SELECT nome FROM Ginasio');
    $stmt->execute();
    $clubes = $stmt->fetchAll();
    return $clubes;
}
?>