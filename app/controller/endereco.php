<?php

interface Endereco{

    public function getEnderecoCep();

	public function setEnderecoCep($cep);

    public function getEnderecoRua();

    public function setEnderecoRua($endereco);

    public function getEnderecoNumero();

    public function setEnderecoNumero($numero);

    public function getEnderecoComplemento();

    public function setEnderecoComplemento($complemento);

}

?>