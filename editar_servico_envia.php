<?php
require_once("valida_session.php");
require_once ("bd/bd_servico.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	     
$codigo = $_POST["cod"];
$nome = $_POST["nome"];
$valor = $_POST["valor"];
$data=date("y/m/d");

$dados = editarServico($codigo,$nome,$valor,$data);
if ($dados == 1){
	$_SESSION['texto_sucesso'] = 'Os dados do serviço foram alterados no sistema.';
	header ("Location:servico.php");
}else{
	$_SESSION['texto_erro'] = 'Os dados do serviço não foram alterados no sistema!';
	header ("Location:servico.php");
}

		
?>