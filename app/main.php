<?php

include("autoload.php");

    //para produção
// if(!isset($_POST['email']) && !isset($_POST['password']) ){
//     echo "Dados não inseridos";
// }
// $email = $_POST['email'];
// $password = $_POST['password'];



//para teste
// Retrieve the JSON data from the request body


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

var_dump($email, $password);

$login_sys = new Login();

$login_status = $login_sys->login_check($email, $password);
$user_name = $login_sys->user_data($email, $password);

$session = new Session_controller();

$session->session_set("email", $email);
$session->session_set("nome", $user_name);

$redirect_urls = array(
    "psicologo" => "./view/telas/psicologo/psicologo.php",
    "paciente" => "./view/telas/paciente/paciente.php",
    "secretario" => "./view/telas/secretario/secretario.html",
    "default" => "./view/login_error.php"
);

$session->session_set('type', $login_status["user_type"]);

$nome = $login_sys->user_data($email, $password);

$redirect_url = isset($redirect_urls[$login_status["user_type"]]) ? $redirect_urls[$login_status["user_type"]] : $redirect_urls["default"];

header("Location: $redirect_url");

?>