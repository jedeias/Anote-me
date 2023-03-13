<?php 

include("connect.php");
session_id(1);
session_start();



if(isset($_POST['entrar']) == true){

$email = $_POST["email"];
$senha = $_POST['senha'];

    $dados = $conn->query("SELECT psicologo.email, paciente.email, secretario.email FROM tipo_usuario
	left JOIN psicologo ON (tipo_usuario.pk_tipo_usuario = psicologo.fk_tipo_usuario)
	LEFT JOIN paciente ON (tipo_usuario.pk_tipo_usuario = paciente.fk_tipo_usuario)
	LEFT JOIN secretario ON (tipo_usuario.pk_tipo_usuario = secretario.fk_tipo_usuario) WHERE email = '$email' ");
    
    if($dados == null){
        $dados = $conn->query("SELECT * FROM psicologo WHERE email = '$email' ");
    
        if($dados == null){
            $dados = $conn->query("SELECT * FROM secretario WHERE email = '$email' ");
            $secretario = 1;
    
        }
        
        else{
            $psicologo = 1;
        }
    
    }else{
        $paciente = 1;
    }

    $contagem = mysqli_num_rows($dados);
    $linha = mysqli_fetch_array($dados);
    
    

    if($contagem == 1 and $paciente == 1){
        if($senha == $linha['senha']){
            $_SESSION['id'] = $linha['pk_paciente'];
            $_SESSION['name'] = $linha['nome'];
            $_SESSION['email'] = $linha['email'];
            header("Location:../Main/Usuario/anotacoes/anotacoes.php");
            exit();
        }else{
            echo "<script>alert('Email ou senha incorreto(a)');</script>";
            header("Refresh: 0, url='../login/TelaLogin.html'");
            exit();
        }
    }

    if($contagem == 1 and $psicologo == 1){


        header("../Main/Usuario/anotacoes/anotacoes.php");

    }
    if($contagem == 1 and $secretario == 1){



        header("../Main/Usuario/anotacoes/anotacoes.php");

    }
}else{
    echo 'não entrei no if';
}