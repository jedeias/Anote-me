<?php

class Crud extends Connect implements CrudController{

    public function insert_atividades_paciente($fk_paciente, $fk_psicologo, $assunto, $atividade){
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

            $this->query($sql);
    }

    public function insert_notas_paciente($id, $emocao, $fk_psicologo, $descricao) {

        $sql = "INSERT INTO anotacoes_paciente (
            pk_anotacoes_paciente,
            fk_redflag,
            fk_emocoes,
            fk_psicologo,
            fk_paciente,
            fk_anotacoes_psicologo,
            anotacoes,
            data_hora
        ) 
        VALUES (
            null,
            null,
            '$emocao',
            '$fk_psicologo',
            '$id',
            null,
            '$descricao',
            NOW()
        )";
    
        $this->query($sql);
    }

    public function delete_atividades_paciente($pk_ativdades_paciente){

        $sql = "DELETE FROM atividades_paciente WHERE atividades_paciente.pk_atividades_paciente = '$pk_ativdades_paciente'";

        $this->query($sql);
    }
    
}

?>