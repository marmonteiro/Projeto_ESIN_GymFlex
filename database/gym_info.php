<?php function fetchGymInfoById($nome_ginasio)
{
    global $dbh;
    $stmt = $dbh->prepare('
    SELECT * FROM Ginasio WHERE nome = ?
    ');

    $stmt = $dbh->prepare('SELECT * FROM Ginasio WHERE nome = ?');
    $stmt->execute(array($nome_ginasio));
    $infoGinasio = $stmt->fetch(PDO::FETCH_ASSOC);
    return $infoGinasio;
};

function fetchNutByGym($nome_ginasio)
{
    global $dbh;
    $stmt = $dbh->prepare('
            SELECT pn.nome AS nome_nutricionista
            FROM Ginasio AS g
            LEFT JOIN Funcionario AS fn ON g.id = fn.ginasio
            LEFT JOIN Nutricionista AS n ON fn.id = n.id
            LEFT JOIN Pessoa AS pn ON n.id = pn.id
            WHERE g.nome = ?
        ');

    $stmt->execute(array($nome_ginasio));
    $nomeNut = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $nomeNut;
};

function fetchPTByGym($nome_ginasio)
{
    global $dbh;
    $stmt = $dbh->prepare('
            SELECT pn.nome AS nome_personaltrainer
            FROM Ginasio AS g
            LEFT JOIN Funcionario AS fn ON g.id = fn.ginasio
            LEFT JOIN PersonalTrainer AS pt ON fn.id = pt.id
            LEFT JOIN Pessoa AS pn ON pt.id = pn.id
            WHERE g.nome = ?
        ');

    $stmt->execute(array($nome_ginasio));
    $nomePT = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $nomePT;
}; 

?>
