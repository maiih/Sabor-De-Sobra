<?php
include 'incs/verificaLogin.php';
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
        <h1>Vamos Criar Uma Nova Receita!</h1>
        <form action="src/cadastrar_receita.php" method="POST" enctype="multipart/form-data">
            <div>
                <input type="text" name="nome_receita" class="inputField" placeholder="Nome da Receita" required>
            </div>
            <div>
                <textarea name="descricao_receita" class="inputField" placeholder="Descrição da Receita" required></textarea>
            </div>
            <div>
                <textarea name="modo_preparo" class="inputField" placeholder="Modo de Preparo" required></textarea>
            </div>

            <div>
                    <label for="foto">Imagem:</label>
                    <input type="file" name="foto" id="foto" accept="image/*" class="form-control" onchange="mostrarPreview(event)" required>
                    <img id="previewImg" src="data:image/jpeg;base64,<?= base64_encode($receita['foto']) ?>" alt="Foto da Receita" class="img-thumbnail mt-2" width="300">
                </div>

            <h3 class="mt-5">Ingredientes</h3>
            <div id="ingredient-list">
                <div class="ingredient-row me-0">
                    <input type="text" name="ingrediente_nome[]" placeholder="Nome do Ingrediente" class="inputField" required>
                    <input type="text" name="ingrediente_quantidade[]" placeholder="Quantidade" class="inputField" required>
                    <select name="ingrediente_unidade[]" class="selectUnit" required>
                        <option value="g">Gramas (g)</option>
                        <option value="kg">Quilogramas (Kg)</option>
                        <option value="l">Litros (L)</option>
                        <option value="ml">Mililitros (mL)</option>
                        <option value="unidade">Unidades</option>
                    </select>

                    <button type="button" class="btn rounded-5 btnlixo" style="margin-bottom: 15px;" onclick="excluirIngrediente(event)">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </div>
            </div>

            <div class="action-buttons">
                <div class="row">
                    <div class="col-6">
                        <button type="button" class="btnCadastro" onclick="addIngredient()">Adicionar Ingrediente</button>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btnCadastro">Cadastrar Receita!</button>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <?php include_once "incs/footer.php"; ?>

    <script>
        function addIngredient() {
            const ingredientList = document.getElementById('ingredient-list');
            const newRow = document.createElement('div');
            newRow.classList.add('ingredient-row', 'me-0');
            
            newRow.innerHTML = `
                <input type="text" name="ingrediente_nome[]" placeholder="Nome do Ingrediente" class="inputField" required>
                <input type="text" name="ingrediente_quantidade[]" placeholder="Quantidade" class="inputField" required>
                <select name="ingrediente_unidade[]" class="selectUnit" required>
                    <option value="g">Gramas (g)</option>
                    <option value="kg">Quilogramas (Kg)</option>
                    <option value="l">Litros (L)</option>
                    <option value="ml">Mililitros (mL)</option>
                    <option value="unidade">Unidades</option>
                </select>
                <button type="button" class="btn rounded-5 btnlixo" style="margin-bottom: 15px;" onclick="excluirIngrediente(event)">
                    <i class="fa-regular fa-trash-can"></i>
                </button>
            `;
            ingredientList.appendChild(newRow);
        }

        function excluirIngrediente(event) {
            event.preventDefault(); // Previne o envio do formulário ao clicar no botão
            const row = event.target.closest('.ingredient-row'); // Encontra a linha de ingrediente
            if (row) {
                row.remove(); // Remove a linha do DOM
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
