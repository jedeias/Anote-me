<?php

class Select
{
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli('localhost', 'root', '', 'clinica_psicologica');

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    
    public function validateUser($email, $password)
    {
        $stmt = $this->conn->prepare("SELECT email, senha, tipo_usuario
                                      FROM (
                                          SELECT email, senha, 'psicologo' AS tipo_usuario FROM psicologo
                                          UNION ALL
                                          SELECT email, senha, 'paciente' AS tipo_usuario FROM paciente
                                          UNION ALL
                                          SELECT email, senha, 'secretario' AS tipo_usuario FROM secretario
                                      ) usuarios WHERE email=? and senha=?");
        
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        if ($user) {
            return array("success" => true, "user_type" => $user["tipo_usuario"]);
        } else {
            return array("success" => false, "error_message" => "Invalid email or password.");
        }
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}

$select = new Select();
$result = $select->validateUser('mariasilva@gmail.com', '12345678');

var_dump($result);

?>