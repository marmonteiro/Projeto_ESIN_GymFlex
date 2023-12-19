<?php function assignNutricionista($dbh)
{
    // vai buscar um id com menos clientes
    $stmt = $dbh->query('SELECT Nutricionista.id, COUNT(Membro.nutricionista) AS nr_clients 
    FROM Nutricionista 
    LEFT JOIN Membro ON Nutricionista.id = Membro.nutricionista 
    GROUP BY Nutricionista.id 
    ORDER BY nr_clients ASC 
    LIMIT 1');
    $nutricionista = $stmt->fetch(PDO::FETCH_ASSOC);
    return $nutricionista['id'];
}

function assignPT($dbh)
{
    // vai buscar um id do PT com menos clientes
    $stmt = $dbh->query('SELECT Personaltrainer.id, COUNT(Membro.personaltrainer) AS nr_clients 
    FROM Personaltrainer 
    LEFT JOIN Membro ON Personaltrainer.id = Membro.personaltrainer 
    GROUP BY Personaltrainer.id 
    ORDER BY nr_clients ASC 
    LIMIT 1');

    $personalTrainer = $stmt->fetch(PDO::FETCH_ASSOC);
    return $personalTrainer['id'];
}


function insertUser($nome, $data_nascimento, $nr_telemovel, $email, $password, $nif, $tipo_plano, $altura, $peso, $morada, $sexo)
{
    global $dbh;;
    

    // inserir dados na tabela Pessoa
    $stmtPessoa = $dbh->prepare('INSERT INTO Pessoa (email, nome, nr_telemovel, morada, data_nascimento, nif) VALUES (?, ?, ?, ?, ?, ?)');
    $stmtPessoa->execute(array($email, $nome, $nr_telemovel, $morada, $data_nascimento, $nif));
    

    // vai guardar o id da pessoa que acabou de ser inserida
    $pessoaID = $dbh->lastInsertId();

    // guardar a foto de perfil
    move_uploaded_file($_FILES['profile_pic']['tmp_name'], "imagens/membros/$pessoaID.png");

    // inserir dados na tabela Membro
    $stmtMembro = $dbh->prepare('INSERT INTO Membro (pwd, altura, peso, sexo, id, inscricoes_ag) VALUES (?, ?, ?, ?, ?, ?)');
    $stmtMembro->execute(array( hash('sha256', $password) , $altura, $peso, $sexo, $pessoaID, 0));
    
    $imc = $peso / (($altura/100) * ($altura/100)); // calcula o imc
    $stmtMembroIMC = $dbh->prepare('UPDATE Membro SET imc = ? WHERE id = ?');
    $stmtMembroIMC->execute(array($imc, $pessoaID));


    // inserir dados na tabela Plano
    $date = date("Y-m-d"); // data do registo
    $stmtPlano = $dbh->prepare('INSERT INTO Plano (tipo_p, data_adesao, membro) VALUES (?, ?, ?)');
    $stmtPlano->execute(array($tipo_plano, $date, $pessoaID));



    // Dá o nutricionista com menos clientes ao novo membro
    $randomNutricionista = assignNutricionista($dbh);

    // Update da tabela Membro com o nutricionista random
    $stmtNutricionista = $dbh->prepare('UPDATE Membro SET nutricionista = ? WHERE id = ?');
    $stmtNutricionista->execute(array($randomNutricionista, $pessoaID));

    if ($tipo_plano === 'Intermédio' || $tipo_plano === 'Avançado') {
        // Dá o PT com menos clientes ao novo membro se o plano for Intermédio ou Avançado
        $randomPT = assignPT($dbh);

        // Update da tabela Membro com o PT
        $stmtPT = $dbh->prepare('UPDATE Membro SET personaltrainer = ? WHERE id = ?');
        $stmtPT->execute(array($randomPT, $pessoaID));
    }

}

?>