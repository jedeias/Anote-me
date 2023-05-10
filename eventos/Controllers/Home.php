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
       if(empty($_POST['title']) || empty($_POST['start']) || empty($_POST['color'])){
        $mensagem = array('msg' => 'Todos os campos precisam ser preenchidos', 'estado' => false, 'tipo' => 'warning');
       }else{
        $evento = $_POST['title'];
        $data = $_POST['start'];
        $color = $_POST['color'];
        $id = $_POST['id'];
        if($id == ''){
            $result = $this->model->registrar($evento, $data, $color);
            if($result == 1){
                $mensagem = array('msg' => 'Evento registrado com sucesso', 'estado' => true, 'tipo' => 'success');

            }else{
                $mensagem = array('msg' => 'Evento não registrado', 'estado' => false, 'tipo' => 'error');

            }
        }else{
            $result = $this->model->editar($evento, $data, $color, $id);
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
}
