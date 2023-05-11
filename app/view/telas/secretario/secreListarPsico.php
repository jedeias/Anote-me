<?php

include("../../../autoload.php");

$session = new Session();

$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');
$id = $session->session_get('id');

$selecionar = new Select();
$dados = $selecionar->getDados($id);
$pegar_imagem = new Select();
$imagem = $pegar_imagem->getImagem($id);

$imagem = $imagem['imagem'];

if($nome == NULL and $email == NULL and $type == NULL){
   header("location: ../../../index.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anotações</title>
    <link rel="stylesheet" href="../../CSS/secretaria.css">
</head>
<body id="body">
<header class="header-container">
        <h1>ANOTE-ME</h1>
        <figure id="wrapperButton" class="click-perfil" onclick="ClickPerfil()"> 
            <?php if(isset($imagem) && $imagem != NULL): ?>
                <img src="<?php echo "../../IMG/imagem_perfil/$imagem"; ?>" alt="" class='perfil' id='first-perfil'>
            <?php else: ?>
                <img src="../../IMG/default.jpg" alt="" class='perfil'>
            <?php endif; ?>
        </figure> 
        <div class="click-wrapper">
            <nav class="dados-wrapper hidden" id="wrapper-content">
                <ul class="lista-dados">

                    <li class="center"> 
                        <?php if(isset($imagem) && $imagem != NULL): ?>
                            <img src="<?php echo "../../IMG/imagem_perfil/$imagem"; ?>" alt="FOTO-DE-PERFIL" class='perfil' id='second-perfil'>
                        <?php else: ?>
                            <img src="../../IMG/default.jpg" alt="" class='perfil'>
                        <?php endif; ?>
                    </li>
                    <li class="center"><?php echo "$nome"; ?></li>
                    <div class='lista-dados-content'>
                        <li>Email : <?php echo $email; ?></li>
                        <li>Telefone<?php echo $telefone;?></li>
                        <li>Clinica : </li>
                    </div>
                    <li class="config-container">
                        <a class="config-button" href="../atualizar_registro.php"><img class="wrapper-icon" src="../../IMG/ico/gear-svgrepo-com.svg" title="Configurações"></a>
                        <a class="config-button" href="../../sair.php"><img class="wrapper-icon" src="../../IMG/ico/arrow-from-shape-right-svgrepo-com.svg" title="Sair"></a>
                    </li>
                
                </ul>
            </nav>
        </div>
    </header>
    <main class="notepad-container">
        <aside class="menu-container">
            <nav class="menu">
                <ul>
                    <a href="secretario.php">
                        <li class="anotacoes">
                            <p>Cadastro</p>
                        </li>
                    </a>
                    <a href="secreListarPsico.php">
                        <li>
                            <p>Psicologos</p>
                        </li>
                    </a>
                    <a href="secreListarPaci.php">
                        <li>
                            <p>Pacientes</p>
                        </li>
                    </a>
                </ul>
            </nav>        
        </aside>
        
        <section class="notepad-content hidden">
            <article class="psi-table">
                <header class="psi-paci-header-text">
                    <h1>Psicologos</h1>
                </header>
                <article class="article-grid-list">
                    <section class="psi-paci-list" data-tilt data-tilt-scale="1.05" data-tilt-reverse>
                        <img class="psi-paci-img" src="../../IMG/default.jpg" alt="foto de perfil">
                        <h1>Clentin da Silva</h1>
                        <div class="psi-paci-text-div">
                            <h1>Pacientes</h1>
                            <p>Maria Carla</p>
                            <p>Josias Matos</p>
                            <p>Rodrigo louco</p>
                        </div>
                    </section>
                    <section class="psi-paci-list" data-tilt data-tilt-scale="1.05" data-tilt-reverse>
                        <img class="psi-paci-img" src="../../IMG/imagem_perfil/fiodor.jpg" alt="foto de perfil">
                        <h1>Jedeias Filho</h1>
                        <div class="psi-paci-text-div">
                            <h1>Pacientes</h1>
                            <p>Maria Carla</p>
                            <p>Josias Matos</p>
                            <p>Rodrigo louco</p>
                        </div>
                    </section>

                </article>
            </article>
            
        </section>
        <section class="notepad-content ">
            <article class="psi-table">
                <button class="backButton backListar" id="backButtonPaciente">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                    </svg>
                </button>
                <div class="listar-psi-paci">
                    <img class="psi-paci-img" src="../../IMG/imagem_perfil/fiodor.jpg" alt="foto de perfil">
                    <h1>Jedeias Filho</h1>
                    <p>Psicologo</p>
                    <div class="listar-psi-paci-info">
                        <div class="info-container">
                            <p class="info-title">Email:</p>
                            <p>Jedeias@jedeias.com</p>
                        </div>
                        <div class="info-container">
                            <p class="info-title">RG:</p>
                            <p>111.222.333.444</p>
                        </div>
                        <div class="info-container">
                            <p class="info-title">CPF:</p>
                            <p>123.345.678.944</p>
                        </div>
                        <div class="info-container">
                            <p class="info-title">Sexo:</p>
                            <p>Masculino</p>
                        </div>
                        <div class="info-container">
                            <p class="info-title">Data de Nascimento:</p>
                            <p>22/03/2003</p>
                        </div>
                    </div>
                </div>
                <h1>Pacientes de Jedeias Filho</h1>
                <div class="paciente-add">
                    <button class='paciente-add-button'><img src='../../IMG/ico/plus-svgrepo-com.svg'></button>
                </div>
            </article>
        </section>
    </main>
    <script src = "../../JS/script.js"></script>
    <script src="../../JS/vanilla-tilt.js"></script>
</body>
</html>
