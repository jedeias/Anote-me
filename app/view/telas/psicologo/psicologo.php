<?php

(include('../../../autoload.php'));

$session = new Session();


$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');
$id = $session->session_get('id');


$pegar_imagem = new Select();
$dados = $pegar_imagem->getDados($id);
$imagem = $pegar_imagem->getImagem($id);

$imagem = $imagem['imagem'];

if($nome == NULL and $email == NULL and $type == NULL){
    header("location: ../../../index.php");
}
 
if($type != "psicologo"){
     header("location: ../{$type}/{$type}.php");
}

?>

<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Anote-me</title>


    <link rel='stylesheet' href='../../CSS/bootstrap.min.css'>
    <link rel='stylesheet' href='../../CSS/main.min.css'>
    <link rel='stylesheet' href='../../CSS/psicologo.css'>
</head>
<body id='body'>
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
                    </div>
                    <li class="config-container">
                        <a class="config-button" href="../atualizar_registro.php"><img class="wrapper-icon" src="../../IMG/ico/gear-svgrepo-com.svg" title="Configurações"></a>
                        <a class="config-button" href="../../sair.php"><img class="wrapper-icon" src="../../IMG/ico/arrow-from-shape-right-svgrepo-com.svg" title="Sair"></a>
                    </li>

                </ul>
            </nav>
        </div>
    </header>    <main class='notepad-container'>
        <aside class='menu-container'>
            <h1>Pacientes</h1>
            <nav class='menu'>
                <?php

                    if (empty($_GET)){

                        $index = null;

                    } else {

                        $index = $_GET['paciente'];

                    }

                    $select = new Select();
                    $patients = $select->select_user_patient($id);
                    $i = 0; // Alguem explica esse $i = 0 ??? sendo que tem um foreach ? // what hell is going on

                    foreach ($patients as $dado)
                    {
                        if($email == $dado['email']){
                            continue;
                        }
                        echo "<article class='paciente-select' onclick=selecionarPaciente($i)>";
                        echo "<p>". $dado['nome'] . "</p>";
                        echo "<p>". $dado['email'] . "</p>";
                        $email = $dado['email'];
                        echo "</article>";
                        $i ++;

                    }
                ?>
            </nav>
        </aside>
        <section class='notepad-content'>
            <section id='pacienteAnotacaoTable' class='paciente-table show'>
                <div class='paciente-anotacoes'>
                    <article class='paciente-anotacoes-header'>
                        <button id='pacientePrevButton' onclick='pacientePrevButton()' class='paciente-prev-button'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-left-fill' viewBox='0 0 16 16'>
                                <path d='m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z'/>
                            </svg>
                        </button>
                        <h1>Anotações</h1>
                        <button id='pacienteNextButton' onclick='pacienteNextButton()' class='paciente-next-button'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-right-fill' viewBox='0 0 16 16'>
                                <path d='m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z'/>
                            </svg>
                        </button>
                    </article>
                    <div class="activity-container">
                    <?php
                        if(!empty($_GET))//SÓ LISTA AS ANOTAÇÕES DO PACIENTE CLICADO
                        {
                            $email_paciente = $patients[$index]['email'];
                            $pk_paciente = $patients[$index]['pk_paciente'];

                            $anotacoes = $select->select_notes($id, $email_paciente);

                            foreach ($anotacoes as $dado)
                            {

                                echo"<article class='activity'>";

                                    echo "<div class='activity-header'>";

                                        echo "<p>" . $dado['hora'] . "</p>";
                                        echo "<p>". $dado['data']. "</p>";

                                    echo "</div>";

                                    echo "<div class='activity-text'>";

                                        echo "<p>" . $dado['anotacao'] . "</p>";

                                    echo "</div>";

                                    echo "<div class='activity-info'>";

                                        echo "<p>Sentindo-se: ". $dado['emocao'] ."</p>";

                                        echo "<p>Intensidade: " . $dado['intensidade']. "%". "</p> ";

                                    echo "</div>";

                                echo "</article>";
                        }
                    }//ELE ENTRA NESSE ELSE SEMPRE QUE PASSA DO LOGIN PARA ESSA TELA, AQUI ELE LISTA TODAS AS ANOTAÇÕES DE TODOS OS PACIENTES REFERENTES AO PSICOLOGO LOGADO
                    else {
                        echo"<p class='sem-paciente'>Selecione um paciente para ver suas anotações.</p>";

                    }

                    ?>
                    </div>
                </div>
            </section>

            <section id='pacienteRecomendadasTable' class='paciente-table'>
                <div class='paciente-anotacoes'>
                    <article class='paciente-anotacoes-header'>
                        <button id='pacientePrevButton' onclick='pacientePrevButton()' class='paciente-prev-button'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-left-fill' viewBox='0 0 16 16'>
                                <path d='m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z'/>
                            </svg>
                        </button>
                        <h1>Atividades Recomendadas</h1>
                        <button id='pacienteNextButton' onclick='pacienteNextButton()' class='paciente-next-button'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-right-fill' viewBox='0 0 16 16'>
                                <path d='m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z'/>
                            </svg>
                        </button>
                    </article>

                    <form id='activityTable' class='activity-add-table hidden' action='../../../controller/crud/psicologo/inserteAtividade.php' method='POST'>
                        <h2>Adicionar atividade</h2>

                        <div class='activity-add-table-left'>
                            <p>Assunto</p>
                        </div>
                        <input type='text' name='assunto' required>
                        <div class='activity-add-table-left'>
                            <p>Atividade</p>
                        </div>
                        <textarea name='atividade' required></textarea>
                        <input type="hidden" value="<?php echo "$pk_paciente"; ?>" name="fk_paciente">
                        <input type="hidden" value="<?php echo "$index" ?>" name="curPaciente">
                        <input class='activity-save' type='submit' value='Salvar' onclick='activityClose()'>

                    </form>
                    <?php



                    if(!empty($_GET)){
                        echo"<article class='activity-add'>";
                        echo"<button id='activityButton' class='activity-button activity-button-plus' onclick='activityClose()' ><img src='../../IMG/ico/plus-svgrepo-com.svg'></button>";
                        echo"</article>";
                    $atividades = $select->select_atividades($id, $pk_paciente);
                    foreach ($atividades as $atividade) {
                        echo "<article class='paciente-atividade'>";
                            echo "<div class='activity'>";
                            echo "<div class='activity-header'>";
                            echo "<p>". $atividade['data'] ."</p>";
                            echo "<p>". $atividade['assunto_atividade'] . "</p>";
                            echo "<form method='POST' onsubmit='deleteAlert(event)' action='../../../controller/crud/psicologo/deleteAtividade.php'><button class='activity-button' name='excluir' value='".$atividade['pk_atividades_paciente']."'><img src='../../IMG/ico/trash-svgrepo-com.svg'></button><input type='hidden' value='$index' name='curPaciente'></form>";
                            echo "</div>";
                            echo "<p class='activity-text'>". $atividade['atividade']  ."</p>";
                            echo "</div>";
                        echo"</article>";
                    }

                    }else{
                        echo"<p class='sem-paciente'>Selecione um paciente para ver suas atividades.</p>";
                    }
                    ?>

                </div>
            </section>

            <section id='pacienteAgendaTable' class='paciente-table'>
                <div class='paciente-anotacoes'>
                    <article class='paciente-anotacoes-header'>
                        <button id='pacientePrevButton' onclick='pacientePrevButton()' class='paciente-prev-button'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-left-fill' viewBox='0 0 16 16'>
                                <path d='m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z'/>
                            </svg>
                        </button>
                        <h1>Agenda</h1>
                        <button id='pacienteNextButton' onclick='pacienteNextButton()' class='paciente-next-button'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-right-fill' viewBox='0 0 16 16'>
                                <path d='m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z'/>
                            </svg>
                        </button>
                    </article>

                    <div class="container-calendar">
                        <div id='calendar'></div>
                    </div>

                    <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header bg-info">
                                    <h5 class="modal-title" id="titulo"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <form action="" method="POST" id="formulario" autocomplete="off">
                                    <div class="modal-body">

                                        <div class="form-floating mb-3">
                                            <input type="text" list="listaPsicologos" class="form-control" id="psicologo" name="psicologo" readonly>
                                            <label for="psicologo" class="form-label">Psicólogo</label>
                                            <datalist id="listaPsicologos">

                                            </datalist>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" list="listaPacientes" class="form-control" id="paciente" name="paciente" readonly>
                                            <label for="paciente" class="form-label">Paciente</label>
                                            <datalist id="listaPacientes">

                                            </datalist>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="hidden" id="id" name="id">
                                            <input type="text" class="form-control" id="title" name="title" readonly>
                                            <label for="title" class="form-label">Evento</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="start" name="start" readonly>
                                            <label for="start" class="form-label">Data</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="time" class="form-control" id="horario" name="horario" readonly>
                                            <label for="horario" class="form-label">Horario</label>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                        $eventos = new Select();
                        $eventos->getEventosPsicologo($id);
                        //var_dump($eventos->getEventosPsicologo($id)); usado para debugar

                    ?>
                </div>
            </section>
        </section>
    </main>


    <script src='../../JS/script.js'></script>
    <script src='../../JS/bootstrap.bundle.min.js'></script>
    <script src='../../JS/main.min.js'></script>
    <script src='../../JS/pt-br.js'></script>
    <script src='../../JS/sweetalert2.all.min.js'></script>
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar'); 
        var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'listWeek',
        headerToolbar: {
            right: 'today prev next',
            left: 'dayGridMonth timeGridWeek listWeek'
        },
        locale: 'pt-br',
        themeSystem: 'bootstrap5',
        dayMaxEventRows: true,
        height: "60vh",
        events: <?php echo $eventos->getEventosPsicologo($id);?>,
        eventClick: (info) => {
        console.log(info);
        document.getElementById('titulo').textContent = 'Dados da Sessão';
        document.getElementById('id').value = info.event.id;
        document.getElementById('title').value = info.event.title;
        document.getElementById('start').value = info.event.startStr;
        document.getElementById('psicologo').value = info.event.extendedProps.psicologo;
        document.getElementById('paciente').value = info.event.extendedProps.paciente;
        armazenarHorario = info.event.extendedProps.horario;
        document.getElementById('horario').value = armazenarHorario;
        myModal.show();
    }
    });
    calendar.render();
    });

    </script>
</body>
    
</html>