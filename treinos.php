<?php
session_start();
require_once("database/init.php");
require_once("database/area_cliente.php");

if (!isset($_SESSION['email'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

try {


    if (!isset($_SESSION['email'])) {
        header('Location: login.php'); // Redirect to login if not logged in
        exit();
    }

    //vai buscar o mes e ano selecionados, ou usa o mes e ano atuais
    $ano_sel = isset($_GET['ano']) ? $_GET['ano'] : date('Y');
    $mes_sel = isset($_GET['mes']) ? $_GET['mes'] : date('m');

    $treinos = fetchTreinos($_SESSION['id']);

    //vai buscar os treinos por mês
    $treinos_por_mes = array();
    foreach ($treinos as $treino) {
        $ano_treino = date('Y', strtotime($treino['data'])); // Obtém o ano do treino
        $mes_treino = date('m', strtotime($treino['data'])); // Obtém o mês do treino
        if ($ano_treino == $ano_sel && $mes_treino == $mes_sel) {
            if (!isset($treinos_por_mes[$mes_treino])) {
                $treinos_por_mes[$mes_treino] = array(); // Cria um array para o mês
            }
            $treinos_por_mes[$mes_treino][] = $treino; // Adiciona o treino ao array do mês
        }
    }

    //vai buscar os anos com treinos
    $anos_treinos = array();
    foreach ($treinos as $treino) {
        $ano = date('Y', strtotime($treino['data'])); // Obtém o ano do treino
        $anos_treinos[$ano] = $ano; // Adiciona o ano ao array
    } 
    
    
    // compara datas para organizar cronologicamente
    function compareDates($a, $b) //está a ser usada!!
    {
        return strtotime($a['data']) - strtotime($b['data']);
    }



} catch (PDOException $e) {
    $_SESSION['msg'] = 'Erro: ' . $e->getMessage();
}


include("templates/header_tpl.php");
include("templates/treinos_tpl.php");
include("templates/footer_tpl.php");
?>