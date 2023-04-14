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
    <?php
        $sql = new Select_controller();
        $dados = $sql->getDados($psico_id);

		var_dump($dados[0]['imagem']);
    ?>
	<title>Meu perfil</title>
	<link rel="stylesheet" href="../../CSS/atualizar_perfil.css">
</head>
<body>
	

	<div class="atualizar-perfil">
		
		<form method="POST" action="../../../controller/crud/psicologo/updatePsicologo.php" enctype="multipart/form-data">
			<h1>Bem vindo(a) <?php echo $nome ?></h1>
			 <?php 
			 if($dados[0]['imagem'] == '') {
				echo '<img src="../../IMG/default.jpg">';
			 }
			?>
			<div class="flex">
				<?php
					// if(isset($mensagem)){
					// 	fereach($mensagem as $mensagem){
					// 		echo '<div class="mensagem">'.$mensagem.'</div>';
					// 	}
					// }
				?>
				<div class="inputBox">
					<span>Nome :</span>
					<input class="box" type="text" id="nome" name="atualizar_nome" value="<?php echo $dados[0]['nome']?>">
					<span>Email :</span>
					<input class="box" type="text" id="email" name="atualizar_email" value="<?php echo $dados[0]['email']?>">
					<span>Atualizar foto :</span>
					<input class="box" type="file" name="atualizar foto" accept="image/jpg, image/jpeg, image/png">
					<span>Senha :</span>
					<input class="box" type="password" name="senha" value="<?php echo $dados[0]['senha'] ?>" placeholder="Nova senha">
				</div>
			</div>
			<input type="submit" value="atualizar perfil" name="atualizar_perfil">
			<a href="./psiPacientes.php" class="voltar">Voltar</a>
		</form>
		<div class="image">
			<img src="../../IMG/Psicologo-Pagina-06.jpg" alt="">
		</div>
		
	</div>

</body>
</html>