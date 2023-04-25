<?php

// extend class Select

interface selectController extends selectGeneric, selectSecretario, selectPsicologo, selectPaciente{

}

interface selectPaciente{
    
}

interface selectPsicologo{

    public function select_user_patient($psico_id);

    public function select_notes($psico_id, $patient_email);

}

interface selectSecretario{

    
    
}

interface selectGeneric{

    public function loginCheck($email, $password);

    public function getAllUser();

    public function getDados($id);

    public function getImagem($id);

}

?>