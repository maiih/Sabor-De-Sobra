<?php
session_start();
require 'UsuarioDAO.php';

$usuarios = UsuarioDAO::consultar();
foreach ($usuarios as $usuario) {
    $idUsuario = $usuario['id_usuario'];
}

$nomeReceita = $_POST['nome_receita'];
$descricaoReceita = $_POST['descricao_receita'];
$modoPreparo = $_POST['modo_preparo'];
$idReceita = UsuarioDAO::cadastrarReceita($nomeReceita, $descricaoReceita, $modoPreparo, $idUsuario);

if ($idReceita && !empty($_POST['ingrediente_nome'])) {
    $nomes = $_POST['ingrediente_nome'];
    $quantidades = $_POST['ingrediente_quantidade'];
    $unidades = $_POST['ingrediente_unidade'];

    foreach ($nomes as $index => $nome) {
        $quantidadeConcatenada = $quantidades[$index] . ' ' . $unidades[$index];
        UsuarioDAO::cadastrarIngrediente($nome, $quantidadeConcatenada, $idReceita);
    }
}

header('Location: ../perfilUser.php');
exit;