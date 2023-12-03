<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

function insertUser($nome, $data_nascimento, $nr_telemovel, $email, $password, $nif, $tipo_plano, $altura, $peso, $morada)
{
    global $dbh;
    $hashedPassword = hash('sha256', $password);
    
    // Insert into Pessoa table
    $stmtPessoa = $dbh->prepare('INSERT INTO Pessoa (nome_completo, nr_telemovel, morada, data_nascimento, nif) VALUES (?, ?, ?, ?, ?)');
    $stmtPessoa->execute(array($nome, $nr_telemovel, $morada, $data_nascimento, $nif));

    // Retrieve last inserted ID for Pessoa (assuming Pessoa has an auto-increment primary key)
    $pessoaID = $dbh->lastInsertId();

    // Insert into Membro table
    $stmtMembro = $dbh->prepare('INSERT INTO Membro (pwd, altura, peso, pessoa_id) VALUES (?, ?, ?, ?)');
    $stmtMembro->execute(array($hashedPassword, $altura, $peso, $pessoaID));

    // Insert into Plano table (assuming a date is associated with the plan)
    $date = date("Y-m-d"); // Example: Current date
    $stmtPlano = $dbh->prepare('INSERT INTO Plano (tipo_p, data_associada, membro_id) VALUES (?, ?, ?)');
    $stmtPlano->execute(array($tipo_plano, $date, $pessoaID));
}
    

if (strlen($email) == 0) {
    $_SESSION['msg'] = 'Invalid E-mail!';
    header('Location: registration.php');
    die();
}

if (strlen($password) < 8) {
    $_SESSION['msg'] = 'Password must have at least 8 characters.';
    header('Location: registration.php');
    die();
}

try {
    $dbh = new PDO('sqlite:sql/gymflex.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    insertUser($email,$password);
    $_SESSION['msg'] = 'Registration successful!';
    header('Location: paginicial.php');
} catch (PDOException $e) {
    $error_msg = $e->getMessage();

    if (strpos($error_msg, 'UNIQUE')) {
        $_SESSION['msg'] = 'E-mail already exists!';
    } else {
        $_SESSION['msg'] = "Registration failed! ($error_msg)";
    }
    header('Location: registration.php');
}
?>