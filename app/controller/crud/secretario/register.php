<?php

echo "<pre>";
print_r($_POST);

$nome = $_POST['nome'];
$sobreNome = $_POST['sobrenome'];
$email = $_POST['email'];
$RG = $_POST['RG'];
$CPF = $_POST['CPF'];
$dataNasc = $_POST['data-nasc'];
$cep = $_POST['cep'];
$rua = $_POST['rua'];
$bairro = $_POST['bairro'];
$casaNum = $_POST['casaNum'];
$complemento = $_POST['complemento'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$senha = $_POST['senha'];
$confirmarSenha = $_POST['confirmarSenha'];

$psicologo = new Pessoas($nome, $RG, $cpf, $sexo, $email, $senha, $data);

?>