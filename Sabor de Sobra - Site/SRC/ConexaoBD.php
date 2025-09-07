<?php

class ConexaoBD
{
    public static function conectar()
    {
        $conexao = new PDO("mysql:host=localhost;dbname=sabordesobra", "root", "1234");
        return $conexao;
    }
}