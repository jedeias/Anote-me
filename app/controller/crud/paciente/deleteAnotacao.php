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

$_SESSION['get_executed'] = false;

$pkAnotacao = $_POST['excluir'];



$delete = new Crud();

$delete->delete_anotacao_paciente($pkAnotacao);

header("location: ../../../view/telas/paciente/anotacoes.php?deletednote");

var_dump($pkAnotacao);
