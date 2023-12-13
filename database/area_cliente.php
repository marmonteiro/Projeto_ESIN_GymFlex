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

    function fetchInscricoesAGByEmail($email) //inscricoes_ag (do mes atual)
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
    };

    function fetchTreinos($id)
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
    };

    function fetchTempoTreinosPlanoFromID($id)
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
    };

    function fetchDetalhesMembroByEmail($email)
    {
        global $dbh;
        $stmt = $dbh->prepare('
        SELECT Pessoa.nome, Pessoa.data_nascimento, Pessoa.nr_telemovel, Pessoa.email, Pessoa.morada, Pessoa.nif,
            Membro.altura, Membro.peso, Membro.imc, Membro.nutricionista, Membro.personaltrainer, Membro.sexo,
            Plano.data_adesao, Plano.tipo_p
        FROM Pessoa
        INNER JOIN Membro ON Membro.id = Pessoa.id
        LEFT JOIN Plano ON Plano.membro = Membro.id
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
    ?>