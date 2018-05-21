<?php
require_once 'db_connect.php'; #Conecta com o banco de dados
require_once 'logar.php'; #Importa as funções de autenticação

$metodo = $_SERVER['REQUEST_METHOD']; #Pega o metodo da requisição

#Função que autentica o usuário
function autenticar($connection, $usuario_email, $usuario_senha){
    $query = "select email, senha from usuarios where email='{$usuario_email}' and senha='{$usuario_senha}'";
    $resultado = mysqli_query($connection, $query);
    $usuario = mysqli_fetch_assoc($resultado);
    return $usuario;
}

if ($metodo === 'POST'){ #Verifica se o método da requisição é POST. se não a app morre.
    $dados_json = json_decode(file_get_contents('php://input'));
    $usuario_email = $dados_json->email;
    $usuario_senha = $dados_json->senha;
    $logar = autenticar($connection, $usuario_email, $usuario_senha);

    if ($logar === null){ # Se a função de autenticação retornar nulo, a API informa usuário ou senha incorreto em JSON
        header('Content-Type: application/json');
        echo json_encode(['Mensagem'=>'Email ou senha incorreto!']);
        die();
    }else{ # Se não for nulo,
        $_SESSION["success"] = "Usuário logado com sucesso.";
        logaUsuario($usuario_email);
        header('Location: perfil.php');
    }

}else{
    die();
}


