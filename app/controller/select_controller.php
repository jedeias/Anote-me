<?php
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

        return $dados;

        // foreach ($dados as $dado) {
        //     switch ($dado['tipo_usuario']) {
        //         case 'paciente':
        //             array_push($pacientes, $dado);
        //             break;
        //         case 'psicologo':
        //             array_push($psicologos, $dado);
        //             break;
        //         case 'secretario':
        //             array_push($secretarios, $dado);
        //             break;
        //     }
        //}  
    }
}
?>