<?php

include("../../../autoload.php");


$session = new Session();

$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');
$paciente_id = $session->session_get('id');
$id = $session->session_get('fk_psicologo');

$pegar_imagem = new Select();
$imagem = $pegar_imagem->getImagem($paciente_id);

$imagem = $imagem['imagem'];

if($nome == NULL and $email == NULL and $type == NULL){
   header("location: ../../../index.php");
}

?>

<!DOCTYPE html>
<html lang='pt-br'>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
  <link rel='stylesheet' href='../../CSS/bootstrap.min.css'>
  <link rel='stylesheet' href='../../CSS/main.min.css'>
  <link rel="stylesheet" href="../../CSS/calendario.css">
</head>
<body>
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
                        <li class="dados-title">tipo de usuário : <?php echo "$type"; ?> </li>
                        <hr>
                    </div>
                    <li class="config-container">
                        <a class="config-button" href="../atualizar_registro.php"><img class="wrapper-icon" src="../../IMG/ico/gear-svgrepo-com.svg" title="Configurações"></a>
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
                <a href="paciente.php">
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
      <section class="notepad-content">
        <section class="section-calendar">
          <div class="container">
            <div id="calendar"></div>
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
                $eventos->getEventosPaciente($id);?>
        </section>
      </section>  
  </section>  

<script src="../../JS/script.js"></script>
<script src='../../JS/bootstrap.bundle.min.js'></script> 
<script src='../../JS/main.min.js'></script>
<script src='../../JS/pt-br.js'></script>
<script src='../../JS/sweetalert2.all.min.js'></script>
<script>
    var myModal = new bootstrap.Modal(document.getElementById('myModal'));
    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    headerToolbar: {
        right: 'today prev next',
        left: 'dayGridMonth timeGridWeek listWeek'
    },
    locale: 'pt-br',
    themeSystem: 'bootstrap5',
    dayMaxEventRows: true,
    events: <?php echo $eventos->getEventosPaciente($id);?>,
    height: 700,
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