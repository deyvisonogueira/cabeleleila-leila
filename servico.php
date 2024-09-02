<?php
require_once('valida_session.php');
require_once('header.php'); 
require_once('sidebar.php'); 
unset ($_SESSION['nome']);
unset ($_SESSION['valor']);
?>

<!-- Main Content -->
<div id="content">

    <?php require_once('navbar.php');?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card shadow mb-2">
            <div class="card-header py-3 text-center">
                <h6 class="m-0 font-weight-bold text-primary" id="title">GERENCIAR INFORMAÇÕES DOS SERVIÇOS</h6>
            </div>
            <div class="card-body">
                <?php
                if (isset($_SESSION['texto_erro'])):
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?= $_SESSION['texto_erro'] ?></strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                    unset($_SESSION['texto_erro']);
                endif;
                ?>

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

                <!-- Botão Adicionar Serviço -->
                <div class="text-right mb-3">
                    <a title="Adicionar novo serviço" href="cad_servico.php">
                        <button type="button" class="btn btn-primary btn-sm">
                            <i class="fas fa-fw fa-wrench">&nbsp;</i> Adicionar Serviço
                        </button>
                    </a>
                </div>

                <!-- Cards de Serviços -->
                <div class="row">
                    <?php 
                    require_once ("bd/bd_servico.php");
                    $servicos = listaServicos();
                    foreach($servicos as $dados): 
                        ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <!-- Imagem do Serviço -->
                                <img src="caminho/para/imagem/<?=$dados['imagem'];?>" class="card-img-top" alt="Imagem do Serviço">

                                <!-- Corpo do Card -->
                                <div class="card-body">
                                    <h5 class="card-title"><?= $dados['nome'] ?></h5>
                                    <p class="card-text">Valor: R$<?= number_format($dados['valor'] ,2,",",".");?></p>
                                </div>

                                <!-- Botões de Ação -->
                                <div class="card-footer">
                                    <a href="editar_servico.php?cod=<?=$dados['cod']; ?>" class="btn btn-sm btn-success">
                                        <i class="fas fa-edit"></i> Atualizar
                                    </a>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#excluir-<?=$dados['cod'];?>" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i> Excluir
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Modal de Confirmação de Exclusão -->
                        <div class="modal fade" id="excluir-<?=$dados['cod'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Excluir Serviço</h5>
                                    </div>
                                    <div class="modal-body">Deseja realmente excluir esta informação?</div>
                                    <div class="modal-footer">
                                        <a href="remove_servico.php?cod=<?=$dados['cod'];?>">
                                            <button class="btn btn-primary btn-user" type="button">Confirmar</button>
                                        </a>
                                        <a href="servico.php">
                                            <button class="btn btn-danger btn-user" type="button">Cancelar</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach ?>
                </div>

            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <?php
    require_once('footer.php');
    ?>
</div>
