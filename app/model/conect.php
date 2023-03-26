<?php

require_once("../config/host.php");

class Connect{

    public function __construct(){

        $host = new Host();

        $this->conn = mysqli_connect($host->server, $host->user, $host->password, $host->database);

        if( !$this-> conn){
            die("Conexão falhou: " . mysqli_connect_error());
        };

    }

    public function query($sql) {
        return mysqli_query($this->conn, $sql);
    }

    public function fetchArray($result) {
        return mysqli_fetch_array($result);
    }

}

$conn = new Connect();


?>