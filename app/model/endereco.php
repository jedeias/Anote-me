<?php

class Endereco{

    public $cep; 
    public $numero;
    public $complemento;
    public $endereco;

    function __construct(string $cep)
    {
        $cep = preg_replace("/[^0-9]/", "", $cep);
        $url = "https://viacep.com.br/ws/$cep/xml/";

        $xml = simplexml_load_file($url);

        $this->endereco = $xml;
    }

    public function getCep() {
        return $this->cep;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getComplemento() {
        return $this->complemento;
    }

    public function setComplemento($complemento) {
        $this->complemento = $complemento;
    }
}

// $endereco = new Endereco('05870020');

// echo "<pre>";
// var_dump ($endereco->getEndereco());

?>