<?php

// Listas de todos os usuários
// Alterar a função validateUser


require_once("connect.php");

class Select extends Connect{
    
    public function validateUser($email, $password) 
    {
        $stmt = $this->getConn()->prepare("SELECT nome, email, senha, tipo_usuario, pk
                                      FROM (
                                          SELECT email, senha, 'psicologo' AS tipo_usuario, pk_psicologo AS 'pk', nome FROM psicologo
                                          UNION ALL
                                          SELECT email, senha, 'paciente' AS tipo_usuario, pk_paciente AS 'pk', nome FROM paciente
                                          UNION ALL
                                          SELECT email, senha, 'secretario' AS tipo_usuario, pk_secretario AS 'pk', nome FROM secretario
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
    public function select_all_users()
    {

        $stmt = $this->getConn()->query("   SELECT nome, email, 'paciente' AS tipo_usuario, pk_paciente AS 'pk' FROM paciente
                                            UNION (SELECT nome, email, 'psicologo' AS tipo_usuario, pk_psicologo AS 'pk' FROM psicologo)
                                            UNION (SELECT nome, email, 'secretario' AS tipo_usuario, pk_secretario AS 'pk' FROM secretario) ");
        
        for ($set = array(); $row = $stmt->fetch_assoc(); $set[] = $row);
       
        return($set);

    }

    //função para buscar dados do usuario, no momento somente nome e email
    // public function userData($email, $password){
    //     $stmt = $this->getConn()->prepare(" SELECT email, senha, nome, pk tipo_usuario
    //                                         FROM (
    //                                         SELECT email, senha, nome,  'psicologo' AS tipo_usuario, pk_psicologo  FROM psicologo
    //                                         UNION ALL
    //                                         SELECT email, senha, nome, 'paciente' AS tipo_usuario FROM paciente
    //                                         UNION ALL
    //                                         SELECT email, senha, nome, 'secretario' AS tipo_usuario FROM secretario
    //                                         ) usuarios WHERE email=? and senha=?");
    //     $stmt->bind_param("ss", $email, $password);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $user = $result->fetch_assoc();
    // //     return $user['nome'];
        
    //  }

    public function select_users_patient($psico_id)
    {
        
        $stmt = $this->getConn()->prepare(" SELECT paciente.nome, paciente.email, paciente.pk_paciente
                                            FROM paciente
                                            INNER JOIN anotacoes_paciente ON (anotacoes_paciente.fk_paciente = paciente.pk_paciente)
                                            INNER JOIN psicologo ON (psicologo.pk_psicologo = anotacoes_paciente.fk_psicologo)
                                            WHERE psicologo.pk_psicologo = ?"); 

        $stmt->bind_param("i", $psico_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
    
        echo "<pre>";

        //print_r($data);
        return $data;

    }
    public function patient_notes($psico_id, $patient_email)
    {
        
        $stmt = $this->getConn()->prepare(" SELECT paciente.nome, paciente.email, paciente.pk_paciente,
                                            anotacoes_paciente.pk_anotacoes_paciente, anotacoes_paciente.anotacoes, anotacoes_paciente.data_hora,
                                            emocoes.descricao, emocoes.emoji, emocoes.intensidade
                                            FROM paciente
                                            INNER JOIN anotacoes_paciente on (anotacoes_paciente.fk_paciente = paciente.pk_paciente)
                                            INNER JOIN emocoes ON (emocoes.pk_emocoes = anotacoes_paciente.fk_emocoes)
                                            INNER JOIN psicologo on (psicologo.pk_psicologo = anotacoes_paciente.fk_psicologo)
                                            WHERE psicologo.pk_psicologo = ? AND paciente.email = ?");
                                            
        $stmt->bind_param("is", $psico_id, $patient_email);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);                                   

        return $data;
    }
    
    public function __destruct()
    {
        $this->getConn()->close();
    }

}


?>
