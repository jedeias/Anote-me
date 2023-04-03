<?php

include("../../../autoload.php");

$session = new Session_controller();

$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');


if (empty($_SESSION)) {

    header("location: ../../../../index.html");

}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Psicologo Teste</title>
</head>
<body>
    <h1>Bem vindo <?php  echo $nome; ?> a pagina do psicolgo php</h1>
    <a href="sair.php">Logout</a>


</body>
</html>