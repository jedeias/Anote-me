<?php

// Fazer interface

class Login extends Select
{
    public function login_check($email, $password)
    {
        $arrayUser = $this->validateUser($email, $password);
        return $arrayUser;
    }

    public function user_data($email, $password)
    {
        $select = new Select();
        
        //return $result = $select->userData($email, $password); 

    }

}

?>