<?php

define ('HOST', 'localhost');
define ('USER', 'root');
define ('PASS', '');
define ('DBNAME', 'clinica_psicologica');

$pdo = new PDO('mysql:host='. HOST . ';dbname='. DBNAME . ';', USER, PASS);

?>