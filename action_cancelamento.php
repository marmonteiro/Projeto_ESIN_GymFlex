<?php
require_once("init.php");
session_start();

try {
    // Para obter o endereço de e-mail do formulário ou de onde quer que você esteja recebendo
    $email = $_POST['email']; 

    // Delete user info from Pessoa and related tables
    $stmt = $dbh->prepare('DELETE FROM Pessoa WHERE email = ?');
    $stmt->execute([$email]);

    // After cancellation, destroy the session and redirect to a confirmation page or login page
    session_destroy();
    header('Location: cancelamento.php'); // Redirect to confirmation page
    exit();

} catch (PDOException $e) {
    // Handle any errors that might occur during deletion
    echo "Error: " . $e->getMessage();
}
?>
