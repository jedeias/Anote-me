<?php

// Fazer interface
class Login extends Select
{

    public function login_check($email, $password){
        
        $select = new Select();

        $result = $select->validateUser($email, $password);
        
        if($result["success"] == false){

            header("location: ../index.html");

        }

        return $result;
    }

    // public function user_data($email, $password){
    //     $select = new Select();
        
    //     return $result = $select->userData($email, $password); 

    // }

}

?>