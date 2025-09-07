<?php
require_once "src/UsuarioDAO.php";

$login = $_POST['nome'];
$senha = md5($_POST['senha']);

if (UsuarioDAO::validarUsuario($login, $senha)) {
    session_start();
    $_SESSION['login'] = $login;
    header("location:telainicial.php");
} else {
    header("location:formcadastro.php");
}
