<?php

$email = $_GET['email'];
$tipo = $_GET['tipo'];
$parteURLCriptografada = $_GET['parte'];

$chave = "minhachave123456";

$parteURLDecodificada = openssl_decrypt(base64_decode($parteURLCriptografada), 'AES-256-CBC', $chave, 0, substr($chave, 0, 16));

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir senha</title>
    <link rel="stylesheet" href="../CSS/login.css">
    <script src="../JS/script.js"></script>
</head>
<body>
   <section class="content">

       <div class="logo-container">
            <div class="logo-text">
                <h1>Recuperar Senha</h1>
            </div>
    
            <div class="logo-image">
                <img class="logo" src="../IMG/logo.png" alt="">       
            </div>
       </div>

        <div class="login-container">

            <form action="../../controller/crud/updatesenha.php" method="post" enctype="multipart/form-data" class="login">
                <label for="codigo">Digite o código de segurança</label>
                <input type="number" name="real_code" id="codigo" class="usuario-input" required>
                <label for="senha">Digite sua nova senha: </label>
                <input type="hidden" name="tipo" value="<?php echo $tipo; ?>">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input type="hidden" name="code" value="<?php echo $parteURLDecodificada; ?>">
                <input type="password" name="senha" id="senha" class="usuario-input" required>
                <input type="submit" name="enviar" id="enviar" class="entrar-button">
            </form> 

        </div>

   </section>
</body>
</html>

