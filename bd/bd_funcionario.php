<?php 

require_once("conecta_db.php");

function checaFuncionario($email, $senha) {
    $conexao = conecta_db();
    $senhaMD5 = md5($senha);
    $query = "SELECT * 
              FROM funcionario 
              WHERE email='$email' and 
                senha='$senhaMD5'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_array($resultado);

    return $dados;
}

function listaFuncionarios() {
    $conexao = conecta_db();
    $usuarios = array();
    $query = "SELECT * 
              FROM funcionario
              ORDER BY nome";

    $resultado = mysqli_query($conexao, $query);
    while ($dados = mysqli_fetch_array($resultado)) {
        array_push($usuarios, $dados);
    }

    return $usuarios;
}

function buscaFuncionario($email) {
    $conexao = conecta_db();
    $query = "SELECT * 
              FROM funcionario
              WHERE email='$email'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_num_rows($resultado);

    return $dados;
}

function cadastraFuncionario($nome, $email, $telefone, $senha, $cep, $endereco, $numero, $bairro, $cidade, $estado, $status, $perfil, $data) {
    $conexao = conecta_db();
    $query = "INSERT INTO funcionario(nome, email, telefone, senha, cep, endereco, numero, bairro, cidade, estado, status, perfil, data) 
              VALUES ('$nome', '$email', '$telefone', '$senha', '$cep', '$endereco', '$numero', '$bairro', '$cidade', '$estado', '$status', '$perfil', '$data')";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_affected_rows($conexao);

    return $dados;
}

function buscaFuncionarioEditar($codigo) {
    $conexao = conecta_db();
    $query = "SELECT * 
              FROM funcionario 
              WHERE cod='$codigo'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_array($resultado);

    return $dados;
}

function editarPerfilFuncionario($codigo, $nome, $email, $telefone, $cep, $endereco, $numero, $bairro, $cidade, $estado, $data) {
    $conexao = conecta_db();
    $query = "SELECT * 
              FROM funcionario 
              WHERE cod='$codigo'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_num_rows($resultado);

    if ($dados == 1) {
        $query = "UPDATE funcionario
                  SET nome = '$nome', email = '$email', telefone = '$telefone', cep = '$cep', endereco = '$endereco', 
                      numero = '$numero', bairro = '$bairro', cidade = '$cidade', estado = '$estado', data ='$data'
                  WHERE cod = '$codigo'";
        $resultado = mysqli_query($conexao, $query);
        $dados = mysqli_affected_rows($conexao);
        return $dados;
    }
}

function editarSenhaFuncionario($codigo, $senha) {
    $conexao = conecta_db();
    $query = "SELECT * 
              FROM funcionario
              WHERE cod='$codigo'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_num_rows($resultado);

    if ($dados == 1) {
        $query = "UPDATE funcionario
                  SET senha = '$senha'
                  WHERE cod = '$codigo'";
        $resultado = mysqli_query($conexao, $query);
        $dados = mysqli_affected_rows($conexao);
        return $dados;
    }
}

function editarFuncionario($codigo, $status, $data) {
    $conexao = conecta_db();
    $query = "SELECT * 
              FROM funcionario 
              WHERE cod='$codigo'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_num_rows($resultado);

    if ($dados == 1) {
        $query = "UPDATE funcionario
                  SET status = '$status', data ='$data'
                  WHERE cod = '$codigo'";
        $resultado = mysqli_query($conexao, $query);
        $dados = mysqli_affected_rows($conexao);
        return $dados;
    }
}

function removeFuncionario($codigo) {
    $conexao = conecta_db();
    $query = "DELETE FROM funcionario WHERE cod = '$codigo'";
    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_affected_rows($conexao);
    return $dados;
}

function funcionarioVinculadoAgendamento($codigo_funcionario) {
    $conexao = conecta_db();
    $query = "SELECT COUNT(*) AS total FROM agendamento WHERE cod_funcionario = '$codigo_funcionario'";
    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_array($resultado);
    return $dados['total'] > 0;
}
?>
