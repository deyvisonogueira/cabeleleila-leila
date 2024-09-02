<?php
require_once('valida_session.php');
require_once('header.php');
require_once('sidebar.php');
require_once('bd/bd_servico.php');
require_once('bd/bd_cliente.php');
require_once('bd/bd_funcionario.php');

// Obtendo clientes, serviços e funcionários do banco de dados
$clientes = listaClientes(); // Função que retorna a lista de clientes
$servicos = listaServicos(); // Função que retorna a lista de serviços
$funcionarios = listaFuncionarios(); // Função que retorna a lista de funcionários
?>

<!-- Main Content -->
<div id="content">
   <?php require_once('navbar.php');?>

   <!-- Begin Page Content -->
   <div class="container-fluid">

       <div class="card shadow mb-4">
           <div class="card-header py-3">
               <h1 class="h3 mb-0 font-weight-bold text-primary">Adicionar Agendamento de Serviço</h1>
           </div>
           <div class="card-body">
               <p>Preencha os dados abaixo para agendar um novo serviço.</p>

               <!-- Exibindo Mensagens de Sucesso e Erro -->
               <?php if (isset($_SESSION['texto_erro'])): ?>
                   <div class="alert alert-danger alert-dismissible fade show" role="alert">
                       <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?= $_SESSION['texto_erro'] ?></strong>
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <?php unset($_SESSION['texto_erro']); ?>
               <?php endif; ?>
               
               <?php if (isset($_SESSION['texto_sucesso'])): ?>
                   <div class="alert alert-success alert-dismissible fade show" role="alert">
                       <strong><i class="fas fa-check"></i>&nbsp;&nbsp;<?= $_SESSION['texto_sucesso'] ?></strong>
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <?php unset($_SESSION['texto_sucesso']); ?>
               <?php endif; ?>

               <!-- Formulário de Agendamento -->
               <form action="cad_agendamento_envia.php" method="post">
                   <div class="row">
                       <!-- Seção de Clientes -->
                       <div class="col-md-4">
                           <div class="card mb-4">
                               <div class="card-body">
                                   <h5 class="card-title">Cliente</h5>
                                   <select name="cod_cliente" class="form-control mb-3" required>
                                       <option value="">Selecione um cliente</option>
                                       <?php foreach($clientes as $cliente): ?>
                                           <option value="<?= $cliente['cod'] ?>"><?= $cliente['nome'] ?></option>
                                       <?php endforeach; ?>
                                   </select>
                               </div>
                           </div>
                       </div>

                       <!-- Seção de Serviços -->
                       <div class="col-md-4">
                           <div class="card mb-4">
                               <div class="card-body">
                                   <h5 class="card-title">Serviço</h5>
                                   <select name="cod_servico" class="form-control mb-3" required>
                                       <option value="">Selecione um serviço</option>
                                       <?php foreach($servicos as $servico): ?>
                                           <option value="<?= $servico['cod'] ?>"><?= $servico['nome'] ?></option>
                                       <?php endforeach; ?>
                                   </select>
                               </div>
                           </div>
                       </div>

                       <!-- Seção de Funcionários -->
                       <div class="col-md-4">
                           <div class="card mb-4">
                               <div class="card-body">
                                   <h5 class="card-title">Funcionário</h5>
                                   <select name="cod_funcionario" class="form-control mb-3" required>
                                       <option value="">Selecione um funcionário</option>
                                       <?php foreach($funcionarios as $funcionario): ?>
                                           <option value="<?= $funcionario['cod'] ?>"><?= $funcionario['nome'] ?></option>
                                       <?php endforeach; ?>
                                   </select>
                               </div>
                           </div>
                       </div>
                   </div>

                   <div class="row">
                       <!-- Data do Serviço -->
                       <div class="col-md-6">
                           <div class="card mb-4">
                               <div class="card-body">
                                   <h5 class="card-title">Data do Serviço</h5>
                                   <input type="date" name="data_servico" class="form-control mb-3" required>
                               </div>
                           </div>
                       </div>

                       <!-- Horário -->
                       <div class="col-md-6">
                           <div class="card mb-4">
                               <div class="card-body">
                                   <h5 class="card-title">Horários</h5>
                                   <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                                        <label class="btn btn-outline-secondary">
                                           <input type="radio" name="horario" value="08:00" autocomplete="off" required> 08:00
                                        </label>
                                        <label class="btn btn-outline-secondary">
                                           <input type="radio" name="horario" value="09:00" autocomplete="off" required> 09:00
                                       </label>
                                       <label class="btn btn-outline-secondary">
                                           <input type="radio" name="horario" value="10:00" autocomplete="off"> 10:00
                                       </label>
                                       <label class="btn btn-outline-secondary">
                                           <input type="radio" name="horario" value="11:00" autocomplete="off"> 11:00
                                       </label>
                                       <label class="btn btn-outline-secondary">
                                           <input type="radio" name="horario" value="12:00" autocomplete="off"> 11:00
                                       </label>
                                    </div>
                                    <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                                       <label class="btn btn-outline-secondary">
                                           <input type="radio" name="horario" value="13:00" autocomplete="off"> 13:00
                                       </label>
                                       <label class="btn btn-outline-secondary">
                                           <input type="radio" name="horario" value="14:00" autocomplete="off"> 14:00
                                       </label>
                                       <label class="btn btn-outline-secondary">
                                           <input type="radio" name="horario" value="15:00" autocomplete="off"> 15:00
                                       </label>
                                       <label class="btn btn-outline-secondary">
                                           <input type="radio" name="horario" value="16:00" autocomplete="off"> 16:00
                                       </label>
                                       <label class="btn btn-outline-secondary">
                                           <input type="radio" name="horario" value="17:00" autocomplete="off"> 17:00
                                       </label>
                                       <!-- Adicione mais horários conforme necessário -->
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>

                   <button type="submit" class="btn btn-success btn-block">Adicionar</button>
               </form>
           </div>
       </div>
   </div>
   <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php require_once('footer.php'); ?>
