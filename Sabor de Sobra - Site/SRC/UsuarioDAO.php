<?php
require "ConexaoBD.php";

class UsuarioDAO
{

    public static function verificarNomeUsuario($nome)
    {
        $conexao = ConexaoBD::conectar();
        $sql = "SELECT * FROM usuario WHERE nome = :nome";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function cadastrar($nome, $senha)
    {
        $conexao = ConexaoBD::conectar();
        $sql = "INSERT INTO usuario (nome, senha) VALUES (:nome, :senha)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':senha', $senha);
        return $stmt->execute();
    }

    static public function validarUsuario($login, $senha)
    {

        $conexao = ConexaoBD::conectar();
        $sql = "select * from usuario where nome = '$login' and senha = '$senha'";
        $resultado = $conexao->query($sql);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function consultar()
    {
        $nome = $_SESSION['login'];
        $conexao = ConexaoBD::conectar();
        $sql = "select * from usuario where nome = '$nome'";
        $usuarios = $conexao->query($sql);

        return $usuarios;
    }

    public static function updateUser($nome, $senha, $id)
    {
        $conexao = ConexaoBD::conectar();
        $sql = "UPDATE usuario SET nome = :nome, senha = :senha WHERE id_usuario = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public static function consultarReceitas()
    {
        $conexao = ConexaoBD::conectar();
        $sql = "select * from receita";
        $receitas = $conexao->query($sql);

        return $receitas;
    }

    public static function consultarReceitasInicio($receita)
    {
        $conexao = ConexaoBD::conectar();
        $sql = "SELECT * FROM receita WHERE nome LIKE '%$receita%'";
        return $conexao->query($sql);
    }

    public static function consultarReceitasPorIngrediente($ingredientes)
    {
        $conexao = ConexaoBD::conectar();
    
        // Verifica se a lista de ingredientes está vazia
        if (empty($ingredientes)) {
            return [];
        }
    
        // Monta a consulta SQL com JOIN para buscar receitas baseadas nos ingredientes
        $placeholders = [];
        foreach ($ingredientes as $index => $ingrediente) {
            $placeholders[] = "i.nome LIKE :ingrediente$index";
        }
        
        $sql = "
            SELECT r.id_receita, r.nome, r.descricao, r.foto 
            FROM receita r
            INNER JOIN ingrediente i ON r.id_receita = i.id_receita
            WHERE " . implode(' OR ', $placeholders) . "
            GROUP BY r.id_receita
        ";
    
        // Prepara a consulta
        $stmt = $conexao->prepare($sql);
    
        // Faz o bind dos parâmetros
        foreach ($ingredientes as $index => $ingrediente) {
            $stmt->bindValue(":ingrediente$index", '%' . $ingrediente . '%', PDO::PARAM_STR);
        }
    
        // Executa a consulta
        $stmt->execute();
    
        // Retorna os resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function deletarReceita($idReceita){
        $conexao = ConexaoBD::conectar();
        $sql = "delete FROM sabordesobra.ingrediente where id_receita = $idReceita;
        delete FROM sabordesobra.receita where id_receita = $idReceita;";
        $resultado = $conexao->query($sql);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function cadastrarReceita($nomeReceita, $descricaoReceita, $modoPreparo, $idUsuario)
    {
        $conexao = ConexaoBD::conectar();

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $foto = file_get_contents($_FILES['foto']['tmp_name']);

            $sql = "INSERT INTO receita (nome, modoPreparo, descricao, id_usuario, foto) 
                    VALUES (:nome, :modoPreparo, :descricao, :idUsuario, :foto)";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':nome', $nomeReceita);
            $stmt->bindParam(':modoPreparo', $modoPreparo);
            $stmt->bindParam(':descricao', $descricaoReceita);
            $stmt->bindParam(':idUsuario', $idUsuario);
            $stmt->bindParam(':foto', $foto, PDO::PARAM_LOB);
            $stmt->execute();

            return $conexao->lastInsertId(); 
        }
        return false;
    }

    public static function cadastrarIngrediente($nome, $quantidade, $idReceita)
    {
        $conexao = ConexaoBD::conectar();

        $sql = "INSERT INTO ingrediente (nome, quantidade, id_receita) 
                VALUES (:nome, :quantidade,  :idReceita)";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':idReceita', $idReceita);
        return $stmt->execute();
    }


    public static function consultarReceitasUser($idUsuario)
    {
        $conexao = ConexaoBD::conectar();
        $sql = "select * from receita where id_usuario='$idUsuario'";
        $receitas = $conexao->query($sql);

        return $receitas;
    }

    public static function consultarIngredientesPorReceita($idReceita)
    {
        $conexao = ConexaoBD::conectar();
        $sql = "select * from ingrediente where id_receita='$idReceita'";
        $receitas = $conexao->query($sql);

        return $receitas;
    }

    public static function consultarReceitaPorId($idReceita)
    {
        $conexao = ConexaoBD::conectar();
        $sql = "select * from receita where id_receita='$idReceita'";
        $receitas = $conexao->query($sql);

        return $receitas;
    }

    public static function updateReceita($nomeReceita, $modoPreparo, $descricaoReceita, $foto, $idReceita)
    {
        $conexao = ConexaoBD::conectar();

        if ($foto) {
            $sql = "UPDATE receita 
                    SET nome = :nome, 
                        modoPreparo = :modoPreparo, 
                        descricao = :descricao, 
                        foto = :foto 
                    WHERE id_receita = :idReceita";
        } else {
            $sql = "UPDATE receita 
                    SET nome = :nome, 
                        modoPreparo = :modoPreparo, 
                        descricao = :descricao 
                    WHERE id_receita = :idReceita";
        }

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome', $nomeReceita);
        $stmt->bindParam(':modoPreparo', $modoPreparo);
        $stmt->bindParam(':descricao', $descricaoReceita);
        $stmt->bindParam(':idReceita', $idReceita, PDO::PARAM_INT);

        if ($foto) {
            $stmt->bindParam(':foto', $foto, PDO::PARAM_LOB);
        }

        return $stmt->execute();
    }


    /*public static function remover()
    {
        $conexao = ConexaoBD::conectar(); // conecta e obtem o objeto conexão

        $id = $_GET['idUsuario'];
        $marca = $_GET['marcaUsuario'];

        $sql = "delete from Usuarios where idUsuario = $id and marcaUsuario= '$marca';";
        $conexao->exec($sql); // envia pro BD
    }



    public static function pesquisarvalor($valormenor, $valormaior)
    {
        $conexao = ConexaoBD::conectar();
        $sql = "SELECT * FROM Usuarios where valorUsuario > $valormenor and valorUsuario < $valormaior";
        $Usuarios = $conexao->query($sql);

        return $Usuarios;
    }

    public static function alterar()
    {
    }
    */
}
