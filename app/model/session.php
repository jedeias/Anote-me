<?php

class Session
{
    function __construct() {
      

        if (!isset($_SESSION)) {
            header("Refresh: 2; url=../../");
        }
        session_start();
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