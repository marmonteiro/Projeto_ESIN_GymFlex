<?php 
function fetchQuantidadeAGByEmail($email)
{ //quantidade_ag do ultimo plano
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
};

function fetchNRInscricoesAGByEmail($email) //nr de inscricoes_ag (do mes atual)
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
    $NRinscricoes_ag = $stmt->fetchColumn();
    return $NRinscricoes_ag;
}
;

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

function fetchDetalhesAula($aulagrupo_id) {
    global $dbh; 

    $stmt = $dbh->prepare('SELECT ag.data, ta.hora_inicio, ta.hora_fim
                            FROM Aulagrupo AS ag
                            INNER JOIN Tipo_ag AS ta ON ag.tipo_ag = ta.nome
                            WHERE ag.id = :aulagrupo_id');
    $stmt->bindParam(':aulagrupo_id', $aulagrupo_id, PDO::PARAM_INT);
    $stmt->execute();

    $classDetails = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $classDetails;
}

function fetchAulasRegistadas($membro_id) {
    global $dbh; 

    $stmt = $dbh->prepare('SELECT ag.data, ta.hora_inicio, ta.hora_fim
                            FROM Aulagrupo AS ag
                            INNER JOIN Tipo_ag AS ta ON ag.tipo_ag = ta.nome
                            INNER JOIN Inscricao_ag AS ia ON ag.id = ia.aulagrupo
                            WHERE ia.membro = :membro_id');
    $stmt->bindParam(':membro_id', $membro_id, PDO::PARAM_INT);
    $stmt->execute();

    $AulasRegistadas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $AulasRegistadas;
}

function fetchAllGinasios() {
    global $dbh;
    $stmt = $dbh->prepare('SELECT id, nome FROM Ginasio');
    $stmt->execute();
    return $stmt->fetchAll();
}

//INSCRIÇÃO NA AULA DE GRUPO

// Verifica se o membro já está inscrito na aula de grupo
function VerificacaoInscAulaGrupo($membro_id, $aula_id) {
    global $dbh;
    $stmt = $dbh->prepare('SELECT COUNT(*) AS num_rows FROM Inscricao_ag WHERE membro = ? AND aulagrupo = ?');
    $stmt->execute(array($membro_id, $aula_id));
    $registo = $stmt->fetch(PDO::FETCH_ASSOC);
    return $registo['num_rows'];
}

// +1 qntd_membros na aula de grupo
function IncrementoQntdMembros($aula_id) {
    global $dbh;
    $stmt = $dbh->prepare('UPDATE Aulagrupo SET qntd_membros = qntd_membros + 1 WHERE id = ?');
    $stmt->execute(array($aula_id));
}

// Entrada na tabela Inscricao_ag
function InscricaoAG($membro_id, $aula_id) {
    global $dbh;
    $stmt = $dbh->prepare('INSERT INTO Inscricao_ag (membro, aulagrupo) VALUES (?, ?)');
    $stmt->execute(array($membro_id, $aula_id));
}


//  
?>