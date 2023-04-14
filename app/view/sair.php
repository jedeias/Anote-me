<?php

include "../autoload.php";
$session = new Session();

$session->session_get('nome');
$session->session_destroy();

header("location: ../../index.html");

?>