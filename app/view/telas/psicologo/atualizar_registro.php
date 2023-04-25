<?php
(include('../../../autoload.php'));

$session = new Session();
$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');
$id = $session->session_get('id');

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
        $dados = $sql->getDados($id);
		$imagem = $sql->getImagem($id);

    ?>
	<title>Meu perfil</title>
	<link rel="stylesheet" href="../../CSS/atualizar_perfil.css">
</head>
<body>
	<div class="atualizar-perfil">

		<form method="POST" action="../../../controller/crud/psicologo/updatePsicologo.php" enctype="multipart/form-data">
			<div class="name-title">Bem vindo(a) <?php echo $nome ?></div>
			<div class="flex">
				<div class="inputBox">
					<?php if(isset($imagem['imagem']) && $imagem['imagem'] != NULL): ?>
						<a class="img-img" href="./atualizar_imagem.php">
							<img src="<?php echo $imagem['imagem'] ?>" alt="">
							<p class="img-hover">Atualizar imagem</p>
						</a>
					<?php else: ?>
					<a class="img-img" href="./atualizar_imagem.php">
						<img class="img-default" src="../../IMG/default.jpg" alt="">
						<p class="img-hover">Atualizar imagem</p>
					</a>
					<?php endif; ?>
					<span>Nome</span>
					<input class="box" type="text" id="nome" name="atualizar_nome" value="<?php echo $dados[0]['nome']?>">
					<span>Email</span>
					<input class="box" type="text" id="telefone" name="atualizar_telefone" value="<?php echo $dados[0]['numero']?>">
					<span>Senha</span>
					<input class="box" type="password" name="senha" value="<?php echo $dados[0]['senha'] ?>" placeholder="Nova senha">
				</div>
			</div>
			<div class="btn-footer">
				<input class="form-btn" type="submit" value="Atualizar Dados" name="atualizar_perfil">
				<a href="./psiPacientes.php"><button type="button" class="form-btn">Voltar</button></a>
			</div>
		</form>

		<div class="image">
			<img src="../../IMG/Psicologo-Pagina-06.jpg" alt="">
		</div>
	</div>
</body>
</html>