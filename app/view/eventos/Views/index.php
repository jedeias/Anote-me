<?php
    
    include("../../autoload.php");

    $session = new Session();

    $nome = $session->session_get('nome');
    $email = $session->session_get('email');
    $type = $session->session_get('type');
    $paci_id = $session->session_get('id');
    $psico_id = $session->session_get('fk_psicologo');

    if($nome == NULL and $email == NULL and $type == NULL){
        header("location: ../../../index.php");
    }

    if($type != "secretario"){
        header("location: ../{$type}/{$type}.php");
    }


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?php echo base_url;?>Assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url;?>Assets/css/main.min.css" rel="stylesheet">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <link rel="stylesheet" href="../CSS/calendario.css">
    <title>ANOTE-ME</title>
    <style>

        html{
            height: 100%;
        }
        body{
            background-image: linear-gradient(120deg, #00002F 0%, #062156 100%);
            height: 100%;
        }
        #style-calendar{
            
        }
        .container{
            max-height: 1000px;
            width: 1000px;
            margin: 0 auto;
            
        }
        #calendar{
            background-color: white;
            padding: 50px;
            border-radius: 10px;
            height: 100%;
        }

        @media screen and (max-width: 600px){
            .agendar{
                font-size:10px;
            }

            .container{
                width:100%;
            }

            #calendar{
                padding:5%;
            }

            .fc .fc-toolbar button{
                width:40px;
                font-size:11px;
            }

         

        }
      
    </style>
   
  </head>
  <body>
    <div class="agendar" title="voltar">
        <a href="../telas/secretario/secretario.php">
        <button class="backButton">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
            </svg>
        </button>
        <h1>ANOTE-ME</h1>
        </a>
        <h1>Agendar Consulta</h1>

    </div>
    <section id="style-calendar">
        <div class="container">
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
                    <form action="" id="formulario" autocomplete="off">
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input type="text" list="listaPsicologos" class="form-control" id="psicologo" name="psicologo" onclick="obterIdPsicologo()">
                                <label for="psicologo" class="form-label">Psicólogo</label>
                                <datalist id="listaPsicologos">
                                    <?php
                                        include "conn/conf.php";
                                        $select = $pdo->query("SELECT psicologo.pk_psicologo, nome FROM psicologo ORDER BY nome ASC");
                                        while($dadosPsicologo = $select->fetch(PDO::FETCH_ASSOC)){
                                            echo "<option value='". $dadosPsicologo["nome"] ."' data-id='". $dadosPsicologo["pk_psicologo"]."'>" . $dadosPsicologo["nome"]. "</option>";
                                        }
                                    ?>
                                </datalist>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" list="listaPacientes" class="form-control" id="paciente" name="paciente" onclick="obterIdPaciente()">
                                <label for="paciente" class="form-label">Paciente</label>
                                <datalist id="listaPacientes">
                                    <?php
                                        include "conn/conf.php";
                                        $select = $pdo->query("SELECT paciente.pk_paciente, nome FROM paciente ORDER BY nome ASC");
                                        while($dadosPaciente = $select->fetch(PDO::FETCH_ASSOC)){
                                            echo "<option value='". $dadosPaciente["nome"]."' data-id='". $dadosPaciente["pk_paciente"]."'>" . $dadosPaciente["nome"] . "</option>";
                                        }
                                    ?>
                                </datalist>
                            </div>
        
                            <div class="form-floating mb-3">
                                <input type="hidden" id="id" name="id">
                                <input type="text" class="form-control" id="title" name="title">
                                <label for="title" class="form-label">Evento</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="start" name="start">
                                <label for="start" class="form-label">Data</label>
                            </div>
                            <div class="form-floating mb-3">
                                    <input type="time" class="form-control" id="horario" name="horario">
                                    <label for="horario" class="form-label">Horario</label>
                                </div>
                            <div class="form-floating mb-3">
                                <input type="color" class="form-control" id="color" name="color" value="#0d6efd">
                                <label for="color" class="form-label">Cor</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-warning" type="button" data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-danger" id="btnApagar"  type="button">Apagar</button>
                            <button class="btn btn-info" id="btnAcao" type="submit">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="<?php echo base_url;?>Assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url;?>Assets/js/main.min.js"></script>
    <script src="<?php echo base_url;?>Assets/js/moment.js"></script>
    <script src="<?php echo base_url;?>Assets/js/sweetalert2.all.min.js"></script>
    <script src="<?php echo base_url;?>Assets/js/pt-br.js"></script>
    <script>
        const base_url = '<?php echo base_url;?>';
    </script>
    <script src="<?php echo base_url;?>Assets/js/app.js"></script>

    
  </body>
</html>