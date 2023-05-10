<?php
class Telefone implements Telefone{
    
    private $ddd;
    private $numero;

    public function __construct(string $ddd, string $numero) {
        $this->setDdd($ddd);
        $this->setNumero($numero);
    }

    private function getDdd() {
        return $this->ddd;
    }

    private function setDdd($ddd) {
        if (preg_match("/^\d{2}$/", $ddd)) {
            $this->ddd = $ddd;
        } else {
            throw new Exception("DDD inválido");
        }
    }

    private function getNumero() {
        return $this->numero;
    }

    private function setNumero($numero) {
        if (preg_match("/^\d{8,9}$/", $numero)) {
            $this->numero = $numero;
        } else {
            throw new Exception("Número de telefone inválido");
        }
    }

    #interface

    public function setTelefoneDdd($ddd){
        $this->setDdd($ddd);
    }

    public function setTelefoneNumero($numero){
        $this->setNumero($numero);
    }

    public function GetTelefoneDdd(){
        $this->getDdd();
    }

    public function getTelefoneNumero(){
        $this->getNumero();
    }

}

?>