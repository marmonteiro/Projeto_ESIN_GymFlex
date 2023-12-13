<?php 

#Buscar o nome da pessoa pelo email
function getNamePersonByEmail($email){
    global $dbh;
    $stmt = $dbh->prepare('SELECT nome FROM pessoa where email = ?');
    $stmt->execute(array($email));
    return $stmt->fetch()['nome'];
}
?>