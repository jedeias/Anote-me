<?php

class Session
{
    function __construct() {
      
        session_start();
      
        if (!isset($_SESSION)) {
        header("Refresh: 2; url=../../");
        }
    }
   
   function set($session_nome, $atributo) {

        $_SESSION[$session_nome] = $atributo;
   
    }
   
   function get($nome) {
            
        if (isset($_SESSION)) {

            return $_SESSION[$nome];

        }else {

            return null;

        }
    }
   
   function destroy() {
        session_destroy();
    }

}


?>