<?php
class Telefone {
    
    private $ddd;
    private $numero;

    public function __construct(string $ddd, string $numero) {
        $this->setDdd($ddd);
        $this->setNumero($numero);
    }

    public function getDdd() {
        return $this->ddd;
    }

    public function setDdd($ddd) {
        if (preg_match("/^\d{2}$/", $ddd)) {
            $this->ddd = $ddd;
        } else {
            throw new Exception("DDD inválido");
        }
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        if (preg_match("/^\d{8,9}$/", $numero)) {
            $this->numero = $numero;
        } else {
            throw new Exception("Número de telefone inválido");
        }
    }

}

// $telefone = new Telefone("11","987654321");

// echo($telefone->getDdd() ." ". $telefone->getNumero());

?>