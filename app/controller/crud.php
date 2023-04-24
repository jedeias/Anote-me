<?php

    interface CrudController{

        public function insert_notas_paciente($id, $emocao, $emocaoGrau, $descricao);
        public function insert_atividades_paciente($fk_psicologo, $fk_paciente, $assunto, $atividade);
        public function atualizar_imagem($tabela, $imagem, $id);
        public function atualizar_perfil($tabela, $nome, $email, $senha, $id);
    
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

