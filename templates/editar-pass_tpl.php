<div class="editar-pass">
    <h2> Alteração de Senha </h2>
    <form method='POST' action="action_editar-pass.php">
        <div class="bloco-pass">
            <label>Senha Antiga</label>
            <input name="Antiga" type="password" required="required">
            <label>Nova Senha</label>
            <input name="Nova" type="password" required="required">
            <label>Confirmar a senha</label>
            <input name="Confirme" type="password" required="required">
            
        </div>
        <p><span class = "error"><?php if(isset($_SESSION["msg"])) { echo $_SESSION["msg"]; unset($_SESSION["msg"]);}else { } ?></span></p>
        <button class="button" type="submit">Submeter</button>
    </form>
</div>