<?php
$idReceita = $_GET['id_receita'];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sabor de Sobra - Receita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/estilos.css">
</head>

<body class="bodydamaria3">
    <header>
        <?php
        include 'incs/nav2.php';
        ?>
    </header>
    <main>

        <?php
        require 'SRC/UsuarioDAO.php';
        $receitas = UsuarioDAO::consultarReceitaPorId($idReceita);
        $ingredientes = UsuarioDAO::consultarIngredientesPorReceita($idReceita);
        foreach ($receitas as $receita) {
        ?>
            <div class="receita-card">
                <h2 class="receita-titulo"><?= $receita['nome'] ?></h2>
                <div class="receita-imagem">
                    <img src="data:image/jpeg;base64,<?= base64_encode($receita['foto']) ?>" alt="<?= $receita['nome'] ?>" height="700px">
                    <div class="overlay ingredientes-section">
                        <h3>Ingredientes</h3>
                    </div>
                </div>
                <div style="margin-top: 100px;">
                    <ul class="ingredientes-lista">
                        <?php
                        foreach ($ingredientes as $ingrediente) {

                        ?>
                            <li>
                                <div class="ingrediente-grupo">
                                    <span class="ingrediente-nome"><?= $ingrediente['nome'] ?></span>
                                    <div class="ingrediente-valor"><?= $ingrediente['preco'] ?></div>
                                </div>
                            </li>

                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="modo-preparo">
                    <h3>Modo de Preparo</h3>
                    <p><?= $receita['modoPreparo'] ?></p>
                </div>
                
            </div>
        <?php

        }
        ?>

    </main>
    <script>
        // Obtém todos os ícones e seus paths SVGs
        const icones = document.querySelectorAll('.icone-toggle');
        const iconePaths = document.querySelectorAll('.iconePath');

        // Define o estado inicial do ícone (preto)
        let estado = 'preto'; // "preto" ou "amarelo"

        // Função para alternar o ícone
        icones.forEach((icone, index) => {
            icone.addEventListener('click', function() {
                if (estado === 'preto') {
                    // Muda o ícone para amarelo
                    iconePaths[index].setAttribute('fill', '#faac07');
                    estado = 'amarelo';
                } else {
                    // Muda o ícone para preto
                    iconePaths[index].setAttribute('fill', '#000000');
                    estado = 'preto';
                }
            });
        });
    </script>
</body>

</html>