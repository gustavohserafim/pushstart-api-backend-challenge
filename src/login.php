<?php

require_once 'Database.php';

session_start();

class Login{

    public static function logar($email, $senha){
        $statement = Database::getInstance()->prepare("SELECT id, email, senha from usuarios WHERE email = ? and senha = ?");
        $statement->bindValue(1, $email);
        $statement->bindValue(2, $senha);
        $statement->execute();
        $user = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }

    public static function verificaUsuario(){
        if (!isset($_SESSION['usuario_logado'])){
            return false;
        }
    }

    public static function logaUsuarios($id){
        $_SESSION['usuario_logado'] = $id;
    }

    public static function usuarioLogado (){
        return $_SESSION["usuario_logado"];
    }

    public static function logout(){
        session_destroy();
        session_start();
    }

}