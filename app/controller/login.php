<?php

// Fazer interface  // preguiça faço mas tarde
class Login extends Select
{

    public function login_check($email, $password){

        $result = $this->loginCheck($email, $password);
        
        if($result["success"] == false){

            header("location: ../index.php");

        }
        
        return $result;
    }

}

?>