<?php 

#Buscar o nome da pessoa pelo email
function getNamePersonByEmail($email){
    global $dbh;
    $stmt = $dbh->prepare('SELECT nome FROM Pessoa where email = ?');
    $stmt->execute(array($email));
    return $stmt->fetch()['nome'];
}

function updatePassMembrobyEmail($password,$email){       #nao esta a conseguir atualizar na base de dados
  global $dbh;
  $stmt = $dbh->prepare('UPDATE Membro set password = ? where email = ?');
  $stmt->execute(array(sha1($password),$email));
}

?>