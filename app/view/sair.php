<?php

include "../autoload.php";
$session = new Session_controller();
var_dump($session->session_get('nome'));


if(isset($session))
{
    $session->session_get('nome');
    $session->session_destroy();
}

?>

<!DOCTYPE html>
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
</html>