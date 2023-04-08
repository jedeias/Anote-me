<?php

// extend class Select


class Select_controller{

    private $select;

    public function __construct(){

        $this->select = new Select();

    }

    public function select_all_users()
    {
        $dados = $this->select->select_all_users();

        $pacientes = array();
        $psicologos = array();
        $secretarios = array();

        foreach ($dados as $dado) {
            switch ($dado['tipo_usuario']) {
                case 'paciente':
                    array_push($pacientes, $dado);
                    break;
                case 'psicologo':
                    array_push($psicologos, $dado);
                    break;
                case 'secretario':
                    array_push($secretarios, $dado);
                    break;
            }
        }  

        return $pacientes;
         //return $array = array("pacientes" => $pacientes, "psicologo" => $psicologos, "secretarios" => $secretarios);
    }

    public function select_notes_user($id)
    {
        return $result = $this->select->select_notes_user($id);
    }
}
?>