<?php

// Pressetar metodos especiais

class Host{

    private $server = "localhost";
    private $database = "clinica_psicologica";
    private $user = "root";
    private $password = "";

    protected function getServer()
    {
        return $this->server;
    }
	protected function getDatabase() {
		return $this->database;
	}

	protected function getUser() {
		return $this->user;
	}

	protected function getPassword() {
		return $this->password;
	}
}

?>