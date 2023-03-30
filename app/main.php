<?php

include("autoload.php");


if(!isset($_POST['email']) && !isset($_POST['password']) ){
    echo "Dados não inseridos";
}

$email = $_POST['email'];
$password = $_POST['password'];

$login_sys = new Login();

$login_status = $login_sys->login_check($email, $password);
$user_name = $login_sys->user_data($email, $password);

$session = new Session_controller();

$session->session_set("email", $email);
$session->session_set("nome", $user_name);

$redirect_urls = array(
    "psicologo" => "./view/psicologo.php",
    "paciente" => "./view/paciente.php",
    "secretario" => "./view/secretario.html",
    "default" => "./view/login_error.php"
);

$session->session_set('type', $login_status["user_type"]);

$nome = $login_sys->user_data($email, $password);

$redirect_url = isset($redirect_urls[$login_status["user_type"]]) ? $redirect_urls[$login_status["user_type"]] : $redirect_urls["default"];

header("Refresh: 0; url=$redirect_url");

?>