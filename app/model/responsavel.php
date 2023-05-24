<?php

//A class de pessoa tem todos os dados de um responsavel

require_once ("pessoas.php");

class Responsavel extends Pessoas{
    
}

$responsavel = new Responsavel();

echo "<pre>";
$responsavel->setNome("Jorge");

var_dump($responsavel);


// $responsavel = new Pessoas();

// echo "<pre>";
// $responsavel->setNome("Jorge");

// var_dump($responsavel);

?>