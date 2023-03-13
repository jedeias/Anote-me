<?php

session_id(1);
session_start();

$email = $_SESSION['email'];


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anotações</title>
    <link rel="stylesheet" href="../CSS/styleanotacoes.css">
</head>
<body id="body">
    <header class="header-container">
        <h1>ANOTE-ME</h1>
        <div class="click-wrapper">
            <div class="click_perfil" onclick="ClickPerfil()"> 
                <img src="../IMG/emoji.webp" alt="" class="perfil" id="first-perfil">
            </div> 
            <nav class="dados-wrapper" id="click">
                <ul class="lista-dados">
                    <li class="center"> <img src="../IMG/emoji.webp" alt="FOTO-DE-PERFIL" class="perfil" id="second-perfil"></li>
                    <li class="center">Nome</li>
                    <li>Email : <?php echo "$email" ?></li>
                    <li>Telefone :</li>
                    <li>Responsável : </li>
                    <li>Telefone do Responsável : </li>
                    <li>Psicologo : </li>
                    <li>Clinica : </li>
                    <li class="config-container">
                        <a class="config-button">Config</a>
                        <a class="config-button">Sair</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <section class="notepad-container">
        <section class="menu-container">
            <nav class="menu">
                <ul>
                    <li class="anotacoes">
                        <p>Anotações</p>
                    </li>   
                    <a href="../aitv recomendadas/atividades.php">
                        <li class="agenda-consultas">
                            <p>Atividades Recomendadas</p>
                        </li>
                    </a>
                    <a href="../calendario/calendario.php">
                        <li class="agenda-consultas">
                            <p>Agenda</p>
                        </li>
                    </a>

                </ul>
            </nav>
        </section>
        <div class="notepad-content">
            <button class="prev-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                    <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                </svg>
            </button>
            <div class="notepad" action="../PHP/receberAnotacao.php" method="post">

                <div class="notepad-header">
                    <p id="digital-date" class="notepad-date"></p> 
                    <p id = "digital-clock" class="notepad-clock"></p>
                </div>
                <textarea id="text1" maxlength="221" placeholder="Como você está?" name="texto"></textarea>
                <div class="action-button-container">
                    <button class="action-button">Descartar</button>
                    <button class="action-button" type="submit" name="salvar" onclick="modalclick()">Salvar</button>
                </div>
                <!--<p class="notepad-count">1/1</p>-->
</div>
            <button class="next-button" onclick="clicktext()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                    <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                </svg>
            </button>
        </div>
    </section>
    <div class="janela-modal" id="janela-modal">
            <div class="modal">
                <button class="fechar" id="fechar">X</button>
                <div class="confirmacao-container">
                    <img src="../IMG/confirmação.webp" alt="confirmado" width="40%" height="40%" class="foto-confirmação">
                    <h1>Anotação enviada com sucesso!!</h1>
                </div>
            </div>
       </div>
    <script src = "../JS/script.js"> </script>
</body>
</html>