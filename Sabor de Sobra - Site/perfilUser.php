<?php
include 'incs/verificaLogin.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/estilos.css">
    <title>Meu Perfil</title>
</head>

<body class="vh-100">
    <header>
        <?php
        include 'incs/nav2.php';
        ?>
    </header>
    <main>
        <div class="row">
            <div class="col-6">
                <div class="row justify-content-center mb-5">
                    <img class="imgPerfil" src="https://m.media-amazon.com/images/S/pv-target-images/6e7c612490e10fc180d1ad5bacd2a3a39030c99cdd7dc0e49144425a6f8823fc._SX1080_FMjpg_.jpg" alt="foto de perfil">
                    <div style="width: 330px; position: absolute; margin-top:280px;" class="text-end">
                        <i class="fa-regular fa-pen-to-square editFotoUser"></i>
                    </div>
                </div>

                <h4 class="text-center mb-5">Informações Pessoais</h4>

                <div class="divFormPerfil">
                    <form action="SRC/updateUser.php" method="POST">
                        <?php
                        require 'SRC/UsuarioDAO.php';
                        $usuarios = UsuarioDAO::consultar();
                        foreach ($usuarios as $usuario) {
                            $_SESSION['idUser'] = $usuario['id_usuario'];

                        ?>
                            <div class="mb-3">
                                <div class="row" style="justify-content:space-between;">
                                    <div class="col">
                                        <input type="text" id="nomeUserIn" class="form-control perfilin rounded-5 dadosUserIn" placeholder="<?= $usuario['nome'] ?>" name="nome_usuario" required style="width: 100%; pointer-events: none;">
                                    </div>
                                    <div class="col-1 text-end m-0 p-0 pt-2">
                                        <i class="fa-regular fa-pen-to-square editInputUser editNomeUser" onclick="editarNomeUser();"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row" style="justify-content:space-between;">
                                    <div class="col">
                                        <input required style="width: 100%; pointer-events: none;" tabindex="-1" type="password" class="form-control perfilin rounded-5 dadosUserIn" name="senhaUser" id="senhaUserIn" value="<?= $usuario['senha'] ?>" style="width: 100%">
                                    </div>
                                    <div class="col-1 text-end m-0 p-0 pt-2">
                                        <i class="fa-regular fa-pen-to-square editInputUser editSenhaUser" onclick="editarSenhaUser();"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="editarPerfil" id="divEditarPerfil" style="display:none;">
                                <div class="mb-3">
                                    <div class="row" style="justify-content:space-between;">
                                        <div class="col">
                                            <input type="text" class="form-control perfilin rounded-5 dadosUserIn" placeholder="Confirme sua nova senha" name="confirma_senha" id="SenhaCUserIn" required style="width: 100%">
                                        </div>
                                        <div class="col-1 text-end m-0 p-0 pt-2">
                                            <i class="fa-regular fa-pen-to-square editInputUser editSenhaCUser" id="editSenhaCUser"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center" style="width: 548px;">
                                    <button type="submit" class="btn btn-success rounded-5" style="height: 50px; font-family: 'Abeezee', sans-serif; background-color: #1D7D0F;">Salvar Alterações</button>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </form>
                </div>
            </div>

            <div style="width: 1px; background-color: rgba(0, 0, 0, 0.4); padding: 0;"></div>
            <div class="col-5 text-center">
                <i class="fa-solid fa-bell-concierge  mb-5" style="font-size: 300px;"></i>
                <h4 class="text-center mb-5">Receitas</h4>

                <?php
                $usuarios = UsuarioDAO::consultar();
                foreach ($usuarios as $usuario) {
                    $idUsuario = $usuario['id_usuario'];
                }

                $receitass = UsuarioDAO::consultarReceitasUser($idUsuario);
                foreach ($receitass as $receitinha) {
                    $id_receita = $receitinha['id_receita'];
                ?>

                    <div class="row m-3 me-0" style="justify-content:space-between;">
                        <div class="col text-start">
                            <p class="mb-0 perfilText"><?= $receitinha['nome'] ?></p>
                        </div>
                        <div class="col text-end">
                            <a href="editarReceita.php?id_receita=<?= $id_receita ?>">
                                <i class="fa-regular fa-pen-to-square perfilText"></i>
                            </a>
                        </div>
                        <hr>
                    </div>

                <?php
                }
                ?>

            </div>
        </div>
    </main>
    <?php
    include 'incs/footer.php';
    ?>
    <script>
        function editarNomeUser() {
            var nomeUserInput = document.getElementById('nomeUserIn');
            var divDados = document.getElementById('divEditarPerfil');
            var SenhaCUserIn = document.getElementById('SenhaCUserIn');
            var editSenhaCUser = document.getElementById('editSenhaCUser');
            SenhaCUserIn.style.display = 'none';
            editSenhaCUser.style.display = 'none';
            nomeUserInput.style.pointerEvents = 'auto';
            nomeUserInput.focus();
            nomeUserInput.value = "<?= $usuario['nome'] ?>";
            divDados.style.display = 'inline';
        }

        function editarSenhaUser() {
            var nomeUserInput = document.getElementById('nomeUserIn');
            var senhaUserInput = document.getElementById('senhaUserIn');
            var divDados = document.getElementById('divEditarPerfil');
            var SenhaCUserIn = document.getElementById('SenhaCUserIn');
            var editSenhaCUser = document.getElementById('editSenhaCUser');
            nomeUserInput.value = "<?= $usuario['nome'] ?>";
            SenhaCUserIn.style.display = 'inline';
            editSenhaCUser.style.display = 'inline';
            divDados.style.display = 'inline';
            senhaUserInput.style.pointerEvents = 'auto';
            senhaUserInput.focus();
            senhaUserInput.placeholder = "Insira uma nova senha";
            senhaUserInput.value = "";
            senhaUserInput.type = 'text';

        }
    </script>

</body>

</html>