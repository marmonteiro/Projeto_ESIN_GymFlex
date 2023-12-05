<?php
session_start();

$msg = $_SESSION['msg'];
unset($_SESSION['msg']);


try {
    $dbh = new PDO('sqlite:sql/gymflex.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $dbh->prepare('SELECT nome, dia_semana, hora_inicio, hora_fim FROM Tipo_ag');
    $stmt->execute();
    $horarios = $stmt->fetchAll();

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
        <?php } else { ?>
            <a href="registo.php" class="inscreva-se">Inscreva-se</a>
            <a href="login.php" id="signup">Login: área de cliente</a>
        <?php } ?>
    </header>

<?php

$horarios = array();

// Preencher o array com os dados da consulta
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $nome_aula = $row["nome"];
    $dia_semana = $row["dia_semana"];
    $hora_inicio = $row["hora_inicio"];
    $hora_fim = $row["hora_fim"];

    // Adicionar os dados ao array organizado por hora
    $horarios[$hora_inicio][$dia_semana] = $nome_aula;
}
?>

<?php echo '<section id="horarios">
        <h2>Horários</h2>
        <p>Confira nossos horários de aulas de grupo e escolha o momento que melhor se adequa à sua agenda.</p>
        <table>
            <thead>
                <tr>
                    <th>Segunda-feira</th>
                    <th>Terça-feira</th>
                    <th>Quarta-feira</th>
                    <th>Quinta-feira</th>
                    <th>Sexta-feira</th>
                    <th>Sábado</th>
                    <th>Domingo</th>
                </tr>
            </thead>
            <tbody>';

  // Loop para preencher as linhas da tabela
foreach ($horarios as $hora => $dias) {
    echo '<tr>
            <td>' . $hora . '</td>';

    // Loop para preencher as colunas para cada dia da semana
    $dias_semana = array('Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado', 'Domingo');
    foreach ($dias_semana as $dia) {
        // Verifica se existe aula para o dia e hora específicos
        if (isset($dias[$dia])) {
            // Exibe o nome da aula
            echo '<td>' . $dias[$dia] . '<br>' . $hora . '</td>';
        } else {
            // Se não houver aula, exibe um traço
            echo '<td>-</td>';
        }
    }

    echo '</tr>';
}

echo '</tbody>
    </table>
</section>';
?>


    <div class="mensagem">
        <p>Inscreve-te já como membro para puderes usufruir destas aulas</p>
        <a href="registo.php" class="button"> Inscreve-te aqui! </a>
    </div>

    <!-- Mensagem e botão para membros    <div class="mensagem">
        <p>Caso já sejas membro, garante já a tua vaga</p>
        <a href="marcaçoes_aula.php" class="button"> Marcações </a>
    </div>
    </section>
    <p> -->



    </p>
    <footer>
        <p>Qualquer dúvida não hesite em contactar, teremos uma equipa ao seu dispor.</p>
        <p>Email: gymflex.geral@gmail.com</p>
        <p>Telemóvel: 923524352</p>
        <p>&copy; GymFlex, 2023</p>
    </footer>

</body>

</html>