<?php

class Login
{

    public function login_check(string $email, string $password)
    {
        $select = new Select();
        return $result = $select->validateUser($email, $password);
    }

    public function user_data(string $email, string $password)
    {
       $select = new Select();
       return $result = $select->userData($email, $password); 
    }

}

?>