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

$psicologo = $_POST['psicoId'];
$paciente = $_POST['paciId'];

$update = new Crud();

$update->update_psicologo_paciente($paciente, $psicologo);

header("location: ../../../view/telas/secretario/secreListarPaci.php?paciId=".$paciente);
