<?php
session_start();
require "UsuarioDAO.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $senhaC = $_POST['senhaC'];

    if ($senha !== $senhaC) {
        $_SESSION['senha_erro'] = true;
        header("Location: ../formcadastro.php");
        exit;
    }

    if (UsuarioDAO::verificarNomeUsuario($nome)) {
        $_SESSION['nomeUsuarioExistente'] = true;
        header("Location: ../formcadastro.php");
        exit;
    }

    $senha = md5($_POST['senha']);
    UsuarioDAO::cadastrar($nome, $senha);
    $_SESSION['sucesso'] = true;
    header("Location: ../formcadastro.php");
    exit;
}
?>