<?php
include 'conexao/db_connect.php'; #Conecta com o banco de dados
$metodo = $_SERVER['REQUEST_METHOD']; #Define o metodo da requisição
#header('Content-Type: application/json; charset=UTF-8');

#Função que autenticado o usuário
function autenticar($conexao, $usuario_email, $usuario_senha){
    $query = "select email, senha from usuarios where email='{$usuario_email}' and senha='{$usuario_senha}'";
    $resultado = mysqli_query($conexao, $query);
    $usuario = mysqli_fetch_assoc($resultado);
    #var_dump($usuario);
    return $usuario;
}

if ($metodo === 'POST'){
    $dados_json = json_decode(file_get_contents('php://input'));
    $usuario_email = $dados_json->email;
    $usuario_senha = $dados_json->senha;

    $logar = autenticar($conexao, $usuario_email, $usuario_senha);

    if ($logar === null){
        echo json_encode(['Erro'=>'Email ou senha incorreto!']);
        die();
    }else{
        setcookie("usuario_logado", $usuario_email);
    }

}else{
    
    die();
}

