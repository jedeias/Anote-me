<?php
class Home extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->views->getView($this, 'index');
    }
    public function registrar()
    {
       if(empty($_POST['psicologo']) ||empty($_POST['paciente']) || empty($_POST['title']) || empty($_POST['start']) || empty($_POST['horario']) || empty($_POST['color'])){
        $mensagem = array('msg' => 'Todos os campos precisam ser preenchidos', 'estado' => false, 'tipo' => 'warning');
       }else{
        $idPsicologo = $_POST['idPsicologo'];
        $idPaciente = $_POST['idPaciente'];
        $psicologo = $_POST['psicologo'];
        $paciente = $_POST['paciente'];
        $evento = $_POST['title'];
        $data = $_POST['start'];
        $horario = $_POST['horario'];
        $color = $_POST['color'];
        $id = $_POST['id'];
        if($id == ''){
            $result = $this->model->registrar($idPsicologo, $idPaciente, $psicologo, $paciente, $evento, $data, $horario, $color);
            if($result == 1){
                $mensagem = array('msg' => 'Evento registrado com sucesso', 'estado' => true, 'tipo' => 'success');

            }else{
                $mensagem = array('msg' => 'Evento não registrado', 'estado' => false, 'tipo' => 'error');
            }
        }else{
            $result = $this->model->editar($evento, $data, $horario, $color, $id);
            if($result == 1){
                $mensagem = array('msg' => 'Evento editado com sucesso', 'estado' => true, 'tipo' => 'success');

            }else{
                $mensagem = array('msg' => 'Evento não editado', 'estado' => false, 'tipo' => 'error');

            }
        }
        echo json_encode($mensagem);
        die();
       }
    }

    public function listar()
    {
        $dados = $this->model->listarEventos();
        echo json_encode($dados, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function apagar($id)
    {
        $dados = $this->model->apagarEvento($id);
        if($dados == 1){
            $mensagem = array('msg' => 'Evento Apagado', 'estado' => true, 'tipo' => 'success');

        }else{
            $mensagem = array('msg' => 'Evento não pode ser apagado', 'estado' => false, 'tipo' => 'error');

        }
        echo json_encode($mensagem, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function drop()
    {
        $data = $_POST['start'];
        $id = $_POST['id'];
        $dados = $this->model->dropEvento($data, $id);
        if($dados == 1){
            $mensagem = array('msg' => 'Evento Modificado', 'estado' => true, 'tipo' => 'success');

        }else{
            $mensagem = array('msg' => 'Erro ao modificar', 'estado' => false, 'tipo' => 'error');

        }
        echo json_encode($mensagem, JSON_UNESCAPED_UNICODE);
        die();
    }
}
