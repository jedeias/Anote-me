<?php
class HomeModel extends Query{
    public function __construct()
    {
        parent::__construct();
    }

    public function registrar($idPsicologo, $idPaciente, $psicologo, $paciente, $evento, $data, $horario, $color)
    {
        $sql = "INSERT INTO consulta (fk_psicologo, fk_paciente, psicologo, paciente, title, start, horario, color) VALUES (?,?,?,?,?,?,?,?)";
        $array = array($idPsicologo, $idPaciente, $psicologo, $paciente, $evento, $data, $horario, $color);
        $dados = $this->save($sql, $array);
        if($dados == 1){
            $msg = 1;
        }else{
            $msg = 0;
        }

        return $msg;
    }

    public function editar($evento, $data, $horario, $color, $id)
    {
        $sql = "UPDATE consulta SET title=?, start=?, horario=?, color=? WHERE id=?";
        $array = array($evento, $data, $horario, $color, $id);
        $dados = $this->save($sql, $array);
        if($dados == 1){
            $msg = 1;
        }else{
            $msg = 0;
        }
        return $msg;
    }
    public function apagarEvento($id)
    {
        $sql = "DELETE FROM consulta WHERE id=?";
        $array = array($id);
        $dados = $this->save($sql, $array);
        if($dados == 1){
            $msg = 1;
        }else{
            $msg = 0;
        }
        return $msg;
    }

    public function dropEvento($data, $id)
    {
        $sql = "UPDATE consulta SET start=? WHERE id=?";
        $array = array($data, $id);
        $dados = $this->save($sql, $array);
        if($dados == 1){
            $msg = 1;
        }else{
            $msg = 0;
        }
        return $msg;
    }

    public function listarEventos()
    {
        $sql = "SELECT consulta.psicologo, consulta.paciente, consulta.title, consulta.start, consulta.horario, consulta.color  FROM consulta";
        return  $this->selectAll($sql);

    }
}

?>