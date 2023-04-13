<?php

    interface CrudController{

        public function insert_notas_paciente($id, $emocao, $fk_psicologo, $descricao);

        public function insert_atividades_paciente($fk_psicologo, $fk_paciente, $assunto, $atividade);

    }


?>