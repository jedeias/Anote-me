<?php

// extend Host
include ($_SERVER['DOCUMENT_ROOT'].'/tcc/app/config/host.php');

class Connect extends Host {
    private $conn;

    public function __construct(){
        
        $this->conn = new mysqli(   $this->getServer(), 
                                    $this->getUser(), 
                                    $this->getPassword(), 
                                    $this->getDatabase()
                                );
        
        if ($this->conn->connect_error) {
            die("Conexão falhou: " . $this->conn->connect_error);
        }
    }

    private function close() {
        $this->conn->close();
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function fetchArray($result) {
        return $result->fetch();
    }

    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }
    
    // public function bind_param($stmt, ...$params) {
    //     return $stmt->bind_param(...$params);
    // }
    
    public function execute($stmt) {
        return $stmt->execute();
    }
    
    public function __destruct() {
        $this->conn->close();
    }

    public function getConn() {
        return $this->conn;
    }
}

?>
