<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sabor de Sobra</title>
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
    <main>
        <section class="welcome-section">
            <div class="text-section">
                <h1>Bem Vindo(a)!</h1>
                <p>DESCUBRA NOVAS RECEITAS! <br>
                    Faça parte da nossa família e viva uma vida bem mais saborosa!</p>
            </div>
            <div class="image-section">
                <img src="img/prato de comida .png" alt="Prato de comida" class="prato-img">
                <div class="green-box">
                    <img src="img/bagulho_branco-removebg-preview.png" alt="" class="bagulho">
                </div>
            </div>
        </section>


    </main>
    <?php
    include 'incs/footer.php';
    ?>
</body>

</html>