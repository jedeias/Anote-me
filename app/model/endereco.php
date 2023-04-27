<?php

class Endereco{

    private $cep; 
    private $numero;
    private $complemento;
    private $endereco;

    function __construct(string $cep)
    {
        $cep = preg_replace("/[^0-9]/", "", $cep);
        $url = "https://viacep.com.br/ws/$cep/xml/";

        $xml = simplexml_load_file($url);

        $this->setEndereco($xml);
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

$endereco = new Endereco('04905002');

echo "<pre>";
var_dump ($endereco->getEndereco());


/*

object(SimpleXMLElement)#2 (10) {
  ["cep"]=>
  string(9) "04905-002"
  ["logradouro"]=>
  string(22) "Estrada do M'Boi Mirim"
  ["complemento"]=>
  string(25) "de 2002 a 2528 - lado par"
  ["bairro"]=>
  string(13) "Jardim Regina"
  ["localidade"]=>
  string(10) "São Paulo"
  ["uf"]=>
  string(2) "SP"
  ["ibge"]=>
  string(7) "3550308"
  ["gia"]=>
  string(4) "1004"
  ["ddd"]=>
  string(2) "11"
  ["siafi"]=>
  string(4) "7107"
}

*/

?>