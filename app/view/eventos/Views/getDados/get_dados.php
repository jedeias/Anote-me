<?php
include "conn/conf.php";

// Array para armazenar os dados dos psicólogos
$psicologos = array();
$selectPsicologos = $pdo->query("SELECT pk_psicologo, nome FROM psicologo ORDER BY nome ASC");
while($dadosPsicologo = $selectPsicologos->fetch(PDO::FETCH_ASSOC)){
    $psicologo = array(
        "id" => $dadosPsicologo["pk_psicologo"],
        "nome" => $dadosPsicologo["nome"]
    );
    $psicologos[] = $psicologo;
}

// Array para armazenar os dados dos pacientes
$pacientes = array();
$selectPacientes = $pdo->query("SELECT pk_paciente, nome FROM paciente ORDER BY nome ASC");
while($dadosPaciente = $selectPacientes->fetch(PDO::FETCH_ASSOC)){
    $paciente = array(
        "id" => $dadosPaciente["pk_paciente"],
        "nome" => $dadosPaciente["nome"]
    );
    $pacientes[] = $paciente;
}

// Combina os arrays de psicólogos e pacientes em um array final
$dados = array(
    "psicologos" => $psicologos,
    "pacientes" => $pacientes
);

// Retorna os dados como JSON
echo json_encode($dados);
?>
