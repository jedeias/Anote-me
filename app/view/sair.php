<?php

include "../autoload.php";
$session = new Session();

$session->session_destroy();

header("location: ../../index.php");

?>