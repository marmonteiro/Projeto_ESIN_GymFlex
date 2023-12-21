<?php
session_start();
require_once("database/init.php");
require_once("database/area_cliente.php");
require_once("database/cancelar_inscricao_ag.php");



if (isset($_SESSION['id']) && isset($_POST['inscricao_id'])) {
    cancelarInscricaoAG($_POST['inscricao_id']);
    decrementarQntdMembros($_POST['inscricao_id']);
    $ano_sel = date('Y');
    $mes_sel = date('m');
    header('Location: minhas_ag.php?ano=' . urlencode($ano_sel) . '&mes=' . urlencode($mes_sel));
    exit();
} else {

    header('Location: minhas_ag.php?ano=<?php echo $ano_sel ?>&mes=<?php echo $mes_sel ?>');
    exit();
}


?>