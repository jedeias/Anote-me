<?php

(include('../../autoload.php'));


    if(isset($_POST['esqueci_senha'])){

    $email = $_POST['email'];
    $select = new Select();
    $teste = $select->getEmail($email);
    $tipo = $teste[0]['tipo'];
    $codigo = rand(1000, 9999);
    mail($email, 'Código de redefinição de senha', 'Seu código de redefinição de senha é: '.$codigo);
    header("location: ../../view/telas/updatesenha.php?email=$email&tipo=$tipo");

    }elseif(isset($_POST['enviar'])){
        $real = $_POST['real_code'];
        $novasenha = $_POST['senha'];
        $table = $_POST['tipo'];
        $email = $_POST['email'];

        echo "<pre>";

        echo "$real";
        echo "$table";
        echo "$novasenha";
        
    /*if($codigo == $real){
        echo "jjjj";
        echo "$tipo";
        $crud = new Crud();
        $crud->update_senha($tipo, $novasenha, $email);
    }*/
}
    else {
    echo "<script>alert('Erro ao enviar dados');</script>";
    //exit();
        }

?>
