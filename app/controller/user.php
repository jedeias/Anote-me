<?php

//teste

class User{

    private $email;
    private $password;
    
    public function __construct($email, $password){

        $this->email = $email;
        $this->password = $password;

    }

    public function getEmail()
    {
        return $this->email;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function setPassword(string $password)
    {
        $this->password = $password;
    }
    
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function toString()
    {
        return ($this->email . "\n" . $this->password);
    }

}

?>