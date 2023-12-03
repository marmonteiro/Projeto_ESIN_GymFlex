<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clubes</title>
    <link rel="stylesheet" href="clubesv4.2.css">
</head>
<body>
    <header>
        <a href="paginicial.html">
            <img id="logo" src="imagens/gymflex_logo.svg" alt="Logotipo">
        </a>
        <h1>GymFlex: Diferentes clubes em diferentes cidades.</h1>

        <div class="barra">
            <a href="clubes.html" class="clubes">Clubes</a>
            <a href="planos.html" class="serviços">Planos</a>
            <a href="aulasgrupo.html" class="info">Aulas de Grupo</a>
            <a href="info.html" class="info">Ajuda</a>
            <a href="#" class="inscreva-se">Inscreva-se</a>
            <a href="login.html" id="signup">Login: área de cliente</a>
        </div>
    </header>

    <div class="clubes">
        <a href="gymflexporto.html" class="porto">GmyFlex Porto</a>
        <a href="gymflexaveiro.html" class="aveiro">GymFlex Aveiro</a>
        <a href="gymflexlisboa.html" class="lisboa">GymFlex Lisboa</a>
        <a href="gymflexmadeira.html" class="madeira">GymFlex Madeira</a>
        <a href="gymflexbraga.html" class="braga">GymFlex Braga</a>
        <a href="gymflexguimaraes.html" class="guimarães">GymFlex Guimarães</a>
    </div> 
    
    <!-- <div class="clubes">
        // <?php
       // $query = "SELECT * FROM ginasio"; ir buscar tabela ginásio
        //$resultado = $conexao->query($query);
    
        // if ($resultado->num_rows > 0) {
           // while ($row = $resultado->fetch_assoc()) {
               // $nome_clube = $row['nome_clube'];
               // $link_clube = $row['link_clube'];
                //echo "<a href=\"$link_clube\" class=\"clube\">$nome_clube</a>";
            //}
       // } else {
            //echo "Sem clubes disponíveis no momento.";
        //}
    
        // Fechar a conexão
        //$conexao->close();
        //?> 
    </div> -->

    <?php
    // Verifique se o ID do clube foi fornecido na URL
    if (isset($_GET['id'])) {
        // Obtenha o ID do clube da URL
        $id_clube = $_GET['id'];

        // Executa uma consulta para obter os detalhes do clube com base no ID
        $query = "SELECT * FROM ginásio WHERE id = $id_clube";
        $resultado = $conexao->query($query);

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            $morada_clube = $row['morada'];

            // Exiba os detalhes do clube
            echo "<h1>Detalhes do Clube</h1>";
            echo "<p>Morada: $morada_clube</p>";
        

        } else {
            echo "Clube não encontrado.";
        }
    } else {
        echo "ID do clube não fornecido.";
    }

    // Fechar a conexão
    $conexao->close();
    ?> 
   
    <ul class="club-info">
        <li>
            <img class="club-logo" src="imagens/porto.png" alt="Ginásio Logo">
            <a href="gymflexporto.html">GymFlex Porto: Rua das Flores, nº26 <br>
                <!-- <span>Contacto telefónico: 923524352</span> <br>
                <span>Email: gymflex.porto@gmail.com</span> -->
            </a>
        </li>

        <li>
            <img class="club-logo" src="imagens/aveiro.png" alt="Ginásio Logo">
            <a href="gymflexaveiro.html">GymFlex Aveiro: Rua Mário Sacramento, nº 32 <br>
                <!-- <span>Contacto telefónico: 923524352</span> <br>
                <span>Email: gymflex.aveiro@gmail.com</span> -->
            </a>
        </li>

        <li>
            <img class="club-logo" src="imagens/lisboa.png" alt="Ginásio Logo">
            <a href="gymflexlisboa.html">GymFlex Lisboa: Travessa de Campo de Ourique, nº 6 <br>
                <!-- <span>Contacto telefónico: 923524352</span> <br>
                <span>Email: gymflex.lisboa@gmail.com</span> -->
            </a>
        </li>

        <li>
            <img class="club-logo" src="imagens/madeira.png" alt="Ginásio Logo">
            <a href="gymflexmadeira.html">GymFlex Madeira: Rua da Ajuda, nº 8 <br>
                <!-- <span>Contacto telefónico: 923524352</span> <br>
                <span>Email: gymflex.madeira@gmail.com</span> -->
            </a>
        </li>
        <li>
            <img class="club-logo" src="imagens/braga.png" alt="Ginásio Logo">
            <a href="gymflexbraga.html">GymFlex Braga: Rua Francisco Sanches, nº 12 <br>
                <!-- <span>Contacto telefónico: 923524352</span> <br>
                <span>Email: gymflex.madeira@gmail.com</span> -->
            </a>
        </li>
        <li>
            <img class="club-logo" src="imagens/guimaraes.png" alt="Ginásio Logo">
            <a href="gymflexguimaraes.html">GymFlex Guimarães: Rua 31 de janeiro, nº 8 <br>
                <!-- <span>Contacto telefónico: 923524352</span> <br>
                <span>Email: gymflex.madeira@gmail.com</span> -->
            </a>
        </li>
    </ul>
    <footer>
        <p>Qualquer dúvida não hesite em contactar, teremos uma equipa ao seu dispor.</p>
        <p>&copy; GymFlex, 2023</p>
    </footer>
</body>
</html>
