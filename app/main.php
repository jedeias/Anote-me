<?php

include("autoload.php");

$email = $_POST['email'];
$password = $_POST['password'];

session_start();

$_SESSION["email"] = $email;

if (!isset($_SESSION['email'])) {
    header("Location: ./view/login_error.php");
    exit();
}

$login_sys = new Login();

$login_status = $login_sys->login_check($email, $password);


if($login_status["success"] == false){
    
    header("Refresh: 0; url=./view/login_error.html");
    
}elseif($login_status["success"] == true and $login_status["user_type"]== 'psicologo'){
    
    header("Refresh: 0; url=./view/psicologo.html");
    
}elseif ($login_status["success"] == true and $login_status["user_type"]== 'paciente') {
    
    header("Refresh: 0; url=./view/paciente.php");
    
}elseif ($login_status["success"] == true and $login_status["user_type"]== 'secretario') {
    
    header("Refresh: 0; url=./view/secretario.html");
    
}else {
    
    header("Refresh: 0; url=./view/login_error.html");
    
}

$_SESSION["type"] = $login_status['user_type'];

?>