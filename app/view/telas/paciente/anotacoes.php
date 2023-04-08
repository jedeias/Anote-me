<?php

include("../../../autoload.php");


$session = new Session();

$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');

if($nome == NULL and $email == NULL and $type == NULL){
   header("location: ../../../index.html");
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anotações</title>
    <link rel="stylesheet" href="../../CSS/styleanotacoes.css">
</head>
<body id="body">
    <header class="header-container">
        <h1>ANOTE-ME</h1>
        <div id="wrapperButton" class="click-perfil" onclick="ClickPerfil()"> 
            <img src="../../IMG/117104319_3204025416385100_1271061160658966926_n.jpg" alt="" class="perfil" id="first-perfil">
        </div> 
        <div class="click-wrapper">
            <nav class="dados-wrapper hidden" id="wrapper-content">
                <ul class="lista-dados">

                    <li class="center"> <img src="../../IMG/117104319_3204025416385100_1271061160658966926_n.jpg" alt="FOTO-DE-PERFIL" class="perfil" id="second-perfil"></li>
                    <li class="center"><?php echo "$nome"; ?></li>
                    <li>Email : <?php echo "$email"; ?></li>
                    <!-- <li>Telefone :</li>
                    <li>Responsável : </li> -->
                    <!-- <li>Telefone do Responsável : </li> -->
                    <li>tipo de usuário : <?php echo "$type"; ?> </li>
                    <!-- <li>Clinica : </li> -->
                    <li class="config-container">
                        <a class="config-button"><img class="wrapper-icon" src="../../IMG/ico/gear-svgrepo-com.svg" title="Configurações"></a>
                        <a class="config-button" href="../../sair.php"><img class="wrapper-icon" src="../../IMG/ico/arrow-from-shape-right-svgrepo-com.svg" title="Sair"></a>
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
                    <a href="atividades.php">
                        <li class="agenda-consultas">
                            <p>Atividades Recomendadas</p>
                        </li>
                    </a>
                    <a href="calendario.php">
                        <li class="agenda-consultas">
                            <p>Agenda</p>
                        </li>
                    </a>

                </ul>
            </nav>
        </section>
        <section class="notepad-content">
            <button class="prev-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                    <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                </svg>
            </button>
            <div class="notepad" action="../PHP/receberAnotacao.php" method="post">

                <article class="notepad-header">
                    <p id="emojiButton" class="emoji-button" onclick="ClickEmoji()">😶</p>
                    <p id="digital-date" class="notepad-date"></p> 
                    <p id = "digital-clock" class="notepad-clock"></p>
                    <div class="emoji-content hidden" id="emojiTab">
                        <h1>Que emoção você sentiu?</h1>
                        <select id="emojiSelect" name="emocao">
                            <option value="nenhuma">Nenhuma</option>
                            <option value="feliz">😃 Feliz</option>
                            <option value="triste">😥 Triste</option>
                            <option value="ansioso">😰 Ansioso(a)</option>
                            <option value="com raiva">😠 Com raiva</option>
                            <option value="com medo">😱 Com medo</option>
                        </select>
                        <hr></hr>
                        <h1>Qual foi a intensidade?</h1>
                        <select id="emojiSelectPercentage" name="emocao">
                            <option value="10">10%</option>
                            <option value="10">20%</option>
                            <option value="10">30%</option>
                            <option value="10">40%</option>
                            <option value="10">50%</option>
                            <option value="10">60%</option>
                            <option value="10">70%</option>
                            <option value="10">80%</option>
                            <option value="10">90%</option>
                            <option value="10">100%</option>
                        </select>
                        <input class="emoji-close" type="button" value="Fechar" onclick="ClickEmoji()">
                    </div>
                </article>
                <textarea id="text1" maxlength="221" placeholder="Como você está?" name="texto"></textarea>
                <div class="action-button-container">
                    <button class="action-button">Descartar</button>
                    <button class="action-button" type="submit" name="salvar" onclick="modalclick()">Salvar</button>
                </div>
            <p class="notepad-count">1/1</p>
            </div>
            <button class="next-button" onclick="clicktext()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                    <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                </svg>
            </button>
        </section>
    </section>

    <script src="../../JS/scriptAnotacoes.js"></script>
</body>
</html>