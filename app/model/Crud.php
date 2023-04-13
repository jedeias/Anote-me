<?php

class Crud extends Connect implements CrudController{

    private function queryIsertAtiviadesPaciente($fk_paciente, $fk_psicologo, $assunto, $atividade){
        $sql = "INSERT INTO atividades_paciente(
            fk_paciente,
            fk_psicologo,
            assunto_atividade,
            atividade,
            data)
            VALUES (
            $fk_paciente,
            $fk_psicologo,
            '$assunto',
            '$atividade',
            CURDATE()
            )";
    }

    public function insert_atividades_paciente($fk_paciente, $fk_psicologo, $assunto, $atividade){
            $this->query($this->queryIsertAtiviadesPaciente($fk_paciente, $fk_psicologo, $assunto, $atividade));
    }

    public function insert_notas_paciente($id, $emocao, $descricao) {

        $sql = "INSERT INTO anotacoes_paciente (
            pk_anotacoes_paciente,
            fk_redflag,
            fk_emocoes,
            fk_paciente,
            fk_anotacoes_psicologo,
            anotacoes,
            data_hora
        ) 
        VALUES (
            null,
            null,
            '$emocao',
            '$id',
            null,
            '$descricao',
            NOW()
        )";
    
        $this->query($sql);
    }
   
    //função para atualizar o perfil psicologo
    public function atualizar_perfil_psicologo($nome,$email,$senha,$id){
        $stmt = $this->getConn()->prepare("UPDATE psicologo SET nome = ?, email = ?, senha = ? WHERE pk_psicologo = ?");
        if (!$stmt) {
            // Se a preparação da consulta falhar, mostre o erro do MySQLi
            die("Erro na consulta: " . $this->getConn()->error);
        }
        $stmt->bind_param("sssi",$nome, $email, $senha, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    //função para atualizar o perfil paciente
    public function atualizar_perfil_paciente($id, $nome, $email, $senha){
        $stmt = $this->getConn()->prepare("UPDATE paciente SET nome = ?, email = ?, senha = ? WHERE id = ?");
        $stmt->bind_param("isss", $id, $nome, $email, $senha);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    //função para atualizar o perfil secretario
    public function atualizar_perfil_secretario($id, $nome, $email, $senha){
        $stmt = $this->getConn()->prepare("UPDATE psicologo SET nome = ?, email = ?, senha = ? WHERE id = ?");
        $stmt->bind_param("isss", $id, $nome, $email, $senha);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    
}

?>