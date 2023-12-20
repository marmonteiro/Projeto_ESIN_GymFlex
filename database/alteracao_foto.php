<?php
function guardarFotoPerfil ($id) {
    move_uploaded_file($_FILES['profile_pic']['tmp_name'], "imagens/membros/$id.png");
}

?>