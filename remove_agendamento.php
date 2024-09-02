<?php 
	require_once("valida_session.php");
	require_once ("bd/bd_agendamento.php");

	$codigo = $_GET['cod'];

	$dados = removeAgendamento($codigo);

	if($dados == 0){
		$_SESSION['texto_erro'] = 'Os dados do agendamento não foram excluídos do sistema!';
		header ("Location:agendamento.php");
	}else{
		$_SESSION['texto_sucesso'] = 'Os dados do agendamento foram excluídos do sistema.';
		header ("Location:agendamento.php");
	}
?>
