<?php 
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

// calcula a data da próxima prestação
function calculoProxPagamento($data_adesao)
{
    $data_atual = time();
    $data_adesao_form = strtotime($data_adesao);
    $dia_adesao = date('d', $data_adesao_form); // dia da data de adesão
    $prox_pagam_form = strtotime("next month", $data_atual);
    $mes_proxpagam = date('m', $prox_pagam_form); // mês da próxima prestação
    $ano_proxpagam = date('Y', $prox_pagam_form); // ano da próxima prestação
    $prox_pagam = $ano_proxpagam . '-' . $mes_proxpagam . '-' . $dia_adesao;
    return $prox_pagam;
}




//verifica se o membro pode alterar o plano (se já passaram 5 meses desde a adesão)
function calculoAlteracaoPermitida($data_adesao)
{
    $ha2Meses = date('Y-m-d', strtotime('-2 months'));
    $alteracaoPermitida = strtotime($data_adesao) <= strtotime($ha2Meses); //será true se já passaram 2 meses desde a adesão
    return $alteracaoPermitida;
}


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