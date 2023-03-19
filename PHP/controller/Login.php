<?php

class Login{

    

    public function __construct( $sql ,string $email, string $senha)
    {
        $this->sql = $sql;
        $this->email = $email;
        $this->senha = $senha;
    }

}

?>