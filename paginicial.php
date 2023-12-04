<?php
session_start();
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    $email = null;
}
$msg = $_SESSION['msg'];
unset($_SESSION['msg']);
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymFlex</title>
    <link rel="icon" href="imagens/gymflex_logo_head.svg">
    <link rel="stylesheet" href="clubesv4.2.css">
</head>

<body>

    <header>
        <a href="paginicial.php">
            <img id="logo" src="imagens/gymflex_logo.svg" alt="Logotipo">
        </a>
        <h1>GymFlex: Diferentes clubes em diferentes cidades</h1>

        <div class="barra">
            <a href="clubes.php" class="clubes">Clubes</a>
            <a href="planos.php" class="planos">Planos</a>
            <a href="aulasgrupo.php" class="info">Aulas de Grupo</a>
            <a href="ajuda.php" class="ajuda">Ajuda</a>
        </div>

        <?php if (isset($_SESSION['email'])) { ?>
            <a href="action_logout.php" class="button">Logout</a>
            <a href="area_cliente.php" class="button">Área de Cliente</a>
        <?php } else { ?>
            <a href="registo.php" class="inscreva-se">Inscreva-se</a>
            <a href="login.php" id="signup">Login: área de cliente</a>
        <?php } ?>
    </header>

    <div class="escolherGymFlex">
        <p>Porquê o GymFlex?</p>
    </div>

    <div class="imagensiniciais">
        <div class="imagens">
            <img src="imagens/fidelização.png" alt="Imagem 1">
            <div class="textoimagensiniciais">
                <p> Sem Fidelização</p>
            </div>
        </div>
        <div class="imagens">
            <img src="imagens/horario.png" alt="Imagem 2">
            <div class="textoimagensiniciais">
                <p>Horário Alargado</p>
            </div>
        </div>
        <div class="imagens">
            <img src="imagens/TreinoPT.png" alt="Imagem 3">
            <div class="textoimagensiniciais">
                <p>Treino Acompanhado ou Autónomo</p>
            </div>
        </div>
        <div class="imagens">
            <img src="imagens/instalações.png" alt="Imagem 4">
            <div class="textoimagensiniciais">
                <p>Instalações</p>
            </div>
        </div>
    </div>
    <p>

    </p>

    <section id="contato">
        <h2>Entre em Contato</h2>
        <p>Tem alguma dúvida ou deseja obter mais informações? Preencha o formulário abaixo e entraremos em contato em
            breve.</p>
        <form action="#" method="post" style="max-width: 400px; margin: 0 auto;">
            <div style="display: flex; flex-direction: column; margin-bottom: 15px;">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>

            <div style="display: flex; flex-direction: column; margin-bottom: 15px;">
                <label for="clube">Clube de Interesse:</label>
                <input type="clube de interesse" id="clube de interesse" name="clube de interesse" required>
            </div>

            <div style="display: flex; flex-direction: column; margin-bottom: 15px;">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div style="display: flex; flex-direction: column; margin-bottom: 15px;">
                <label for="mensagem">Mensagem:</label>
                <textarea id="mensagem" name="mensagem" rows="4" required></textarea>
            </div>

            <button type="submit">Enviar Mensagem</button>
        </form>
    </section>
    <p>

    </p>


    <div class="feedback">
        <p class="feedback-mensagem">A sua opinião é importante para nós, avalie-nos de 1 a 5. </p>
        <div class="botões">
            <button value="1">1</button>
            <button value="2">2</button>
            <button value="3">3</button>
            <button value="4">4</button>
            <button value="5">5</button>
        </div>
    </div>


    <div class="feedback2">
        <p class="feedback-mensagem">Envie-nos as suas sugestões de melhoria</p>
        <form class="feedback-form">
            <textarea id="mensagem" name="mensagem" rows="4" placeholder="Digite a sua sugestão aqui"
                required></textarea>
            <button type="submit">Enviar Sugestão</button>
        </form>
    </div>



    <footer>
        <p>Qualquer dúvida não hesite em contactar, teremos uma equipa ao seu dispor.</p>
        <p>Email: gymflex.geral@gmail.com</p>
        <p>Telemóvel: 923524352</p>
        <p>&copy; GymFlex, 2023</p>
    </footer>
</body>

</html>