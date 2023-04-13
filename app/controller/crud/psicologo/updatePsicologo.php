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
    // $atualizar_senha = $_POST['atualizar_senha'];
    // $nova_senha = $_POST['nova_senha'];
    // $confirmar_senha = $_POST['confirmar_senha'];
    

    // if(!empty($atualizar_senha) || !empty($nova_senha) || !empty($confirmar_senha)){
    //     if($atualizar_senha != $senha_antiga){
    //         $mensagem[] = 'senha antiga não é igual';
    //     }elseif($nova_senha != $confirmar_senha){
    //         $mensagem[] = 'confirmar senha nao é igual';
    //     }else{
            
    //     }
    // }


    $crud = new Crud();
    $atualizar = $crud->atualizar_perfil_psicologo($nome, $email, $senha,$psico_id, $imagem);

    // verifique se a atualização foi bem sucedida e redirecione o usuário para a página do perfil
    if ($atualizar) {
        $nome = $session->session_set('nome', $nome);

        header('location: ../../../view/telas/psicologo/psiPacientes.php');
    } else {
        echo "Erro ao atualizar o perfil.";
    }
}


?>