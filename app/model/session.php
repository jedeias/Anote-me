<?php

class Session
{
    function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
   
    function set($session_nome, $atributo) {
        $_SESSION[$session_nome] = $atributo;
    }
   
    function get($nome) {
        return isset($_SESSION[$nome]);
    }
   
    function destroy() {
        session_destroy();
    }
}

?>