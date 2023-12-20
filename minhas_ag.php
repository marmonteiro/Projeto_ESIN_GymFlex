<?php
session_start();
require_once("database/init.php");
require_once("database/area_cliente.php");
require_once("database/organizacao_datas.php");


try {
    $ano_sel = date('Y');
    $mes_sel = date('m');


    //vai buscar os detalhes do membro
    $user = fetchDetalhesMembroByEmail($_SESSION['email']);

    // vai buscar as inscricoes_ag do membro
    $inscricoes_ag = fetchInscricoesAGByEmail($_SESSION['id']);

    //definicao do array inscricoes por mes
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


    //definicao do array anos com inscricoes
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