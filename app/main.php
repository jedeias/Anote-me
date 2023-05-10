<?php

include("autoload.php");

if(!isset($_POST['email']) && !isset($_POST['password']) ){
echo "Dados não inseridos";
}
$email = $_POST['email'];
$password = $_POST['password'];

$loginSys = new Login();

$loginStatus = $loginSys->login_check($email, $password);

$session = new Session();

$session->session_set("email", $email);
$session->session_set("nome", $loginStatus["nome"]);
$session->session_set("id", $loginStatus["id"]);
$session->session_set("fk_psicologo", $loginStatus["fk_psicologo"]);
$session->session_set("get_executed", false);

$redirectUrls = array(
    "psicologo" => "./view/telas/psicologo/psicologo.php",
    "paciente" => "./view/telas/paciente/paciente.php",
    "secretario" => "./view/telas/secretario/secretario.php",
    "default" => "../index.php?invalido"
);


$session->session_set('type', $loginStatus["user_type"]);

$redirectUrl = isset($redirectUrls[$loginStatus["user_type"]]) ? $redirectUrls[$loginStatus["user_type"]] : $redirectUrls["default"];

header("Location: $redirectUrl");

?>