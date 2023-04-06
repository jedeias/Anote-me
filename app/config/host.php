<?php

// Pressetar metodos especiais




class Host{

    public $server = "localhost";
    public $database = "clinica_psicologica";
    public $user = "root";
    public $password = "";

    public function getServer()
    {
        return $this->server;
    }

}

?>