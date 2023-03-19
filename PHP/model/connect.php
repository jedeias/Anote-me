<?php

class Connect{

    public $conn;

    public function __construct(string $servidor, string $user_name, string $password, string $db_name){

        $this->conn = mysqli_connect($servidor, $user_name, $password, $db_name);

        if( !$this-> conn){
            die("Conexão falhou: " . mysqli_connect_error());
        };

    }

}

    
?>