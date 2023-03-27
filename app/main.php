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

$redirect_urls = array(
    "psicologo" => "./view/psicologo.html",
    "paciente" => "./view/paciente.php",
    "secretario" => "./view/secretario.html",
    "default" => "./view/login_error.php"
);

$redirect_url = isset($redirect_urls[$login_status["user_type"]]) ? $redirect_urls[$login_status["user_type"]] : $redirect_urls["default"];

$_SESSION["type"] = $login_status["user_type"];

header("Refresh: 0; url=$redirect_url");

?>