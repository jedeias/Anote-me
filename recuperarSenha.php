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
            
            <form class="login" action="app/controller/crud/updatesenha.php" method="POST" enctype="multipart/form-data">
                
                <h1 class="login-label">Recuperar Senha</h1>
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
                <input type="email" name="email" placeholder="E-mail" class="usuario-input" required>
               
                <div class="action-button">
                
                    <input type="submit" name="esqueci_senha" class="entrar-button">
                </div>
                           <div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed provident amet praesentium laboriosam optio alias. Quo accusamus, quam repellat alias ea dignissimos omnis ducimus non beatae, voluptates est atque quaerat!</p>
                           </div>
            </form>

            
        
        </div>
    
    </section>

   
</body>
</html>