<?php
session_start();

$nome = $_POST['nome'];
$data_nascimento = $_POST['data_nascimento'];
$nr_telemovel = $_POST['nr_telemovel'];
$nif = $_POST['nif'];
$tipo_plano = $_POST['tipo_plano'];
$altura = $_POST['altura'];
$peso = $_POST['peso'];
$sexo = $_POST['sexo'];
$morada = $_POST['morada'];
$email = $_POST['email'];
$password = $_POST['password'];

$idade = date_diff(date_create($data_nascimento), date_create('today'))->y; // calcula a idade

function assignNutricionista($dbh)
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
    global $dbh;
    $hashedPassword = hash('sha256', $password);
    

    // inserir dados na tabela Pessoa
    $stmtPessoa = $dbh->prepare('INSERT INTO Pessoa (email, nome, nr_telemovel, morada, data_nascimento, nif) VALUES (?, ?, ?, ?, ?, ?)');
    $stmtPessoa->execute(array($email, $nome, $nr_telemovel, $morada, $data_nascimento, $nif));
    

    // vai guardar o id da pessoa que acabou de ser inserida
    $pessoaID = $dbh->lastInsertId();

    // inserir dados na tabela Membro
    $stmtMembro = $dbh->prepare('INSERT INTO Membro (pwd, altura, peso, sexo, id, inscricoes_ag) VALUES (?, ?, ?, ?, ?, ?)');
    $stmtMembro->execute(array($hashedPassword, $altura, $peso, $sexo, $pessoaID, 0));
    
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


//Error Handling

if (strlen($email) == 0) {
    $_SESSION['msg'] = 'E-mail inválido.';
    header('Location: registo.php');
    die();
}

if ($sexo != 'M' && $sexo != 'F') {
    $_SESSION['msg'] = 'Obrigatório assinalar um sexo.';
    header('Location: registo.php');
    die();
}

if (strlen($nif) != 9) {
    $_SESSION['msg'] = 'NIF inválido.';
    header('Location: registo.php');
    die();
}

if (strlen($nr_telemovel) != 9) {
    $_SESSION['msg'] = 'Número de telemóvel inválido.';
    header('Location: registo.php');
    die();
}

if (strlen($password) < 8) {
    $_SESSION['msg'] = 'Password deve ter mais que 8 caracteres.';
    header('Location: registo.php');
    die();
}

if ($idade < 16) {
    $_SESSION['msg'] = 'A idade mínima é 16 anos.';
    header('Location: registo.php');
    die();
}
try {
    $dbh = new PDO('sqlite:sql/gymflex.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    insertUser($nome, $data_nascimento, $nr_telemovel, $email, $password, $nif, $tipo_plano, $altura, $peso, $morada, $sexo);
    $_SESSION['msg'] = 'Registration successful!';
    header('Location: paginicial.html');

} catch (PDOException $e) {
    $error_msg = $e->getMessage();

    if (strpos($error_msg, 'UNIQUE constraint failed: Pessoa.email')) {
        $_SESSION['msg'] = 'E-mail já está registado!';
    }
    else {
        $_SESSION['msg'] = "Registo falhou! ($error_msg)";
    }
    header('Location: registo.php');
}
?>