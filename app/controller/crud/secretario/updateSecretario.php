<?php

(include('../../../autoload.php'));

$session = new Session();

$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');
$id = $session->session_get('id');

if (empty($_SESSION)) {

    header('location: ../../../../index.html');

}

require_once("../../../controller/crud.php");
// atualização do perfil
if(isset($_POST['atualizar_perfil'])){

    $nome = $_POST['atualizar_nome'];
    $email = $_POST['atualizar_email'];
    $senha = $_POST['senha'];
    $id = $session->session_get('id');

    $crud = new Crud();
    $atualizar = $crud->atualizar_perfil("secretario", $nome, $email, $senha, $id);

    // verifique se a atualização foi bem sucedida e redirecione o usuário para a página do perfil
    if ($atualizar) {
        $nome = $session->session_set('nome', $nome);

        header('location: ../../../view/telas/secretario/secretario.php');
    } else {

        //header('location: ../../../view/telas/secretario/secrePsicologos.php');
        echo "Erro ao atualizar o perfil.";
    }
}

?>