<?php
require_once("valida_session.php");
require_once("bd/bd_funcionario.php");

$codigo = $_GET['cod'];

if ($_SESSION['cod_usu'] != $codigo) {
    if (funcionarioVinculadoAgendamento($codigo)) {
        $_SESSION['texto_erro'] = 'O funcionário não pode ser excluído do sistema, pois está vinculado a um agendamento!';
        header("Location: funcionario.php");
    } else {
        $dados = removeFuncionario($codigo);

        if ($dados == 0) {
            $_SESSION['texto_erro'] = 'Os dados do funcionário não foram excluídos do sistema!';
        } else {
            $_SESSION['texto_sucesso'] = 'Os dados do funcionário foram excluídos do sistema.';
        }
        header("Location: funcionario.php");
    }
} else {
    $_SESSION['texto_erro'] = 'O funcionário não pode ser excluído do sistema, pois está logado!';
    header("Location: funcionario.php");
}
?>
