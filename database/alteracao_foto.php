<?php
$pessoaID = $_SESSION['id'];
//guardar nova foto
move_uploaded_file($_FILES['profile_pic']['tmp_name'], "imagens/membros/$pessoaID.png");
?>