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

    <section id="horarios">
        <h2>Horários</h2>
        <p>Confira nossos horários de aulas de grupo e escolha o momento que melhor se adequa à sua agenda.</p>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Segunda-feira</th>
                    <th>Terça-feira</th>
                    <th>Quarta-feira</th>
                    <th>Quinta-feira</th>
                    <th>Sexta-feira</th>
                    <th> Sábado </th>
                    <th> Domingo </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>08:00 - 09:30</td>
                    <td> Pilates </td>
                    <td> Cycling </td>
                    <td> Pilates</td>
                    <td> Body Step </td>
                    <td> Zumba </td>
                    <td> - </td>
                    <td> - </td>
                </tr>
                <tr>
                    <td>10:00 - 11:30</td>
                    <td> Cycling </td>
                    <td> Pilates </td>
                    <td> Cycling </td>
                    <td> Xpress abs</td>
                    <td> Pilates </td>
                    <td> Pilates </td>
                    <td> Cycling </td>
                </tr>
                <tr>
                    <td> 12:00 - 13:30</td>
                    <td> Body Step </td>
                    <td> Body Pump </td>
                    <td> Xpress Abs </td>
                    <td> Zumba </td>
                    <td> Body Step </td>
                    <td> Body Step </td>
                    <td> Body Pump </td>
                </tr>
                <tr>
                    <td>13:30 - 14:30</td>
                    <td> - </td>
                    <td> - </td>
                    <td> - </td>
                    <td> - </td>
                    <td> - </td>
                    <td> - </td>
                    <td> - </td>
                </tr>
                <tr>
                    <td>14:30 - 15:30</td>
                    <td> Zumba </td>
                    <td> - </td>
                    <td> Body Step </td>
                    <td> Cycling </td>
                    <td> Xpress Abs</td>
                    <td> Body Pump </td>
                    <td> Pilates </td>
                </tr>
                <tr>
                    <td>16:00 - 17:30</td>
                    <td> Cycling </td>
                    <td> Zumba </td>
                    <td> - </td>
                    <td> Zumba </td>
                    <td> Body Pump </td>
                    <td> Zumba </td>
                    <td> Body Step </td>
                </tr>
                <tr>
                    <td>17:30 - 18:30</td>
                    <td> - </td>
                    <td> Body Step</td>
                    <td> Zumba </td>
                    <td> Body Pump</td>
                    <td> - </td>
                    <td> Xpress Abs</td>
                </tr>
                <tr>
                    <td>19:00 - 20:00</td>
                    <td> Body Pump </td>
                    <td> Xpress Abs </td>
                    <td> Cycling </td>
                    <td> Pilates </td>
                    <td> Cycling </td>
                    <td> Cycling </td>
                </tr>
                <tr>
                    <td>20:00 - 21:00</td>
                    <td> Xpress Abs </td>
                    <td> Cycling </td>
                    <td> Body Pump </td>
                    <td> - </td>
                    <td> Pilates </td>
                </tr>

                <!-- Adicione mais linhas conforme necessário -->
            </tbody>
        </table>
    </section>

    <!-- Mensagem e botão para não membros -->
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