<?php

include("../../../autoload.php");
include("../../../model/connect.php");

$session = new Session();

echo"<pre>";
var_dump($_SESSION);

echo"<hr>";

$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');
$id = $session->session_get('id');

if($nome == NULL or $email == NULL or $type == NULL){
   header("location: /../../../tcc/index.html");
}
$emocao = $_POST["emocao"];
$emocaoGrau = $_POST["emocaoGrau"];
$descricao = $_POST["descricao"];

$session->session_set( "emocao" ,$emocao);
$session->session_set( "emocaoGrau" ,$emocaoGrau );
$session->session_set( "descricao" ,$descricao );

$inser = new Crud();

echo"<br>";

$inser->insert_notas_paciente ($id, $emocao, $descricao);

header("refresh: 4; /../../tcc/app/view/telas/paciente/anotacoes.php")

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="app/view/CSS/login.css">
</head>

<body>
    <h1>Salvo com sucesso</h1>
</body>