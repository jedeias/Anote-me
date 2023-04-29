<?php

class Crud extends Connect implements CrudController{

    private function queryIsertAtiviadesPaciente($fk_paciente, $fk_psicologo, $assunto, $atividade){
        $sql = "INSERT INTO atividades_paciente(
            pk_atividades_paciente,
            fk_paciente,
            fk_psicologo,
            assunto_atividade,
            atividade,
            data)
            VALUES (
            DEFAULT,
            $fk_paciente,
            $fk_psicologo,
            '$assunto',
            '$atividade',
            CURDATE()
            )";

        return $sql;
    }

    public function insert_atividades_paciente($fk_paciente, $fk_psicologo, $assunto, $atividade){
            $this->getConn()->query($this->queryIsertAtiviadesPaciente($fk_paciente, $fk_psicologo, $assunto, $atividade));
    }

    public function insert_notas_paciente($id, $idPsicologo, $emocao, $emocaoGrau, $descricao) {

        $sql = "INSERT INTO anotacoes_paciente (
            pk_anotacoes_paciente,
            fk_redflag,
            fk_paciente,
            fk_psicologo,
            anotacao,
            emocao,
            intensidade,
            data,
            hora
        ) 
        VALUES (
            null,
            '11',
            $id,
            '$idPsicologo',
            '$descricao',
            '$emocao',
            '$emocaoGrau',
            CURDATE(),
            DATE_FORMAT(NOW(), '%k:%i')
        )";
    
        $this->query($sql);
    }

    public function delete_atividades_paciente($pk_ativdades_paciente){

        $sql = "DELETE FROM atividades_paciente WHERE atividades_paciente.pk_atividades_paciente = '$pk_ativdades_paciente'";

        $this->query($sql);
    }

    public function delete_anotacao_paciente($pk_anotacoes_paciente){
        $sql = "DELETE FROM anotacoes_paciente WHERE anotacoes_paciente.pk_anotacoes_paciente = '$pk_anotacoes_paciente'";

        $this->query($sql);
    }

    // atualizar a imagem do perfil do usuario de acordo com a tabela
    public function atualizar_imagem($tabela, $imagem, $id){

        $stmt = $this->getConn()->prepare("SELECT * FROM $tabela WHERE $tabela.pk_$tabela = ?");
        if (!$stmt) {

            die("Erro na consulta: " . $this->getConn()->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {

            return false;
        }
    

        // executar a consulta UPDATE na tabela especificada
        $stmt = $this->getConn()->prepare("UPDATE $tabela SET imagem = ? WHERE $tabela.pk_$tabela = ?");
        if (!$stmt) {
            // Se a preparação da consulta falhar, mostre o erro do MySQLi
            die("Erro na consulta: " . $this->getConn()->error);
        }
        $stmt->bind_param("si",$imagem, $id);
        $stmt->execute();
    
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }  
    }

    // // função para atualizar o perfil dos usuarios de acordo com a tabela
    // public function atualizar_perfil($tabela, $nome, $telefone, $senha, $id){
    //     $stmt = $this->getConn()->prepare("UPDATE $tabela, telefon SET nome = ?, tabela.email = ?, senha = ? WHERE $tabela.pk_$tabela = ? AND $tabela.fk_telefone = telefone.pk_telefone");
    //     if (!$stmt) {
    //         die("Erro na consulta: " . $this->getConn()->error);
    //     }
    //     $stmt->bind_param("sssi",$nome, $email, $senha, $id);
    //     $stmt->execute();
    
    //     if ($stmt->affected_rows > 0) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public function atualizar_perfil($tabela, $nome, $email, $senha, $id){
        $stmt = $this->getConn()->prepare("UPDATE $tabela SET nome = ?, email = ?, senha = ? WHERE pk_$tabela = ?");
        if (!$stmt) {
            die("Erro na consulta: " . $this->getConn()->error);
        }
        $stmt->bind_param("sssi", $nome, $email, $senha, $id);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

}

?>