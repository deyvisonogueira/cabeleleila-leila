<?php

if ($_SESSION['perfil'] == 1) {
    $texto = "PAINEL ADMINISTRATIVO DO USUÁRIO";
} elseif ($_SESSION['perfil'] == 2) {
    $texto = "PAINEL ADMINISTRATIVO DO CLIENTE";
} else {
    $texto = "PAINEL ADMINISTRATIVO DO FUNCIONÁRIO";
}

?>
<!-- Incluir o link do Google Fonts para a fonte Newsreader -->
<link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

<!-- Topbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow mb-4 static-top" style="font-family: 'Newsreader', serif;">
    <div class="container-fluid">
        <!-- Navbar brand -->
        <a class="navbar-brand" href="#" style="color: #426B1F;">
            Cabeleleila Leila </a>

        <!-- Toggle button for mobile view -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <!-- Links -->
                <li class="nav-item">
                    <a class="nav-link" href="#">Painel de Controle</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Quem somos</a>
                </li>
                    <a class="nav-link" href="#">Administradores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Funcionários</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Serviços</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Agendamentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contato</a>
                </li>

                <!-- Divider -->
                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                            <?php echo $_SESSION['nome_usu'] ?>
                        </span>
                        <i class="fa fa-arrow-circle-down"></i>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <?php if ($_SESSION['perfil'] == 1) { ?>
                            <a class="dropdown-item" href="editar_perfil_usuario.php">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-900"></i>
                                Perfil do Usuário
                            </a>
                        <?php } elseif ($_SESSION['perfil'] == 2) { ?>
                            <a class="dropdown-item" href="editar_perfil_cliente.php">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-900"></i>
                                Perfil do Cliente
                            </a>
                        <?php } elseif ($_SESSION['perfil'] == 3) { ?>
                            <a class="dropdown-item" href="editar_perfil_funcionario.php">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-900"></i>
                                Perfil do Funcionário
                            </a>
                        <?php } ?>
                        <a class="dropdown-item" href="editar_senha.php">
                            <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-900"></i>
                            Senha
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-900"></i>
                            Sair
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End of Topbar -->
