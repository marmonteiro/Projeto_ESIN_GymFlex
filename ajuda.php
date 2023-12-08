<?php
session_start();
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    $email = null;
}
$msg = $_SESSION['msg'];
unset($_SESSION['msg']);
include("templates/header_ajuda_tpl.php");
?>

 <!-- <!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymFlex</title>
    <link rel="icon" href="imagens/gymflex_logo_head.svg">
    <link rel="stylesheet" href="css/estetica.css">
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
    </header>  --> 

    <section id="Ajuda">
        <h1>Ajuda</h1>
        <section id="FAQ">
            <h2>FAQ</h2>
            <p id="intro">Algumas das perguntas mais frequentes.</p>
            <section>
                <details id="Categoria">
                    <summary>Informações Gerais</summary>
                    <p>
                    <details id="Pergunta">
                        <summary>Quais são as localizações dos ginásios GymFlex?</summary>
                        <p>Temos vários clubes espalhados por todo o país. Conhece todos os nossos clubes em <a
                                href="clubes.html">Clubes</a>.</p>
                    </details>
                    <details id="Pergunta">
                        <summary>Qual o horário de funcionamento dos ginásios GymFlex?</summary>
                        <p>Os nossos Clubes estão abertos todos os dias do ano, de segunda a sexta-feira das 6h às 22h e
                            aos fins de semana e feriados das 8h às 20h. Qualquer interrupção em algum dos nossos
                            serviços será devidamente notificada a todos os membros por mensagem ou e-mail.</p>
                    </details>
                    <details id="Pergunta">
                        <summary>Quais os planos oferecidos?</summary>
                        <p>Oferecemos 3 tipos de planos mensais: Plano Básico, Plano Intermédio e Plano Avançado. Sabe
                            os detalhes de cada plano em <a href="servicos.html">Serviços</a>.</p>
                    </details>
                    <details id="Pergunta">
                        <summary>Existe estacionamento disponível nos ginásios GymFlex?</summary>
                        <p>Sim! Oferecemos estacionamento gratuito para todos membros em todos os nossos clubes.</p>
                    </details>
                    <details id="Pergunta">
                        <summary>Existem aulas de grupo? Quais?</summary>
                        <p>Sim! Oferecemos várias aulas de grupo desde Zumba a CrossFit. Sabe mais em <a
                                href="servicos.html">Serviços</a>.</p>
                    </details>

                    </p>
                </details>

                <details id="Categoria">
                    <summary>Se ainda não és Membro</summary>
                    <p>
                    <details id="Pergunta">
                        <summary>Como me posso inscrever como membro?</summary>
                        <p>Podes te inscrever como membro ao te registares no nosso site ou presencialmente, visitando
                            qualquer um dos nossos clubes.</p>
                    </details>
                    <details id="Pergunta">
                        <summary>A partir de que idade posso me tornar membro?</summary>
                        <p>A idade mínima de inscrição é de 16 anos.</p>
                    </details>
                    <details id="Pergunta">
                        <summary>Quais são as opções de pagamento disponíveis?</summary>
                        <p>Aceitamos pagamentos em dinheiro, cartão de crédito/débito ou transferência bancária.</p>
                    </details>
                    <details id="Pergunta">
                        <summary>Posso frequentar outros clubes GymFlex após me inscrever num específico?</summary>
                        <p>Sim! Os nossos membros podem frequentar qualquer um dos nossos clubes.</p>
                    </details>
                    <details id="Pergunta">
                        <summary>Posso visitar um ginásio GymFlex antes de me inscrever?</summary>
                        <p>Sim! Podes te dirigir a qualquer um dos nossos clubes e comprar uma utilização diária de
                            forma a experimentares um treino nos nossos estabelecimentos.</p>
                    </details>
                    </p>
                </details>

                <details id="Categoria">
                    <summary>Se já és Membro</summary>
                    <p>
                    <details id="Pergunta">
                        <summary>Como posso cancelar a minha subscrição?</summary>
                        <p>Para cancelares a tua subscrição deves aceder à tua Área de Cliente e . Alternativamente
                            podes fazê-lo presencialmente, em qualquer um dos nossos clubes.</p>
                    </details>
                    <details id="Pergunta">
                        <summary>Como posso trocar o meu plano mensal?</summary>
                        <p>Para trocares o teu plano mensal deves aceder à tua Área de Cliente > Mudar o Meu Plano e
                            selecionar o plano para que pretendes trocar. Alternativamente podes fazê-lo
                            presencialmente, em qualquer um dos nossos clubes.</p>
                    </details>
                    <details id="Pergunta">
                        <summary>Como me posso inscrever numa aula de grupo?</summary>
                        <p>Para te inscreveres numa aula de grupo deves aceder à tua Área de Cliente > Inscrição em Aula
                            de Grupo e selecionar o clube e a aula que pretendes te inscrever.</p>
                    </details>
                    </p>
                </details>
            </section>
        </section>
    </section>


    <section id="Contactos">
        <p id="intro">Queres esclarecer alguma dúvida que não está aqui?</p>
        <h2>Contactos</h2>
        <section id="Contactos">
            <p>Email de apoio ao cliente: <a href="mailto:support@gymflex.com">gymflex.geral@gmail.com</a>.</p>
            <p>Telefone de apoio ao cliente: <a href=“tel:+351 910 111 222>+351 910 111 222</a>.</p>
            <p>Ou contacta diretamente o ginásio mais perto de ti. Descobre-o <a href="clubes.php">aqui</a>.</p>
        </section>
    </section>


    <footer>
        <p>&copy; GymFlex, 2023</p>
    </footer>
</body>

</html>