<h1> Planos de Membro</h1>
<h4> Escolha o plano que melhor se adequa a si e junte-se à equipa GymFlex.</h4>
<div class="planos">
    <?php foreach ($tipo_p_info as $plano): ?>
        <div class="retangulo_planos">
            <div>
                <h2> Plano
                    <?php echo $plano['nome']; ?>
                </h2>
                <p>
                    <span class=bold><?php echo $plano['tempo_treino']; ?> </span>Horas de Treino por mês
                </p>
                <p>
                    <span class=bold><?php echo $plano['quantidade_ag']; ?> </span>Aulas de Grupo por mês
                </p>
                <p>Acompanhamento contínuo por <span class=bold>Nutricionista</span></p>
                <?php if ($plano['nome'] == "Intermédio" || $plano['nome'] == "Avançado") { ?>
                    <p>Acompanhamento contínuo por <span class=bold>Personal Trainer</span></p>
                <?php } ?>
                <p>Cancelamento gratuito a qualquer momento </p>
                <p id=preco>
                    <?php echo $plano['preco']; ?> € / mês
                </p>
            </div>
            <div>
                <?php if (!isset($_SESSION['email'])) { ?>
                    <a href="registo.php?plano_sel=<?php echo urlencode($plano['nome']); ?>" class="button"> Registe-se </a>
                <?php } else { ?>
                    <a href="alteracao_plano.php?plano_sel=<?php echo urlencode($plano['nome']); ?>" class="button"> Escolha o seu
                        plano</a>
                <?php } ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<div class="planos_duvidas">
    <p>Queres vir treinar connosco e tens alguma dúvida sobre os planos? Entra em contacto, estamos disponíveis para ti.
    </p>
</div>