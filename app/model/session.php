<?php

class Session implements Session_controller
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


    public function session_set($session_nome, $atributo) {
    
        $this->set($session_nome, $atributo);
    
    }

    public function session_get($session_nome) {
    
        return $this->get($session_nome);
    
    }

    public function session_destroy() {

        $this->destroy();
    
    }

}

?>