<?php

(include('../../../autoload.php'));

$session = new Session();


$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');
$psico_id = $session->session_get('id');



if (empty($_SESSION)) {

    header('location: ../../../../index.html');

}

?>

<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Anote-me</title>
    <link rel='stylesheet' href='../../CSS/configuracoesPsicologo.css'>
</head>
<body id='body'>
    <header class='header-container'>
        <h1 onclick="location.href=psiPacientes.php">ANOTE-ME</h1>
        <div class='click-wrapper'>
            <nav class='dados-wrapper hidden' id='wrapper-content'>
                <ul class='lista-dados'>
                    <li class='center'> <img src='../../IMG/117104319_3204025416385100_1271061160658966926_n.jpg' alt='FOTO-DE-PERFIL' class='perfil' id='second-perfil'></li>
                    <li class='center'><?php echo $nome; ?></li>
                    <div class='lista-dados-content'>
                        <li>Email : <?php echo $email; ?></li>
                        <li>Telefone : <?php echo $psico_id; ?></li>
                        <li>Responsável : </li>
                        <li>Telefone do Responsável : </li>
                        <li>Psicologo : </li>
                        <li>Clinica : </li>
                    </div>
                    
                    <li class='config-container'>
                        <a class='config-button' href="./atualizar_registro.php"><img class='wrapper-icon' src='../../IMG/ico/gear-svgrepo-com.svg' title='Configurações'></a>
                        <a class='config-button' href="../../sair.php"><img class='wrapper-icon' src='../../IMG/ico/arrow-from-shape-right-svgrepo-com.svg' title='Sair'></a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <section class="config-container">

    <section class="notepad-container">
        <section class="menu-container">
            <figure id='wrapperButton' class='click-perfil' onclick='ClickPerfil()'> 
                <img src='../../IMG/117104319_3204025416385100_1271061160658966926_n.jpg' alt='' class='perfil' id='first-perfil'>
            </figure> 
        </section>
    </section>       
    </section>


    <script src="../../JS/script.js"></script>
</body>
</html>