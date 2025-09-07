<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="logo">
    <a href="index.php"><img src="img/logo.png" alt="Sabor de Sobra"></a>
</div>

<nav class="navindex">
    <ul class="mt-5">
        <li class="nav-item">
            <a href="telainicial.php" class="nav-link <?php echo ($current_page == 'telainicial.php') ? 'active' : ''; ?>">
                <i class="fa-solid fa-house"></i>
                Página Inicial
            </a>
        </li>
        <li class="nav-item">
            <a href="Rpesquisa.php" class="nav-link <?php echo ($current_page == 'Rpesquisa.php') ? 'active' : ''; ?>">
                <i class="fa-solid fa-utensils"></i>
                Receitas
            </a>
        </li>
        <li class="nav-item">
            <a href="dicas.php" class="nav-link <?php echo ($current_page == 'dicas.php') ? 'active' : ''; ?>">
                <i class="fa-solid fa-lightbulb"></i>
                Dicas
            </a>
        </li>
    </ul>
</nav>

<?php
if (isset($_SESSION['login'])) {
    if ($current_page == 'perfilUser.php') {
?>
        <div class="botaoPerfilNav2">
            <button class="btn btn-outline-success rounded-5" onclick="window.location.href='logout.php'" style="width: 150px;">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                Logout
            </button>
        </div>
    <?php
    } else {
    ?>
        <div class="botaoPerfilNav2">
            <button class="btn btn-outline-success rounded-5" onclick="window.location.href='perfilUser.php'" style="width: 150px;">
                <i class="fa-regular fa-circle-user text-start"></i>
                Perfil
            </button>
        </div>
    <?php
    }
} else {
    if ($current_page == 'index.php' && isset($_SESSION['login'])) {
    ?>
        <div class="botaoPerfilNav2">
            <button class="btn btn-outline-success rounded-5" onclick="window.location.href='formcadastro.php'" style="width: 150px;">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                Cadastrar</button>
            <button class="btn btn-outline-success rounded-5" onclick="window.location.href='perfilUser.php'" style="width: 150px;">
                <i class="fa-regular fa-circle-user iconPerfil"></i>
                Perfil
            </button>
        </div>

        <?php
    } else {
        if ($current_page = 'dicas.php') {
        ?>
            <div class="botaoPerfilNav2">
            <button class="btn btn-outline-success rounded-5" onclick="window.location.href='formcadastro.php'" style="width: 50px;">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
            </button>
            <button class="btn btn-outline-success rounded-5" onclick="window.location.href='perfilUser.php'" style="width: 50px;">
                <i class="fa-regular fa-circle-user iconPerfil"></i>
                
            </button>
        </div>
        <?php
        }
        ?>
        
<?php
    }
}

?>