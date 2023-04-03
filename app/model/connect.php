<?php

require_once("../config/host.php");

class Connect{
    private $conn;

    public function __construct(){
        $host = new Host();
        $this->conn = new mysqli($host->server, $host->user, $host->password, $host->database);
        if ($this->conn->connect_error) {
            die("Conexão falhou: " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function fetchArray($result) {
        return $result->fetch_array();
    }

    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }

    public function close() {
        $this->conn->close();
    }


}

?>
