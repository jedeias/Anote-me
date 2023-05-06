<?php

include("../../../autoload.php");


$session = new Session();

$nome = $session->session_get('nome');
$email = $session->session_get('email');
$type = $session->session_get('type');
$id = $session->session_get('id');

$pegar_imagem = new Select();
$imagem = $pegar_imagem->getImagem($id);

$imagem = $imagem['imagem'];

if($nome == NULL and $email == NULL and $type == NULL){
   header("location: ../../../index.html");
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
                <img src="<?php echo "../$imagem"; ?>" alt="" class='perfil' id='first-perfil'>
            <?php else: ?>
                <img src="../../IMG/default.jpg" alt="" class='perfil'>
            <?php endif; ?>
        </figure> 
        <div class="click-wrapper">
            <nav class="dados-wrapper hidden" id="wrapper-content">
                <ul class="lista-dados">

                    <li class="center"> 
                        <?php if(isset($imagem) && $imagem != NULL): ?>
                            <img src="<?php echo "../$imagem"; ?>" alt="FOTO-DE-PERFIL" class='perfil' id='second-perfil'>
                        <?php else: ?>
                            <img src="../../IMG/default.jpg" alt="" class='perfil'>
                        <?php endif; ?>
                    </li>
                    <li class="center"><?php echo "$nome"; ?></li>
                    <div class='lista-dados-content'>
                        <li class="dados-title">Email</li>
                        <li><?php echo $email; ?></li>
                        <hr>
                        <li class="dados-title">Telefone</li>
                        <li>91234-5678</li>
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

            <article class="cadastro-table no-border" id="cadastroTable">
                <button class="cadastro-button left-button" onclick="pacienteButton()">
                    <h1>Cadastrar Paciente</h1>
                </button>
                <button class="cadastro-button right-button" onclick="psicologoButton()">
                    <h1>Cadastrar Psicologo</h1>
                </button>
            </article>

            <article class="cadastro-table show" id="cadastroPacienteTable">
                <button class="backButton" id="backButtonPaciente">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                    </svg>
                </button>
                <div class="paciente-cadastro-container">
                        <h1>Cadastrar Paciente</h1>
                        <form method="POST" action="teste.php">
                            <div class="cross-input">
                            <div>
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" required>
                            </div>
                            <div>
                                <label for="nome">Sobrenome</label>
                                <input type="text" name="sobrenome" required>
                            </div>
                            </div>
                            <label for="email">Email</label>
                            <input type="email" name="email" required>
                            <div class="cross-input">
                            <div>
                                <label for="RG">RG</label>
                                <input type="text" name="RG" required>
                            </div>
                            <div>
                                <label for="CPF">CPF</label>
                                <input type="text" name="CPF" required>
                            </div>
                            </div>
                            <label for="data-nasc">Data de Nascimento</label>
                            <input type="date" name="data-nasc" id="dataNascPaci" max="<?php echo date('Y-m-d'); ?>">
                            <label for="sexo">Sexo</label>
                            <select name="sexo">
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                            <label for="telefone">Telefone</label>
                            <input placeholder="(11) 96123-4567" name="telefone" id="telefone" type="tel" minlength="8" maxlength="15">
                            <?php
                                $select = new Select();
                                $pisicologos = $select->selectPsicologos();

                                echo "<label for='psicologoResponsavel'>Psicologo Responsável</label>";
                                echo "<select name='psicologoResponsavel'>";
                                foreach($pisicologos as $psicologo){
                                    echo "<option value='".$psicologo['pk_psicologo']."'>".$psicologo['nome']."</option>";
                                }

                                echo "</select>";

                            ?>
                            <p class="form-subtitle">Endereço</p>
                            <label for="CEP">CEP</label>
                            <input id="paciCEP" type="text" name="cep" required>
                            <label for="rua">Rua</label>
                            <input id="paciRua" type="text" name="rua" required>
                            <label for="bairro">Bairro</label>
                            <input id="paciBairro" type="text" name="bairro" required>
                            <label for="casaNum">Número</label>
                            <input type="text" name="casaNum" required>
                            <label for="complemento">Complemento</label>
                            <input type="text" name="complemento">
                            <div class="cross-input">
                                <div class="small-input">
                                    <label for="estado">Estado</label>
                                    <select id="paciEstado" name="estado">
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                    </select>
                                </div>
                                <div class="big-input">
                                    <label for="cidade">Cidade</label>
                                    <input class="form-space" id="paciCidade" type="text" name="cidade" required>
                                </div>
                            </div>
                            <label for="senha">Senha</label>
                            <div class="senha-container">
                                <input type="password" name="senha" onchange="conferirSenha('paciForm')" required id="paciSenha">
                                <img title="Mostrar Senha" src="../../IMG/ico/eye-fill.svg" id="paciShowSenha" onclick="mostrarSenha('paciForm')" alt="">
                            </div>
                            <label for="confirmarSenha">Confirmar Senha</label>
                            <div class="senha-container">
                                <input type="password" name="confirmarSenha" onchange="conferirSenha('paciForm')" required id="paciConfirmSenha">
                                <img title="Mostrar Senha" src="../../IMG/ico/eye-fill.svg" id="paciConfirmShowSenha" onclick="mostrarSenha('paciConfirmForm')" alt="">
                            </div>
                            <div class="check-container">
                                <div class="check-input">
                                    <input name="responsavelBox" id="responsavelBox" type="Checkbox">
                                    <label for="responsavelBox">Este paciente possui um responsavel</label>
                                </div>
                                <div class="check-disabled" id="checkDisabled"></div>
                            </div>
                            <p class="check-text" id="checkText">Paciente menor que 18 anos, responsável obrigatorio.</p>
                            <div class="responsavel-form" id="responsavelForm">
                                <hr>
                                <h1>Cadastrar Responsável</h1>
                                <div class="cross-input">
                                <div>
                                    <label for="resNome">Nome</label>
                                    <input type="text" name="resNome" required disabled>
                                </div>
                                <div>
                                    <label for="resSobrenome">Sobrenome</label>
                                    <input type="text" name="resSobrenome" required disabled>
                                </div>
                                </div>
                                <label for="resEmail">Email</label>
                                <input type="email" name="resEmail" required disabled>
                                <div class="cross-input">
                                <div>
                                    <label for="resRG">RG</label>
                                    <input type="text" name="resRG" required disabled>
                                </div>
                                <div>
                                    <label for="resCPF">CPF</label>
                                    <input type="text" name="resCPF" required disabled>
                                </div>
                                </div>
                                <label for="resTelefone">Telefone</label>
                                <input placeholder="(11) 96123-4567" name="resTelefone" id="telefone" type="tel" minlength="8" maxlength="15" required disabled>
                            </div>
                            <input type="submit">
                        
                </div>
            </article>

            <article class="cadastro-table" id="psicologoCadastroTable">
                <button class="backButton" id="backButtonPsicologo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                    </svg>
                </button>
            </article>

        </section>

    </main>
    <script src = "../../JS/script.js"> </script>
    <script src = "../../JS/cep.js"> </script>
</body>
</html>