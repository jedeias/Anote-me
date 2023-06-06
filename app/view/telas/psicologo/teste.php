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

$noteId = $_POST['noteId'];

$paciId = $_POST['paciId'];

$comentario = $_POST['comentario'];

$redFlagCor = $_POST['red-flag-select'];

$curPaci = $_POST['curPaci'];

echo $noteId;
echo $paciId;
echo $comentario;
echo $redFlagCor;

$update = new Crud();
$select = new Select();

$checkNote = $select->checkNotaPsicologo($noteId);

if($checkNote == false){
   $update->insertNotaPsicologo($noteId, $id, $comentario, $redFlagCor);
} else{
   $update->atualizarNotaPsicologo($noteId, $comentario, $redFlagCor);
}


header("location: psicologo.php?paciente=".$curPaci);





