<?php 
function fetchPlanoMembroByMembroID($id) //vai buscar o plano atual do membro (data_adesao, tipo_p, preco)
{
    global $dbh;
    $stmt = $dbh->prepare('
    SELECT Plano.data_adesao, Plano.tipo_p, Tipo_p.preco
    FROM Plano
    INNER JOIN Tipo_p ON Plano.tipo_p = Tipo_p.nome
    WHERE Plano.membro = ?
    ORDER BY Plano.data_adesao DESC
    LIMIT 1
');
    $stmt->execute(array($id));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
};

function fetchInfoTipoPlanosdif($planoAtual) //vai buscar os tipos de planos disponiveis (nome, preco) exceto o plano atual
{
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM Tipo_p WHERE nome != ?');
    $stmt->execute(array($planoAtual));
    $tipo_p_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $tipo_p_info;
};
?>