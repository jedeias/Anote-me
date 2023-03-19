<?php

include ("autoload.php");

// $email = $_POST["email"];
// $senha = $_POST["senha"];

$email = "teste@teste.com"; 
$senha = "123456";


$login = new Login($sql->conn, $email, $senha);

$login->security($email);

$login->security($senha);

?>