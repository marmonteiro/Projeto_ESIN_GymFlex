<?php 
function fetchInfoTipoPlanos()
{
  global $dbh;
  $stmt = $dbh->prepare('SELECT * FROM Tipo_p');
  $stmt->execute();
  $tipo_p_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $tipo_p_info;
}

?>