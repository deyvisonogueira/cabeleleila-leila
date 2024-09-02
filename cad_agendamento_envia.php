<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$cod_cliente = $_POST["cod_cliente"];
$cod_servico = $_POST["cod_servico"];
$cod_funcionario = $_POST["cod_funcionario"];
$data_servico = $_POST["data_servico"];
$horario = $_POST["horario"];

$status = 1;
$data=date("y/m/d");

require_once ("bd/bd_agendamento.php");

$dados = cadastraAgendamento($cod_cliente, $cod_servico, $cod_funcionario, $data_servico, $horario, $status, $data);
if($dados == 1){
    $_SESSION['texto_sucesso'] = 'Ordem de serviço aberta com sucesso.';
    unset($_SESSION['texto_erro']);
    header ("Location:resumo_agendamento.php");
}else{
    $_SESSION['texto_erro'] = 'O dados não foram adicionados no sistema!';
    header ("Location:cad_agendamento.php");
}

?>