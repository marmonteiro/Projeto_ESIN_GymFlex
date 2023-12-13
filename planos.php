<?php
require_once("database/init.php");
session_start();

function fetchInfoTipoPlanos() {

    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM Tipo_p');
    $stmt->execute();
    $tipo_p_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $tipo_p_info;
};

try {
    $tipo_p_info = fetchInfoTipoPlanos();
    foreach($tipo_p_info as $plano) {
        $nome_plano = $plano['nome'];
        $preco_plano = $plano['preco'];
        $tempo_treino_plano = $plano['tempo_treino'];
        $quantidade_ag_plano = $plano['quantidade_ag'];

    }

} catch (PDOException $e) {
    $error_msg = $e->getMessage();
}
include("templates/header_tpl.php");
?>


    <div class="planos">
        <?php foreach($tipo_p_info as $plano): ?>
            <div class="retangulo_planos">
                <div>
                    <h2> Plano 
                       <?php echo $plano['nome']; ?>
                    </h2>
        
                    <p>Preço mensal:
                        <?php echo $plano['preco']; ?> €
                    </p>
                    <p>Tempo de Treino:
                        <?php echo $plano['tempo_treino']; ?> horas
                    </p>
                    <p>Número de aulas de grupo:
                        <?php echo $plano['quantidade_ag']; ?>
                    </p>
                    <p>Acompanhamento contínuo por nutrição </p>
                    <p>Cancelamento gratuito a qualquer momento </p>
                </div>
                <div>
                    <a href="registo.php" class="botao_planos">Inscreva-se</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


    <div class="planos_duvidas">
        <p>Queres vir treinar connosco e tens alguma dúvida sobre os planos? Entra em contacto, estamos disponíveis para ti. </p>
    </div>
    
    <?php 
      include("templates/footer_tpl.php");
    ?>
</body>