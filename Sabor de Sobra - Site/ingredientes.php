<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingredientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/estilos.css">
</head>

<body class="bodydamaria">
    <header>
        <?php
        include 'incs/nav2.php';
        ?>
    </header>

    <main>
        <div class="ingredientes-container">
            <p class="negro fs-3">O que você tem em casa? Cadastre seus ingredientes para conseguirmos encontrar a receita que melhor se adequa a você!</p>
            <p class="fs-3">(Lembre-se de escrever corretamente!)</p>
            <form method="post" action="ingredientes.php">
    <div id="ingredientes-list">
        <div class="ingrediente-item">
            <input type="text" name="ingredientes[]" placeholder="Nome do Ingrediente" required>
            <button type="button" class="excluir">Excluir</button>
        </div>
    </div>
    <button type="button" id="adicionar-ingrediente">Adicionar Ingrediente</button>
    <button type="submit" id="buscar-receita">Buscar Receita!</button>
</form>


        </div>
        <div class="card-container">
        <div class="row rowReceitas">
        <?php
        require 'src/UsuarioDAO.php';
        // Verifica se o formulário foi enviado
        if (isset($_POST['ingredientes']) && !empty($_POST['ingredientes'])) {
            $ingredientes = $_POST['ingredientes'];

            // Chama a função que consulta as receitas passando os ingredientes
            $receitas = UsuarioDAO::consultarReceitasPorIngrediente($ingredientes);

            // Exibe as receitas
            foreach ($receitas as $receita) {
                $imagem = isset($receita['foto']) && !empty($receita['foto']) ? 'data:image/jpeg;base64,' . base64_encode($receita['foto']) : 'img/default.png';
                $id_receita = $receita['id_receita']; // Asegure-se de que o ID da receita está sendo retornado

        ?>
                <a href="receita.php?id_receita=<?= $id_receita ?>" class="aCard">
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
        }
        ?>
        </div>
        </div>

    </main>


    <script>
        document.getElementById('adicionar-ingrediente').addEventListener('click', function() {
            const novoIngrediente = document.createElement('div');
            novoIngrediente.classList.add('ingrediente-item');
            novoIngrediente.innerHTML = `
            <input type="text" name="ingredientes[]" placeholder="Nome do Ingrediente...">
            <button type="button" class="excluir">Excluir</button>
        `;
            document.getElementById('ingredientes-list').appendChild(novoIngrediente);
        });

        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('excluir')) {
                e.target.parentNode.remove();
            }
        });
    </script>

</body>

</html>