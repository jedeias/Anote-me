<?php

include ($_SERVER['DOCUMENT_ROOT'].'/tcc/app/controller/select_controller.php');
// Listas de todos os usuários
// Alterar a função validateUser

// require_once("connect.php");

class Select extends Connect implements selectController{

    public function selectPsicologos(){
        $sql = $this->getConn()->query("SELECT pk_psicologo, nome, email, RG, CPF, Sexo, data_nasc, imagem FROM psicologo");
        $data = $sql->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    public function selectPsicologo($id){
        $stmt = $this->getConn()->prepare("SELECT pk_psicologo, nome, email, RG, CPF, Sexo, quantidade_anotacoes, DATE_FORMAT(data_nasc, '%d/%m/%Y') as data_nasc, imagem FROM psicologo WHERE pk_psicologo = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function selectPacientes(){
        $sql = $this->getconn()->query("SELECT pk_paciente, nome, email, RG, CPF, Sexo, DATE_FORMAT(data_nasc, '%d/%m/%Y') as data_nasc, imagem FROM paciente");
        $data = $sql->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    public function selectPaciente($id){
        $stmt = $this->getConn()->prepare("SELECT pk_paciente, fk_psicologo, nome, email, RG, CPF, Sexo, DATE_FORMAT(data_nasc, '%d/%m/%Y') as data_nasc, imagem FROM paciente WHERE pk_paciente = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function selectNumAnotacoes($id){
        $stmt = $this->getConn()->prepare("SELECT COUNT(*) AS num_anotacoes FROM anotacoes_paciente WHERE fk_paciente = ? AND data >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)");
        $stmt = $this->getConn()->prepare("SELECT COUNT(*) AS num_anotacoes FROM anotacoes_paciente WHERE fk_paciente = ? AND DATE(data) = CURDATE()");

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function selectQuantidadeAnotacoesPsicologo($id){
        $stmt = $this->getConn()->prepare("SELECT quantidade_anotacoes FROM psicologo WHERE pk_psicologo = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function loginCheck($email, $password) 
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
    
    public function select_all_users()
    {

        $stmt = $this->getConn()->query("   SELECT nome, email, 'paciente' AS tipo_usuario, pk_paciente AS 'pk' FROM paciente
                                            UNION (SELECT nome, email, 'psicologo' AS tipo_usuario, pk_psicologo AS 'pk' FROM psicologo)
                                            UNION (SELECT nome, email, 'secretario' AS tipo_usuario, pk_secretario AS 'pk' FROM secretario) ");
        
        for ($set = array(); $row = $stmt->fetch_assoc(); $set[] = $row);
       
        return($set);

    }

    public function select_user_patient($psico_id)
    {
        
        $stmt = $this->getConn()->prepare("SELECT paciente.nome, paciente.email, paciente.pk_paciente, paciente.sexo, DATE_FORMAT(paciente.data_nasc, '%d/%m/%Y') as data_nasc
        FROM paciente WHERE paciente.fk_psicologo = ?"); 

        $stmt->bind_param("i", $psico_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC); 
        return $data;

    }
    public function select_notes($psico_id, $patient_email)
    {
        
        $stmt = $this->getConn()->prepare("SELECT paciente.nome, paciente.email, paciente.pk_paciente, anotacoes_paciente.pk_anotacoes_paciente, anotacoes_paciente.anotacao, anotacoes_paciente.emocao, anotacoes_paciente.intensidade, anotacoes_paciente.redflag, DATE_FORMAT(anotacoes_paciente.data, '%d/%m/%Y') as data, DATE_FORMAT(anotacoes_paciente.hora, '%H : %i') as hora
        FROM anotacoes_paciente INNER JOIN paciente ON (anotacoes_paciente.fk_paciente = paciente.pk_paciente) INNER JOIN psicologo ON (paciente.fk_psicologo = psicologo.pk_psicologo) WHERE psicologo.pk_psicologo = ? AND paciente.email = ?");
                                            
        $stmt->bind_param("is", $psico_id, $patient_email);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);                                   

        return $data;
    }
    public function select_psi_note($noteId){
        $stmt = $this->getConn()->prepare("SELECT comentario FROM anotacoes_psicologo WHERE fk_anotacoes_paciente = ?");
        $stmt->bind_param("i", $noteId);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    public function checkNotaPsicologo($noteId){
        $stmt = $this->getConn()->prepare("SELECT comentario FROM anotacoes_psicologo WHERE fk_anotacoes_paciente = ?");
        $stmt->bind_param("i", $noteId);
        $stmt->execute(); 
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if(count($data) == 0){
            return false;
        } else {
            return true;
        }

    }

    
    public function select_atividades($psico_id, $patient_id)
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

    public function getDadosPsicologoPaciente($id){
        $conn = $this->getConn();
        $stmt = mysqli_prepare($conn, "SELECT pk_paciente AS id, psicologo.nome as nome_psicologo FROM paciente                                        
                                        JOIN psicologo ON paciente.fk_psicologo = psicologo.pk_psicologo                
                                        WHERE paciente.pk_paciente = ?");
        if(!$stmt) {
            die("erro na preparação da consulta: " . mysqli_error($conn));
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $data;
        
    }
    public function getDadosResponsavel($id){
        $conn = $this->getConn();
        $stmt = mysqli_prepare($conn, "SELECT pk_paciente AS id, responsavel.nome, telefone.numero as numero_responsavel FROM paciente                                        
                                        JOIN responsavel ON paciente.fk_responsavel = responsavel.pk_responsavel
                                        LEFT JOIN telefone ON responsavel.fk_telefone = telefone.pk_telefone
                                        WHERE paciente.pk_paciente = ?");
        if(!$stmt)        {
            die("erro na preparação da consulta: " . mysqli_error($conn));
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $data;
    }
    
    public function getDados($id){
        $conn = $this->getConn();
        $stmt = mysqli_prepare($conn, "SELECT pk_psicologo AS id, nome, email, senha, telefone.numero FROM psicologo 
                                            JOIN telefone ON psicologo.fk_telefone = telefone.pk_telefone
                                            WHERE psicologo.pk_psicologo = ? 
                                        UNION ALL
                                        SELECT pk_paciente AS id, paciente.nome, paciente.email, paciente.senha, telefone.numero FROM paciente 
                                            JOIN telefone ON paciente.fk_telefone = telefone.pk_telefone
                                            WHERE paciente.pk_paciente = ?
                                        UNION ALL
                                        SELECT pk_secretario AS id, nome, email, senha, telefone.numero FROM secretario 
                                            JOIN telefone ON secretario.fk_telefone = telefone.pk_telefone
                                            WHERE secretario.pk_secretario = ?
                                        ");
        if (!$stmt) {
            die("Erro na preparação da consulta: " . mysqli_error($conn));
        }
    
        mysqli_stmt_bind_param($stmt, "iii", $id, $id, $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
        mysqli_stmt_close($stmt);
    
        return $data;
    }

    public function getImagem($id){
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

    public function getEventosPsicologo($id){
        $conn = $this->getConn();
        $stmt = mysqli_prepare($conn, "SELECT * FROM consulta WHERE fk_psicologo = ?");
        if (!$stmt) {
            die("Erro na preparação da consulta: " . mysqli_error($conn));
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $dados = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $retorna = json_encode($dados, JSON_UNESCAPED_UNICODE);
        return $retorna;   
    }

    public function getEventosPaciente($id){
        $conn = $this->getConn();
        $stmt = mysqli_prepare($conn, "SELECT * FROM consulta WHERE fk_paciente = ?");
        if (!$stmt) {
            die("Erro na preparação da consulta: " . mysqli_error($conn));
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $dados = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $retorna = json_encode($dados, JSON_UNESCAPED_UNICODE);
        return $retorna;   
    }

    public function notificacaoPaciente($id){
        $conn = $this->getConn();

        $stmt = mysqli_prepare($conn , "SELECT DATE_FORMAT(start, '%d/%m/%Y') AS data_formatada, horario, lida FROM consulta WHERE fk_paciente = ? ORDER BY id DESC LIMIT 1");
        if(!$stmt){
            die("Erro na preparação da consulta: " . mysqli_error($conn));
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $ultimaConsulta = mysqli_fetch_assoc($result);

        return $ultimaConsulta;
    }
    public function listarAgenda($id){
        $conn = $this->getConn();

        $stmt = mysqli_prepare($conn , "SELECT DATE_FORMAT(start, '%d/%m/%Y') AS data_formatada, horario, paciente FROM consulta WHERE fk_psicologo = ? ORDER BY id DESC LIMIT 5");
        if(!$stmt){
            die("Erro na preparação da consulta: " . mysqli_error($conn));
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $consultas = array();
        while ($consulta = mysqli_fetch_assoc($result)) {
            $consultas[] = $consulta;
        }

        return $consultas;
    }

    public function getEmail($email){
        $stmt = $this->getConn()->prepare(" SELECT paciente.email, 'paciente' AS tipo FROM paciente WHERE paciente.email = ?
                                            UNION ALL
                                            SELECT secretario.email, 'secretario' AS tipo  FROM secretario WHERE secretario.email = ?
                                            UNION ALL 
                                            SELECT psicologo.email, 'psicologo' AS tipo  FROM psicologo WHERE psicologo.email = ?
                                        ");

        mysqli_stmt_bind_param($stmt, "sss", $email, $email, $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

        mysqli_stmt_close($stmt);

        return $data;

    }
    
    public function __destruct()
    {
        $this->getConn()->close();
    }

}

?>
