<?php
    require_once('valida_session.php');
    require_once('header.php'); 
    require_once ("bd/bd_agendamento.php");
?>

<!-- Main Content -->
<div id="content" class="container-fluid p-0">
 <?php require_once('navbar.php');?>

 <!-- Begin Page Content -->
 <div class="container-fluid justify-content-center d-flex p-3 align-items-center h-100">

    <!-- Content Row -->
    <div class="row justify-content-center">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4" id="cards-notice">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Agendamentos marcados</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                                if ($_SESSION['perfil'] == 1) {
                                    $status = 1;
                                    $total = consultaStatusUsuario($status);
                                    $totalValue = $total['total'];
                                    echo '<a href="agendamento_aberta.php"' . $total['total'] . '" style="color: #e74a3b;">' . $total['total'] . '</a>';
                                }
                                if ($_SESSION['perfil'] == 2) {
                                    $cod_usuario = $_SESSION['cod_usu'];
                                    $status = 1;
                                    $total = consultaStatusCliente($cod_usuario,$status);
                                    $totalValue = $total['total'];
                                    echo '<a href="agendamento_aberta.php"' . $total['total'] . '" style="color: #e74a3b;">' . $total['total'] . '</a>';
                                }
                                if ($_SESSION['perfil'] == 3) {
                                    $cod_usuario = $_SESSION['cod_usu'];
                                    $status = 1;
                                    $total = consultaStatusFuncionario($cod_usuario,$status);
                                    $totalValue = $total['total'];
                                    echo '<a href="agendamento_aberta.php"' . $total['total'] . '" style="color: #e74a3b;">' . $total['total'] . '</a>';
                                }
                            ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4" id="cards-notice">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Agendamentos em atendimento  
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                              <?php
                                if ($_SESSION['perfil'] == 1) {
                                    $status = 2;
                                    $total = consultaStatusUsuario($status);
                                    $totalValue = $total['total'];
                                    echo '<a href="agendamento_execucao.php"' . $total['total'] . '" style="color: #f6c23e;">' . $total['total'] . '</a>';
                                }
                                if ($_SESSION['perfil'] == 2) {
                                    $cod_usuario = $_SESSION['cod_usu'];
                                    $status = 2;
                                    $total = consultaStatusCliente($cod_usuario,$status);
                                    $totalValue = $total['total'];
                                    echo '<a href="agendamento_execucao.php"' . $total['total'] . '" style="color: #f6c23e;">' . $total['total'] . '</a>';
                                }
                                if ($_SESSION['perfil'] == 3) {
                                    $cod_usuario = $_SESSION['cod_usu'];
                                    $status = 2;
                                    $total = consultaStatusFuncionario($cod_usuario,$status);
                                    $totalValue = $total['total'];
                                    echo '<a href="agendamento_execucao.php"' . $total['total'] . '" style="color: #f6c23e;">' . $total['total'] . '</a>';
                                }
                            ?>  
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4" id="cards-notice">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Agendamentos concluídos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                if ($_SESSION['perfil'] == 1) {
                                    $status = 3;
                                    $total = consultaStatusUsuario($status);
                                    $totalValue = $total['total'];
                                    echo '<a href="agendamento_comcluidas.php"' . $total['total'] . '" style="color: #36b9cc;">' . $total['total'] . '</a>';
                                }
                                if ($_SESSION['perfil'] == 2) {
                                    $cod_usuario = $_SESSION['cod_usu'];
                                    $status = 3;
                                    $total = consultaStatusCliente($cod_usuario,$status);
                                    $totalValue = $total['total'];
                                    echo '<a href="agendamento_comcluidas.php"' . $total['total'] . '" style="color: #36b9cc;">' . $total['total'] . '</a>';
                                }
                                if ($_SESSION['perfil'] == 3) {
                                    $cod_usuario = $_SESSION['cod_usu'];
                                    $status = 3;
                                    $total = consultaStatusFuncionario($cod_usuario,$status);
                                    $totalValue = $total['total'];
                                    echo '<a href="agendamento_comcluidas.php"' . $total['total'] . '" style="color: #36b9cc;">' . $total['total'] . '</a>';
                                }
                            ?>  
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

</div>
<!-- /.container-fluid -->
<?php
    require_once('footer.php');
?>
</div>


