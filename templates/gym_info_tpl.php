<div class="club-info">
        <h2>
            <?php echo $nome_ginasio ?>
</h2>
        <p> <strong>Morada:</strong>
            <?php echo $morada_ginasio ?>
        </p>
        <p> <strong>Contacto telefónico:</strong>
            <?php echo $telefone_ginasio ?>
        </p>
        <p><strong>Email:</strong>
            <?php echo $email_ginasio ?>
        </p>
        <!-- <img class="imagem clube" src="<?php echo $imagem_ginasio ?>" alt="GymFlex Porto"> -->
    </div>
    
    <div class="titulos_clubes">
           <p>Como chegar:</p>
        <img class="mapa" src="<?php echo $mapa_ginasio ?>" alt="Mapa GymFlex">
    </div>

    <div>
        <div class="titulos_clubes">
           <p>A nossa equipa:</p>
        </div>
        <table>
            <tr>
                <td>
                    <p>Nutricionistas:</p>
                    <ul class="listaEquipa">
                        <?php if (!empty($nomeNut)): ?>
                            <?php foreach ($nomeNut as $nutricionista): ?>
                                <?php if (!empty($nutricionista['nome_nutricionista'])): ?>
                                    <li class="listaEquipa">
                                        <?php echo $nutricionista['nome_nutricionista']; ?>
                                    </li class="listaEquipa">
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="listaEquipa" >Nenhum nutricionista encontrado</li class="listaEquipa">
                        <?php endif; ?>
                    </ul class="listaEquipa">
                </td>
                <td>
                    <p>Personal Trainers:</p>
                    <ul class="listaEquipa">
                        <?php if (!empty($nomePT)): ?>
                            <?php foreach ($nomePT as $personaltrainer): ?>
                                <?php if (!empty($personaltrainer['nome_personaltrainer'])): ?>
                                    <li class="listaEquipa">
                                        <?php echo $personaltrainer['nome_personaltrainer']; ?>
                                    </li class="listaEquipa">
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="listaEquipa"> Nenhum personal trainer encontrado </li class="listaEquipa">
                        <?php endif; ?>
                    </ul class="listaEquipa">
                </td>
            </tr>
        </table>
    </div>
