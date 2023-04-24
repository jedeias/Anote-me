<?php
(include('../../../autoload.php'));

$session = new Session();

$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');
$paci_id = $session->session_get('id');


if (empty($_SESSION)) {

    header('location: ../../../../index.html');

}

require_once("../../../controller/crud.php");

if(isset($_POST['atualizar_imagem'])){

    if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        // Verifica se um arquivo de imagem foi enviado e se não houve erros
        $nome_arquivo = $_FILES['imagem']['name'];
        $tamanho_arquivo = $_FILES['imagem']['size'];
        $tipo_arquivo = $_FILES['imagem']['type'];
        $caminho_temporario = $_FILES['imagem']['tmp_name'];
        
        // Move o arquivo para o diretório desejado
        $novo_caminho = '../../../view/IMG/imagem_perfil/' . $nome_arquivo;
        move_uploaded_file($caminho_temporario, $novo_caminho);

        $crud = new Crud();
        $atualizar = $crud->atualizar_imagem('paciente', $novo_caminho, $paci_id);

      var_dump($atualizar);
        if ($atualizar) {

            header('location: ../../../view/telas/paciente/atualizar_registro.php');

        } else {
            echo "Erro ao atualizar o perfil.";
        }
    }
   header('location: ../../../view/telas/paciente/atualizar_registro.php');
}

?>