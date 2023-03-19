<?php

include ("autoload.php");

$email = $_POST["email"];
$senha = $_POST["senha"];


$login = new Login($email, $senha);

$email_scurity_stats = $login->security($email);
$senha_scurity_stats = $login->security($senha);

if($email_scurity_stats == TRUE and $senha_scurity_stats == TRUE){

    $login->sql_Connect($email,$senha);

}else{

    #colocar aviso da pasta view para informar ao usuario que o acesso foi negado

    echo"<br> bad required <br>";
                
    echo"<br> We detected malicious code in your request. Please try again. <br> ";
    
    echo "<br> You can't use this character:<br> ";
    

}

?>