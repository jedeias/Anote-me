<?php

// Pressetar metodos especiais

class Host{

    private $server = "localhost";
    private $database = "clinica_psicologica";
    private $user = "root";
    private $password = "";

    public function getServer()
    {
        return $this->server;
    }
	public function getDatabase() {
		return $this->database;
	}

	public function getUser() {
		return $this->user;
	}

	public function getPassword() {
		return $this->password;
	}
}

?>