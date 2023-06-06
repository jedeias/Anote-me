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
 
 if($type != "secretario"){
     header("location: ../{$type}/{$type}.php");
 }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ANOTE-ME</title>
    <link rel="stylesheet" href="../../CSS/secretaria.css">
    <link rel="stylesheet" href="../../CSS/agendaPsicologo.css">
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

                    <a href="../../eventos">
                        <li>
                            <p>Agendar Sessão</p>
                        </li>
                    </a> 
                </ul>
            </nav>        
        </aside>
        
        <section class="notepad-content " id="psicoCards">
            <article class="psi-table">
                <?php
                $select = new Select();
                $psicologos = $select->selectPsicologos();

                if(isset($_GET['psicoId'])){
                    $psicoId = $_GET['psicoId'];

                    $psicoDetailsId = $_GET['psicoId'];
                    $psicologo = $select->selectPsicologo($psicoId);

                    $listar =  $select->listarAgenda($psicoId);

                    if(!empty($listar)) {
                        echo '<table>';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<te style="text-align: center;">Consultas Marcadas</te>';
                        echo '<th style="text-align: center;">Data</th>';
                        echo '<th style="text-align: center;">Hora</th>';
                        echo '<th style="text-align: center;">Paciente</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        foreach ($listar as $consulta) {
                            echo '<tr>';
                            echo '<td style="text-align: center;">' . $consulta['data_formatada'] . '</td>';
                            echo '<td style="text-align: center;">' . $consulta['horario'] . '</td>';
                            echo '<td style="text-align: center;">' . $consulta['paciente'] . '</td>';
                            echo '</tr>';
                        }

                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo '<p>Nenhuma consulta encontrada.</p>';
                    }
                } else {
                    echo '<p>Nenhuma consulta encontrada.</p>';
                }
                ?>
            </article>


        </section>
    </main>
    <script src = "../../JS/script.js"></script>
    <script src="../../JS/vanilla-tilt.js"></script>
</body>
</html>
