<?php

class Pessoas implements pessoasInterface{
	private $id;
    private $nome;
    private $RG;
    private $cpf;
    private $sexo;
    private $email;
    private $senha;
	private $dataNasc;
	private $endereco;
    private $telefone;

	public function __construct($id, $nome, $RG, $cpf, $sexo, $email, $senha, $dataNasc, $endereco, $telefone) {
		$this->setId($id);
		$this->setNome($nome);
		$this->setRG($RG);
		$this->setCpf($cpf);
		$this->setSexo($sexo);
		$this->setDataNasc($dataNasc);
		$this->setEndereco($endereco);
		$this->setTelefone($telefone);
	}

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

	public function getId() {
		return (int) $this->id;
	}

	public function setId($id): self {
		$this->id = $id;
		return $this;
	}
}

?>