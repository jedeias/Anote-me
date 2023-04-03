<?php

include("../../../autoload.php");

$session = new Session_controller();

$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');


if (empty($_SESSION)) {

    header("location: ../../../../index.html");

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anotações</title>
    <link rel="stylesheet" href="../../CSS/psiPacientes.css">
</head>
<body id="body">
    <header class="header-container">
        <h1>ANOTE-ME</h1>
        <figure id="wrapperButton" class="click-perfil" onclick="ClickPerfil()"> 
            <img src="../../IMG/117104319_3204025416385100_1271061160658966926_n.jpg" alt="" class="perfil" id="first-perfil">
        </figure> 
        <div class="click-wrapper">
            <nav class="dados-wrapper hidden" id="wrapper-content">
                <ul class="lista-dados">
                    <li class="center"> <img src="../../IMG/117104319_3204025416385100_1271061160658966926_n.jpg" alt="FOTO-DE-PERFIL" class="perfil" id="second-perfil"></li>
                    <li class="center"><?php echo $nome; ?></li>
                    <div class="lista-dados-content">
                        <li>Email : <?php echo $email; ?></li>
                        <li>Telefone :</li>
                        <li>Responsável : </li>
                        <li>Telefone do Responsável : </li>
                        <li>Psicologo : </li>
                        <li>Clinica : </li>
                    </div>
                    
                    <li class="config-container">
                        <a class="config-button"><img class="wrapper-icon" src="../../IMG/ico/gear-svgrepo-com.svg" title="Configurações"></a>
                        <a class="config-button"><img class="wrapper-icon" src="../../IMG/ico/arrow-from-shape-right-svgrepo-com.svg" title="Sair"></a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="notepad-container">
        <aside class="menu-container">
            <h1>Pacientes</h1>
            <nav class="menu">
                <article class="paciente-select">
                    <p>Jose toledo da Silva</p>
                    <p>Josetoledo@gmail.com</p>
                    <p>40 anos</p>
                    <hr>
                </article>
                <article class="paciente-select">
                    <p>Jose toledo da Silva</p>
                    <p>Josetoledo@gmail.com</p>
                    <p>40 anos</p>
                    <hr>
                </article>
                <article class="paciente-select">
                    <p>Jose toledo da Silva</p>
                    <p>Josetoledo@gmail.com</p>
                    <p>40 anos</p>
                    <hr>
                </article>
            </nav>
        </aside>
        <section class="notepad-content">
            <section id="pacienteAnotacaoTable" class="paciente-table show">
                <div class="paciente-anotacoes">
                    <article class="paciente-anotacoes-header">
                        <button id="pacientePrevButton" onclick="pacientePrevButton()" class="paciente-prev-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                            </svg>                            
                        </button>
                        <h1>Anotações</h1>
                        <button id="pacienteNextButton" onclick="pacienteNextButton()" class="paciente-next-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                            </svg>
                        </button>
                    </article>
                    <article class="activity">
                        <div class="activity-header">
                        <p>18:32</p> 
                        <p>16/02/2023</p>
                        </div>
                        <div class="activity-text">
                            <p>Hoje nao estou me sentindo muito bem.</p>
                        </div>
                        <div class="activity-info">
                            <p>Sentindo-se: Triste 😢</p>
                            <p>Intensidade: 50%</p>       
                        </div>
                    </article>

                    <article class="activity">
                        <div class="activity-header">
                        <p>18:32</p> 
                        <p>16/02/2023</p>
                        </div>
                        <div class="activity-text">
                            <p>Hoje nao estou me sentindo muito bem.</p>
                        </div>
                        <div class="activity-info">
                            <p>Sentindo-se: Triste 😢</p>
                            <p>Intensidade: 50%</p>       
                        </div>
                    </article>

                    <article class="activity">
                        <div class="activity-header">
                        <p>18:32</p> 
                        <p>16/02/2023</p>
                        </div>
                        <div class="activity-text">
                            <p>Hoje nao estou me sentindo muito bem.</p>
                        </div>
                        <div class="activity-info">
                            <p>Sentindo-se: Triste 😢</p>
                            <p>Intensidade: 50%</p>       
                        </div>
                    </article>
                </div>
            </section>

            <section id="pacienteRecomendadasTable" class="paciente-table">
                <div class="paciente-anotacoes">
                    <article class="paciente-anotacoes-header">
                        <button id="pacientePrevButton" onclick="pacientePrevButton()" class="paciente-prev-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                            </svg>                            
                        </button>
                        <h1>Atividades Recomendadas</h1>
                        <button id="pacienteNextButton" onclick="pacienteNextButton()" class="paciente-next-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                            </svg>
                        </button>
                    </article>

                    <article class="activity-add">
                        <button id="activityButton" class="activity-button activity-button-plus" onclick="activityClose()" ><img src="../../IMG/ico/plus-svgrepo-com.svg"></button>

                    </article>

                    <article id="activityTable" class="activity-add-table hidden" action="" method="POST">
                        <h2>Adicionar atividade</h2>

                        <div class="activity-add-table-left">
                            <p>Assunto</p>
                        </div>
                        <input type="text" name="assunto">
                        <div class="activity-add-table-left">
                            <p>Atividade</p>
                        </div>
                        <textarea name="descricao"></textarea>
                        <input class="activity-save" type="button" value="Salvar" onclick="activityClose()">
                        
                    </article>

                    <article class="paciente-atividade">
                        <div class="activity">
                            <div class="activity-header">
                            <p>16/02/2023</p> 
                            <p>Alimentação</p>
                            <button class="activity-button" name="excluir"><img src="../../IMG/ico/trash-svgrepo-com.svg"></button>
                            </div>
                            <p class="activity-text">Conduza sua alimentação para que seja o mais organizada possivel, se alimente 3 vezes a o dia, de manhã, a tarde e a noite, com isso terá mais energia para conduzir o dia.</p>
                        </div>
                    </article>
                </div>
            </section>

            <section id="pacienteAgendaTable" class="paciente-table">
                <div class="paciente-anotacoes">
                    <article class="paciente-anotacoes-header">
                        <button id="pacientePrevButton" onclick="pacientePrevButton()" class="paciente-prev-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                            </svg>                            
                        </button>
                        <h1>Agenda</h1>
                        <button id="pacienteNextButton" onclick="pacienteNextButton()" class="paciente-next-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                            </svg>
                        </button>
                    </article>
                    <div class="paciente-atividade">
                        <h1>TESTE3</h1>
                    </div>
                </div>
            </section>
        </section>
    </main>
    <script src = "../../JS/script.js"> </script>
</body>
</html>