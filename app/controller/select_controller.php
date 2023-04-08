<?php

// extend class Select


class Select_controller extends Select{

    private $select;

    // public function selectUsers()
    // {
    //     $dados = $this->select_all_users();

    //     $pacientes = array();
    //     $psicologos = array();
    //     $secretarios = array();

    //     foreach ($dados as $dado) {
    //         switch ($dado['tipo_usuario']) {
    //             case 'paciente':
    //                 array_push($pacientes, $dado);
    //                 break;
    //             case 'psicologo':
    //                 array_push($psicologos, $dado);
    //                 break;
    //             case 'secretario':
    //                 array_push($secretarios, $dado);
    //                 break;
    //         }
    //     }  
    //      //return $array = array("pacientes" => $pacientes, "psicologo" => $psicologos, "secretarios" => $secretarios);
    // }

    public function select_user_patient($psico_id)
    {
        return $pacientes = $this->select_users_patient($psico_id);
    }
    public function select_notes($psico_id, $patient_email)
    {
        return $result = $this->patient_notes($psico_id);
    }
}
?>