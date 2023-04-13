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
<html>
<head>
    <?php
        $sql = new Select_controller();
        $dados = $sql->getDados($psico_id);
    ?>
	<title>Meu perfil</title>
	<style>
		form {
			display: flex;
			flex-direction: column;
			max-width: 500px;
			margin: 0 auto;
		}
		input {
			margin-bottom: 10px;
			padding: 5px;
			border-radius: 5px;
			border: 1px solid #ccc;
		}
		button {
			padding: 10px;
			background-color: #4CAF50;
			color: white;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<h1>Bem vindo(a) <?php echo $nome ?></h1>
	<form method="POST" action="../../../controller/crud/psicologo/updatePsicologo.php">
		<label for="nome">Nome:</label>
		<input type="text" id="nome" name="nome" value="<?php echo $dados[0]['nome']?>">

		<label for="email">E-mail:</label>
		<input type="email" id="email" name="email" value="<?php echo $dados[0]['email']?>">

		<label for="senha">Senha:</label>
		<input type="password" id="senha" name="senha" value="<?php echo $dados[0]['senha']?>">

		<input type="submit" name="atualizar" value="Atualizar Perfil">
	</form>

</body>
</html>