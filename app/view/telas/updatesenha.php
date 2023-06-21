<?php

$email = $_GET['email'];
$tipo = $_GET['tipo'];

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="../../controller/crud/updatesenha.php" method="post">
        <label for="codigo">Digite o código de segurança</label>
        <input type="number" name="real_code" id="codigo">
        <label for="senha">Digite sua nova senha: </label>
        <input type="hidden" name="tipo" value="<?php echo $tipo; ?>">
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        <input type="password" name="senha" id="senha">
        <input type="submit" name="enviar" id="enviar">
    </form> 
</body>
</html>

