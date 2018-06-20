<?php

require_once 'Database.php'; #Conecta com o banco de dados
require_once 'logar.php';

verificaUsuario(); #Verifica se o usuario já está logado

$metodo = $_SERVER['REQUEST_METHOD'];

if($metodo === 'GET'){

    $id = $_SESSION["usuario_logado"];
    $statement = $connection->prepare("select nome, email, foto from usuarios where id = ?");
    $statement->bindValue(1, $id);
    $statement->execute();
    $resultado = $statement->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($resultado);

}elseif ($metodo === 'POST') {

    $id = $_SESSION["usuario_logado"];
    $extensao = strtolower(substr($_FILES['foto']['name'], -4)); //pega a extensao do arquivo
    $foto_nome = $id . $extensao; //define o nome do arquivo
    $diretorio = "../img/"; //define o diretorio que foto será salva
    move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$foto_nome); //efetua o upload
    $statement = $connection->prepare("update usuarios set foto = ? where id= ? ");
    $statement->bindValue(1, 'http://localhost/api/img/'.$foto_nome);
    $statement->bindValue(2, $id);
    $statement->execute();

}elseif ($metodo === 'PUT'){

    $id = $_SESSION["usuario_logado"];
    $dados_json = json_decode(file_get_contents('php://input'));
    $novo_nome = $dados_json->nome;
    $novo_email = $dados_json->email;
    $nova_senha = $dados_json->senha;
    $statement = $connection->prepare("UPDATE usuarios set nome = ?, email = ?, senha = ? where id = ?");
    $statement->bindValue(1, $novo_nome);
    $statement->bindValue(2, $novo_email);
    $statement->bindValue(3, $nova_senha);
    $statement->bindValue(4, $id);
    $statement->execute();

}elseif ($metodo === 'DELETE'){
    logout();
}
