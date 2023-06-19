<?php

(include('../../autoload.php'));

$session = new Session();

$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');
$id = $session->session_get('id');

// se nao existir session ele volta para a raiz do app
if (empty($_SESSION)) {

    header('location: ../../../index.php');

}

//require_once("../../../controller/crud.php");

// atualização do perfil
if(isset($_POST['atualizarSizeAnotacoes'])){

    $quantidadeAnotacoes = $_POST['sizeAnotacoes'];
    $id = $session->session_get('id');

    $crud = new Crud();
    $atualizar = $crud->quantidadeAnotacoes($type, $quantidadeAnotacoes, $id);

    // verifique se a atualização foi bem sucedida e redirecione o usuário para a página do perfil
    if ($atualizar) {
        header('location: ../../view/telas/'.$type.'/'.$type.'.php');
    } else {
        header('location: ../../view/telas/'.$type.'/'.$type.'.php');
    }
}

?>
