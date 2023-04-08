<?php

// Fazer interface

class Login
{
    public function login_check($email, $password)
    {
        $select = new Select();
        return $result = $select->validateUser($email, $password);
    }

    public function user_data($email, $password)
    {
        $select = new Select();
        
        return $result = $select->userData($email, $password); 

    }

}

?>