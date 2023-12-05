<?php
session_start();

$msg = $_SESSION['msg'];
unset($_SESSION['msg']);

// Ir buscar dados à base de dados //
try {
    $dbh = new PDO('sqlite:sql/gymflex.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $nome_plano = $_GET['nome'];;
    $stmt = $dbh->prepare('SELECT * FROM Tipo_p WHERE nome = ?');
    $stmt->execute(array($nome_plano));
    $planos = $stmt->fetchAll();
    var_dump($planos);

} catch (PDOException $e) {
    $error_msg = $e->getMessage();
}

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

        <div class="barra">
            <a href="clubes.php" class="clubes">Clubes</a>
            <a href="planos.php" class="planos">Planos</a>
            <a href="aulasgrupo.php" class="info">Aulas de Grupo</a>
            <a href="ajuda.php" class="ajuda">Ajuda</a>
        </div>

        <?php if (isset($_SESSION['email'])) { ?>
            <a href="action_logout.php" class="button">Logout</a>
            <a href="area_cliente.php" class="button">Área de Cliente</a>
            <p>Olá, <?php echo $_SESSION['nome'] ?>!</p>
        <?php } else { ?>
            <a href="registo.php" class="inscreva-se">Inscreva-se</a>
            <a href="login.php" id="signup">Login: área de cliente</a>
        <?php } ?>
    </header>

   <!-- Mostrar os planos -->
   <div class="planos">
        <?php foreach ($planos as $plano): ?>
            <div class="plano">
                <h2><?= $plano['nome'] ?></h2>
                <p>Preço: R$ <?= $plano['preco'] ?></p>
                <p>Tempo de Treino: <?= $plano['tempo_treino'] ?> horas</p>
                <p>Quantidade de Aulas de grupo: <?= $plano['quantidade_ag'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>


<!-- HTML de antes --> 
    <div class="planos">
        <div class="retangulo_planos">
            <p>Plano Básico</p>
            <ul>
                <li>Consulta inicial de nutrição</li>
                <li>1 aula de grupo por semana</li>
                <li>3 entradas livres por semana</li>
                <li>Cancelamento gratuito</li>
            </ul>
            <p>Apenas por 9,99 €/mês</p>
            <div class="botao_planos">
                <a href="registo.php" class="planos">Inscreva-se</a>
            </div>
        </div>
        <div class="retangulo_planos">
            <p>Plano Intermédio</p>
            <ul>
                <li>Consulta inicial de nutrição</li>
                <li>2 aulas de grupo por semana</li>
                <li>5 entradas livres por semana</li>
                <li>Cancelamento gratuito</li>
            </ul>
            <p>Apenas por 15,99 €/mês</p>
            <div class="botao_planos">
                <a href="registo.php" class="planos">Inscreva-se</a>
            </div>
        </div>
        <div class="retangulo_planos">
            <p>Plano Avançado</p>
            <ul>
                <li>Acompanhamento contínuo por nutrição</li>
                <li>Acesso ilimitado a aulas de grupo</li>
                <li>Acesso ilimitado ao ginásio</li>
                <li>Cancelamento gratuito</li>
            </ul>
            <p>Apenas por 22,99 €/mês</p>
            <div class="botao_planos">
                <a href="registo.php" class="planos">Inscreva-se</a>
            </div>
        </div>
    </div>

    <div class="planos_duvidas">
        <p>Queres vir treinar connosco e tens alguma dúvida sobre os planos? Entra em contacto, estamos disponíveis para
            ti. </p>
        <p>Email: gymflex.geral@gmail.com</p>
        <p>Telemóvel: 923524352</p>
    </div>




    <footer>
        <p>Qualquer dúvida não hesite em contactar, teremos uma equipa ao seu dispor.</p>
        <p>&copy; GymFlex, 2023</p>
    </footer>
</body>