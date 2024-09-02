<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Newsreader', serif; /* Definir a fonte */
            background-color: #426B1F; /* Definir a cor de fundo para verde escuro */
        }

        .text-gray-900 {
            color: #426B1F; /* Alterar a cor do texto para verde escuro */
        }
        .alert-danger {
            color: #426B1F; /* Alterar a cor do texto para verde escuro */
            border-color: #426B1F; /* Alterar a borda da alerta para verde escuro */
        }
        .alert-success {
            color: #426B1F; /* Alterar a cor do texto para verde escuro */
            border-color: #426B1F; /* Alterar a borda da alerta para verde escuro */
        }
        .btn-primary {
            background-color: #426B1F; /* Alterar a cor de fundo dos botões primários para verde escuro */
            border-color: #426B1F; /* Alterar a cor da borda dos botões primários para verde escuro */
        }
        .btn-primary:hover {
            background-color: #365E3F; /* Alterar a cor de fundo dos botões primários ao passar o mouse para um verde um pouco mais escuro */
            border-color: #365E3F; /* Alterar a cor da borda dos botões primários ao passar o mouse */
        }
        a {
            color: #426B1F; /* Alterar a cor dos links para verde escuro */
        }
        a:hover {
            color: #365E3F; /* Alterar a cor dos links ao passar o mouse para um verde um pouco mais escuro */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-register-image"></div>
                            <div class="col-lg-6">
                                <div class="p-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Cadastrar Cliente</h1>
                                    </div>
                                    <?php if (isset($_SESSION['msg_erro'])): ?>
                                        <div class="alert alert-danger">
                                            <?php
                                                echo $_SESSION['msg_erro'];
                                                unset($_SESSION['msg_erro']);
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (isset($_SESSION['msg_sucesso'])): ?>
                                        <div class="alert alert-success">
                                            <?php
                                                echo $_SESSION['msg_sucesso'];
                                                unset($_SESSION['msg_sucesso']);
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                    <form class="user" action="processa_cadastro_cliente.php" method="post">
                                        <div class="form-group">
                                            <label> Nome Completo </label>
                                            <input type="text" class="form-control form-control-user" id="nome" name="nome" value="<?php if (!empty($_SESSION['nome'])) { echo $_SESSION['nome'];} ?>"  
                                        placeholder="Nome Completo" required>
                                        </div>
                                        <div class="form-group">
                                            <label> Email </label>
                                            <input type="email" class="form-control form-control-user" id="email" name="email" value="<?php if (!empty($_SESSION['email'])) { echo $_SESSION['email'];} ?>" 
                                        placeholder="Endereço de Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label> Senha </label>
                                        <input type="password" class="form-control form-control-user" id="senha" name="senha" placeholder="Senha" required>
                                        </div>
                                        <div class="form-group">
                                            <label> Confirmar Senha </label>
                                            <input type="password" class="form-control form-control-user"
                                            id="confirma_senha" name="confirma_senha" placeholder="Confirmar Senha"  oninput="validatepassword(this)" required>
                                        </div>
                                        <div class="form-group">
                                            <label> CEP </label>
                                            <input type="text" class="form-control form-control-user" id="cep" name="cep" value="<?php if (!empty($_SESSION['cep'])) { echo $_SESSION['cep'];} ?>"  
                                            placeholder="00000-000" required>
                                        </div>
                                        <div class="form-group">
                                            <label> Endereço </label>
                                            <input type="text" class="form-control form-control-user" id="endereco" name="endereco" value="<?php if (!empty($_SESSION['endereco'])) { echo $_SESSION['endereco'];} ?>" 
                                            placeholder="Rua, Avenida, Alamenda..." required>
                                        </div>
                                        <div class="form-group">
                                            <label> Número </label>
                                            <input type="number" class="form-control form-control-user" id="numero" name="numero" value="<?php if (!empty($_SESSION['numero'])) { echo $_SESSION['numero'];} ?>"  
                                            placeholder="" required>
                                        </div>
                                        <div class="form-group">
                                            <label> Bairro </label>
                                            <input type="text" class="form-control form-control-user" id="bairro" name="bairro" value="<?php if (!empty($_SESSION['bairro'])) { echo $_SESSION['bairro'];} ?>" 
                                            placeholder="Nome do Bairro" required>
                                        </div>
                                        <div class="form-group">
                                            <label> Cidade </label>
                                            <input type="text" class="form-control form-control-user" id="cidade" name="cidade" value="<?php if (!empty($_SESSION['cidade'])) { echo $_SESSION['cidade'];} ?>"  
                                            placeholder="Nome da Cidade" required>
                                        </div>
                                        <div class="form-group">
                                            <label> Estado </label>
                                            <input type="text" class="form-control form-control-user" id="estado" name="estado" value="<?php if (!empty($_SESSION['estado'])) { echo $_SESSION['estado'];} ?>" 
                                            placeholder="Ex: MG" required>
                                        </div>
                                        <div class="form-group">
                                            <label> Telefone - Ex.: (11) 91234-1234 </label>
                                            <input type="tel" class="form-control form-control-user" id="telefone" name="telefone" placeholder="(xx)xxxxx-xxxx"  value="<?php if (!empty($_SESSION['telefone'])) { echo $_SESSION['telefone'];} ?>" maxlength="15" required >
                                        </div>
                                        <input type="hidden" name="status" value="1"> <!-- Valor padrão para status -->
                                        <input type="hidden" name="perfil" value="2"> <!-- Valor padrão para perfil -->
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Cadastrar</button>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="index.php">Voltar para o Login</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    
    <!-- Script para buscar e preencher o endereço pelo CEP -->
    <script>
    document.getElementById('cep').addEventListener('blur', function() {
        const cep = this.value.replace(/\D/g, '');
        if (cep) {
            const url = `https://viacep.com.br/ws/${cep}/json/`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (!data.erro) {
                        document.getElementById('endereco').value = data.logradouro;
                        document.getElementById('bairro').value = data.bairro;
                        document.getElementById('cidade').value = data.localidade;
                        document.getElementById('estado').value = data.uf;
                    } else {
                        alert('CEP não encontrado!');
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar o CEP:', error);
                });
        }
    });
    </script>
</body>
</html>
