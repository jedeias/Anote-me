<?php

include("../../../autoload.php");


$session = new Session();

$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');


if($nome == NULL and $email == NULL and $type == NULL){
   header("location: ../../sair.php");
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
            <img src="../../IMG/117104319_3204025416385100_1271061160658966926_n.jpg" alt="" class="perfil" id="first-perfil">
        </figure> 
        <div class="click-wrapper">
            <nav class="dados-wrapper hidden" id="wrapper-content">
                <ul class="lista-dados">
                    <li class="center"> <img src="../../IMG/117104319_3204025416385100_1271061160658966926_n.jpg" alt="FOTO-DE-PERFIL" class="perfil" id="second-perfil"></li>
                    <li class="center"><?php echo $nome; ?></li>
                    <div class="lista-dados-content">
                        <li>Email : <?php echo $email; ?></li>
                        <li>Telefone :</li>
                        <li>Responsável : </li>
                        <li>Telefone do Responsável : </li>
                        <li>Psicologo : </li>
                        <li>Clinica : </li>
                    </div>
                    
                    <li class="config-container">
                        <a class="config-button"><img class="wrapper-icon" src="../../IMG/ico/gear-svgrepo-com.svg" title="Configurações"></a>
                        <a class="config-button"><img class="wrapper-icon" src="../../IMG/ico/arrow-from-shape-right-svgrepo-com.svg" title="Sair"></a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="notepad-container">
        <aside class="menu-container">
            <nav class="menu">
                <ul>
                    <a href="secreCadastro.html">
                        <li>
                            <p>Cadastro</p>
                        </li>
                    </a>  

                    <a href="secrePsicologos.html">
                        <li>
                            <p>Psicologos</p>
                        </li>
                    </a> 

                    <a href="secrePacientes.html">
                        <li>
                            <p>Pacientes</p>
                        </li>
                    </a> 
                    
                </ul>
            </nav>        
        </aside>
        <section class="notepad-content">

            <article class="cadastro-table show" id="cadastroTable">
                <button class="cadastro-button" onclick="pacienteButton()">
                    <h1>Cadastrar Paciente</h1>
                </button>
                <button class="cadastro-button" onclick="psicologoButton()">
                    <h1>Cadastrar Psicologo</h1>
                </button>
            </article>

            <article class="cadastro-table" id="cadastroPacienteTable">
                <button class="backButton" id="backButtonPaciente">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                    </svg>
                </button>
                <form class="paciente-cadastro">
                    <h2 class="title-paci">Cadastro do paciente</h2>
                    <label for="nome"></label>
                    <input type="text" name="nome" placeholder="Nome do Paciente:">
                    <label for="email"></label>
                    <label for="RG"></label>
                    <input type="text" name="RG" placeholder="RG:">
                    <label for="Cpf"></label>
                    <input type="number" name="cpf" placeholder="CPF:">
                    <label for="sexo"></label>
                    <select name="sexo" id="" >
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                    <label for="data_naci"></label>
                    <input type="date" name="" id="" placeholder="Data de Nascimento">
                    <input type="email" name="email" placeholder="Email:">
                    <label for="senha"></label>
                    <input type="password" name="senha" placeholder="Senha:">
                    <br>
                    <h2>Informações do Responsavel</h2>
                    <label for="nome"></label>
                    <input type="text" name="nome" placeholder="Nome do Responsavel:">
                    <label for="rg"></label>
                    <input type="text" name="rg" placeholder="RG do Responsavel:">
                    <label for="cpf"></label>
                    <input type="text" name="cpf" placeholder="CPF do Responsavel:">
                    <label for="email"></label>
                    <input type="text" name="email" placeholder="Email do Responsavel:">
                    <br>
                    <h2>Informações de Contato</h2>
                    <br>
                    <h1>Contato Responsavel:</h1>
                    <label for="ddi"></label>
                    <input type="number" name="ddi" placeholder="DDI Ex: +55">
                    <label for="telefone"></label>
                    <input type="number" name="telefone" id="telefone" placeholder="Numero do Resposavel, Ex: (11) 91234-1234" maxlength="15">
                    <br>
                    <h1>Contato Paciente:</h1>
                    <br>
                    <label for="ddi"></label>
                    <input type="number" name="ddi" placeholder="DDI Ex: +55">
                    <label for="telefone"></label>
                    <input type="number" name="telefone" id="telefone" placeholder="Numero do Paciente, Ex: (11) 91234-1234" maxlength="15">
                    <br>
                    <h2>Endereço</h2>
                    <br>
                    <label for="rua"></label>
                    <input type="text" name="rua" placeholder="Rua:">
                    <label for="numerocasa"></label>
                    <input type="text" name="numerocasa" placeholder="numero:">
                    <label for="bairro"></label>
                    <input type="text" name="bairro" placeholder="bairro:">
                    <label for="cep"></label>
                    <input type="number" name="cep" placeholder="CEP:">
                    <label for="cidade"></label>
                    <input type="text" name="cidade" placeholder="Cidade:">
                    <label for="estado"></label>
                    <input type="text" name="estado" placeholder="Estado:">
                    <label for="complemento"></label>
                    <input type="text" name="estado" placeholder="Complemento: Ex: comdominio jorge, Bloco 2, etc">
                    <br>

                    <div class="action-button-container">
                        <button class="action-button">Descartar</button>
                        <button class="action-button" type="submit" name="salvar">Salvar</button>
                    </div>
                </form>
            </article>

            <article class="cadastro-table" id="psicologoCadastroTable">
                <button class="backButton" id="backButtonPsicologo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                    </svg>
                </button>
                <form class="psicologo-cadastro">
                    <h2 class="title-psi">Cadastro do Psicológo</h2>
                    <label for="nome" ></label>
                    <input type="text" name="nome" placeholder="Nome:">
                    <label for="email"></label>
                    <input type="email" name="email"p placeholder="Email:">
                    <label for="senha"></label>
                    <input type="password" name="senha" placeholder="Senha:">
                    <label for="RG"></label>
                    <input type="text" name="RG" placeholder="RG:">
                    <label for="CPF"></label>
                    <input type="Number" name="CPF" placeholder="CPF:">
                    <label for="CRP"></label>
                    <input type="text" name="CRP" placeholder="Crp:">
                    <label for="sexo"></label>
                    <select name="sexo" id="">
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                    <label for="data_naci"></label>
                    <input type="date" name="" id="" placeholder="Data de Nascimento">
                    <br>
                    <h2>Informações de Contato:</h2>
                    <br>
                    <label for="ddi"></label>
                    <input type="number" name="ddi" placeholder="DDI Ex: +55">
                    <label for="telefone"></label>
                    <input type="number" name="telefone" id="telefone" placeholder="Numero do Paciente, Ex: (11) 91234-1234" maxlength="15">
                    <br>
                    <h2>Endereço:</h2>
                    <br>
                    <label for="rua"></label>
                    <input type="text" name="rua" placeholder="Rua:">
                    <label for="numerocasa"></label>
                    <input type="text" name="numerocasa" placeholder="Numero:">
                    <label for="bairro"></label>
                    <input type="text" name="bairro" placeholder="Bairro:">
                    <label for="cep"></label>
                    <input type="number" name="cep" placeholder="CEP:">
                    <label for="cidade"></label>
                    <input type="text" name="cidade" placeholder="Cidade:">
                    <label for="estado"></label>
                    <input type="text" name="estado" placeholder="Estado:">
                    <label for="complemento"></label>
                    <input type="text" name="estado" placeholder="Complemento: Ex: comdominio jorge, Bloco 2, etc">
                    <br>
                    <div class="action-button-container">
                        <button class="action-button">Descartar</button>
                        <button class="action-button" type="submit" name="salvar">Salvar</button>
                    </div>
                </form>
               
            </article>

        </section>

    </main>
    <script src = "../../JS/script.js"> </script>
</body>
</html>