<?php

function autoload($class_Name){

    $dirs = array(  "controller/",
                    "model/",
                    "view/", 
                    "config/",
                    "/config",
                    "../config", 
                    "../controller/", 
                    "../model/", 
                    "../view", 
                    "../../view/",
                    "../../../controller/", 
                    "../../../model/", 
                    "../../../view/");

    foreach($dirs as $dir){

        $file = (($_SERVER['DOCUMENT_ROOT'].'/tcc/app/'."$dir" . "$class_Name" . ".php"));

        if(file_exists($file)){
        
            include_once($file);
        
        }
    }

}

spl_autoload_register('autoload');

?>