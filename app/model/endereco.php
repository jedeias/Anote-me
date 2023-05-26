<?php

class Endereco implements interfaceEndereco{

    private $cep; 
    private $numero;
    private $complemento;
    private $endereco;

    function __construct($cep, $numero, $complemento, $endereco){

        $this->setCep($cep);
        $this->setNumero($numero);
        $this->setComplemento($complemento);
        $this->setRua($endereco);
        
    }

    public function getCep() {
        return $this->cep;
    }

	public function setCep($cep): self {
		$this->cep = $cep;
		return $this;
	}

    public function getEndereco() {
        return $this->endereco;
    }

    public function setRua($endereco) {
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


?>