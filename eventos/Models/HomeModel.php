<?php
class HomeModel extends Query{
    public function __construct()
    {
        parent::__construct();
    }
    public function registrar($evento, $data, $color)
    {
        $sql = "INSERT INTO eventos (title, start, color) VALUES (?,?,?)";
        $array = array($evento, $data, $color);
        $dados = $this->save($sql, $array);
        if($dados == 1){
            $msg = 1;
        }else{
            $msg = 0;
        }

        return $msg;
    }

    public function editar($evento, $data, $color, $id)
    {
        $sql = "UPDATE eventos SET title=?, start=?, color=? WHERE id=?";
        $array = array($evento, $data, $color, $id);
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
        $sql = "SELECT * FROM eventos";
        return  $this->selectAll($sql);

    }
}

?>