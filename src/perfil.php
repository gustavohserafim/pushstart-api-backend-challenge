<?php
require_once 'db_connect.php'; #Conecta com o banco de dados
require_once 'logar.php';

verificaUsuario(); #Verifica se o usuario já está logado

$metodo = $_SERVER['REQUEST_METHOD'];

if($metodo === 'GET'){
    $email = $_SESSION["usuario_logado"];
    $query = "select nome, email, foto from usuarios where email = '{$email}'";
    $consulta = mysqli_query($connection, $query);
    $resultado = mysqli_fetch_assoc($consulta);
    header('Content-Type: application/json');
    echo json_encode($resultado);

}elseif ($metodo === 'POST') {
    $email = $_SESSION["usuario_logado"];
    $extensao = strtolower(substr($_FILES['foto']['name'], -4)); //pega a extensao do arquivo
    $foto_nome = $email . $extensao; //define o nome do arquivo
    $diretorio = "../img/"; //define o diretorio que foto será salva
    move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$foto_nome); //efetua o upload
    $sql = "update usuarios set foto = 'http://localhost/api/img/{$foto_nome}' where email='{$email}'";
    $update = mysqli_query($connection, $sql);

}elseif ($metodo === 'PUT'){
    $email = $_SESSION["usuario_logado"];
    $dados_json = json_decode(file_get_contents('php://input'));
    $novo_nome = $dados_json->nome;
    $novo_email = $dados_json->email;
    $nova_senha = $dados_json->senha;
    $sql = "update usuarios set nome = '{$novo_nome}', email = '{$novo_email}', senha ='{$nova_senha}' where email = '{$email}'";
    $consulta = mysqli_query($connection, $sql);

}elseif ($metodo === 'DELETE'){
    logout();
}
