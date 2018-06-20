<?php

require_once 'Login.php';
require_once 'User.php';
require_once 'Database.php';


switch ($_GET['a']){
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $dados_json = json_decode(file_get_contents('php://input'));
            $id = $_SESSION["usuario_logado"];
            $result = Login::logar(Database::conectar(), $dados_json->email, $dados_json->senha);
            echo 'foi';
        }
    break;
    case '':


}