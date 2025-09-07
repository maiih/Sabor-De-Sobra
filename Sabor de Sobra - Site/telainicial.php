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
    <title>Sabor De Sobra</title>

<body class="bodydamaria">
    <header>
        <?php
        include 'incs/nav2.php';
        ?>
    </header>
    <main class="main">

        <div class="row">
            <div class="banner mb-3">
                <img src="img/Banner.png" alt="banner" class="imgBanner">
            </div>
        </div>

        <div class="row">
            <div class="divBtnInicio text-center mb-3">
                <div class="input-container">
                    <form method="post">
                        <input class="btnInicio btnSearch" placeholder="Pesquise seu prato do dia!" name="search">
                            <i class='fa-solid fa-magnifying-glass'></i>
                    </form>
                </div>
                <button class="btnInicio"><a href="cadastrodareceita.php" class="aInicio">Crie uma receita nova!</a></button>
                <button class="btnInicio"><a href="ingredientes.php" class="aInicio">Quais Ingredientes você tem?</a></button>
            </div>
        </div>
        <div class="card-container">
            <div class="row rowReceitas">
                <?php

                if (isset($_POST['search']) && !empty($_POST['search'])) {
                    require 'SRC/UsuarioDAO.php';
                    $receitas = UsuarioDAO::consultarReceitasInicio($_POST['search']);
                } else {
                    require 'SRC/UsuarioDAO.php';
                    $receitas = UsuarioDAO::consultarReceitas();
                }
                foreach ($receitas as $receita) {
                    $imagem = isset($receita['foto']) && !empty($receita['foto']) ? 'data:image/jpeg;base64,' . base64_encode($receita['foto']) : 'img/default.png';

                ?>
                    <a href="receita.php?id_receita=<?= $receita['id_receita'] ?>" class="aCard">
                    <div class="card col-3 mb-4">
                       <div class="divCardFoto">
                       <img class="card-img-top" src="<?= $imagem ?>" alt="Imagem do prato">
                       </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $receita['nome'] ?></h5>
                            <p class="card-text"><?= $receita['descricao'] ?></p>
                        </div>
                    </div>
                    </a>
                <?php
                }
                ?>

            </div>
        </div>
    </main>

</body>

</html>