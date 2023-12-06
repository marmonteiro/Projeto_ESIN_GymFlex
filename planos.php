<?php
session_start();

$msg = $_SESSION['msg'];
unset($_SESSION['msg']);

// Ir buscar dados à base de dados //
try {
    $dbh = new PDO('sqlite:sql/gymflex.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


<<<<<<< HEAD
    $stmt = $dbh->prepare('SELECT * FROM Tipo_p');
    $stmt->execute();
    $tipo_p_info = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($tipo_p_info as $plano) {
        $nome_plano = $plano['nome'];
        $preco_plano = $plano['preco'];
        $tempo_treino_plano = $plano['tempo_treino'];
        $quantidade_ag_plano = $plano['quantidade_ag'];

    }


=======
    $nome_plano = $_GET['nome']; //Não está a ir buscar os nomes!! Penso que seja por ser primary key da tabela 
    echo "Nome do plano: $nome_plano"; //Fiz isto para verificar que efetivamente o array dos nomes está vazio
    $nome_plano = 'Básico'; // Se lhe der aqui o nome do plano aparece direito no site 
    $stmt = $dbh->prepare( 'SELECT * FROM Tipo_p WHERE nome = ?');
    $stmt->execute(array($nome_plano));
    $planos = $stmt->fetchAll();
    var_dump($planos); 
>>>>>>> c0abdd22461c6583a5ec497169113559615e3fd0

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

        <?php if(isset($_SESSION['email'])) { ?>
            <a href="action_logout.php" class="button">Logout</a>
            <a href="area_cliente.php" class="button">Área de Cliente</a>
            <p>Olá,
                <?php echo $_SESSION['nome'] ?>!
            </p>
        <?php } else { ?>
            <a href="registo.php" class="inscreva-se">Inscreva-se</a>
            <a href="login.php" id="signup">Login: área de cliente</a>
        <?php } ?>
    </header>



    <h2>Plan Information</h2>

    <?php foreach($tipo_p_info as $plano): ?>
        <div>
            <h3>
                <?php echo $plano['nome']; ?>
            </h3>
            <p>Preço:
                <?php echo $plano['preco']; ?>
            </p>
            <p>Tempo de Treino:
                <?php echo $plano['tempo_treino']; ?> horas
            </p>
            <p>Quantidade de Aulas em Grupo:
                <?php echo $plano['quantidade_ag']; ?>
            </p>
        </div>
    <?php endforeach; ?>    


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