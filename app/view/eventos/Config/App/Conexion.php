<?php
class Conexion{
    private $conect;
    public function __construct()
    {
        $pdo = "mysql:host=".host.";dbname=".db.";charset=utf8";
        try {
            $this->conect = new PDO($pdo, user, pass);
            $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conect->exec("SET NAMES 'utf8'");
        } catch (PDOException $e) {
            echo "Error en la conexion".$e->getMessage();
        }
    }
    public function conect()
    {
        return $this->conect;
    }
}

?>