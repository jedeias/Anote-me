<?php

class Crud
{
    private $conn;

    public function __construct()
    {
        $this->conn = new Connect();
    }

    public function insert_activities()
    {
        $stmt = $this->conn->prepare("INSERT INTO atividade (pk_atividade) VALUES (NULL)");
        $stmt->execute();
    }

    public function insert_type_activites($assunto, $descricao)
    {
        $atividade = new Insert();
        $atividade->insert_activities();
        
        $stmt = $this->conn->prepare("INSERT INTO tipo_atividade (pk_tipo_atividade, fk_atividade, finalidade, descricao) VALUES (default, '$atividade', '$assunto', '$descricao')"); 
 
        $stmt->execute();
    }
}

?>