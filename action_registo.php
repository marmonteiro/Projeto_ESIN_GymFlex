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

require_once 'database/init.php';
require_once 'database/action_registo.php';

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
    
    insertUser($nome, $data_nascimento, $nr_telemovel, $email, $password, $nif, $tipo_plano, $altura, $peso, $morada, $sexo);
    $_SESSION['msg'] = 'Registration successful!';
    header('Location: paginicial.php');

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