<?php

include("../../../autoload.php");
include("../../../model/connect.php");

$session = new Session();

echo"<pre>";
echo"<hr>";

$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');
$id = $session->session_get('id');
$fkPsicologo = $session->session_get('fk_psicologo');

if($nome == NULL or $email == NULL or $type == NULL){
   header("location: /../../../tcc/index.php");
}
$emocao = $_POST["emocao"];
$emocaoGrau = $_POST["emocaoGrau"];
$descricao = $_POST["descricao"];

$session->session_set( "emocao" ,$emocao);
$session->session_set( "emocaoGrau" ,$emocaoGrau );
$session->session_set( "descricao" ,$descricao );
$session->session_set("get_executed", false);

$inser = new Crud();
$select = new Select();
$numAnotacoes = $select->selectNumAnotacoes($id);
$qtAnotacoesPsicologo = $select->selectQuantidadeAnotacoesPsicologo($fkPsicologo);

echo"<br>";

if($numAnotacoes[0]['num_anotacoes'] < $qtAnotacoesPsicologo[0]['quantidade_anotacoes']){

   $inser->insert_notas_paciente($id, $fkPsicologo, $emocao,$emocaoGrau, $descricao);
   header("location: /../../tcc/app/view/telas/paciente/paciente.php?savednote");

}else{

   header("location: /../../tcc/app/view/telas/paciente/paciente.php?limite");
}

