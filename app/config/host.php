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

	/**
	 * @return mixed
	 */
	public function getDatabase() {
		return $this->database;
	}

	/**
	 * @return mixed
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * @return mixed
	 */
	public function getPassword() {
		return $this->password;
	}
}

?>