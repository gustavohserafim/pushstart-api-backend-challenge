<?php

class User{

    public static function consultaPerfil($id){
        $statement = Database::getInstance()->prepare("select nome, email, foto from usuarios where id = ?");
        $statement->bindValue(1, $id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    public static function atualizaPerfil($email, $nome, $senha, $id){
        $statement = Database::getInstance()->prepare("update usuarios set email = ?, nome = ?, senha = ? where id = ?");
        $statement->bindValue(1, $email);
        $statement->bindValue(2, $nome);
        $statement->bindValue(3, $senha);
        $statement->bindValue(4, $id);
        $statement->execute();
    }

    public static function atualizaFoto($id){
        $ext = strtolower(substr($_FILES['foto']['name'], -4));
        $foto_nome = $id . $ext;
        $foto_dir = 'img/';
        move_uploaded_file($_FILES['foto']['tmp_name'], $foto_dir . $foto_nome);
        $statement = Database::getInstance()->prepare("update usuarios set foto = ? where id = ?");
        $statement->bindValue(1, 'http://localhost/apiv2/img/'.$foto_nome);
        $statement->bindValue(2, $id);
        $statement->execute();


    }

    public static function criaThumb(){


    }

}