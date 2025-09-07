<?php

echo 'chegou na etapa 2';
require '../SRC/UsuarioDAO.php';

$idReceita = $_POST['id_receita'];
$nomeReceita = $_POST['nome_receita'];
$modoPreparo = $_POST['modo_preparo'];
$descricaoReceita = $_POST['descricao_receita'];
$fotoAtual = $_POST['foto_atual'];

if (isset($_FILES['foto']) && $_FILES['foto']['size'] > 0) {
    $foto = file_get_contents($_FILES['foto']['tmp_name']);
} else {
    $foto = base64_decode($fotoAtual);
}

$atualizado = UsuarioDAO::updateReceita($nomeReceita, $modoPreparo, $descricaoReceita, $foto, $idReceita);

if ($atualizado) {
    header("Location: ../telainicial.php");
} else {
    echo "Erro ao atualizar a receita.";
}
?>
