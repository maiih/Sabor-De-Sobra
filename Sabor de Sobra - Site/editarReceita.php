<?php
include 'incs/verificaLogin.php';
require 'SRC/UsuarioDAO.php';

$idReceita = $_GET['id_receita'];


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Receita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/estilos.css">
</head>

<body class="vh-100">
    <header>
        <?php include_once "incs/nav2.php"; ?>
    </header>

    <main class="mainCadastro">
        <?php
        $receitas = UsuarioDAO::consultarReceitaPorId($idReceita);
        $ingredientes = UsuarioDAO::consultarIngredientesPorReceita($idReceita);
        foreach ($receitas as $receita) {
        ?>

            <h1>Vamos Editar Sua Receita!</h1>
            <form action="SRC/updateReceita.php" method="POST" enctype="multipart/form-data">
                <div>
                    <input type="text" name="nome_receita" class="inputField" placeholder="Nome da Receita" value="<?= $receita['nome'] ?>">
                </div>
                <div>
                    <textarea name="descricao_receita" class="inputField" placeholder="Descrição da Receita"><?= $receita['descricao'] ?></textarea>
                </div>
                <div>
                    <textarea name="modo_preparo" class="inputField" placeholder="Modo de Preparo"><?= $receita['modoPreparo'] ?></textarea>
                </div>

                <input type="hidden" name="id_receita" value="<?= $idReceita ?>">
                <input type="hidden" name="foto_atual" value="<?= base64_encode($receita['foto']) ?>">

                <div>
                    <label for="foto">Imagem:</label>
                    <input type="file" name="foto" id="foto" accept="image/*" class="form-control" onchange="mostrarPreview(event)">
                    <!-- Miniatura da imagem selecionada -->
                    <img id="previewImg" src="data:image/jpeg;base64,<?= base64_encode($receita['foto']) ?>" alt="Foto da Receita" class="img-thumbnail mt-2" width="300">
                </div>

                <h3 class="mt-5">Ingredientes</h3>
                <p>Por favor, garanta que a segunda coluna seja apenas um número!</p>
                <div id="ingredient-list">
                    <?php if (isset($ingredientes)): ?>
                        <?php foreach ($ingredientes as $ingrediente): ?>
                            <div class="ingredient-row me-0">
                                <input type="text" name="ingrediente_nome[]" class="inputField" placeholder="Nome do Ingrediente" value="<?= $ingrediente['nome'] ?>">
                                <input type="text" name="ingrediente_quantidade[]" class="inputField" placeholder="Quantidade" value="<?= $ingrediente['quantidade'] ?>">
                                <select name="ingrediente_unidade[]" class="selectUnit">
                                    <option value="g">Gramas (g)</option>
                                    <option value="kg">Quilogramas (Kg)</option>
                                    <option value="l">Litros (L)</option>
                                    <option value="ml">Mililitros (mL)</option>
                                    <option value="unidade">Unidades</option>
                                </select>

                                <button class="btn rounded-5 btnlixo" style="margin-bottom: 15px;" id="btnlixo" onclick="excluirIngrediente(event)"><i class="fa-regular fa-trash-can"></i></button>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="action-buttons">
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btnCadastro" onclick="addIngredient()">Adicionar Ingrediente</button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btnCadastro">Atualizar Receita!</button>
                        </div>
                    </div>
                </div>
            </form>

            <form action="src/deletarReceita.php" method="POST" onsubmit="return confirm('Tem certeza de que deseja excluir esta receita?')">
                <input type="hidden" name="id_receita" value="<?= $idReceita ?>">
                <button type="submit" class="btnDelete">Excluir Receita</button>
            </form>

        <?php
        }
        ?>
    </main>

    <?php include_once "incs/footer.php"; ?>

    <script>
        function addIngredient() {
            const ingredientList = document.getElementById('ingredient-list');
            const newRow = document.createElement('div');
            newRow.classList.add('ingredient-row');
            newRow.innerHTML = `
                <input type="text" name="ingrediente_nome[]" placeholder="Nome do Ingrediente" class="inputField">
                <input type="text" name="ingrediente_quantidade[]" placeholder="Quantidade" class="inputField">
                <select name="ingrediente_unidade[]" class="selectUnit">
                    <option value="g">Gramas (g)</option>
                    <option value="kg">Quilogramas (Kg)</option>
                    <option value="l">Litros (L)</option>
                    <option value="ml">Mililitros (mL)</option>
                    <option value="unidade">Unidades</option>
                </select>
                <button class="btn rounded-5 btnlixo" style="margin-bottom: 15px;" id="btnlixo" onclick="excluirIngrediente(event)"><i class="fa-regular fa-trash-can"></i></button>
            `;
            ingredientList.appendChild(newRow);
        }

        function excluirIngrediente(event) {
            event.preventDefault();
            const row = event.target.closest('.ingredient-row');
            if (row) {
                row.remove();
            }
        }

        function mostrarPreview(event) {
            const input = event.target;
            const preview = document.getElementById('previewImg');

            // Verifica se um arquivo foi selecionado
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                // Função chamada quando a leitura do arquivo é concluída
                reader.onload = function(e) {
                    preview.src = e.target.result; // Define a pré-visualização
                };

                reader.readAsDataURL(input.files[0]); // Lê o arquivo como DataURL
            }
        }
    </script>
</body>

</html>