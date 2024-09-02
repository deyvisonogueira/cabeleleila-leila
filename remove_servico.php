<?php
require_once("valida_session.php");
require_once("bd/bd_servico.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$codigo = $_GET['cod'];

// Verifica se o serviço está vinculado a um agendamento
if (servicoVinculadoAgendamento($codigo)) {
    $_SESSION['texto_erro'] = 'O serviço não pode ser excluído do sistema, pois está vinculado a um agendamento!';
    header("Location: servico.php");
    exit();
} else {
    $dados = removeServico($codigo);

    if ($dados == 0) {
        $_SESSION['texto_erro'] = 'Os dados do serviço não foram excluídos do sistema!';
    } else {
        $_SESSION['texto_sucesso'] = 'Os dados do serviço foram excluídos do sistema.';
    }
    header("Location: servico.php");
    exit();
}
?>
