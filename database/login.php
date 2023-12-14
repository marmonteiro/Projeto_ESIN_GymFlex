<?php

// verificar se a combinacao email/password existe na base de dados
function loginSuccess($email, $password)
{
  global $dbh;
  $stmt = $dbh->prepare('
    SELECT Membro.*
    FROM Membro
    INNER JOIN Pessoa ON Membro.id = Pessoa.id
    WHERE Pessoa.email = ? AND Membro.pwd = ?
');
  $stmt->execute(array($email, hash('sha256', $password)));
  return $stmt->fetch();
}

function fetchNomeandIDByEmail($email)
{ //Tendo o email, vai buscar o nome do user
  global $dbh;
  $stmt = $dbh->prepare('SELECT Membro.id, Pessoa.nome FROM Membro INNER JOIN Pessoa ON Membro.id = Pessoa.id WHERE Pessoa.email = ?');
  $stmt->execute(array($email));
  $membro = $stmt->fetch(PDO::FETCH_ASSOC);
  return $membro;

}
?>
