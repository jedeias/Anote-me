<?php 

interface Pessoas{
    public function getPessoasSenha();
    
    public function setPessoasSenha($senha);

    public function getPessoasEmail();
    
    public function setPessoasEmail($email);

    public function getPessoasSexo();
    
    public function setPessoasSexo($sexo);

    public function getPessoasCpf();
    
    public function setPessoasCpf($cpf);
    
    public function getPessoasRG();
    
    public function setPessoasRG($RG);

    public function getPessoasNome();
    
    public function setPessoasNome($nome);

    public function getPessoasDataNasc(); 

    public function setPessoasDataNasc($dataNasc); 

    public function getPessoasEndereco(); 

    public function setPessoasEndereco($endereco); 

    public function getPessoasTelefone();
    
    public function setPessoasTelefone($telefone);
}

?>