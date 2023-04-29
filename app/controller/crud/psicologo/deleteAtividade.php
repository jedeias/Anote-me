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


$pkAtividade = $_POST['excluir'];



$delete = new Crud();

$delete->delete_atividades_paciente($pkAtividade);

$curPaciente = $_POST['curPaciente'];

header("location: ../../../view/telas/psicologo/psicologo.php?paciente=".$curPaciente."");

echo "$pkAtividade";

?>