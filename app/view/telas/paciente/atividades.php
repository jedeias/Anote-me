<?php

include("../../../autoload.php");


$session = new Session();

$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');
$paciente_id = $session->session_get('id');
$psico_id = $session->session_get('fk_psicologo');



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
    <link rel="stylesheet" href="../../CSS/styleatividades.css">
</head>
<body>
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
    <section class="activity-container">
        <section class="menu-container">
            <nav class="menu">
                <ul>
                    <a href="anotacoes.php">
                    <li class="anotacoes">
                        <p>Anotações</p>
                    </li>
                    </a>   
                    <li class="agenda-consultas">
                        <p>Atividades Recomendadas</p>
                    </li>
                    <a href="calendario.php">
                        <li class="agenda-consultas">
                            <p>Agenda</p>
                        </li>
                    </a>
                </ul>
            </nav>
        </section>
        <section class="activity-content">
            <?php

            $select = new Select();

            $atividades = $select->select_atividades($psico_id, $paciente_id);
            foreach ($atividades as $atividade) {
                echo "<article class='paciente-atividade'>";
                    echo "<div class='activity'>";
                    echo "<div class='activity-header'>";
                    echo "<p> Assunto: ". $atividade['assunto_atividade'] . "</p>";
                    echo "<p> Data de início: ". $atividade['data'] ."</p>";
                    echo "</div>";
                    echo "<p class='activity-text'>". $atividade['atividade']  ."</p>";
                    echo "</div>";
                echo"</article>";
            }            

            ?>
        </section>
      </div>  
    </section>
    <script src="../../JS/script.js"></script>
</body>
</html>