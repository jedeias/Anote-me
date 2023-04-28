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

$fk_paciente = intval($_POST["fk_paciente"]);
$fk_psicologo = $session->session_get('id');
$assunto = $_POST["assunto"];
$atividade = $_POST["atividade"];

$insert = new Crud();

$insert->insert_atividades_paciente($fk_paciente, $fk_psicologo, $assunto, $atividade);

$curPaciente = $_POST['curPaciente'];

header("location: ../../../view/telas/psicologo/psicologo.php?paciente=".$curPaciente."");

