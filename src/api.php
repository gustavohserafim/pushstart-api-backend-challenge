<?php

require_once 'Database.php';
require_once 'Login.php';
require_once 'User.php';
require_once 'Validacao.php';

#header('Content-Type: application/json');

if (isset($_SESSION["usuario_logado"])){
    $id = $_SESSION["usuario_logado"];
}

switch ($_GET['a']){
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            $dados_json = json_decode(file_get_contents('php://input'));
            $result = Login::logar($dados_json->email, $dados_json->senha);

            if ($result === null){
                echo json_encode(['Mensagem'=>'Email ou senha incorreto!']);
                die();
            }else{
                $_SESSION["success"] = "Usuário logado com sucesso.";
                Login::logaUsuarios($result[0]['id']);
                header('api.php?a=ler');
            }

        }else{
            echo json_encode(['Erro'=>'Metodo de requisição incorreta']);
            die();
        }
    break;

    case 'ler':
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            if (Login::verificaUsuario() === false){
                echo json_encode(['Erro'=>'Você não está logado!']);
                die();
            }else{
                $resultado = User::consultaPerfil($id);
                echo json_encode($resultado);
            }
        }else{
            echo json_encode(['Erro'=>'Metodo de requisição incorreta']);
            die();
        }
    break;

    case 'atualizar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (Login::verificaUsuario() === false){
                echo json_encode(['Erro'=>'Você não está logado!']);
                die();
            }else {
                $dados_json = json_decode(file_get_contents('php://input'));
                if (Validacao::validaEmail($dados_json->email) === true){
                    User::atualizaPerfil($dados_json->email, $dados_json->nome, $dados_json->senha, $id);
                }else{
                    echo json_encode(['Erro'=>'Email invalido!']);
                }

                header('api.php?a=ler');
            }
        }else{
            echo json_encode(['Erro'=>'Metodo de requisição incorreta']);
            die();
        }
        break;

    case 'foto':
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (Login::verificaUsuario() === false){
                echo json_encode(['Erro'=>'Você não está logado!']);
                die();
            }else {
                if (Validacao::validaFoto() === true){
                    User::atualizaFoto($id);
                    echo 'Foto atualizada';
                    header('api.php?a=ler');
                }else{
                    echo json_encode(['Erro'=>'Foto invalida']);
                    die();
                }

            }
        }else{
            echo json_encode(['Erro'=>'Metodo de requisição incorreta']);
            die();
        }
    break;

    case 'logout':
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE'){
            if (Login::verificaUsuario() === false){
                echo json_encode(['Erro'=>'Você não está logado!']);
                die();
            }else {
                Login::logout();
            }
        }else{
            echo json_encode(['Erro'=>'Metodo de requisição incorreta']);
            die();
        }
    break;

    default:
        header('api.php?a=ler');
    break;
}