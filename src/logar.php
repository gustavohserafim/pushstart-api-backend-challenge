<?php

session_start();

function usuarioEstaLogado() { #Verifica se o usuario já está logado
    return isset($_SESSION["usuario_logado"]);
}

function verificaUsuario() {
    if(!usuarioEstaLogado()) {
        $_SESSION["danger"] = "Voce nao esta logado.";
        header('Content-Type: application/json');
        echo json_encode(['Mensagem'=>'Voce nao esta logado.']);
        die();
    }
}

function usuarioLogado() {
    return $_SESSION["usuario_logado"];
}

function logaUsuario($id) {
    $_SESSION["usuario_logado"] = $id;
}

#Faz logout apagando a sessão
function logout() {
    session_destroy();
    session_start();
}