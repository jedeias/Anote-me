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
                        <li class="dados-title">Email</li>
                        <li><?php echo $email; ?></li>
                        <hr>
                        <li class="dados-title">Telefone</li>
                        <li><?php echo $dados[0]['numero']; ?></li>
                        <hr>
                       
                    </div>
                    <li class="config-container">
                        <a class="config-button" href="../atualizar_registro.php"><img class="wrapper-icon" src="../../IMG/ico/gear-svgrepo-com.svg" title="Configurações"></a>
                        <a class="config-button" href="../../sair.php"><img class="wrapper-icon" src="../../IMG/ico/arrow-from-shape-right-svgrepo-com.svg" title="Sair"></a>
                    </li>
                
                </ul>
            </nav>
        </div>
    </header>    <main class="notepad-container">
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
        
        <section class="notepad-content">
            <article class="psi-table">
            <?php
                    $select = new Select();
                    $pacientes = $select->selectPacientes();

                    if(empty($_GET)){
                        echo "<header class='psi-paci-header-text'>";
                        echo "<h1>Pacientes</h1>";
                        echo "<input type='text' id='paciSearchBar' placeholder='Pesquisar Paciente' class='psi-search-bar' onkeyup='searchPaci()'>";
                        echo "</header>";
                        echo "<article class='article-grid-list' id='paciCardsScroll'>";
                        foreach($pacientes as $paciente){
                             $imagemSrc = $paciente['imagem'];
                             if($paciente['Sexo'] == 'M'){
                                $sexo = "Masculino";
                             } elseif ($paciente['Sexo'] == 'F'){
                                $sexo = "Feminino";
                             } else {
                                $sexo = "Indefinido";
                             }
                            if($imagemSrc == null){
                                $imagem = "../../IMG/default.jpg";
                            } else {
                                $imagem = $imagemSrc;
                            }
                            echo "<section class='psi-paci-list' data-tilt data-tilt-scale='1.05' data-tilt-reverse data-nome='".$paciente['nome']."' onclick='clickPaciCard(".$paciente['pk_paciente'].")' id='paciCard".$paciente['pk_paciente']."')'>";
                            echo "<img class='psi-paci-img' src='".$imagem."' alt='foto de perfil'>";
                            echo "<h1>".$paciente['nome']."</h1>";
                            echo "<div class='psi-paci-text-div paci-info-list'>";
                            echo "<h1>Email</h1>";
                            echo "<p>".$paciente['email']."</p>";
                            echo "<h1>RG</h1>";
                            echo "<p>".$paciente['RG']."</p>";
                            echo "<h1>CPF</h1>";
                            echo "<p>".$paciente['CPF']."</p>";
                            echo "<h1>Sexo</h1>";
                            echo "<p>".$sexo."</p>";
                            echo "<h1>Data de Nascimento</h1>";
                            echo "<p>".$paciente['data_nasc']."</p>";
                            echo "</div>";
                            echo "</section>";
                        }

                    } else {
                        $paciDetailsId = $_GET['paciId'];
                        $paciente = $select->selectPaciente($paciDetailsId);
                        foreach($paciente as $dado){
                            $psicologoInfo = $select->selectPsicologo($dado['fk_psicologo']);
                            foreach($psicologoInfo as $psicologo){
                                $psicologoNome = $psicologo['nome'];
                            }
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
                        echo "<button class='backButton backListar' id='backButtonListarPsico' onclick='voltarPaciTable()'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' fill='currentColor' class='bi bi-caret-left-fill' viewBox='0 0 16 16'>
                                    <path d='m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z'/>
                                </svg>
                              </button>
    
                              <div class='listar-psi-paci big-div'>
                                <img class='psi-paci-img' src=".$imagem." alt='foto de perfil'>
                                <h1>".$nome."</h1>
                                <p>Paciente</p>
                                <div class='listar-psi-paci-info big-div'>
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
                                        <p class='info-title'>Psicologo Responsável:</p>
                                        <p>".$psicologoNome."</p>
                                        <button class='editPsicoButton' id='editPsicoButton' onclick='editPsico()' title='Editar Psicologo'><img src='../../IMG/ico/pencil-svgrepo-com.svg'></button>
                                    </div>
                                    <div class='info-container'>
                                        <p class='info-title'>Data de Nascimento:</p>
                                        <p>".$data_nasc."</p>
                                    </div>
                                </div>
                              </div>";
                        $psicologos = $select->selectPsicologos();
                        echo "<form onsubmit='confirmEditarPsico()' class='editPsicoTable hidden' id='editPsicoTable' method='POST' action='../../../controller/crud/secretario/trocarPsicologo.php'>
                                <div>
                                <h1>Mudar Psicologo</h1>
                                <select id='mudarPsicoSelect' name='psicoId' required>
                                <option value='' selected disabled hidden>Escolha o psicologo desejado</option>";

                        foreach($psicologos as $psicologo){
                            echo "<option value='".$psicologo['pk_psicologo']."'>".$psicologo['nome']."</option>";
                        }
                        echo  "</select>
                               </div>
                                <input type='hidden' name='paciId' value='".$paciDetailsId."'>
                                <button class='editPsicoTableButton'>Trocar Psicologo</button>
                              </form>";
                            
                            }

                ?>
                
            </article>
            
        </section>
    </main>
    <script src = "../../JS/script.js"></script>
    <script src="../../JS/vanilla-tilt.js"></script>
</body>
</html>