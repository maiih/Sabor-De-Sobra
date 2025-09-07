<?php
session_start();  
require "UsuarioDAO.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome_usuario'];
    $senha = $_POST['senhaUser'];
    $senhaC = $_POST['confirma_senha'];
    $id = $_SESSION['idUser'];
    

    if ($senha !== $senhaC) {
        echo "<script>alert('As senhas precisam ser iguais!'); window.location.href = '../perfilUser.php';</script>";
        exit;
    }

    $senhaUser = md5($senha);
    UsuarioDAO::updateUser($nome, $senhaUser, $id);
    echo "<script>alert('Perfil atualizado com sucesso!'); window.location.href = '../perfilUser.php';</script>";
}
?>
