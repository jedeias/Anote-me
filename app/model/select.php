<?php

include ($_SERVER['DOCUMENT_ROOT'].'/tcc/app/controller/select_controller.php');
// Listas de todos os usuários
// Alterar a função validateUser

require_once("connect.php");


class Select extends Connect implements selectController{

    #interface start

    public function select_user_patient($psico_id)
    {
        return $pacientes = $this->select_users_patient($psico_id);
    }
    public function select_notes($psico_id, $patient_email)
    {
        return $result = $this->patient_notes($psico_id, $patient_email);
    }

    public function select_atividades($psico_id, $patient_id){
        return $result = $this->select_activities($psico_id, $patient_id);
    }

    public function getDados($id){
        return $result = $this->todosDados($id);
    }
    public function getImagem($id){
        return $result = $this->imagemPerfil($id);
    }

    public function getAllUser(){
        return $result = $this->select_all_users();
    }

    public function loginCheck($email, $password){
        return $result = $this->validateUser($email, $password);
    }

    #interface end

    private function validateUser($email, $password) 
    {

        $sql = $this->getConn()->query("SELECT nome, email, senha, tipo_usuario, pk, fk
        FROM (
            SELECT email, senha, 'psicologo' AS tipo_usuario, pk_psicologo AS 'pk', fk_telefone AS 'fk', nome FROM psicologo
            UNION ALL
            SELECT email, senha, 'paciente' AS tipo_usuario, pk_paciente AS 'pk', fk_psicologo AS 'fk', nome FROM paciente
            UNION ALL
            SELECT email, senha, 'secretario' AS tipo_usuario, pk_secretario AS 'pk', fk_telefone AS 'fk', nome FROM secretario
        ) usuarios WHERE email='$email' and senha='$password'");

        if($sql) {
            $user = $sql->fetch_assoc();

            return array("success" => true, "user_type" => $user["tipo_usuario"], "nome" => $user["nome"], "id" => $user["pk"], "fk_psicologo" => $user["fk"]);
        } else {
            return array("success" => false, "error_message" => "Invalid email or password.");
        }

    }
    
    private function select_all_users()
    {

        $stmt = $this->getConn()->query("   SELECT nome, email, 'paciente' AS tipo_usuario, pk_paciente AS 'pk' FROM paciente
                                            UNION (SELECT nome, email, 'psicologo' AS tipo_usuario, pk_psicologo AS 'pk' FROM psicologo)
                                            UNION (SELECT nome, email, 'secretario' AS tipo_usuario, pk_secretario AS 'pk' FROM secretario) ");
        
        for ($set = array(); $row = $stmt->fetch_assoc(); $set[] = $row);
       
        return($set);

    }

    private function select_users_patient($psico_id)
    {
        
        $stmt = $this->getConn()->prepare("SELECT paciente.nome, paciente.email, paciente.pk_paciente
        FROM paciente WHERE paciente.fk_psicologo = ?"); 

        $stmt->bind_param("i", $psico_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
    
        echo "<pre>";
        return $data;

    }
    private function patient_notes($psico_id, $patient_email)
    {
        
        $stmt = $this->getConn()->prepare("SELECT paciente.nome, paciente.email, paciente.pk_paciente, anotacoes_paciente.pk_anotacoes_paciente, anotacoes_paciente.anotacao, anotacoes_paciente.emocao, anotacoes_paciente.intensidade, DATE_FORMAT(anotacoes_paciente.data, '%d/%m/%y') as data, DATE_FORMAT(anotacoes_paciente.hora, '%H:%i') as hora
        FROM anotacoes_paciente INNER JOIN paciente ON (anotacoes_paciente.fk_paciente = paciente.pk_paciente) INNER JOIN psicologo ON (paciente.fk_psicologo = psicologo.pk_psicologo) WHERE psicologo.pk_psicologo = ? AND paciente.email = ?");
                                            
        $stmt->bind_param("is", $psico_id, $patient_email);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);                                   

        return $data;
    }
    private function select_activities($psico_id, $patient_id)
    {
        $stmt = $this->getconn()->prepare(" SELECT atividades_paciente.assunto_atividade, atividades_paciente.atividade, DATE_FORMAT(atividades_paciente.data, '%d/%m/%y') as data, atividades_paciente.pk_atividades_paciente
                                            FROM atividades_paciente
                                            WHERE fk_psicologo = ? AND fk_paciente = ?");
                            
                            
        $stmt->bind_param("ii", $psico_id, $patient_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);


        return $data;
    }
    
    private function todosDados($id){
        $conn = $this->getConn();
        $stmt = mysqli_prepare($conn, "SELECT pk_psicologo AS id, nome, email, senha FROM psicologo WHERE pk_psicologo = ? 
                                        UNION ALL
                                        SELECT pk_paciente AS id, nome, email, senha  FROM paciente WHERE pk_paciente = ?
                                        UNION ALL
                                        SELECT pk_secretario AS id, nome, email, senha FROM secretario WHERE pk_secretario = ?
                                        ");
    
        mysqli_stmt_bind_param($stmt, "iii", $id, $id, $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
        mysqli_stmt_close($stmt);
    
        return $data;
    }

    //tudo certo 
    private function imagemPerfil($id){
        $conn = $this->getConn();
        $stmt = mysqli_prepare($conn, "SELECT pk_psicologo AS id, imagem FROM psicologo WHERE pk_psicologo = ? 
                                    UNION ALL
                                    SELECT pk_paciente AS id, imagem  FROM paciente WHERE pk_paciente = ?
                                    UNION ALL
                                    SELECT pk_secretario AS id, imagem FROM secretario WHERE pk_secretario = ?
                                    ");
        if (!$stmt) {
            die("Erro na preparação da consulta: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt, "iii", $id, $id, $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            die("Erro na execução da consulta: " . mysqli_error($conn));
        }

        $imagem = mysqli_fetch_array($result);
        mysqli_stmt_close($stmt);

        return $imagem;  
    }
    
    public function __destruct()
    {
        $this->getConn()->close();
    }

}

?>
