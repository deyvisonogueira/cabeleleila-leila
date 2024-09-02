<?php
    require_once("valida_session.php");
    require_once("bd/bd_cliente.php");

    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $codigo = $_GET['cod'];

    if ($_SESSION['cod_usu'] != $codigo) {
        if (clienteVinculadoAgenda($codigo)) {
            $_SESSION['texto_erro'] = 'O cliente não pode ser excluído do sistema, pois está vinculado a uma ordem de serviço!';
            header("Location:cliente.php");
        } else {
            $dados = removeCliente($codigo);

            if ($dados == 0) {
                $_SESSION['texto_erro'] = 'Os dados do cliente não foram excluídos do sistema!';
            } else {
                $_SESSION['texto_sucesso'] = 'Os dados do cliente foram excluídos do sistema.';
            }
            header("Location:cliente.php");
        }
    } else {
        $_SESSION['texto_erro'] = 'O cliente não pode ser excluído do sistema, pois está logado!';
        header("Location:cliente.php");
    }
?>