<?php

class Pessoas implements Pessoas{
    private $nome;
    private $RG;
    private $cpf;
    private $sexo;
    private $email;
    private $senha;
	private $dataNasc;
	private object $endereco;
    private object $telefone;

	public function getSenha() {
		return $this->senha;
	}

	public function setSenha($senha): self {
		$this->senha = $senha;
		return $this;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email): self {
		$this->email = $email;
		return $this;
	}

	public function getSexo() {
		return $this->sexo;
	}

	public function setSexo($sexo): self {
		$this->sexo = $sexo;
		return $this;
	}

	public function getCpf() {
		return $this->cpf;
	}

	public function setCpf($cpf): self {
		$this->cpf = $cpf;
		return $this;
	}

	public function getRG() {
		return $this->RG;
	}

	public function setRG($RG): self {
		$this->RG = $RG;
		return $this;
	}

	public function getNome() {
		return $this->nome;
	}

	public function setNome($nome): self {
		$this->nome = $nome;
		return $this;
	}
	
	public function getDataNasc() {
		return $this->dataNasc;
	}

	public function setDataNasc($dataNasc): self {
		$this->dataNasc = $dataNasc;
		return $this;
	}

	
	public function getEndereco() {
		return $this->endereco;
	}

	public function setEndereco($endereco): self {
		$this->endereco = $endereco;
		return $this;
	}

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone): self{
        $this->telefone = $telefone;
        return $this;
    }


	#Interface

    public function getPessoasSenha(){

		$this->getSenha();
	}
    
    public function setPessoasSenha($senha){

		$this->setSenha();
	}

    public function getPessoasEmail(){

		$this->getEmail();
	}
    
    public function setPessoasEmail($email){

		$this->setEmail();
	}

    public function getPessoasSexo(){

		$this->getSexo();
	}
    
    public function setPessoasSexo($sexo){

		$this->setSexo();
	}

    public function getPessoasCpf(){

		$this->getCpf();
	}
    
    public function setPessoasCpf($cpf){

		$this->setCpf();
	}
    
    public function getPessoasRG(){

		$this->getRG();
	}
    
    public function setPessoasRG($RG){

		$this->setRG();
	}

    public function getPessoasNome(){

		$this->getNome();
	}
    
    public function setPessoasNome($nome){

		$this->setNome();
	}

    public function getPessoasDataNasc(){

		$this->getDataNasc();
	} 

    public function setPessoasDataNasc($dataNasc){

		$this->setDataNasc();
	} 

    public function getPessoasEndereco(){

		$this->getEndereco();
	} 

    public function setPessoasEndereco($endereco){

		$this->setEndereco();
	} 

    public function getPessoasTelefone(){

		$this->getTelefone();
	}
    
    public function setPessoasTelefone($telefone){

		$this->setTelefone();
	}

}

?>