<?php

(include('../../../autoload.php'));

$session = new Session();


$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');
$psico_id = $session->session_get('id');

if (empty($_SESSION)) {

    header('location: ../../../../index.html');

}

?>

<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Anotações</title>
    <script src='../../JS/index.global.min.js'></script>
    <link rel="stylesheet" href="../../CSS/calendario.css">
    <link rel='stylesheet' href='../../CSS/psiPacientes.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Adicione os arquivos JavaScript do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNSG+p" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body id='body'>
    <header class='header-container'>
        <h1 onclick='location.href=psiPacientes.php'>ANOTE-ME</h1>
        <figure id='wrapperButton' class='click-perfil' onclick='ClickPerfil()'> 
            <img src='../../IMG/117104319_3204025416385100_1271061160658966926_n.jpg' alt='' class='perfil' id='first-perfil'>
        </figure> 
        <div class='click-wrapper'>
            <nav class='dados-wrapper hidden' id='wrapper-content'>
                <ul class='lista-dados'>
                    <li class='center'> <img src='../../IMG/117104319_3204025416385100_1271061160658966926_n.jpg' alt='FOTO-DE-PERFIL' class='perfil' id='second-perfil'></li>
                    <li class='center'><?php echo $nome; ?></li>
                    <div class='lista-dados-content'>
                        <li>Email : <?php echo $email; ?></li>
                        <li>Telefone : <?php echo $psico_id; ?></li>
                        <li>Responsável : </li>
                        <li>Telefone do Responsável : </li>
                        <li>Psicologo : </li>
                        <li>Clinica : </li>
                    </div>
                    
                    <li class='config-container'>
                        <a class='config-button'><img class='wrapper-icon' src='../../IMG/ico/gear-svgrepo-com.svg' title='Configurações'></a>
                        <a class='config-button' href="../../sair.php"><img class='wrapper-icon' src='../../IMG/ico/arrow-from-shape-right-svgrepo-com.svg' title='Sair'></a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <main class='notepad-container'>
        <aside class='menu-container'>
            <h1>Pacientes</h1>
            <nav class='menu'>
                <?php
                    
                    if (empty($_GET)){

                        $index = null;

                    } else {

                        $index = $_GET['paciente'];
        
                    }

                    $select = new Select_controller();
                    $patients = $select->select_user_patient($psico_id);
                    $i = 0;
                    
                    foreach ($patients as $dado)
                    {
                        if($email == $dado['email']){
                            break;
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
                    <?php   

                        if(!empty($_GET))//SÓ LISTA AS ANOTAÇÕES DO PACIENTE CLICADO
                        {

                            $email_paciente = $patients[$index]['email'];
                            $anotacoes = $select->patient_notes($psico_id, $email_paciente);

                            foreach ($anotacoes as $dado)
                            {

                                echo"<article class='activity'>";

                                    echo "<div class='activity-header'>";

                                        echo "<p>" . $dado['time'] . "</p>"; 
                                        echo "<p>" . $dado['data'] . "</p>"; 
                                       // echo "<p>16/02/2023</p>";

                                    echo "</div>";

                                    echo "<div class='activity-text'>";

                                        echo "<p>" . $dado['anotacoes'] . "</p>";

                                    echo "</div>";

                                    echo "<div class='activity-info'>";

                                        echo "<p>"."Sentindo-se: 😢 ". $dado['descricao'] ."</p>";
                                        echo "<p>Intensidade: " . $dado['intensidade']. "%". "</p> ";   

                                    echo "</div>";

                                echo "</article>";
                        }
                    }//ELE ENTRA NESSE ELSE SEMPRE QUE PASSA DO LOGIN PARA ESSA TELA, AQUI ELE LISTA TODAS AS ANOTAÇÕES DE TODOS OS PACIENTES REFERENTES AO PSICOLOGO LOGADO
                    else {
                        foreach($patients as $all)
                        {
                        echo"<article class='activity'>";

                        echo "<div class='activity-header'>";

                            echo "<p>" . $all['data_hora'] . "</p>"; 
                            echo "<p>16/02/2023</p>";

                        echo "</div>";

                        echo "<div class='activity-text'>";

                            echo "<p>" . $all['anotacoes'] . "</p>";

                        echo "</div>";

                        echo "<div class='activity-info'>";

                            echo "<p>"."Sentindo-se: 😢 ". $all['descricao'] ."</p>";
                            echo "<p>Intensidade: " . $all['intensidade']. "%". "</p> ";   

                        echo "</div>";

                    echo "</article>";
                        }
                    }

                    ?>
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

                    <article class='activity-add'>
                        <button id='activityButton' class='activity-button activity-button-plus' onclick='activityClose()' ><img src='../../IMG/ico/plus-svgrepo-com.svg'></button>

                    </article>

                    <article id='activityTable' class='activity-add-table hidden' action='' method='POST'>
                        <h2>Adicionar atividade</h2>

                        <div class='activity-add-table-left'>
                            <p>Assunto</p>
                        </div>
                        <input type='text' name='assunto'>
                        <div class='activity-add-table-left'>
                            <p>Atividade</p>
                        </div>
                        <textarea name='descricao'></textarea>
                        <input class='activity-save' type='button' value='Salvar' onclick='activityClose()'>
                        
                    </article>

                    <article class='paciente-atividade'>
                        <div class='activity'>
                            <div class='activity-header'>
                            <p>16/02/2023</p> 
                            <p>Alimentação</p>
                            <button class='activity-button' name='excluir'><img src='../../IMG/ico/trash-svgrepo-com.svg'></button>
                            </div>
                            <p class='activity-text'>Conduza sua alimentação para que seja o mais organizada possivel, se alimente 3 vezes a o dia, de manhã, a tarde e a noite, com isso terá mais energia para conduzir o dia.</p>
                        </div>
                    </article>
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
                    <div class="psicologo-agenda">
                        <div id='calendar'></div>
                    </div>
                    <div class="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Adicionar Evento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="paciente">Paciente:</label>
                                            <input type="text" class="form-control" id="paciente">
                                        </div>
                                        <div class="form-group">
                                            <label for="psicologo">Psicólogo:</label>
                                            <input type="text" class="form-control" id="psicologo">
                                        </div>
                                        <div class="form-group">
                                            <label for="data">Data:</label>
                                            <input type="date" class="form-control" id="data">
                                        </div>
                                        <div class="form-group">
                                            <label for="hora">Hora:</label>
                                            <input type="time" class="form-control" id="hora">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary id="saveButton">Salvar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </main>

    <script src='../../JS/script.js'></script>
    <script>

    document.addEventListener("DOMContentLoaded", function() {
        // cria um calendário usando o FullCalendar
        var calendarEl = document.getElementById("calendar");
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: "dayGridMonth",
            locale: "pt-br",
            selectable: true,
            select: function(info) {
            // abre o modal com o formulário de evento
            $('.modal').modal('show');

            // preenche os campos do formulário com as informações do evento selecionado
            $('#paciente').val('');
            $('#psicologo').val('');
            $('#data').val(info.startStr.substring(0, 10)); // corrigido aqui
            $('#hora').val(info.startStr.substring(11,16));
            
            // salva o evento quando o botão "Salvar" for clicado
            $('#saveButton').unbind().click(function() {
                var paciente = $('#paciente').val();
                var psicologo = $('#psicologo').val();
                var start = moment($('#data').val() + 'T' + $('#hora').val() + ':00');
                var end = start.clone().add(1, 'hours');
                var event = {
                title: paciente + ' - ' + psicologo,
                start: start.format(),
                end: end.format(),
                allDay: false
                };
                calendar.addEvent(event);
                $('.modal').modal('hide');
            });
            }
        });
  calendar.render();
});
  </script>

</body>
</html>