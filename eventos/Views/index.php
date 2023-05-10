<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?php echo base_url;?>Assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url;?>Assets/css/main.min.css" rel="stylesheet">

    <title>Hello, world!</title>
  </head>
  <body>
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

                <form action="" id="formulario">
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" id="id" name="id">
                            <input type="text" class="form-control" id="title" name="title">
                            <label for="title" class="form-label">Evento</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="start" name="start">
                            <label for="start" class="form-label">Data</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="color" class="form-control" id="color" name="color">
                            <label for="color" class="form-label">Cor</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-warning">Cancelar</button>
                        <button class="btn btn-danger" id="btnEditar"  type="button">Apagar</button>
                        <button class="btn btn-info" id="btnAcao" type="submit">Registrar</button>
                    </div>
                </form> 

            </div>
        </div>
    </div>

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