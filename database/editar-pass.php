<?php
function updatePassMembrobyEmail($password, $email)
{
  global $dbh;
  $stmtUpdate = $dbh->prepare('UPDATE Membro
                                  SET pwd = ?
                                  WHERE id = (SELECT id FROM Pessoa WHERE email = ?)');
  $stmtUpdate->execute(array(hash('sha256', $password), $email));
}

