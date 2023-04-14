<?php

// Fazer interface  // preguiça faço mas tarde
class Login extends Select
{

    public function login_check($email, $password){

        $result = $this->validateUser($email, $password);
        
        echo"<pre>";
        var_dump($result);
        if($result["success"] == false){

            header("location: ../index.html");

        }
        
        return $result;
    }

}

?>