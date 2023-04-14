<?php

    interface CrudController{

        public function insert_notas_paciente($id, $emocao,$fk_psicologo, $descricao);

        public function insert_atividades_paciente($fk_psicologo, $fk_paciente, $assunto, $atividade);

        public function delete_atividades_paciente($pk_ativdades_paciente);
        
        public function atualizar_perfil_psicologo($nome, $email, $senha, $id);
        public function atualizar_perfil_paciente($nome, $email, $senha, $id);
        public function atualizar_perfil_secretario($nome, $email, $senha, $id);
    }


?>