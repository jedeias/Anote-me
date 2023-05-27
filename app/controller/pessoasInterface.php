<?php 

interface pessoasInterface{

    public function getSenha();
	

	public function setSenha($senha);
	

	public function getEmail();
	

	public function setEmail($email);
	

	public function getSexo();
	

	public function setSexo($sexo);
	

	public function getCpf();
	

	public function setCpf($cpf);
	

	public function getRG();
	

	public function setRG($RG);
	

	public function getNome();
	

	public function setNome($nome);
	
	
	public function getDataNasc();
	

	public function setDataNasc($dataNasc);
	

	
	public function getEndereco();
	

	public function setEndereco($endereco);
	

    public function getTelefone();
   
     

    public function setTelefone($telefone);
     

	public function getId();
	

	public function setId($id);
	

}

?>