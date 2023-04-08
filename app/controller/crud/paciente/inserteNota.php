<?php

include("../../../autoload.php");


$session = new Session();

$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');

if($nome == NULL and $email == NULL and $type == NULL){
   header("location: /../../../tcc/index.html");
}

$_POST["emocao"];
$_POST["emocaoGrau"];
$_POST["descricao"];

echo"<pre>";
var_dump($_POST);


?>