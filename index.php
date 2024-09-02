<?php
session_start();
require_once('header.php'); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .font-newsreader {
            font-family: 'Newsreader', serif;
        }
        .form-control-user, .form-control-user select {
            font-family: 'Newsreader', serif;
            font-size: 1rem;
            padding: 0.75rem 1rem;
            border-radius: 10rem;
            border: 1px solid #ced4da;
            width: 100%;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="card shadow-lg my-5" style="border: none;">
                    <div class="card-body p-5">
                        
                        <!-- Título Centralizado -->
                        <div class="text-center mb-4">
                            <h1 class="h3" style="color: #426B1F; font-weight: bold; font-family: 'Newsreader', serif;">Cabeleleila Leila</h1>
                            <hr style="width: 50%; margin: auto; border-top: 1px solid black;">
                        </div>

                        <div class="text-center">
                            <h1 class="h4 mb-4 font-newsreader" style="color: black;">Login</h1>
                        </div>

                        <?php
                        if (isset($_SESSION['msg_sucesso'])):
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><i class="fas fa-check-circle"></i>&nbsp;&nbsp;<?= $_SESSION['msg_sucesso'] ?></strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                        unset($_SESSION['msg_sucesso']);
                        endif;
                        
                        if (isset($_SESSION['texto_erro_login'])):
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?= $_SESSION['texto_erro_login'] ?></strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                        unset($_SESSION['texto_erro_login']);
                        endif;
                        ?>
                        
                        <form class="user" action="valida_login.php" method="post">
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user"
                                    id="email" name="email" aria-describedby="emailHelp"
                                    placeholder="Endereço de Email..." required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user"
                                    id="senha" name="senha" placeholder="Senha" required>
                            </div>
                            <div class="form-group">
                                <select class="form-control form-control-user" id="perfil" name="perfil" required>
                                    <option value="">Selecione o perfil</option>
                                    <option value="1" <?= (isset($_SESSION['perfil']) && $_SESSION['perfil'] == '1') ? 'selected' : '' ?>>Administrador</option>
                                    <option value="2" <?= (isset($_SESSION['perfil']) && $_SESSION['perfil'] == '2') ? 'selected' : '' ?>>Cliente</option>
                                    <option value="3" <?= (isset($_SESSION['perfil']) && $_SESSION['perfil'] == '3') ? 'selected' : '' ?>>Funcionário</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" style="display: block; margin: 0 auto; width: auto; background-color: #426B1F; border-color: #426B1F;">
                                Acessar
                            </button>
                        </form>
                        <div class="text-center mt-3">
                            <a class="small" href="esqueci_senha.php" style="color: #426B1F;">Esqueci minha senha</a>
                        </div>
                        <div class="text-center mt-3">
                            <a class="small" href="cadastrar_novo_cliente.php" style="color: #426B1F;">Cadastrar Cliente</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/validate.js"></script>
</body>
</html>
