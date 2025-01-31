<?php
require_once('valida_session.php');
require_once('header.php'); 
require_once('sidebar.php'); 
require_once ("bd/bd_agendamento.php");
require_once ("bd/bd_funcionario.php");

$codigo = $_GET['cod'];
$dados = buscaAgendamentoEditar($codigo);

$cod = $dados[0];
$nome_cliente = $dados[1];
$nome_funcionario = $dados[2];
$nome_servico = $dados[3];
$data_servico = $dados[4];
$horario = $dados[5];
$status = $dados[6];
$cod_funcionario = $dados[7];

$funcionarios = listaFuncionarios();

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
                        <h6 class="m-0 font-weight-bold text-primary" id="title">ATUALIZAR DADOS DO AGENDAMENTO DE SERVIÇO</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="user" action="editar_agendamento_envia.php" method="post">
                    <input type="hidden" name="cod" value="<?=$cod?>">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label> Nome do Cliente </label>
                            <input type="text" class="form-control form-control-user" id="nome_cliente" name="nome_cliente" value="<?= $nome_cliente ?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label> Serviço </label>
                            <input type="text" class="form-control form-control-user" id="nome_servico" name="nome_servico" value="<?= $nome_servico ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label> Funcionário </label>
                            <select class="form-control" id="cod_funcionario" name="cod_funcionario" required>
                                <option value="<?=$cod_funcionario?>"><?=$nome_funcionario?></option> 
                                <?php foreach($funcionarios as $dados):?>
                                <option value="<?=$dados['cod']?>"><?=$dados['nome']?></option> 
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label> Data do Serviço </label>
                            <input type="date" class="form-control form-control-user" id="data_servico" name="data_servico" value="<?= $data_servico ?>" required>
                        </div>
                        <div class="col-sm-6">
                            <label> Horaário </label>
                            <input type="time" class="form-control form-control-user" id="horario" name="horario" value="<?= $horario ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label> Situação </label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="1" <?php echo ($status == 1) ? 'selected': ''; ?>>Aberto</option>
                                <option value="2" <?php echo ($status == 2) ? 'selected': ''; ?>>Executando</option>
                                <option value="3" <?php echo ($status == 3) ? 'selected': ''; ?>>Concluída</option>
                            </select>
                        </div>                   
                    </div>
                    <div class="card-footer text-muted" id="btn-form">
                        <div class="text-right">
                            <a title="Voltar" href="agendamento.php"><button type="button" class="btn btn-success"><i class="fas fa-arrow-circle-left"></i>&nbsp;Voltar</button></a>
                            <a title="Adicionar"><button type="submit" name="updatebtn" class="btn btn-primary uptadebtn"><i class="fas fa-edit">&nbsp;</i>Atualizar</button> </a>
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
