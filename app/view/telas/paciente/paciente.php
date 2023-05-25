<?php

include("../../../autoload.php");


$session = new Session();

$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');
$paci_id = $session->session_get('id');
$psico_id = $session->session_get('fk_psicologo');

$selecionar = new Select();
$dados = $selecionar->getDados($paci_id);
$responsavel = $selecionar->getDadosResponsavel($paci_id);
$psicologo = $selecionar->getDadosPsicologoPaciente($paci_id);
$imagem = $selecionar->getImagem($paci_id);

$imagem = $imagem['imagem'];

if($nome == NULL and $email == NULL and $type == NULL){
   header("location: ../../sair.php");
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

        <div class="container-notif">
            <!--notificação-->
            <script>
                let btn_noti = document.getElementsById('noti');
                function click_noti(){
                    console.log('clicou');
                    let notificacao = document.getElementById('notificacoes');
                    notificacao.classList.toggle('notification');
                }
            </script>
            <div class="com-notifiacao" id="noti" onclick="click_noti()">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="60" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                </svg>
            </div>

            <div class="vazio" id="notificacoes">
                <?php $notificacao = new Select();
                    $sessao = $notificacao->notificacaoPaciente($paci_id);
                    if($sessao != null){
                        echo '<p> voce tem uma sessão marcada para: </p>';
                        echo '<li> dia: ' . $sessao['data_formatada'] . '</li>';
                        echo '<li> horario: ' .$sessao['horario'] . '</li>';
                        echo '<a href="./calendario.php">Consultar agenda</a>';
                    }else{

                        echo '<p> voce não tem consultas marcadas: </p>';
                        echo '<li> dia: </li>';
                        echo '<li> horario: </li>';
                        
                    }      
                ?>
            </div>

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
                            <li class="dados-title">Email</li>
                            <li><?php echo $email; ?></li>
                            <hr>
                            <li class="dados-title">Telefone</li>
                            <li><?php echo $dados[0]['numero']; ?></li>
                            <hr>
                            <li class="dados-title">Responsável</li>
                            <li><?php echo $responsavel[0]['nome']; ?></li>
                            <hr>
                            <li class="dados-title">Tel. Responsável</li>
                            <li><?php echo $responsavel[0]['numero_responsavel']; ?></li>
                            <hr>
                            <li class="dados-title">Psicologo</li>
                            <li><?php echo $psicologo[0]['nome_psicologo'];?></li>
                            <hr>
                        </div>
                        <li class="config-container">
                            <a class="config-button" href="../atualizar_registro.php"><img class="wrapper-icon" src="../../IMG/ico/gear-svgrepo-com.svg" title="Configurações"></a>
                            <a class="config-button" href="../../sair.php"><img class="wrapper-icon" src="../../IMG/ico/arrow-from-shape-right-svgrepo-com.svg" title="Sair"></a>
                        </li>
                    
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <section class="notepad-container">
        <section class="menu-container">
            <nav class="menu">
                <ul>
                    <li class="active-menu">
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
            <button class="prev-button" onclick="prevNote()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                    <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                </svg>
            </button>
            <?php

            ob_start();
              $anotacoes = $selecionar->select_notes($psico_id, $email);
              
              $numAnotacoes = 0;

              foreach($anotacoes as $anotacao){
                $numAnotacoes = $numAnotacoes+1;
                echo"<div id='anotacao".$numAnotacoes."' class='notepad'>";
                echo"<article class='notepad-header'>";
                echo"<p id='emojiAnotacao".$numAnotacoes."'class='emoji-button' title='Emoção: ".$anotacao['emocao']."&#013Intensidade: ".$anotacao['intensidade']."%'>".$anotacao['emocao']."</p>";
                echo"<p class='notepad-date'>".$anotacao['data']."</p>";
                echo"<p class='notepad-clock'>".$anotacao['hora']."</p>";
                echo"</article>";
                echo"<textarea class='prev-note-text' readonly>".$anotacao['anotacao']."</textarea>";
                echo"<div class='action-button-container'>";
                echo"<form class='delete-form' method='POST' onsubmit='deleteAlertAnotacao(event)' action='../../../controller/crud/paciente/deleteAnotacao.php'><button class='action-button prev-note-descartar' name='excluir' value='".$anotacao['pk_anotacoes_paciente']."'>Descartar</button></form>";
                echo"</div>";
                echo"</div>";
              }

              echo "<div class='hidden' id='numAnotacoes' data-valor='".$numAnotacoes."'> </div>";

              $html = ob_get_clean();
            $html = preg_replace('/\s+/', ' ', $html);

            echo $html;
            ?>
            <div id="anotacao<?php echo $numAnotacoes + 1;?>" class="notepad active">           
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
                <textarea required id="textarea" placeholder="Como você está?" name="descricao"></textarea>
                <div class="action-button-container">
                    <button type=button class="action-button" onclick="DescartarAnotacao()">Descartar</button>
                    <button class="action-button" type="submit" onclick="modalclick()">Salvar</button>
                </div>

            </form>
            </div>
            <button class="next-button" onclick="nextNote()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                    <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                </svg>
            </button>
            <p id='notepad-count' class='notepad-count'>1/1</p>
        </section>
        <?php

        if (!isset($_SESSION['get_executed']) || !$_SESSION['get_executed']) {
            if(isset($_GET["savednote"])){
                echo "<div class='saved-note'>";
                echo "<p>Anotação Salva!</p>";
                echo "</div>";
              }
      
              if(isset($_GET["deletednote"])){
                echo "<div class='saved-note'>";
                echo "<p>Anotação Deletada</p>";
                echo "</div>";   
              }           
            $_SESSION['get_executed'] = true;
        }

        
        ?>
    </section>
    <script src="../../JS/scriptAnotacoes.js"></script>
    
</body>
</html>
