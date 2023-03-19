<?php

// class Connect{

//     public $conn;

//     public function __construct(string $servidor, string $user_name, string $password, string $db_name){

//         $this->conn = mysqli_connect($servidor, $user_name, $password, $db_name);

//         if( !$this-> conn){
//             die("Conexão falhou: " . mysqli_connect_error());
//         };

//     }

// }

    
// $conn = new Connect("localhost","root", "","clinica_psicologica");

// $dados= $conn->query("SELECT * FROM psicologo");

// while ($linha = mysqli_fetch_array($dados)){
//     $pk_psicologo = $linha['pk_psicologo'];
//     $nome = $linha['nome'];
//     $email = $linha['email'];
//     $senha = $linha['senha'];

//     echo("
//         <br>$pk_psicologo<br>
//         <br>$nome<br>
//         <br>$email<br>
//         <br>$senha<br>
//     ");
// }


class Connect{

    public $conn;

    public function __construct(string $servidor, string $user_name, string $password, string $db_name){

        $this->conn = mysqli_connect($servidor, $user_name, $password, $db_name);

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

    
// $conn = new Connect("localhost","root", "","clinica_psicologica");

// $psicologos = $conn->query("SELECT * FROM psicologo");

// while ($psicologo = $conn->fetchArray($psicologos)){
//     echo("
//         <br>{$psicologo['pk_psicologo']}<br>
//         <br>{$psicologo['nome']}<br>
//         <br>{$psicologo['email']}<br>
//         <br>{$psicologo['senha']}<br>
//     ");
// }

?>