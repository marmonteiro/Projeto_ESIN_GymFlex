<?php 

#Buscar o nome da pessoa pelo email
/* function getNamePessoaByEmail($email){
    global $dbh;
    $stmt = $dbh->prepare('SELECT nome FROM Pessoa where email = ?');
    $stmt->execute(array($email));
    return $stmt->fetch()['nome'];
} 
 */
function updatePassMembrobyEmail($password, $email)
{
    global $dbh;
      $stmtUpdate = $dbh->prepare('UPDATE Membro
                                  INNER JOIN Pessoa ON Membro.id = Pessoa.id
                                  SET Membro.pwd = ?
                                  WHERE Pessoa.email = ?');
      $stmtUpdate->execute(array(sha1($password), $email));
    } 
/* 
    function updatePassPersonbyEmail($password,$email){       #nao esta a conseguir atualizar na base de dados
      global $dbh;
      $stmt = $dbh->prepare('UPDATE Person set password = ? where email = ?');
      $stmt->execute(array(sha1($password),$email));
    } */