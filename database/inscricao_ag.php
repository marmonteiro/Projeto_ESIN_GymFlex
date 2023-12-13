<?php function fetchQuantidadeAGByEmail($email) { //quantidade_ag do ultimo plano
    global $dbh;
    $stmt = $dbh->prepare('
    SELECT Tipo_p.quantidade_ag
    FROM Plano
    INNER JOIN Membro ON Plano.membro = Membro.id
    INNER JOIN Tipo_p ON Plano.tipo_p = Tipo_p.nome
    INNER JOIN Pessoa ON Membro.id = Pessoa.id
    WHERE Pessoa.email = ?
    ORDER BY Plano.data_adesao DESC
    LIMIT 1
');
    $stmt->execute(array($email));
    $quantidade_ag = $stmt->fetchColumn();
    return $quantidade_ag;
}

function fetchInscricoesAGByEmail($email) //inscricoes_ag (do mês atual)
{
    global $dbh;
    $stmt = $dbh->prepare('
    SELECT COUNT(Inscricao_ag.id) AS inscricoes_ag
    FROM Inscricao_ag
    INNER JOIN Membro ON Inscricao_ag.membro = Membro.id
    INNER JOIN Pessoa ON Membro.id = Pessoa.id
    INNER JOIN Aulagrupo ON Inscricao_ag.aulagrupo = Aulagrupo.id
    WHERE Pessoa.email = ?
    AND strftime("%Y-%m", Aulagrupo.data) = strftime("%Y-%m", "now")
');

    $stmt->execute(array($_SESSION['email']));
    $inscricoes_ag = $stmt->fetchColumn();
    return $inscricoes_ag;
}


function fetchAGByGinasio($ginasio) //vai buscar as aulas de grupo disponiveis no ginasio escolhido (id, data, qntd_membros, ginasio, tipo_ag, nome_tipo, capacidade_tipo, dia_semana, hora_inicio, hora_fim)
{
    global $dbh;
    $stmt = $dbh->prepare('
    SELECT a.id, a.data, a.qntd_membros, a.ginasio, a.tipo_ag,
           t.nome AS nome_tipo, t.capacidade AS capacidade_tipo,
           t.dia_semana, t.hora_inicio, t.hora_fim
    FROM Aulagrupo a
    INNER JOIN Tipo_ag t ON a.tipo_ag = t.nome
    WHERE a.ginasio = ?
');
    $stmt->execute(array($ginasio));
    $aulasDisponiveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $aulasDisponiveis;
}
?>