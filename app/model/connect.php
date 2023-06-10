<?php

require_once ($_SERVER['DOCUMENT_ROOT']."/tcc/app/config/host.php");

abstract class Connect extends Host {
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
        // Definir o conjunto de caracteres para utf8
        $this->conn->set_charset("utf8");
    }

    private function close() {
        $this->conn->close();
    }

    protected function query($sql) {
        return $this->conn->query($sql);
    }

    protected function fetchArray($result) {
        return $result->fetch();
    }

    protected function prepare($sql) {
        return $this->conn->prepare($sql);
    }
    
    protected function execute($stmt) {
        return $stmt->execute();
    }

    protected function getConn() {
        return $this->conn;
    }
    
    public function __destruct() {
        $this->conn->close();
    }

}

?>