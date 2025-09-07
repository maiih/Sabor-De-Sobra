<?php
include 'incs/verificaLogin.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sabor de Sobra - Pesquisa</title>
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

    <main class="area-pesquisa">
        <div class="botaopesquisa">
            <input type="text" class="campo-pesquisa" placeholder="Pesquise aqui o seu prato do dia...">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
            </svg>
        </div>
        <div class="ajeitar">
            <?php
            require 'SRC/UsuarioDAO.php';
            $receitas = UsuarioDAO::consultarReceitas();
            foreach ($receitas as $receita) {

                $imagem = isset($receita['foto']) && !empty($receita['foto']) ? 'data:image/jpeg;base64,' . base64_encode($receita['foto']) : 'https://www.shutterstock.com/image-photo/mix-food-assorted-table-600nw-2503190997.jpg';
            ?>
                <div class="receita-item">
                    <img src="<?= $imagem ?>" alt="<?= $receita['nome'] ?>" class="imgprato">
                    <div class="info-receita">
                        <h3 class="linhadonome">
                            <span class="nome-receita"><?= $receita['nome'] ?></span>
                            <span class="icone-toggle">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 512 512">
                                    <path class="iconePath" fill="#000000" d="M169.7 .9c-22.8-1.6-41.9 14-47.5 34.7L110.4 80c.5 0 1.1 0 1.6 0c176.7 0 320 143.3 320 320c0 .5 0 1.1 0 1.6l44.4-11.8c20.8-5.5 36.3-24.7 34.7-47.5C498.5 159.5 352.5 13.5 169.7 .9zM399.8 410.2c.1-3.4 .2-6.8 .2-10.2c0-159.1-128.9-288-288-288c-3.4 0-6.8 .1-10.2 .2L.5 491.9c-1.5 5.5 .1 11.4 4.1 15.4s9.9 5.6 15.4 4.1L399.8 410.2zM176 208a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm64 128a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zM96 384a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
                                </svg>
                            </span>
                        </h3>
                        <p><?= $receita['descricao'] ?></p>
                    </div>
                </div>
                <hr>

            <?php
            }
            ?>
            
        </div>

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