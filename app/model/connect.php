<?php
// extend Host
require_once("./config/host.php");

class Connect extends Host {
    private $conn;

    public function __construct(){
        $this->conn = new mysqli(   $this->getServer(), 
                                    $this->getUser(), 
                                    $this->getPassword(), 
                                    $this->getDatabase());

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

    public function __destruct() {
        $this->conn->close();
    }


}

?>
