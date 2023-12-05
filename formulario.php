<?php
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os dados do formulário
    $nome = $_POST["nome"];
    $clube = $_POST["clube_de_interesse"];
    $email = $_POST["email"];
    $mensagem = $_POST["mensagem"];

    // Aqui você pode adicionar validações e processamento adicional, se necessário

    // Exemplo simples: exibindo os dados na tela

    // Você pode adicionar o código para enviar um email, salvar no banco de dados, etc.

    // Exibindo a mensagem de sucesso
    echo "<p>Formulário enviado com sucesso!</p>";
}
?>
