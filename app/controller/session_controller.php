<?php

class Session_controller {
    
    private $session;

    public function __construct() {
    
        $this->session = new Session();
    
    }

    public function session_set($session_nome, $atributo) {
    
        $this->session->set($session_nome, $atributo);
    
    }

    public function session_get($session_nome) {
    
        return $this->session->get($session_nome);
    
    }

    public function session_destroy() {

        $this->session->destroy();
    
    }
}
?>