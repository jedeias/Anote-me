<?php

include("../../../autoload.php");


$session = new Session();

$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');
$id = $session->session_get('id');

$pegar_imagem = new Select();
$imagem = $pegar_imagem->getImagem($id);

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
        <figure id="wrapperButton" class="click-perfil" onclick="ClickPerfil()"> 
            <?php if(isset($imagem['imagem']) && $imagem['imagem'] != NULL): ?>
                <img src="<?php echo $imagem['imagem'] ?>" alt="" class='perfil' id='first-perfil'>
            <?php else: ?>
                <img src="../../IMG/default.jpg" alt="" class='perfil'>
            <?php endif; ?>
        </figure> 
        <div class="click-wrapper">
            <nav class="dados-wrapper hidden" id="wrapper-content">
                <ul class="lista-dados">

                    <li class="center"> 
                        <?php if(isset($imagem['imagem']) && $imagem['imagem'] != NULL): ?>
                            <img src="<?php echo $imagem['imagem'] ?>" alt="FOTO-DE-PERFIL" class='perfil' id='second-perfil'>
                        <?php else: ?>
                            <img src="../../IMG/default.jpg" alt="" class='perfil'>
                        <?php endif; ?>
                    </li>
                    <li class="center"><?php echo "$nome"; ?></li>
                    <div class='lista-dados-content'>
                        <li>Email : <?php echo $email; ?></li>
                        <li>Telefone : <?php echo $id; ?></li>
                        <li>Responsável : </li>
                        <li>Telefone do Responsável : </li>
                        <li>Psicologo : </li>
                        <li>Clinica : </li>
                    </div>
                    <li class="config-container">
                        <a class="config-button" href="./atualizar_registro.php"><img class="wrapper-icon" src="../../IMG/ico/gear-svgrepo-com.svg" title="Configurações"></a>
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
                    <li class="active">
                        <p>Anotações</p>
                    </li>   
                    <a href="atividades.php">
                        <li class="menu-select">
                            <p>Atividades Recomendadas</p>
                        </li>
                    </a>
                    <a href="calendario.php">
                        <li class="menu-select">
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
            <div class="notepad">           
                <form action="../../../controller/crud/paciente/inserteNota.php" method="POST">

                <article class="notepad-header">
                    <p id="emojiButton" class="emoji-button" onclick="ClickEmoji()">😶</p>
                    <p id="digital-date" class="notepad-date"></p> 
                    <p id = "digital-clock" class="notepad-clock"></p>
                    <div class="emoji-content hidden" id="emojiTab">
                        <h1>Que emoção você sentiu?</h1>
                        <select id="emojiSelect" name="emocao">
                            <option value="indiferente">Indiferente</option>
                            <option value="feliz">😃 Feliz</option>
                            <option value="triste">😥 Triste</option>
                            <option value="ansioso">😰 Ansioso(a)</option>
                            <option value="raiva">😠 Com raiva</option>
                            <option value="medo">😱 Com medo</option>
                        </select>
                        <hr></hr>
                        <h1>Qual foi a intensidade?</h1>
                        <select id="emojiSelectPercentage" name="emocaoGrau">
                            <option value="10">10%</option>
                            <option value="20">20%</option>
                            <option value="30">30%</option>
                            <option value="40">40%</option>
                            <option value="50">50%</option>
                            <option value="60">60%</option>
                            <option value="70">70%</option>
                            <option value="80">80%</option>
                            <option value="90">90%</option>
                            <option value="100">100%</option>
                        </select>
                        <input class="emoji-close" type="button" value="Fechar" onclick="ClickEmoji()">
                    </div>
                </article>
                <textarea id="text1" placeholder="Como você está?" name="descricao"></textarea>
                <div class="action-button-container">
                    <button class="action-button">Descartar</button>
                    <button class="action-button" type="submit" onclick="modalclick()">Salvar</button>
                </div>

            </form>
            <p class="notepad-count">1/1</p>
            </div>
            <button class="next-button" onclick="clicktext()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                    <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                </svg>
            </button>
        </section>
        <?php

        if(isset($_GET["savednote"])){
          echo "<div class='saved-note'>";
          echo "<p>Anotação Salva!</p>";
          echo "</div>";
        }
        
        ?>
    </section>

    <script src="../../JS/scriptAnotacoes.js"></script>
</body>
</html>
