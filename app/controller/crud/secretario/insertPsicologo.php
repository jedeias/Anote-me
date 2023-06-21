<?php


include("../../../autoload.php");
include("../../../model/connect.php");

if(isset($_POST)){

    $nome = $_POST['nome'];
    $RG = $_POST['RG'];
    $cpf = $_POST['CPF'];
    $sexo = $_POST['sexo'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $rua = $_POST['rua'];
    $numerocasa = $_POST['casaNum'];
    $bairro = $_POST['bairro'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];


    $insert = new Crud();
    $insert->insertPsicologo($_POST);

    header("location: ../../../view/telas/secretario/secretario.php");

}



?>