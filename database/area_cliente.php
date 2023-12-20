<?php function fetchQuantidadeAGByEmail($email)
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

function fetchInscricoesAGByEmail($id) //inscricoes_ag 
{
    global $dbh;
    $stmt = $dbh->prepare('
            SELECT Ginasio.nome AS nome_ginasio,
            Aulagrupo.data,
            Tipo_ag.hora_inicio,
            Tipo_ag.hora_fim,
            Tipo_ag.duracao_ag,
            Tipo_ag.nome AS tipo_ag,
            Inscricao_ag.id AS id
        FROM Inscricao_ag
        INNER JOIN Membro ON Inscricao_ag.membro = Membro.id
        INNER JOIN Pessoa ON Membro.id = Pessoa.id
        INNER JOIN Aulagrupo ON Inscricao_ag.aulagrupo = Aulagrupo.id
        INNER JOIN Tipo_ag ON Aulagrupo.tipo_ag = Tipo_ag.nome
        INNER JOIN Ginasio ON Aulagrupo.ginasio = Ginasio.id
        WHERE Pessoa.id = ?
    ');

    $stmt->execute(array($id));
    $inscricoes_ag = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $inscricoes_ag;
}
;

function fetchTreinos($id) //treinos do membro
{
    global $dbh;
    $stmt = $dbh->prepare('
        SELECT Treino.*, Ginasio.nome AS nome_ginasio
        FROM Treino
        INNER JOIN Ginasio ON Treino.ginasio = Ginasio.id
        WHERE Treino.membro = ?
    ');
    $stmt->execute(array($id));
    $treinos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $treinos;
}
;

function fetchTempoTreinosPlanoFromID($id) //tempo_treino disponivel do ultimo plano do membro
{
    global $dbh;
    $stmt = $dbh->prepare('
        SELECT Tipo_p.tempo_treino
        FROM Plano
        INNER JOIN Membro ON Plano.membro = Membro.id
        INNER JOIN Tipo_p ON Plano.tipo_p = Tipo_p.nome
        INNER JOIN Pessoa ON Membro.id = Pessoa.id
        WHERE Pessoa.id = ?
        ORDER BY Plano.data_adesao DESC
        LIMIT 1
    ');
    $stmt->execute(array($id));
    $tempo_treino_plano = $stmt->fetchColumn();
    return $tempo_treino_plano;
}
;

function fetchDetalhesMembroByEmail($email) //detalhes do membro (nome, data_nascimento, nr_telemovel, email, morada, nif, nr_cartao, altura, peso, imc, nutricionista_nome, personaltrainer_nome, sexo, pwd,   data_adesao, tipo_p do ultimo plano)
{
    global $dbh;
    $stmt = $dbh->prepare('
        SELECT Pessoa.nome, Pessoa.data_nascimento, Pessoa.nr_telemovel, Pessoa.email, Pessoa.morada, Pessoa.nif, Membro.nr_cartao,  
            Membro.altura, Membro.peso, Membro.imc, Membro.nutricionista, Membro.personaltrainer, Membro.sexo, Membro.pwd,
            Plano.data_adesao, Plano.tipo_p,
            Nutricionista.nome AS nutricionista_nome,
            PersonalTrainer.nome AS personaltrainer_nome
        FROM Pessoa
        INNER JOIN Membro ON Membro.id = Pessoa.id
        LEFT JOIN Plano ON Plano.membro = Membro.id
        LEFT JOIN Pessoa AS Nutricionista ON Nutricionista.id = Membro.nutricionista
        LEFT JOIN Pessoa AS PersonalTrainer ON PersonalTrainer.id = Membro.personaltrainer
        WHERE Pessoa.email = ?
        AND Plano.id = (
            SELECT MAX(id)
            FROM Plano
            WHERE Plano.membro = Membro.id
        )
    ');
    $stmt->execute(array($email));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}
;

$meses = array(
    '01' => 'Janeiro',
    '02' => 'Fevereiro',
    '03' => 'Março',
    '04' => 'Abril',
    '05' => 'Maio',
    '06' => 'Junho',
    '07' => 'Julho',
    '08' => 'Agosto',
    '09' => 'Setembro',
    '10' => 'Outubro',
    '11' => 'Novembro',
    '12' => 'Dezembro'
);

?>