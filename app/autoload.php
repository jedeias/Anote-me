<?php

function autoload($class_Name){

    $dirs = array("controller/","model/","view/", "config");

    foreach($dirs as $dir){

        $file = ("$dir" . "$class_Name" . ".php");

        if(file_exists($file)){
        
            include_once($file);
        
        }
    }

}

spl_autoload_register('autoload');

?>
