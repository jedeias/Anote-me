<?php

include "../autoload.php";
$session = new Session();

$session->session_get('nome');
$session->session_destroy();

header("location: ../../index.html");


    
?>

<!-- <!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de sair teste</title>
</head>
<body>
    <h1>Voce se deslogou...</h1>
</body>
</html> -->