<?php
session_start();
require_once('header.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Newsreader', serif;
        }
        .bg-gradient-primary {
            background: linear-gradient(to right, #426B1F, #426B1F);
        }
        .card {
            border: none;
        }
        .text-gray-900 {
            color: #426B1F !important;
        }
        .btn-primary {
            background-color: #426B1F;
            border-color: #426B1F;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
        .btn-primary:hover, .btn-primary:focus {
            background-color: #365e1f;
            border-color: #365e1f;
        }
        .btn-secondary:hover, .btn-secondary:focus {
            background-color: #5a6268;
            border-color: #545b62;
        }
    </style>
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Redefinir Senha</h1>
                                    </div>
                                    <form class="user" action="processa_esqueci_senha.php" method="post">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Endereço de Email..." required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nova Senha</label>
                                            <input type="password" class="form-control form-control-user" id="nova_senha" name="nova_senha" placeholder="Nova Senha" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Redefinir Senha
                                        </button>

                                        <?php if (isset($_SESSION['msg_sucesso'])): ?>
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong><?= $_SESSION['msg_sucesso'] ?></strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <?php unset($_SESSION['msg_sucesso']); ?>
                                        <?php endif; ?>

                                        <?php if (isset($_SESSION['msg_erro'])): ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong><?= $_SESSION['msg_erro'] ?></strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <?php unset($_SESSION['msg_erro']); ?>
                                        <?php endif; ?>

                                        <button type="button" class="btn btn-secondary btn-user btn-block" onclick="window.location.href='index.php';">
                                            Voltar para o Início
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>
