<?php

(include('../../../autoload.php'));

$session = new Session();

$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');
$id = $session->session_get('id');

// se nao existir session ele volta para a raiz do app
if (empty($_SESSION)) {

    header('location: ../../../../index.html');

}

require_once("../../../controller/crud.php");

// atualização do perfil
if(isset($_POST['atualizar_perfil'])){

    $nome = $_POST['atualizar_nome'];
    $telefone = $_POST['atualizar_telefone'];
    $senha = $_POST['senha'];
    $id = $session->session_get('id');

    $crud = new Crud();
    $atualizar = $crud->atualizar_perfil("secretario", $nome, $telefone, $senha,$id);
    
    // verifique se a atualização foi bem sucedida e redirecione o usuário para a página do perfil
    if ($atualizar) {
        $nome = $session->session_set('nome', $nome);

        header('location: ../../../view/telas/secretario/home.php');
    } else {

        header('location: ../../../view/telas/secretario/home.php');
        
    }
}

?>
