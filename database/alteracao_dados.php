<?php

function UpdatePessoa($email, $nome, $morada, $nr_telemovel, $id) {
    global $dbh;
    $stmt = $dbh->prepare('UPDATE Pessoa SET email, nome = ?, morada = ?, nr_telemovel = ? WHERE id = ?');
    $stmt->execute([$email, $nome, $morada, $nr_telemovel, $id]);
}

function UpdateMembro($altura, $peso, $nr_cartao, $id) {
    global $dbh;
    $stmt = $dbh->prepare('UPDATE Membro SET altura = ?, peso = ?, nr_cartao = ? WHERE id = ?');
    $stmt->execute([$altura, $peso, $nr_cartao, $id]);
}

function UpdateIMC ($imc, $id) {
    global $dbh;
    $stmt = $dbh->prepare('UPDATE Membro SET imc = ? WHERE id = ?');
    $stmt->execute([$imc, $id]);
}

?>