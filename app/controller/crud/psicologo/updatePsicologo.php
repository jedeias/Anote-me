<?php

echo "estou aqui";
(include('../../../autoload.php'));

$session = new Session();


$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');
$psico_id = $session->session_get('id');

var_dump($psico_id);

if (empty($_SESSION)) {

    header('location: ../../../../index.html');

}



require_once("../../../controller/crud.php");
// atualização do perfil
if(isset($_POST['atualizar_perfil'])){

    echo "<pre>";
    

    // if(isset($_FILES['atualizar_foto']) && $_FILES['atualizar_foto']['error'] == 0) {
    //     $imagem = $_FILES['atualizar_foto']['name'];
    //     $imagem_temp = $_FILES['atualizar_foto']['tmp_name'];
    //     $imagem_dir = '../../../IMG/' . $imagem;
    //     move_uploaded_file($imagem_temp, $imagem_dir);
        
    //     var_dump($imagem);
    // }
    
    $nome = $_POST['atualizar_nome'];
    $email = $_POST['atualizar_email'];
    $senha = $_POST['senha'];
    $psico_id = $session->session_get('id');


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