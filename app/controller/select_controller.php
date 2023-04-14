<?php

// extend class Select

interface selectController {

    public function select_user_patient($psico_id);

    public function select_notes($psico_id, $patient_email);
    
    public function getDados($id);

    public function getAllUser();

    public function loginCheck($email, $password);
}
?>