<?php
session_start();

$senhaErro = isset($_SESSION['senha_erro']) && $_SESSION['senha_erro'];
unset($_SESSION['senha_erro']);

$sucesso = isset($_SESSION['sucesso']) && $_SESSION['sucesso'];
unset($_SESSION['sucesso']);

$nomeUsuarioExistente = isset($_SESSION['nomeUsuarioExistente']) && $_SESSION['nomeUsuarioExistente'];
unset($_SESSION['nomeUsuarioExistente']);

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/estilos.css">
    <title>Faça o seu cadastro!</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap');
    </style>
</head>

<body class="vh-100">
    <header>
        <?php
        include 'incs/nav2.php';
        ?>
    </header>
    <main class="d-flex justify-content-center align-items-center mt-5">

        <div class="formdiv2 d-flex justify-content-center align-items-center">
            <div class="formCadastroUser justify-content-center align-items-center d-flex" style="width:500px;">

                <form action="src/cadastrarUsuario.php" method="post" class="row g-3" style="gap: 20px;">

                    <div class="d-flex justify-content-center">
                        <img src="img/logo.png" alt="logo sabor de sobra" style="width:130px;">
                    </div>
                    <h1 class="text-center my-3" style="font-family: 'Abril Fatface', cursive; font-size:50px; margin: 0;">Cadastrar-se</h1>

                    <div class="col-12">
                        <input type="text" class="form-control cadastroin" name="nome" id="nome" placeholder="Insira aqui o nome de usuário:" required>
                    </div>

                    <div class="col-12">
                        <div class="input-group">
                            <input type="password" class="form-control cadastroin" name="senha" id="senha" placeholder="Insira aqui a sua senha:" style="z-index:0;" required>
                            <button type="button" class="btn olho" id="toggleSenha" onclick="mostrarSenha()">
                                <i class="fa-regular fa-eye" id="iconeOlho"></i>
                            </button>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-group">
                            <input type="password" class="form-control cadastroin" name="senhaC" id="senhaC" placeholder="Repita aqui a sua senha:" style="z-index:0;" required>
                            <a class="btn olho" id="toggleSenhaC" onclick="mostrarSenhaC()">
                                <i class="fa-regular fa-eye" id="iconeOlhoC"></i>
                            </a>
                        </div>
                    </div>

                    <p class="text-danger text-center mb-0 <?php echo $senhaErro ? '' : 'd-none'; ?>">
                        As senhas precisam ser iguais.
                    </p>

                    <p class="text-success text-center mb-0 <?php echo $sucesso ? '' : 'd-none'; ?>">
                       Cadastro realizado com sucesso!
                    </p>

                    <p class="text-danger text-center mb-0 <?php echo $nomeUsuarioExistente ? '' : 'd-none'; ?>">
                        Já existe um usuário com esse nome.
                    </p>

                    <div class="col-12 d-grid">
                        <button type="submit" class="btn btn-success rounded-5" style="height: 50px; font-family: 'Abeezee', sans-serif;">Cadastrar</button>
                    </div>
                    <div class="col-12 text-end mt-0">
                        <p>Já Possui Cadastro? <a href="login.php">Faça login agora!</a></p>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php

    ?>

    <script>
        function mostrarSenha() {
            var campoSenha = document.getElementById("senha");
            var iconeOlho = document.getElementById("iconeOlho");

            if (campoSenha.type === "password") {
                campoSenha.type = "text";
                iconeOlho.classList.remove('fa-eye');
                iconeOlho.classList.add('fa-eye-slash');
            } else {
                campoSenha.type = "password";
                iconeOlho.classList.remove('fa-eye-slash');
                iconeOlho.classList.add('fa-eye');
            }
        }

        function mostrarSenhaC() {
            var campoSenha = document.getElementById("senhaC");
            var iconeOlho = document.getElementById("iconeOlhoC");

            if (campoSenha.type === "password") {
                campoSenha.type = "text";
                iconeOlho.classList.remove('fa-eye');
                iconeOlho.classList.add('fa-eye-slash');
            } else {
                campoSenha.type = "password";
                iconeOlho.classList.remove('fa-eye-slash');
                iconeOlho.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>