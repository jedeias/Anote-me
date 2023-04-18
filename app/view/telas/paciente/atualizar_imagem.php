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
	
        $sql = new Select();
        $dados = $sql->getDados($psico_id);
		$imagem = $sql->getImagem($psico_id);
		//var_dump($imagem);
    ?>
	<title>Meu Imagem</title>
	<link rel="stylesheet" href="../../CSS/atualizar_perfil.css">
</head>
<body>
	<div class="atualizar-perfil">
		<form method="POST" action="../../../controller/crud/psicologo/updateImage.php" enctype="multipart/form-data">
			<div class="name-title">Atualizar imagem</div>
			<div class="flex">
				<div class="inputBox">
					<?php if(isset($imagem['imagem']) && $imagem['imagem'] != NULL): ?>
						<img src="<?php echo $imagem['imagem'] ?>" alt="">
					<?php else: ?>
						<img class="img-default" src="../../IMG/default.jpg" alt="">
					<?php endif; ?>
					<span>Atualizar foto :</span>
					<input class="box-file" type="file" name="imagem" accept="image/jpg, image/jpeg, image/png">
				</div>
			</div>
			<div class="btn-footer">
			<input class="form-btn" type="submit" value="Atualizar Imagem" name="atualizar_imagem">
			<a href="./atualizar_registro.php"><button class="form-btn" type="button">Voltar</button></a>
			</div>
		</form>

		<div class="image">
			<img src="../../IMG/Psicologo-Pagina-06.jpg" alt="">
		</div>
	</div>
</body>
</html>