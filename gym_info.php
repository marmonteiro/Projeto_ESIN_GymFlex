<?php
session_start();
require_once("database/init.php");

$nome_ginasio = $_GET['nome_ginasio'];

require_once ("database/gym_info.php");

try {
    $infoGinasio = fetchGymInfoById($nome_ginasio);

    $morada_ginasio = $infoGinasio['morada'];
    $telefone_ginasio = $infoGinasio['nr_telefone'];
    $email_ginasio = $infoGinasio['email'];
    $mapa_ginasio = $infoGinasio['mapa_url'];
    $imagem_ginasio = $infoGinasio['imagem_url'];

    $nomeNut = fetchNutByGym($nome_ginasio);
    $nomePT = fetchPTByGym($nome_ginasio);


} catch (PDOException $e) {
    $_SESSION['msg'] = $e->getMessage();
}
include("templates/header_tpl.php");
include("templates/gym_info_tpl.php");
include("templates/footer_tpl.php");
?>