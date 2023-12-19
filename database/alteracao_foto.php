<?php
$pessoaID = $_SESSION['id'];
move_uploaded_file($_FILES['profile_pic']['tmp_name'], "imagens/membros/$pessoaID.png");
?>