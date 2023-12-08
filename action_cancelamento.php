<?php
require_once("init.php");
session_start();

try {
    // Para obter o  e-mail 
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
