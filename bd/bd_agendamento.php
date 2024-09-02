<?php 
require_once("conecta_db.php");

function consultaStatusUsuario($status){
    $conexao = conecta_db();
    $query = "SELECT count(*) AS total
                FROM agendamento
            WHERE status = '$status'";
    $resultado = mysqli_query($conexao,$query);
    $total  = mysqli_fetch_assoc($resultado);
    return $total;
}

function consultaStatusCliente($cod_usuario, $status){
    $conexao = conecta_db();
    $query = "SELECT count(*) AS total
                FROM agendamento
            WHERE cod_cliente='$cod_usuario' and status = '$status'";
    $resultado = mysqli_query($conexao,$query);
    $total  = mysqli_fetch_assoc($resultado);
    return $total;
}

function consultaStatusFuncionario($cod_usuario, $status){
    $conexao = conecta_db();
    $query = "SELECT count(*) AS total
                FROM agendamento
            WHERE cod_funcionario='$cod_usuario' and status = '$status'";
    $resultado = mysqli_query($conexao,$query);
    $total  = mysqli_fetch_assoc($resultado);
    return $total;
}

function listaAgendamento() {
    $conexao = conecta_db();
    $agendamento = array();
    $query = "SELECT
              o.cod AS cod,
              c.nome AS nome_cliente,
              t.nome AS nome_funcionario,
              s.nome AS nome_servico,
              o.data_servico AS data_servico,
              o.horario AS horario,
              o.status AS status
              FROM agendamento o, servico s, cliente c, funcionario t
              WHERE o.cod_cliente = c.cod AND
                    o.cod_servico = s.cod AND
                    o.cod_funcionario = t.cod
              ORDER by o.status ASC";
  
    $resultado = mysqli_query($conexao, $query);
    while ($dados = mysqli_fetch_array($resultado)) {
        array_push($agendamento, $dados);
    }
  
    return $agendamento;
}


function cadastraAgendamento($cod_cliente, $cod_servico, $cod_funcionario, $data_servico, $horario, $status, $data){
    $conexao = conecta_db();
    $query = "INSERT INTO agendamento(cod_cliente, cod_servico, cod_funcionario, data_servico, horario, status, data) 
              VALUES ('$cod_cliente','$cod_servico','$cod_funcionario','$data_servico','$horario',1,'$data')";
  
    $resultado = mysqli_query($conexao,$query);
    $dados = mysqli_affected_rows($conexao);
  
    return $dados;
}

function buscaAgendamentoAdd() {
    $conexao = conecta_db();
    $query = "SELECT 
              c.nome AS nome_cliente,
              t.nome AS nome_funcionario,
              s.nome AS nome_servico,
              s.valor AS valor_servico,
              o.data_servico AS data_servico,
              o.horario AS horario,
              o.status AS status
              FROM agendamento o, servico s, cliente c, funcionario t 
              WHERE o.cod_cliente = c.cod AND 
                    o.cod_servico = s.cod AND 
                    o.cod_funcionario = t.cod
              ORDER BY o.cod DESC LIMIT 1";
						  
    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_array($resultado);

    return $dados;
}


function buscaAgendamentoEditar($codigo) {
    $conexao = conecta_db();
    $query = "SELECT 
              o.cod AS cod,
              c.nome AS nome_cliente,
              t.nome AS nome_funcionario,
              s.nome AS nome_servico,
              o.data_servico AS data_servico,
              o.horario AS horario,
              o.status AS status,
              t.cod AS cod_funcionario
              FROM agendamento o, servico s, cliente c, funcionario t 
              WHERE o.cod_cliente = c.cod AND 
                    o.cod_servico = s.cod AND 
                    o.cod_funcionario = t.cod AND
                    o.cod = '$codigo'";
						  
    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_array($resultado);

    return $dados;
}


function editarAgendamento($codigo, $cod_funcionario, $data_servico, $horario, $status) {
    $conexao = conecta_db();
    $query = "SELECT * 
              FROM agendamento
              WHERE cod='$codigo'";
  
    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_num_rows($resultado);
  
    if ($dados == 1) {
        $query = "UPDATE agendamento
                  SET cod_funcionario = '$cod_funcionario', data_servico = '$data_servico', horario = '$horario', status = '$status'
                  WHERE cod = '$codigo'";
        $resultado = mysqli_query($conexao, $query);
        $dados = mysqli_affected_rows($conexao);
        return $dados;
    }
}

function listaAgendamentoCliente(){
    $conexao = conecta_db();
    $agendamento = array();
    $query = "SELECT
              o.cod AS cod,
              c.nome AS nome_cliente,
              t.nome AS nome_funcionario,
              s.nome AS nome_servico,
              o.data_servico AS data_servico,
              o.status AS status
              FROM agendamento o, servico s, cliente c, funcionario t
              WHERE o.cod_cliente = c.cod AND
                    o.cod_servico = s.cod AND
                    o.cod_funcionario = t.cod AND
                    o.cod_cliente = '".$_SESSION['cod_usu']."'
              ORDER by o.status ASC";
  
    $resultado = mysqli_query($conexao,$query);
    while($dados = mysqli_fetch_array($resultado)) {
      array_push($agendamento,$dados);
    }
  
    return $agendamento;
}

function listaAgendamentoFuncionario(){
    $conexao = conecta_db();
    $agendamento = array();
    $query = "SELECT
              o.cod AS cod,
              c.nome AS nome_cliente,
              t.nome AS nome_funcionario,
              s.nome AS nome_servico,
              o.data_servico AS data_servico,
              o.status AS status
              FROM agendamento o, servico s, cliente c, funcionario t
              WHERE o.cod_cliente = c.cod AND
                    o.cod_servico = s.cod AND
                    o.cod_funcionario = t.cod AND
                    o.cod_funcionario = '".$_SESSION['cod_usu']."'
              ORDER by o.status ASC";
  
    $resultado = mysqli_query($conexao,$query);
    while($dados = mysqli_fetch_array($resultado)) {
      array_push($agendamento,$dados);
    }
  
    return $agendamento;
}

function removeAgendamento($codigo){
    $conexao = conecta_db();
    $query = "DELETE FROM agendamento WHERE cod = '$codigo'";
    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_affected_rows($conexao);
    return $dados;
}

function editarAgendamentoFuncionario($codigo, $data_servico, $horario, $status, $data) {
    $conexao = conecta_db();
    $query = "SELECT * 
              FROM agendamento
              WHERE cod='$codigo'";
  
    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_num_rows($resultado);
  
    if ($dados == 1) {
        $query = "UPDATE agendamento
                  SET data_servico = '$data_servico', horario = '$horario', status = '$status', data = '$data'
                  WHERE cod = '$codigo'";
        $resultado = mysqli_query($conexao, $query);
        $dados = mysqli_affected_rows($conexao);
        return $dados;
    }
}
?>
