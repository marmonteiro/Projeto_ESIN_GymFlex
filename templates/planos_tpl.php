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