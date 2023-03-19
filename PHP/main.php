<?php

include ("autoload.php");

// $email = $_POST["email"];
// $senha = $_POST["senha"];

$email = "teste@teste.com"; 
$senha = "123456";

$sql = new Connect("localhost","root","","clinica_psicologica");

$login = new Login($sql->conn, $email, $senha);

$seguranca = new Security();

$seguranca->input_check($email);

?>