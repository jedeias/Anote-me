<?php
include 'connect.php';
session_id(2);
session_start();
//MUDAR CAMINHO BD

$_SESSION['teste'] = 'teste';


if(isset($_POST['enviar']) == true){

    $email = $_POST['Email'];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<script>alert('Email inválido');</script>";
        header("Refresh: 0, url='../login/RecuperarSenha.html' ");
    }
    //Esse if pode ser tirado, pois já é obrigatório colocar um email válido no html
    else{
        
        $dados = $conn->query("SELECT * FROM paciente WHERE email = '$email' ");

        if($dados == null){

            $dados = $conn->query("SELECT * FROM psicologo WHERE email = '$email' ");
        
            if($dados == null){
            
                $dados = $conn->query("SELECT * FROM secretario WHERE email = '$email' ");
                $tabelaUsuario = 'secretario';
            
            }
            
            else{
            
                $tabelaUsuario = 'psicologo';
            
            }

        }
        
        else{

            $tabelaUsuario = 'paciente';
        
        }
        
        $linha = mysqli_num_rows($dados);

        if($linha == 0){
        
            echo "<script>alert('O email informado não está cadastrado no nosso sistema');</script>";
            
            header("Refresh: 0, url='../login/TelaRecuperarSenha.html");
            
            session_destroy();
            exit();
        
        }else {
            
            $codigo = rand(1000, 9999);
            
            if(mail($email, "Mude sua senha", "Este é seu código de recuperação de senha: ".$codigo)){
            
                $_SESSION['codigo'] = $codigo;
                $_SESSION['email'] = $email;
                $_SESSION['tabela'] = $tabelaUsuario;
                header("Location: ../login/TeladeRedefinicaodesenha.html");
               
               
          
            }

    }
}
}

else{

    echo "<script>alert('Erro ao receber dados');</script>";

    header("Refresh = 0, url='../login/Telalogin.html");

    session_destroy();
    exit();

}

?>

