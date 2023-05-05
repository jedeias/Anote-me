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
$fkPsicologo = $session->session_get('fk_psicologo');

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

$inser->insert_notas_paciente($id, $fkPsicologo, $emocao,$emocaoGrau, $descricao);


header("location: /../../tcc/app/view/telas/paciente/paciente.php?savednote");
