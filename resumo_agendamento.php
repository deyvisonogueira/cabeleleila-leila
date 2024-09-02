<?php
require_once('valida_session.php');
require_once('header.php'); 
require_once('sidebar.php'); 
require_once ("bd/bd_agendamento.php"); // Alterado para bd_agendamento
require_once ("bd/bd_cliente.php");
require_once ("bd/bd_funcionario.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dados = buscaAgendamentoAdd(); // Alterado para buscaAgendamento()

$nome_cliente = $dados[0];
$nome_funcionario = $dados[1]; // Atualizado para "funcionario"
$nome_servico = $dados[2];
$valor_servico = $dados[3];
$data_servico = $dados[4];
$horario = $dados[5]; // Adicionando o horário
$status = $dados[6];
?>

<!-- Main Content -->
<div id="content">

    <?php require_once('navbar.php');?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="m-0 font-weight-bold text-primary" id="title">AGENDAMENTO DE SERVIÇO</h6> <!-- Alterado para Agendamento -->
                    </div>
                </div>
            </div>
            <div class="card-body">
            <?php
            if (isset($_SESSION['texto_sucesso'])):
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-check"></i>&nbsp;&nbsp;<?= $_SESSION['texto_sucesso'] ?></strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
                unset($_SESSION['texto_sucesso']);
            endif;
            ?>

                <form class="user" action="cad_agendamento_envia.php" method="post"> <!-- Alterado para cad_agendamento_envia.php -->
                    
                        <div class="form-group">
                            <label> Nome do Cliente </label>
                            <input type="text" class="form-control form-control-user" id="nome_cliente" name="nome_cliente" value="<?= $nome_cliente ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label> Serviço </label>
                            <input type="text" class="form-control form-control-user" id="nome_servico" name="nome_servico" value="<?= $nome_servico ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label> Valor do Serviço </label>
                            <input type="text" class="form-control form-control-user"
                            id="valor_servico" name="valor_servico" value="<?= $valor_servico?>" readonly>
                        </div> 

                        <div class="form-group">
                            <label> Funcionário </label>
                            <input type="text" class="form-control form-control-user" id="nome_funcionario" name="nome_funcionario" value="<?= $nome_funcionario ?>" readonly>
                        </div>

                         <div class="form-group">
                            <label> Data do Serviço </label>
                            <input type="text" class="form-control form-control-user" id="data_servico" name="data_servico" value="<?= date('d/m/Y',strtotime($data_servico)) ?>" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label> Horário do Serviço </label>
                            <input type="text" class="form-control form-control-user" id="horario" name="horario" value="<?= isset($horario) ? $horario : '' ?>" readonly>
                        </div>                          

                    <div class="card-footer text-muted" id="btn-form">
                        <div class="text-right">
                            <a title="Voltar" href="agendamento.php"><button type="button" class="btn btn-success"><i class="fas fa-arrow-circle-left"></i>&nbsp;Voltar</button></a>
                        </div>
                    </div>
                </form>  
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>

<!-- End of Main Content -->
<?php
require_once('footer.php');
?>
