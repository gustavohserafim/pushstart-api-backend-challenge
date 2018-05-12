<?php
require_once 'conexao/db_connect.php'; #Conecta com o banco de dados
require_once 'logar.php';
verificaUsuario();

$metodo = $_SERVER['REQUEST_METHOD'];

if($metodo === 'GET'){
    $email = $_SESSION["usuario_logado"];
    $query = "select nome, email, foto from usuarios where email = '{$email}'";
    $consulta = mysqli_query($connection, $query);
    $resultado = mysqli_fetch_assoc($consulta);
    header('Content-Type: application/json');
    echo json_encode($resultado);
    #var_dump($resultado);
    #echo json_encode();

}elseif ($metodo === 'PUT'){
    $email = $_SESSION["usuario_logado"];

    $dados_json = json_decode(file_get_contents('php://input'));
    $novo_nome = $dados_json->nome;
    $novo_email = $dados_json->email;
    $nova_senha = $dados_json->senha;
    $query = "update usuarios set nome = '{$novo_nome}', email = '{$novo_email}', senha ='{$nova_senha}' where email = '{$email}' ";
    $consulta = mysqli_query($connection, $query);

}elseif ($metodo === 'POST') {
    $foto = file_get_contents('php://input');



}elseif ($metodo === 'DELETE'){
    logout();
}
