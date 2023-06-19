<?php

// extend class Select

interface selectController {

    public function getDadosResponsavel($id);

    public function selectPsicologos();

    public function selectPsicologo($id);

    public function selectPacientes();

    public function selectPaciente($id);

    public function selectNumAnotacoes($id);

    public function selectQuantidadeAnotacoesPsicologo($id);

    public function loginCheck($email, $password); 

    public function select_all_users();
    
    public function select_user_patient($psico_id);

    public function select_notes($psico_id, $patient_email);
    
    public function select_atividades($psico_id, $patient_id);
    
    public function getDadosPsicologoPaciente($id);
    
    public function getDados($id);

    public function getImagem($id);

    public function getEventosPsicologo($id);

    public function getEventosPaciente($id);

    public function notificacaoPaciente($id);
    public function listarAgenda($id);

}

?>