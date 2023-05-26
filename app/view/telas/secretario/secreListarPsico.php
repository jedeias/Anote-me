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

                    if(empty($_GET)){
                        echo "<header class='psi-paci-header-text'>";
                        echo "<h1>Psicologos</h1>";
                        echo "<input type='text' id='psiSearchBar' placeholder='Pesquisar Psicologo' class='psi-search-bar' onkeyup='searchPsico()'>";
                        echo "</header>";
                        echo "<article class='article-grid-list' id='psicoCardsScroll'>";
                        foreach($psicologos as $psicologo){
                             $imagemSrc = $psicologo['imagem'];
                            if($imagemSrc == null){
                                $imagem = "../../IMG/default.jpg";
                            } else {
                                $imagem = $imagemSrc;
                            }
                            echo "<section class='psi-paci-list' data-tilt data-tilt-scale='1.05' data-tilt-reverse data-nome='".$psicologo['nome']."' onclick='clickPsicoCard(".$psicologo['pk_psicologo'].")' id='psicoCard".$psicologo['pk_psicologo']."')'>";
                            echo "<img class='psi-paci-img' src='".$imagem."' alt='foto de perfil'>";
                            echo "<h1>".$psicologo['nome']."</h1>";
                            echo "<div class='psi-paci-text-div'>";
                            echo "<h1>Pacientes</h1>";
                            $pacientes = $select->select_user_patient($psicologo['pk_psicologo']);
                            if(empty($pacientes)){
                                echo "<p>Sem pacientes no momento.</p>";
                            } else{
                            foreach($pacientes as $paciente){
                                echo "<p>".$paciente['nome']."</p>";
                            }
                        }
                            echo "</div>";
                            echo "</section>";
                        }

                    } else {
                        $psicoDetailsId = $_GET['psicoId'];
                        $psicologo = $select->selectPsicologo($psicoDetailsId);
                        $pacientes = $select->select_user_patient($psicoDetailsId);
                        foreach($psicologo as $dado){
                            $nome = $dado['nome'];
                            $email = $dado['email'];
                            $rg = $dado['RG'];
                            $cpf = $dado['CPF'];
                            $sexo = $dado['Sexo'];
                            if($sexo == 'M'){
                                $sexo = 'Masculino';
                            } elseif($sexo == 'F') {
                                $sexo = 'Feminino';
                            } else {
                                $sexo = 'Indefinido';
                            }
                            $data_nasc = $dado['data_nasc'];
                            $imagem = $dado['imagem'];
                            if($imagem == null){
                                $imagem = "../../IMG/default.jpg";
                            }
                        }
                        echo "<button class='backButton backListar' id='backButtonListarPsico' onclick='voltarPsicoTable()'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' fill='currentColor' class='bi bi-caret-left-fill' viewBox='0 0 16 16'>
                                    <path d='m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z'/>
                                </svg>
                              </button>
    
                              <div class='listar-psi-paci'>
                                <img class='psi-paci-img' src=".$imagem." alt='foto de perfil'>
                                <h1>".$nome."</h1>
                                <p>Psicologo</p>
                                <div class='listar-psi-paci-info'>
                                    <div class='info-container'>
                                        <p class='info-title'>Email:</p>
                                        <p>".$email."</p>
                                    </div>
                                    <div class='info-container'>
                                        <p class='info-title'>RG:</p>
                                        <p>".$rg."</p>
                                    </div>
                                    <div class='info-container'>
                                        <p class='info-title'>CPF:</p>
                                        <p>".$cpf."</p>
                                    </div>
                                    <div class='info-container'>
                                        <p class='info-title'>Sexo:</p>
                                        <p>".$sexo."</p>
                                    </div>
                                    <div class='info-container'>
                                        <p class='info-title'>Data de Nascimento:</p>
                                        <p>".$data_nasc."</p>
                                    </div>
                                </div>
                              </div>
                              <h1>Pacientes de ".$nome."</h1>";
                              if(empty($pacientes)){
                                echo "<p>Sem pacientes no momento.</p>";
                            } else {
                                foreach($pacientes as $paciente){
                                    $sexo = $paciente['sexo'];
                                    if($sexo == 'M'){
                                        $sexo = 'Masculino';
                                    } elseif($sexo == 'F') {
                                        $sexo = 'Feminino';
                                    } else {
                                        $sexo = 'Indefinido';
                                    }
                                    echo "<div class='psi-details-paci' onclick='redirectPaci(".$paciente['pk_paciente'].")'>
                                            <h1>".$paciente['nome']."<h1>
                                            <div>
                                                <p>".$paciente['email']."</p>
                                                <p>".$paciente['data_nasc']."<p> 
                                                <p>".$sexo."</p>
                                            </div>
                                          </div>";
                                }
                            }

                            
                            }

                ?>
                </article>
            </article>
            
        </section>
        <section class="notepad-content hidden" id="psicoDetails">
            <article class="psi-table">
                <button class="backButton backListar" id="backButtonListarPsico" onclick="voltarPsicoTable()">
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
                <div class="psi-details-paci">
                    <h1>Maria Luiza<h1>
                    <div>
                        <p>Maria@maria.com</p>
                        <p>22/03/2003<p> 
                        <p>Feminino</p>
                    </div>
                </div>
                <div class="psi-details-paci">
                    <h1>Maria Luiza<h1>
                    <div>
                        <p>Maria@maria.com</p>
                        <p>22/03/2003<p> 
                        <p>Feminino</p>
                    </div>
                </div>
                <div class="psi-details-paci">
                    <h1>Maria Luiza<h1>
                    <div>
                        <p>Maria@maria.com</p>
                        <p>22/03/2003<p> 
                        <p>Feminino</p>
                    </div>
                </div>
            </article>
        </section>
    </main>
    <script src = "../../JS/script.js"></script>
    <script src="../../JS/vanilla-tilt.js"></script>
</body>
</html>
