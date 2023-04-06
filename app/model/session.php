<?php

class Session
{
    function __construct() {
        
        session_start();
    }
   
    function set($session_nome, $atributo) {
        $_SESSION[$session_nome] = $atributo;
    }

    function get($nome) {
        if (isset($_SESSION[$nome])) {
            return $_SESSION[$nome];
        }
        return null;
    }
   
    function destroy() {
        session_destroy();
    }
}

?>