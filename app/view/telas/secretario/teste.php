<?php

$telefone_ddd = substr($_POST['telefone'],1,2);
$telefone_numero = substr($_POST['telefone'],5);

var_dump($telefone_ddd);
var_dump($telefone_numero);



?>