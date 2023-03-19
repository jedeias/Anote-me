<?php
include 'connect.php';

if(isset($_POST['salvar']) == true) {

    date_default_timezone_set('America/Sao_Paulo');

    $TextoUsuario = $_POST['texto'];
    $datetime = date("d/m/Y H:i");
    $id = $_POST['salvar'];


    $conn->query("INSERT INTO anotacoes_paciente (anotacoes, data_hora) VALUES('$TextoUsuario', '$datetime')");

    header("Refresh: 0, url='../Main/Usuario/anotacoes/anotacoes.php'");


}
else {
    echo "<script>alert('Erro ao enviar anotação');</script>";
    header("Refresh: 0, url='../Main/Usuario/anotacoes/anotacoes.php'");
}

?>