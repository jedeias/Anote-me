<?php
(include('../../autoload.php'));

$session = new Session();
$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');
$id = $session->session_get('id');

if (empty($_SESSION)) {
    header('location: ../../../index.php');
}

$back = "$type/$type.php";

$action = '../../controller/crud/updateSizeNotes.php';

$sql = new Select();
$dados = $sql->selectPsicologo($id);
foreach($dados as $dado){
    $anotacoes = $dado['quantidade_anotacoes'];
}
$imagem = $sql->getImagem($id);

$imagem = $imagem['imagem'];

?>

<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>Meu perfil</title>
	<link rel="stylesheet" href="../CSS/atualizar_perfil.css">
</head>
<body>
	<div class="atualizar-perfil">

		<form method="POST" action=<?php echo"$action"; ?> enctype="multipart/form-data">
			<div class="name-title">Definir anotações a receber</div>
			<div class="flex">
				<div class="inputBox">

					<span>Quantidades de Anotações</span>
					<input class="box" type="number" id="sizeAnotacoes" name="sizeAnotacoes" value="<?php echo $anotacoes?>">

				</div>
			</div>
			<div class="btn-footer">
				<input class="form-btn" type="submit" value="Definir" name="atualizarSizeAnotacoes">
				<a href=<?php echo $back; ?>><button type="button" class="form-btn">Voltar</button></a>
			</div>
		</form>

		<div class="image">
			<img src="../IMG/Psicologo-Pagina-06.jpg" alt="">
		</div>
	</div>
</body>
</html>