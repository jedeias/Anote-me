<?php

include("autoload.php");


$json = file_get_contents('php://input');

// Decode the JSON data into an associative array
$data = json_decode($json, true);

if (isset($data['email'])){
    
    $email = $data['email'];
    $password = $data['password'];

}else{

    if(!isset($_POST['email']) && !isset($_POST['password']) ){
    echo "Dados não inseridos";
    }
    $email = $_POST['email'];
    $password = $_POST['password'];

}

$login_sys = new Login();

$login_status = $login_sys->login_check($email, $password);

$session = new Session();

$session->session_set("email", $email);
$session->session_set("nome", $login_status["name"]);
$session->session_set("nome", $login_status["id"]);

$redirect_urls = array(
    "psicologo" => "./view/telas/psicologo/psiPacientes.php",
    "paciente" => "./view/telas/paciente/anotacoes.php",
    "secretario" => "./view/telas/secretario/secretario.html",
    "default" => "./view/login_error.php"
);

$session->session_set('type', $login_status["user_type"]);


$redirect_url = isset($redirect_urls[$login_status["user_type"]]) ? $redirect_urls[$login_status["user_type"]] : $redirect_urls["default"];

header("Location: $redirect_url");

?>