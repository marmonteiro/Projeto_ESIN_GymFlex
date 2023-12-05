<?php
  session_start();

  // get email and password from HTTP parameters
  $email = $_POST['email'];
  $password = $_POST['password'];
  

  // check if email and password are correct
  function loginSuccess($email, $password) {
    global $dbh;
    $stmt = $dbh->prepare('
    SELECT Membro.*
    FROM Membro
    INNER JOIN Pessoa ON Membro.id = Pessoa.id
    WHERE Pessoa.email = ? AND Membro.pwd = ?
');
    $stmt->execute(array($email, hash('sha256', $password)));
    return $stmt->fetch();
  }

  function fetchNomeByEmail($email) {
    global $dbh; // Ensure $dbh is accessible within the function

    $stmt = $dbh->prepare('
        SELECT Pessoa.nome
        FROM Pessoa
        WHERE Pessoa.email = ?
    ');

    $stmt->execute(array($email));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result['nome'];
    } else {
        return null; // If no matching email is found, return null or handle as appropriate
    }
}


    // if email and password are correct, create session
try {
        $dbh = new PDO('sqlite:sql/gymflex.db');
        $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        if ($user = loginSuccess($email, $password)) {
          $_SESSION['email'] = $email;
          $_SESSION['nome'] = fetchNomeByEmail($email);
          
          header('Location: area_cliente.php'); // login successful
          exit(); 

        } else { // login failed
          $_SESSION['msg'] = 'E-mail ou Password incorretos!';
        }
    
      } catch (PDOException $e) {
        $_SESSION['msg'] = 'Error: ' . $e->getMessage();
      }
    
      header('Location: login.php');
    ?>