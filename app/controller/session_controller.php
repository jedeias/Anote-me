<?php

// extend class Session

interface Session_controller {
    
    public function session_set($session_nome, $atributo);
    public function session_get($session_nome);
    public function session_destroy();
    
}
?>