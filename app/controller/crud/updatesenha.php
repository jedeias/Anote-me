<?php

(include('../../autoload.php'));



// se nao existir session ele volta para a raiz do ap

    if(isset($_POST['esqueci_senha'])){

    $email = $_POST['email'];
    $select = new Select();
    $teste = $select->getEmail($email);
    $parteURL = rand(1000, 9999);

    $chave = "minhachave123456";
    
    $parteURLCriptografada = base64_encode(openssl_encrypt($parteURL, 'AES-256-CBC', $chave, 0, substr($chave, 0, 16)));

    
    if($teste == null){
        echo "<script>alert('E-mail não encontrado no banco de dados');</script>";
        header("Refresh: 0; url=../../../index.php");
        exit();
    }
    else{
        $tipo = $teste[0]['tipo'];
        mail($email, 'Código de redefinição de senha', 'Seu código de redefinição de senha é: '.$parteURL);
        header("location: ../../view/telas/updatesenha.php?email=$email&tipo=$tipo&parte=".urlencode($parteURLCriptografada));
    }

    }elseif(isset($_POST['enviar'])){
        $real = $_POST['real_code'];
        $novasenha = $_POST['senha'];
        $table = $_POST['tipo'];
        $email = $_POST['email'];
        $code = $_POST['code'];
        
    if($code == $real){
        $crud = new Crud();
        $update = $crud->senha_nova($table, $novasenha, $email);

        if($update){
            echo "<script>alert('Senha salva com sucesso!!');</script>";
            header("Refresh: 0; url=../../../index.php");
            exit();
        }
        else{
            echo "<script>alert('Erro ao redefinir senha');</script>";
            header("Refresh: 0; url=../../../index.php");
            exit();
        }
    }
    else{
        echo "<script>alert('código de segurança incorreto');</script>";
        header("Refresh: 0; url=../../../index.php");
        exit();
    }
}
else {
    echo "<script>alert('Erro ao enviar dados');</script>";
    exit();
    }

?>
