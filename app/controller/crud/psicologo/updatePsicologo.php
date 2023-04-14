<?php


(include('../../../autoload.php'));

$session = new Session();


$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');
$psico_id = $session->session_get('id');

if (empty($_SESSION)) {

    header('location: ../../../../index.html');

}



require_once("../../../controller/crud.php");
// atualização do perfil
if(isset($_POST['atualizar'])){

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $psico_id = $session->session_get('id');

    $crud = new Crud();
    $atualizar = $crud->atualizar_perfil_psicologo($nome, $email, $senha,$psico_id);

    // verifique se a atualização foi bem sucedida e redirecione o usuário para a página do perfil
    if ($atualizar) {
        $nome = $session->session_set('nome', $nome);

        header('location: ../../../view/telas/psicologo/psiPacientes.php');
    } else {
        echo "Erro ao atualizar o perfil.";
    }
}


?>