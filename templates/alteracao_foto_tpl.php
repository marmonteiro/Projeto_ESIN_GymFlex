<div id="alteracao_foto">
    <h2>Alteração de Foto de Perfil</h2>
    <p>Escolha uma foto para o seu perfil.</p>
    <p id="msg_erro"><?php echo $_SESSION['msg'] ; unset ($_SESSION['msg'])?></p>
    <form action="action_alteracao_foto.php" method="post" enctype="multipart/form-data">
        <input type="file" name="profile_pic" id="profile_pic" required>
        <input type="submit" value="Alterar">
    </form>
</div>