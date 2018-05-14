<?php
session_start();
#Verifica se o usuario já está logado
function usuarioEstaLogado() {
    return isset($_SESSION["usuario_logado"]);
}

function verificaUsuario() {
    if(!usuarioEstaLogado()) {
        $_SESSION["danger"] = "Você não tem acesso a esta funcionalidade.";
        header('Content-Type: application/json');
        echo json_encode(['Mensagem'=>'Você não está logado.']);
        die();
    }
}

function usuarioLogado() {
    return $_SESSION["usuario_logado"];
}

function logaUsuario($usuario_email) {
    $_SESSION["usuario_logado"] = $usuario_email;
}

#Faz logout apagando a sessão
function logout() {
    session_destroy();
    session_start();
}