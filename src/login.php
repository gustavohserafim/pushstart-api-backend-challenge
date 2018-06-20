<?php

require_once 'Database.php'; #Conecta com o banco de dados
require_once 'logar.php'; #Importa as funções de autenticação

class Login{
    public static function logar($connection ,$usuario_email, $usuario_senha){
        $statement = $connection->prepare("select id, email, senha from usuarios where email= ? and senha= ?");
        $statement->bindValue(1, $usuario_email);
        $statement->bindValue(2, $usuario_senha);
        $statement->execute();
        $usuario = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $usuario;
    }

};
/*
if ($_SERVER['REQUEST_METHOD'] === 'POST'){ #Verifica se o método da requisição é POST. se não a app morre.
    $dados_json = json_decode(file_get_contents('php://input'));
    $usuario_email = $dados_json->email;
    $usuario_senha = $dados_json->senha;
    #$logar = logar($connection, $usuario_email, $usuario_senha);
    $logar = Login::logar(Database::conectar(), $usuario_email, $usuario_senha);

    if ($logar === null){ # Se a função de autenticação retornar nulo, a API informa usuário ou senha incorreto em JSON
        header('Content-Type: application/json');
        echo json_encode(['Mensagem'=>'Email ou senha incorreto!']);
        die();
    }else{ # Se não for nulo,
        $_SESSION["success"] = "Usuário logado com sucesso.";
        #var_dump($logar->id);
        logaUsuario($logar[0]['id']);
        header('Location: perfil.php');
    }

}else{
    die();
}
*/