<?php

class Endereco implements Endereco{

    private $cep; 
    private $numero;
    private $complemento;
    private $endereco;

    #API de endereco

    // function __construct(string $cep)
    // {
    //     $cep = preg_replace("/[^0-9]/", "", $cep);
    //     $url = "https://viacep.com.br/ws/$cep/xml/";

    //     $xml = simplexml_load_file($url);

    //     $this->setRua($xml);
    // }

    function __construct($cep, $numero, $complemento, $endereco){

        $this->setCep($cep);
        $this->setNumero($numero);
        $this->setComplemento($complemento);
        $this->setRua($endereco);
        
    }

    private function getCep() {
        return $this->cep;
    }

	private function setCep($cep): self {
		$this->cep = $cep;
		return $this;
	}

    private function getEndereco() {
        return $this->endereco;
    }

    private function setRua($endereco) {
        $this->endereco = $endereco;
    }

    private function getNumero() {
        return $this->numero;
    }

    private function setNumero($numero) {
        $this->numero = $numero;
    }

    private function getComplemento() {
        return $this->complemento;
    }
    private function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    #interfac

    public function getEnderecoCep(){
        $this->getCep();
    }

	public function setEnderecoCep($cep){
        $this->setCep($cep);
    }

    public function getEnderecoRua(){
        $this->getRua();
    }

    public function setEnderecoRua($endereco){
        $this->setRua($endereco);
    }

    public function getEnderecoNumero(){
        $this->getNumero();
    }

    public function setEnderecoNumero($numero){
        $this->setNumero($numero);
    }

    public function getEnderecoComplemento(){
        $this->getComplemento();
    }

    public function setEnderecoComplemento($complemento){
        $this->setComplemento($complemento);
    }
}


?>