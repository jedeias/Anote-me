<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="app/view/CSS/login.css">
    <script src="app/view/JS/script.js"></script>
</head>

<body>

    <section class="content">
        
        <div class="logo-container">

            <div class="logo-text">
                <h1>Recuperar Senha</h1>
            </div>

            <div class="logo-image">
                
                <img class="logo" src="IMG/logo.png" alt="">
            
            </div>

        </div>
        
        <div class="login-container">
            
            <form class="login" action="app/main.php" method="POST" enctype="multipart/form-data">
                
                <h1 class="login-label">Email para recuperação de senha</h1>
                <?php
                    include("app/autoload.php");
                    $session = new Session();
                    if ($session->session_get("get_executed") == false) {
                        if(isset($_GET["invalido"])){
                            echo "<p class='invalido'>Usuario ou senha inválidos!</p>";
                        }       
                        $session->session_set("get_executed", true);
                    }
                ?>            
                <input type="text" name="email" placeholder="E-mail" class="usuario-input" required>
               
                <div class="action-button">                
                    <input type="submit" name="recuperarSenha" class="entrar-button" value="Recuperar">
                </div>
                           
            </form>

            
        
        </div>
    
    </section>

   
</body>
</html>