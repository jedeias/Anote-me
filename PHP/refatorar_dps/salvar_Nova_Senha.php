<?php
include("connect.php");
session_id(2);
session_start();

if(isset($_POST['concluido']) == true and isset($_SESSION['codigo']) == true and isset($_SESSION['email']) == true and isset($_SESSION['tabela']) == true){
    $codigoUsuario = $_POST['codigo'];
    $truecodigo = $_SESSION['codigo'];
    $emailUsuario = $_SESSION['email'];
    $novasenha = $_POST['senha'];
    $tabela = $_SESSION['tabela'];

    if($codigoUsuario == $truecodigo){
        
        if($conn->query("UPDATE $tabela SET senha = '$novasenha' WHERE email = '$emailUsuario' ")){

            echo "<script>alert('Senha atualizada com sucesso');</script>";
            header("Refresh: 0, url='../login/Telalogin.html'");

        }

    }
    else{

        echo "<script>alert('código de verifação errado');</script>";
        header("Refresh: 0, url='../login/TelaRecuperarSenha.html'");

        session_destroy();
        exit();

    }
}
else{

    echo"<script>alert('Erro ao receber dados')</script>";
    header("Refresh: 0, url='../login/Telalogin.html'");

    session_destroy();
    exit();
}

?>