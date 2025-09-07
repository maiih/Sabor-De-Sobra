<?php
require 'UsuarioDAO.php';

$idReceita = $_POST['id_receita'];
UsuarioDAO::deletarReceita($idReceita);

header('Location: ../perfilUser.php');
