<?php

class Crud extends Connect implements CrudController{

    public function insert_type_activites($assunto, $descricao)
    {
        $stmt = $this->prepare("INSERT INTO tipo_atividade (pk_tipo_atividade, finalidade, descricao) VALUES (default, '$assunto', '$descricao')"); 
        $stmt->execute();
   
    }

    public function insert_activitie(){
        
        $sql = $this->prepare("SELECT max(pk_tipo_atividade) as last_id FROM tipo_atividade");
        
        if ($sql->execute()) {

            $result = $sql->get_result()->fetch_assoc();
            $last_id = $result['last_id'];

            if (isset($result) == 1) 
            {
                $stmt = $this->prepare("INSERT INTO atividade (pk_atividade, fk_tipo_atividade) VALUES (default,'$last_id')");
                if ($stmt !== false) 
                {
                    $stmt->execute();
                } else {
                    echo "stmt false.";
                }
            } else {
                echo "not existe last id";
            }
        } else {
            echo "not execute first if";
        }
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

    
    
}

?>