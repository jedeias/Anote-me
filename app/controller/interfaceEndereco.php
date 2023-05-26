<?php

interface interfaceEndereco{

    public function getCep();

	public function setCep($cep);
	

    public function getEndereco();

    public function setRua($endereco);

    public function getNumero();

    public function setNumero($numero);

    public function getComplemento();
    public function setComplemento($complemento);

}

?>