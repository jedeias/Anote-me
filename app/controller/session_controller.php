<?php

class Session_controller{

    public function session_set($session_nome, $atributo)
    {
        $session = new Session();

        $session->set($session_nome, $atributo);

    }

    public function session_get($session_nome)
    {
        $session = new Session();

        $session->get($session_nome);

    }

    public function session_destroy()
    {
        $session = new Session();

        $session->destroy();

    }


}

?>