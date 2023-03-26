<?php

include("autoload.php");

$email = $_POST['email'];
$password = $_POST['password'];

$login_sys = new Login();

$login_status = $login_sys->login_check($email, $password);


if($login_status["success"] == false){
    header("Refresh: 2; url=./view/login_error.html");
}elseif($login_status["success"] == true and $login_status["user_type"]== 'psicologo'){
    echo"Redrect to home psicologo";
}elseif ($login_status["success"] == true and $login_status["user_type"]== 'paciente') {
    echo"Redrect to home paciente";
}elseif ($login_status["success"] == true and $login_status["user_type"]== 'secretario') {
    echo"Redrect to home paciente";
}else {
    header("Refresh: 2; url=./view/login_error.html");
}

?>