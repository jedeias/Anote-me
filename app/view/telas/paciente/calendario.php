<?php

include("../../../autoload.php");


$session = new Session();

$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');
$paciente_id = $session->session_get('id');
$psico_id = $session->session_get('fk_psicologo');

$pegar_imagem = new Select();
$imagem = $pegar_imagem->getImagem($paciente_id);

if($nome == NULL and $email == NULL and $type == NULL){
   header("location: ../../../index.html");
}

?>

<!DOCTYPE html>
<html lang='pt-br'>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src='../../JS/index.global.min.js'></script>
  <link rel="stylesheet" href="../../CSS/calendario.css">
</head>
<body>
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
                    <li>Email : <?php echo "$email"; ?></li>
                    <!-- <li>Telefone :</li>
                    <li>Responsável : </li> -->
                    <!-- <li>Telefone do Responsável : </li> -->
                    <li>tipo de usuário : <?php echo "$type"; ?> </li>
                    <!-- <li>Clinica : </li> -->
                    <li class="config-container">
                        <a class="config-button" href="./atualizar_registro.php"><img class="wrapper-icon" src="../../IMG/ico/gear-svgrepo-com.svg" title="Configurações"></a>
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
          <a hre>
            <a href="atividades.php">
              <li class="agenda-consultas">
                <p>Atividades Recomendadas</p>
              </li>
            </a>
          </a>
            <li class="agenda-consultas">
              <p>Agenda</p>
            </li>
        </ul>
      </nav>
    </section>
    <script src="../../JS/script.js"></script>
</body>

</html>