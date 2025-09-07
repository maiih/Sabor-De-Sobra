<?php
include 'incs/verificaLogin.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Receitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/estilos.css">
</head>

<body class="vh-100">

<header>
        <?php
        include 'incs/nav2.php';
        ?>
    </header>


    <div class="conteudo-principal">
        <!-- Campo de busca -->
        <div class="caixa-pesquisa">
            <input type="text" placeholder="Pesquise aqui o seu prato do dia...">
            <button class="botao-pesquisa">
                <i class='fa-solid fa-magnifying-glass'></i>
            </button>
        </div>

        <?php
        require 'SRC/UsuarioDAO.php';
        $receitas = UsuarioDAO::consultarReceitas();
        foreach ($receitas as $receita) {

            $imagem = isset($receita['foto']) && !empty($receita['foto']) ? 'data:image/jpeg;base64,' . base64_encode($receita['foto']) : 'https://www.shutterstock.com/image-photo/mix-food-assorted-table-600nw-2503190997.jpg';
        ?>
            <!-- Lista de receitas -->
            <div class="lista-receitas">
                <div class="cartao-receita">
                    <img src="<?= $imagem ?>" alt="Imagem da receita" class="imagem-receita">
                    <div class="info-receita">
                        <h2 class="titulo-receita"><?= $receita['nome'] ?><span class="icone-receita"><i class="fa-solid fa-pizza-slice"></i></span></h2>
                        <p class="descricao-receita"><?= $receita['modoPreparo'] ?></p>
                    </div>
                </div>

            <?php
        }
            ?>
            </div>
    </div>

    <?php
    include_once "incs/footer.php"
    ?>
</body>

</html>