<?php

class Login{

    public function __construct( $sql ,string $email, string $senha)
    {
        $this->sql = $sql;
        $this->email = $email;
        $this->senha = $senha;
    }


    public function security(string $input)
    {
        $this->input = $input;
      
        $security = new Security();

        $security->input_Check($this->input); 
    
    }
    
    public function sql_Connect($locate)
    {
        $this->locate = $locate;


        $conn = new Connect("localhost","root","","clinica_psicologica");

    }

}

?>