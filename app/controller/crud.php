<?php

    interface CrudController extends Update, Delete, IncertePsicologo, IncertePaciente{

    }


    interface Update{

        public function atualizar_imagem($tabela, $imagem, $id);
        public function atualizar_perfil($tabela, $nome, $email, $senha, $id);

    }

    interface Delete{

    }

    interface IncertePaciente{

        public function insert_notas_paciente($id, $emocao, $emocaoGrau, $descricao);

    }

    interface IncertePsicologo{
        public function insert_atividades_paciente($fk_psicologo, $fk_paciente, $assunto, $atividade);

    }

    interface IncerteSecretario{

    }

?>

