<?php

class Pessoas{

    protected $nome;
    protected $RG;
    protected $cpf;
    protected $sexo;
    protected $email;
    protected $senha;

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
}

?>