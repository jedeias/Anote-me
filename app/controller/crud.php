<?php

    interface CrudController{

        public function insert_notas_paciente($id, $emocao, $fk_psicologo, $descricao);
        public function insert_atividades_paciente($fk_psicologo, $fk_paciente, $assunto, $atividade);
        public function atualizar_perfil_psicologo($nome, $email, $senha, $id);
        public function atualizar_perfil_paciente($nome, $email, $senha, $id);
        public function atualizar_perfil_secretario($nome, $email, $senha, $id);
        public function atualizar_imagem_psicologo($id, $imagem);
        
    }


    interface Update{

    }

    interface Delete{

    }

    interface IncertePaciente{

    }

    interface IncertePsicologo{

    }

    interface IncerteSecretario{

    }

?>

