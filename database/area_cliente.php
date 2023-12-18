<?php function fetchQuantidadeAGByEmail($email)
{ //quantidade_ag do ultimo plano
    global $dbh;
    $stmt = $dbh->prepare('
        SELECT Tipo_p.quantidade_ag
        FROM Plano
        INNER JOIN Membro ON Plano.membro = Membro.id
        INNER JOIN Tipo_p ON Plano.tipo_p = Tipo_p.nome
        INNER JOIN Pessoa ON Membro.id = Pessoa.id
        WHERE Pessoa.email = ?
        ORDER BY Plano.data_adesao DESC
        LIMIT 1
    ');
    $stmt->execute(array($email));
    $quantidade_ag = $stmt->fetchColumn();
    return $quantidade_ag;
}
;

function fetchNRInscricoesAGByEmail($email) //nr de inscricoes_ag (do mes atual)
{
    global $dbh;
    $stmt = $dbh->prepare('
        SELECT COUNT(Inscricao_ag.id) AS inscricoes_ag
        FROM Inscricao_ag
        INNER JOIN Membro ON Inscricao_ag.membro = Membro.id
        INNER JOIN Pessoa ON Membro.id = Pessoa.id
        INNER JOIN Aulagrupo ON Inscricao_ag.aulagrupo = Aulagrupo.id
        WHERE Pessoa.email = ?
        AND strftime("%Y-%m", Aulagrupo.data) = strftime("%Y-%m", "now")
    ');

    $stmt->execute(array($_SESSION['email']));
    $NRinscricoes_ag = $stmt->fetchColumn();
    return $NRinscricoes_ag;
}
;

function fetchInscricoesAGByEmail($id) //inscricoes_ag 
{
    global $dbh;
    $stmt = $dbh->prepare('
    SELECT Ginasio.nome AS nome_ginasio,
       Aulagrupo.data,
       Tipo_ag.hora_inicio,
       Tipo_ag.hora_fim,
       Tipo_ag.duracao_ag,
       Tipo_ag.nome AS tipo_ag
FROM Inscricao_ag
INNER JOIN Membro ON Inscricao_ag.membro = Membro.id
INNER JOIN Pessoa ON Membro.id = Pessoa.id
INNER JOIN Aulagrupo ON Inscricao_ag.aulagrupo = Aulagrupo.id
INNER JOIN Tipo_ag ON Aulagrupo.tipo_ag = Tipo_ag.nome
INNER JOIN Ginasio ON Aulagrupo.ginasio = Ginasio.id
WHERE Pessoa.id = ?

    ');

    $stmt->execute(array($id));
    $inscricoes_ag = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $inscricoes_ag;
}
;

function fetchTreinos($id)
{
    global $dbh;
    $stmt = $dbh->prepare('
        SELECT Treino.*, Ginasio.nome AS nome_ginasio
        FROM Treino
        INNER JOIN Ginasio ON Treino.ginasio = Ginasio.id
        WHERE Treino.membro = ?
    ');
    $stmt->execute(array($id));
    $treinos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $treinos;
}
;

function fetchTempoTreinosPlanoFromID($id)
{
    global $dbh;
    $stmt = $dbh->prepare('
        SELECT Tipo_p.tempo_treino
        FROM Plano
        INNER JOIN Membro ON Plano.membro = Membro.id
        INNER JOIN Tipo_p ON Plano.tipo_p = Tipo_p.nome
        INNER JOIN Pessoa ON Membro.id = Pessoa.id
        WHERE Pessoa.id = ?
        ORDER BY Plano.data_adesao DESC
        LIMIT 1
    ');
    $stmt->execute(array($id));
    $tempo_treino_plano = $stmt->fetchColumn();
    return $tempo_treino_plano;
}
;

function fetchDetalhesMembroByEmail($email)
{
    global $dbh;
    $stmt = $dbh->prepare('
        SELECT Pessoa.nome, Pessoa.data_nascimento, Pessoa.nr_telemovel, Pessoa.email, Pessoa.morada, Pessoa.nif,
            Membro.altura, Membro.peso, Membro.imc, Membro.nutricionista, Membro.personaltrainer, Membro.sexo,
            Plano.data_adesao, Plano.tipo_p
        FROM Pessoa
        INNER JOIN Membro ON Membro.id = Pessoa.id
        LEFT JOIN Plano ON Plano.membro = Membro.id
        WHERE Pessoa.email = ?
        AND Plano.id = (
            SELECT MAX(id)
            FROM Plano
            WHERE Plano.membro = Membro.id
        )
    ');
    $stmt->execute(array($email));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}
;

$user = fetchDetalhesMembroByEmail($_SESSION['email']);

$nome = $user['nome'];
$data_nascimento = $user['data_nascimento'];
$nr_telemovel = $user['nr_telemovel'];
$email = $user['email'];
$morada = $user['morada'];
$nif = $user['nif'];
$altura = $user['altura'];
$peso = $user['peso'];
$imc = $user['imc'];
$sexo = $user['sexo'];
$tipo_plano = $user['tipo_p']; //tipo de plano atual
$data_adesao = $user['data_adesao']; //ultima data de adesao
$nutricionista_id = $user['nutricionista'];
$personaltrainer_id = $user['personaltrainer'];
$idade = date_diff(date_create($data_nascimento), date_create('today'))->y; // calcula a idade

// vai buscar os nomes do nutricionista e do personal trainer
$stmtNutricionista = $dbh->prepare('SELECT nome FROM Pessoa WHERE id = ?');
$stmtPersonalTrainer = $dbh->prepare('SELECT nome FROM Pessoa WHERE id = ?');
$stmtNutricionista->execute([$nutricionista_id]);
$stmtPersonalTrainer->execute([$personaltrainer_id]);
$nutricionista_nome = $stmtNutricionista->fetchColumn();
$personaltrainer_nome = $stmtPersonalTrainer->fetchColumn();

//calculo da proxima prestação
$data_atual = time();
$data_adesao_form = strtotime($data_adesao);
$dia_adesao = date('d', $data_adesao_form); // dia da data de adesão
$prox_pagam_form = strtotime("next month", $data_atual);
$mes_proxpagam = date('m', $prox_pagam_form); // mês da próxima prestação
$ano_proxpagam = date('Y', $prox_pagam_form); // ano da próxima prestação
$prox_pagam = $ano_proxpagam . '-' . $mes_proxpagam . '-' . $dia_adesao;

//calculo da quantidade de aulas de grupo disponiveis
$quantidade_ag = fetchQuantidadeAGByEmail($_SESSION['email']);
$NRinscricoes_ag = fetchNRInscricoesAGByEmail($_SESSION['email']);
$disponiveis_ag = $quantidade_ag - $NRinscricoes_ag;
$_SESSION['disponiveis_ag'] = $disponiveis_ag;

//verifica se o membro pode alterar o plano (se já passaram 5 meses desde a adesão)
$ha2Meses = date('Y-m-d', strtotime('-2 months'));
$alteracaoPermitida = strtotime($data_adesao) <= strtotime($ha2Meses);


//vai buscar info dos treinos
$treinos = fetchTreinos($_SESSION['id']);


//vai buscar o mes e ano selecionados, ou usa o mes e ano atuais
$ano_sel = isset($_GET['ano']) ? $_GET['ano'] : date('Y');
$mes_sel = isset($_GET['mes']) ? $_GET['mes'] : date('m');
//vai buscar os treinos por mês
$treinos_por_mes = array();
foreach ($treinos as $treino) {
    $ano_treino = date('Y', strtotime($treino['data'])); // Obtém o ano do treino
    $mes_treino = date('m', strtotime($treino['data'])); // Obtém o mês do treino
    if ($ano_treino == $ano_sel && $mes_treino == $mes_sel) {
        if (!isset($treinos_por_mes[$mes_treino])) {
            $treinos_por_mes[$mes_treino] = array(); // Initialize the array for the month if it doesn't exist
        }
        $treinos_por_mes[$mes_treino][] = $treino; // Add the training session to the corresponding month
    }
}


//calcula a duração total dos treinos no ultimo mes
$duracao_total = 0;
$mes_atual = date('m');
$ano_atual = date('Y');
if (isset($treinos_por_mes[$mes_atual])) {
    foreach ($treinos_por_mes[$mes_atual] as $treino) {
        $mes_treino = date('m', strtotime($treino['data']));
        $ano_treino = date('Y', strtotime($treino['data']));

        if ($mes_treino == $mes_atual && $ano_treino == $ano_atual) {
            $duracao_total += $treino['duracao_t'];
        }
    }
}
$meses = array(
    '01' => 'Janeiro',
    '02' => 'Fevereiro',
    '03' => 'Março',
    '04' => 'Abril',
    '05' => 'Maio',
    '06' => 'Junho',
    '07' => 'Julho',
    '08' => 'Agosto',
    '09' => 'Setembro',
    '10' => 'Outubro',
    '11' => 'Novembro',
    '12' => 'Dezembro'
);

//vai buscar os anos com treinos
$anos_treinos = array();
foreach ($treinos as $treino) {
    $ano = date('Y', strtotime($treino['data'])); // Obtém o ano do treino
    $anos_treinos[$ano] = $ano; // Adiciona o ano ao array
}

//vai buscar o tempo de treino do plano
$tempo_treino_plano = fetchTempoTreinosPlanoFromID($_SESSION['id']);
$tempo_treino_plano = intval($tempo_treino_plano);

//calcula o tempo de treino restante
$tempo_treino_restante = $tempo_treino_plano - $duracao_total;




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
?>

