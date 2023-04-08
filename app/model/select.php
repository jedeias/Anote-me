<?php

// Listas de todos os usuários
// Alterar a função validateUser


require_once("connect.php");

class Select extends Connect{
    
    public function validateUser($email, $password) {
        $stmt = $this->getConn()->prepare("SELECT email, senha, tipo_usuario
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
    public function select_all_users(){

        $stmt = $this->getConn()->query("SELECT nome, email, 'paciente' AS tipo_usuario FROM paciente
                                     UNION (SELECT nome, email, 'psicologo' AS tipo_usuario FROM psicologo)
                                     UNION (SELECT nome, email, 'secretario' AS tipo_usuario FROM secretario)");

        echo "<pre>";
        
        for ($set = array (); $row = $stmt->fetch_assoc(); $set[] = $row);
       
        return($set);

    }

    //função para buscar dados do usuario, no momento somente nome e email
    public function userData($email, $password){
        $stmt = $this->getConn()->prepare(" SELECT email, senha, nome, pk tipo_usuario
                                            FROM (
                                            SELECT email, senha, nome,  'psicologo' AS tipo_usuario, pk_psicologo  FROM psicologo
                                            UNION ALL
                                            SELECT email, senha, nome, 'paciente' AS tipo_usuario FROM paciente
                                            UNION ALL
                                            SELECT email, senha, nome, 'secretario' AS tipo_usuario FROM secretario
                                            ) usuarios WHERE email=? and senha=?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        return $user['nome'];
        
    }

    public function select_notes_user($id)
    {
        
        $stmt = $this->getConn()->prepare(" SELECT anotacoes_paciente.anotacoes, anotacoes_paciente.data_hora
                                            FROM anotacoes_paciente
                                            INNER JOIN psicologo on (anotacoes_paciente.fk_psicologo = psicologo.pk_psicologo)
                                            WHERE pk_psicologo = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $userId = $result->fetch_assoc();

        return $userId['pk_psicologo'];
    }

    public function __destruct()
    {
        $this->getConn()->close();
    }

}

?>
