<?php

include("../../../autoload.php");


$session = new Session();


$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');
$id = $session->session_get('id');

$selecionar = new Select();
$dados = $selecionar->getDados($id);
$pegar_imagem = new Select();
$imagem = $pegar_imagem->getImagem($id);

$imagem = $imagem['imagem'];

if($nome == NULL and $email == NULL and $type == NULL){
   header("location: ../../../index.php");
}

?>

<?php

//valores pre setados com o intuito de teste.


    $_POST = array(
        //paciente
        "nome" => "João",
        "sobrenome" => "Silva",
        "email" => "joao.silva@example.com",
        "RG" => "123456",
        "CPF" => "111.222.333-4",
        "data-nasc" => "01/01/2000",
        "sexo" => "M",
        "senha" => "123456",
        "confirmarSenha" => "123456",
        
        //telefone
        "telefone" => "(11) 99999-999",
        
        //endereço
        "cep" => "01234-567",
        "rua" => "Rua Teste",
        "bairro" => "Bairro Teste",
        "casaNum" => "123",
        "complemento" => "Apartamento 123",
        "estado" => "SP",
        "cidade" => "São Paulo",
        
        "responsavelBox" => "on",
        
        //responsavel
        "resNome" => "Maria",
        "resSobrenome" => "Silva",
        "resEmail" => "maria.silva@example.com",
        "resRG" => "654321",
        "resCPF" => "111.222.333-0",
        "resTelefone" => "(11) 98888-8888"
            
        );

    
    if($_POST == true){
        
        $insert = new Crud();
        
        $insert->insertPaciente($_POST);
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anotações</title>
    <link rel="stylesheet" href="../../CSS/secretaria.css">
</head>
<body id="body">
<header class="header-container">
        <h1>ANOTE-ME</h1>
        <figure id="wrapperButton" class="click-perfil" onclick="ClickPerfil()"> 
            <?php if(isset($imagem) && $imagem != NULL): ?>
                <img src="<?php echo "../../IMG/imagem_perfil/$imagem"; ?>" alt="" class='perfil' id='first-perfil'>
            <?php else: ?>
                <img src="../../IMG/default.jpg" alt="" class='perfil'>
            <?php endif; ?>
        </figure> 
        <div class="click-wrapper">
            <nav class="dados-wrapper hidden" id="wrapper-content">
                <ul class="lista-dados">

                    <li class="center"> 
                        <?php if(isset($imagem) && $imagem != NULL): ?>
                            <img src="<?php echo "../../IMG/imagem_perfil/$imagem"; ?>" alt="FOTO-DE-PERFIL" class='perfil' id='second-perfil'>
                        <?php else: ?>
                            <img src="../../IMG/default.jpg" alt="" class='perfil'>
                        <?php endif; ?>
                    </li>
                    <li class="center"><?php echo "$nome"; ?></li>
                    <div class='lista-dados-content'>
                        <li>Email : <?php echo $email; ?></li>
                        <li>Telefone :</li>
                        <li>Clinica : </li>
                    </div>
                    <li class="config-container">
                        <a class="config-button" href="../atualizar_registro.php"><img class="wrapper-icon" src="../../IMG/ico/gear-svgrepo-com.svg" title="Configurações"></a>
                        <a class="config-button" href="../../sair.php"><img class="wrapper-icon" src="../../IMG/ico/arrow-from-shape-right-svgrepo-com.svg" title="Sair"></a>
                    </li>
                
                </ul>
            </nav>
        </div>
    </header>
    <main class="notepad-container">
        <aside class="menu-container">
            <nav class="menu">
                <ul>
                    <a href="secreCadastro.php">
                        <li>
                            <p>Cadastro</p>
                        </li>
                    </a>  

                    <a href="secreListarPsico.php">
                        <li>
                            <p>Psicologos</p>
                        </li>
                    </a> 

                <a href="secreListarPaci.php">
                        <li>
                            <p>Pacientes</p>
                        </li>
                    </a> 
                    
                </ul>
            </nav>        
        </aside>
        <section class="notepad-content">
            <article class="psi-table">
                <header class="psi-paci-header-text">
                    <h1>Psicologos</h1>
                </header>
                <article class="article-grid-list">
                    <section class="psi-paci-list">
                        <div class="psi-paci-text-div">
                            <p>nome: cleitin </p>
                            <p>Data_Nasc: sei la</p>
                            <p>test: teste</p>
                            <p>test: teste</p>
                        </div>
                    </section>
                    
                    <section class="psi-paci-list">
                        <div class="psi-paci-text-div">
                            <p>nome: junin </p>
                            <p>Data_Nasc: sei la</p>
                            <p>test: teste</p>
                            <p>test: teste</p>
                        </div>
                    </section>

                </article>
            </article>

        </section>

    </main>
    <script src = "../../JS/script.js"> </script>
    <script src = "../../JS/cep.js"> </script>
</body>
</html>