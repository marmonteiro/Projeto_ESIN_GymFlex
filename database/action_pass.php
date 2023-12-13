<?php 
#Entrar
  function loginSuccess($email, $password) {
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM Pessoa WHERE email = ? AND password = ?');
    $stmt->execute(array($email, sha1($password)));
    return $stmt->fetch();
  }


#Buscar o nome da pessoa pelo email
function getNamePersonByEmail($email){
    global $dbh;
    $stmt = $dbh->prepare('SELECT nome FROM pessoa where email = ?');
    $stmt->execute(array($email));
    return $stmt->fetch()['nome'];
}
?>