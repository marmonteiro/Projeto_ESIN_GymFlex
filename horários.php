<?php
session_start();

$msg = $_SESSION['msg'];
unset($_SESSION['msg']);

try {
    $dbh = new PDO('sqlite:sql/gymflex.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $dbh->prepare('SELECT * FROM Tipo_ag WHERE nome = ?');
    $stmt->execute();
    $horarios = $stmt->fetchAll();} 
    
    catch (PDOException $e) {
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
    

    // Preencher o array com os dados da consulta
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $nome_aula = $row["nome"];
        $dia_semana = $row["dia_semana"];
        $hora_inicio = $row["hora_inicio"];
        $hora_fim = $row["hora_fim"];

        // Adicionar os dados ao array organizado por hora e dia
        $horarios[$hora_inicio][$dia_semana] = $nome_aula;
    }
    ?>

<h2>Horários</h2>
    <p>Confira nossos horários de aulas de grupo e escolha o momento que melhor se adequa à sua agenda.</p>
    <table>
        <thead>
            <tr>
                <th>Horário</th>
                <th>Segunda-feira</th>
                <th>Terça-feira</th>
                <th>Quarta-feira</th>
                <th>Quinta-feira</th>
                <th>Sexta-feira</th>
                <th>Sábado</th>
                <th>Domingo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Define the time slots
            $timeSlots = array(
                '08:00 - 09:30',
                '10:00 - 11:30',
                '12:00 - 13:30',
                '13:30 - 14:30',
                '14:30 - 15:30',
                '16:00 - 17:30',
                '17:30 - 18:30',
                '19:00 - 20:00',
                '20:00 - 21:00'
            );
// A partir daqui isto já não guarda      o nome nas celilas
            foreach ($timeSlots as $timeSlot) {
                echo '<tr>';
                echo '<td>' . $timeSlot . '</td>';

                // Loop through days of the week
                $dias_semana = array('Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado', 'Domingo');
                foreach ($dias_semana as $nome_aula) {
                    echo '<td>' . (isset($schedule[$timeSlot][$nome_aula]) ? $schedule[$timeSlot][$nome_aula] : '-') . '</td>';
                }

                echo '</tr>';
            }
            ?>

            </tbody>
        </table>
    </section>

    <div class="mensagem">
        <p>Inscreve-te já como membro para puderes usufruir destas aulas</p>
        <a href="registo.php" class="button"> Inscreve-te aqui! </a>
    </div>

    <footer>
        <p>Qualquer dúvida não hesite em contactar, teremos uma equipa ao seu dispor.</p>
        <p>Email: gymflex.geral@gmail.com</p>
        <p>Telemóvel: 923524352</p>
        <p>&copy; GymFlex, 2023</p>
    </footer>

</body>

</html>

<!-- 
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

                Adicione mais linhas conforme necessário -->
  <!--           </tbody>
        </table>
    </section>

" --> 

