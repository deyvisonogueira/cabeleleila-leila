<?php
// Inclui os arquivos necessários para validação de sessão, cabeçalho e barra lateral
require_once('valida_session.php'); 
require_once('header.php'); 
require_once('sidebar.php'); 
require_once('bd/bd_usuario.php'); // Inclui o arquivo que contém funções relacionadas ao banco de dados de usuários
?>

<!-- Conteúdo Principal -->
<div id="content">

    <?php require_once('navbar.php'); ?> <!-- Inclui a barra de navegação -->

    <!-- Início do Conteúdo da Página -->
    <div class="container-fluid">

        <div class="card shadow mb-2">
            <div class="card-header py-3">

                <div class="row">
                    <div class="col-md-8">
                        <!-- Título da Página -->
                        <h6 class="m-0 font-weight-bold text-primary" id="title">ORDEM DE SERVIÇO ABERTAS</h6>
                    </div>
                    <?php 
                    // Verifica se o usuário tem o perfil de administrador (perfil 1)
                    if ($_SESSION['perfil'] == 1) {
                    ?>
                        <div class="col-md-4 card_button_title">
                            <!-- Botão para adicionar nova ordem de serviço, visível apenas para administradores -->
                            <a title="Adicionar nova ordem" href="cad_ordem.php">
                                <button type="button" class="btn btn-primary btn-sm card_button_title" data-toggle="modal" id="">
                                    <i class="fas fa-fw fa-clipboard-list">&nbsp;</i> Adicionar Ordem
                                </button>
                            </a>
                        </div>
                    <?php 
                    }
                    ?> 
                </div>

            </div>
            <div class="card-body">
                <?php
                // Exibe mensagem de erro, caso exista
                if (isset($_SESSION['texto_erro'])):
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?= $_SESSION['texto_erro'] ?></strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                    unset($_SESSION['texto_erro']); // Remove a mensagem de erro da sessão
                endif;
                ?>

                <?php
                // Exibe mensagem de sucesso, caso exista
                if (isset($_SESSION['texto_sucesso'])):
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-check"></i>&nbsp;&nbsp;<?= $_SESSION['texto_sucesso'] ?></strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                    unset($_SESSION['texto_sucesso']); // Remove a mensagem de sucesso da sessão
                endif;
                ?>
                
                <!-- Tabela que lista as ordens de serviço -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <!-- Cabeçalho da tabela -->
                                <th style="display:none";>cod</th>
                                <th>Nome do Cliente</th>
                                <th>Funcionário</th>
                                <th>Serviço</th>
                                <th class="text-center">Data do Serviço</th>
                                <?php 
                                // Exibe colunas de "Atualizar" e "Excluir" apenas para administradores (perfil 1) ou funcionários com perfil específico (perfil 3)
                                if ($_SESSION['perfil'] == 1) {
                                ?>
                                    <th class="text-center" data-orderable="false">Atualizar</th>
                                    <th class="text-center" data-orderable="false">Excluir</th>
                                <?php 
                                } elseif ($_SESSION['perfil'] == 3) { // Para outro perfil específico, apenas a coluna "Atualizar" é exibida
                                ?>
                                    <th class="text-center" data-orderable="false">Atualizar</th>
                                <?php 
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        require_once("bd/bd_ordem.php"); // Inclui o arquivo que contém funções relacionadas ao banco de dados de ordens
                        
                        // Se o usuário é administrador (perfil 1), lista todas as ordens de serviço
                        if ($_SESSION['perfil'] == 1) {
                            $ordem = listaOrdem();
                            foreach($ordem as $dados): 
                                if($dados[5] == 1): ?> <!-- Verifica se a ordem está ativa -->
                                    <tr>
                                        <!-- Exibe as informações das ordens de serviço -->
                                        <td style="display:none"><?= $dados[0] ?></td>
                                        <td><?= $dados[1] ?></td>
                                        <td><?= $dados[2] ?></td>
                                        <td><?= $dados[3] ?></td>
                                        <td class="text-center"><?= date('d/m/Y', strtotime($dados[4])) ?></td>
                                        <td class="text-center">
                                            <!-- Botão para atualizar a ordem de serviço -->
                                            <?php if($dados[5] == 1): ?>
                                                <a title="Atualizar" href="editar_ordem.php?cod=<?= $dados[0]; ?>" class="btn btn-sm btn-success"><i class="fas fa-edit">&nbsp;</i>Atualizar</a>
                                            <?php endif ?>
                                        </td>
                                        <td class="text-center">
                                            <!-- Botão para excluir a ordem de serviço -->
                                            <?php if (($dados[5] == 1) || ($dados[5] == 3)): ?> 
                                                <a title="Excluir" href="javascript:void(0)" data-toggle="modal" data-target="#excluir-<?= $dados[0]; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt">&nbsp;</i>Excluir</a>
                                            <?php endif ?>
                                        </td> 
                                    </tr>

                                    <!-- Modal de confirmação para exclusão da ordem de serviço -->
                                    <div class="modal fade" id="excluir-<?= $dados[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Excluir ordem</h5>
                                                </div>
                                                <div class="modal-body">Deseja realmente excluir esta informação?</div>
                                                <div class="modal-footer">
                                                    <a href="remove_ordem.php?cod=<?= $dados[0]; ?>"><button class="btn btn-primary btn-user" type="button">Confirmar</button></a>
                                                    <a href="ordem.php"><button class="btn btn-danger btn-user" type="button">Cancelar</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; endforeach; 
                            } 
                        
                        // Se o usuário é cliente (perfil 2), lista apenas as ordens de serviço relacionadas ao cliente
                        if ($_SESSION['perfil'] == 2) {
                            $ordem = listaOrdemCliente();
                            foreach($ordem as $dados): 
                                if($dados[5] == 1): ?>
                                    <tr>
                                        <!-- Exibe as informações das ordens de serviço -->
                                        <td style="display:none"><?= $dados[0] ?></td>
                                        <td><?= $dados[1] ?></td>
                                        <td><?= $dados[2] ?></td>
                                        <td><?= $dados[3] ?></td>
                                        <td class="text-center"><?= date('d/m/Y', strtotime($dados[4])) ?></td>
                                    </tr>
                                <?php endif; endforeach; 
                            } 
                        
                        // Se o usuário é funcionário (perfil 3), lista as ordens de serviço relacionadas ao funcionário
                        if ($_SESSION['perfil'] == 3) {
                            $ordem = listaOrdemFuncionario();
                            foreach($ordem as $dados): 
                                if($dados[5] == 1): ?>
                                    <tr>
                                        <!-- Exibe as informações das ordens de serviço -->
                                        <td style="display:none"><?= $dados[0] ?></td>
                                        <td><?= $dados[1] ?></td>
                                        <td><?= $dados[2] ?></td>
                                        <td><?= $dados[3] ?></td>
                                        <td class="text-center"><?= date('d/m/Y', strtotime($dados[4])) ?></td>
                                        <td class="text-center">
                                            <!-- Botão para atualizar a ordem de serviço -->
                                            <?php if($dados[5] == 1): ?>
                                                <a title="Atualizar" href="editar_ordem_treceirizado.php?cod=<?= $dados[0]; ?>" class="btn btn-sm btn-success"><i class="fas fa-edit">&nbsp;</i>Atualizar</a>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endif; endforeach; 
                            } 
                                ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Inclui o rodapé -->
<?php require_once('footer.php'); ?>
</div>

<!-- Script para remover a mensagem de erro ou sucesso após um curto período -->
<script>
  $(document).ready(function() {
      window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
      }, 4000);
  });    
</script>

</body>
</html>
