<?php
session_start();
require_once("database/init.php");
include("database/area_cliente.php");


try {

    //vai buscar os detalhes do membro
    $user = fetchDetalhesMembroByEmail($_SESSION['email']);

    
    $ano_sel = isset($_GET['ano']) ? $_GET['ano'] : date('Y');
    $mes_sel = isset($_GET['mes']) ? $_GET['mes'] : date('m');

    // vai buscar as inscricoes_ag do membro
    $inscricoes_ag = fetchInscricoesAGByEmail($_SESSION['id']);

    $inscricoes_por_mes = array();
    foreach ($inscricoes_ag as $inscricao) {
        $ano_inscricao = date('Y', strtotime($inscricao['data']));
        $mes_inscricao = date('m', strtotime($inscricao['data']));

        if ($ano_inscricao == $ano_sel && $mes_inscricao == $mes_sel) {
            if (!isset($inscricoes_por_mes[$mes_inscricao])) {
                $inscricoes_por_mes[$mes_inscricao] = array();
            }
            $inscricoes_por_mes[$mes_inscricao][] = $inscricao;
        }
    }

    $anos_inscricoes = array();
    foreach ($inscricoes_ag as $inscricao) {
        $ano = date('Y', strtotime($inscricao['data']));
        $anos_inscricoes[$ano] = $ano;
    }


} catch (PDOException $e) {
    $_SESSION['msg'] = 'Erro: ' . $e->getMessage();

}
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

include("templates/header_tpl.php");
include("templates/minhas_ag_tpl.php");
include("templates/footer_tpl.php");
?>