function ClickPerfil(){
    let wrapper = document.getElementById("wrapper-content");
    wrapper.classList.toggle('hidden');
}

function activityClose(){
    let activityTable = document.getElementById('activityTable');
    activityTable.classList.toggle('hidden');
}

document.addEventListener('click' ,function(e){
    let wrapper = document.getElementById("wrapper-content");
    let wrapperButton = document.getElementById("wrapperButton");

    if(!wrapper.contains(e.target) && !wrapperButton.contains(e.target)){
        if(!wrapper.classList.contains('hidden')){
            wrapper.classList.toggle('hidden')
        }
    }

    let editPsicoTable = document.getElementById('editPsicoTable');
    let editPsicoButton = document.getElementById('editPsicoButton');

    let activityButton = document.getElementById('activityButton');
    let activityTable = document.getElementById('activityTable');

    if(!activityTable.contains(e.target) && !activityButton.contains(e.target)){
        if(!activityTable.classList.contains('hidden')){
            activityTable.classList.toggle('hidden');
        }
    }

    if(!editPsicoTable.contains(e.target) && !editPsicoButton.contains(e.target)){
        if(!editPsicoTable.classList.contains('hidden')){
            editPsicoTable.classList.toggle('hidden');
        }
    }
})


let pacienteAnotacaoTable = document.getElementById("pacienteAnotacaoTable");
let pacienteRecomendadasTable = document.getElementById("pacienteRecomendadasTable");
let pacienteAgendaTable = document.getElementById("pacienteAgendaTable");

function pacienteNextButton(){
    if(pacienteAnotacaoTable.classList.contains('show')){
        pacienteAnotacaoTable.classList.remove('show')
        pacienteRecomendadasTable.classList.add('show')
    } else if(pacienteRecomendadasTable.classList.contains('show')){
        pacienteRecomendadasTable.classList.remove('show')
        pacienteAgendaTable.classList.add('show')
    } else if(pacienteAgendaTable.classList.contains('show')){
        pacienteAgendaTable.classList.remove('show')
        pacienteAnotacaoTable.classList.add('show')
    }
}

function pacientePrevButton(){
    if(pacienteAnotacaoTable.classList.contains('show')){
        pacienteAnotacaoTable.classList.remove('show')
        pacienteAgendaTable.classList.add('show')
    } else if(pacienteAgendaTable.classList.contains('show')){
        pacienteAgendaTable.classList.remove('show')
        pacienteRecomendadasTable.classList.add('show')
    } else if (pacienteRecomendadasTable.classList.contains('show')){
        pacienteRecomendadasTable.classList.remove('show')
        pacienteAnotacaoTable.classList.add('show')
    }
}

function pacienteButton(){
    let cadastroTable = document.getElementById("cadastroTable");
    let cadastroPacienteTable = document.getElementById("cadastroPacienteTable");

    cadastroTable.classList.remove('show');
    cadastroPacienteTable.classList.add('show');
}

function psicologoButton(){
    let cadastroTable = document.getElementById("cadastroTable");
    let cadastroPsicologoTable = document.getElementById("psicologoCadastroTable");

    cadastroTable.classList.remove('show');
    cadastroPsicologoTable.classList.add('show');
}

var btnVoltarPaciente = document.getElementById("backButtonPaciente");

btnVoltarPaciente.addEventListener("click", function() {
    window.location.href = "secretario.php";
});

var btnVoltarPsicologo = document.getElementById("backButtonPsicologo");

btnVoltarPsicologo.addEventListener("click", function() {
    window.location.href = "secretario.php";
});

function selecionarPaciente(numero){
    location.href = '../psicologo/psicologo.php?paciente=' + numero;

}

function deleteAlert(e){
    var confirmacao = confirm("Deseja mesmo excluir esta atividade?");

    if(!confirmacao){
        e.preventDefault();
    }
}

//Mascara Numero de telefone

function mascara (o,f){
    v_obj = o
    v_fun = f
    setTimeout("execmascara(), 1")
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function mtel(v){
    v=v.replace(/\D/g,""); 
    v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); 
    v=v.replace(/(\d)(\d{4})$/,"$1-$2");
    return v;
}

function id( el ){
	return document.getElementById( el );
}

window.onload = function(){
	id('telefone').onkeyup = function(){
		mascara( this, mtel );
	}
}

// Mostrar Senha ao clicar no olho

function mostrarSenha(lugar){

    switch(lugar){
        case 'paciForm' :
            var inputPass = document.getElementById("paciSenha");
            var showPassBtn = document.getElementById("paciShowSenha");
            if (inputPass.type === 'password'){
                inputPass.setAttribute('type','text');
                showPassBtn.setAttribute('src','../../IMG/ico/eye-slash-fill.svg');
                showPassBtn.setAttribute('title','Ocultar Senha')
            } else {
                inputPass.setAttribute('type','password');
                showPassBtn.setAttribute('src','../../IMG/ico/eye-fill.svg');
                showPassBtn.setAttribute('title','Mostrar Senha')
            }
            break;
        case 'psiForm' :
            var inputPass = document.getElementById("psiSenha");
            var showPassBtn = document.getElementById("psiShowSenha");
            if (inputPass.type === 'password'){
                inputPass.setAttribute('type','text');
                showPassBtn.setAttribute('src','../../IMG/ico/eye-slash-fill.svg');
                showPassBtn.setAttribute('title','Ocultar Senha')
            } else {
                inputPass.setAttribute('type','password');
                showPassBtn.setAttribute('src','../../IMG/ico/eye-fill.svg');
                showPassBtn.setAttribute('title','Mostrar Senha')
            }
            break;    
        case 'paciConfirmForm' :
            var inputPass = document.getElementById("paciConfirmSenha");
            var showPassBtn = document.getElementById("paciConfirmShowSenha");
            if (inputPass.type === 'password'){
                inputPass.setAttribute('type','text');
                showPassBtn.setAttribute('src','../../IMG/ico/eye-slash-fill.svg');
                showPassBtn.setAttribute('title','Ocultar Senha')
            } else {
                inputPass.setAttribute('type','password');
                showPassBtn.setAttribute('src','../../IMG/ico/eye-fill.svg');
                showPassBtn.setAttribute('title','Mostrar Senha')
            }
            break;
        case 'psiConfirmForm' :
            var inputPass = document.getElementById("psiConfirmSenha");
            var showPassBtn = document.getElementById("psiConfirmShowSenha");
            if (inputPass.type === 'password'){
                inputPass.setAttribute('type','text');
                showPassBtn.setAttribute('src','../../IMG/ico/eye-slash-fill.svg');
                showPassBtn.setAttribute('title','Ocultar Senha')
            } else {
                inputPass.setAttribute('type','password');
                showPassBtn.setAttribute('src','../../IMG/ico/eye-fill.svg');
                    showPassBtn.setAttribute('title','Mostrar Senha')
            }
            break;
        case 'loginForm':
            var inputPass = document.getElementById("loginSenha");
            var showPassBtn = document.getElementById("loginShowSenha");
            if (inputPass.type === 'password'){
                inputPass.setAttribute('type','text');
                showPassBtn.setAttribute('src','app/view/IMG/ico/eye-slash-fill.svg');
                showPassBtn.setAttribute('title','Ocultar Senha')
            } else {
                inputPass.setAttribute('type','password');
                showPassBtn.setAttribute('src','app/view/IMG/ico/eye-fill.svg');
                showPassBtn.setAttribute('title','Mostrar Senha')
            }
            break;

    }
    

}

function conferirSenha(lugar){
    switch(lugar){
        case 'paciForm': 
            var senha = document.getElementById('paciSenha');
            var confirmSenha = document.getElementById('paciConfirmSenha');
            
            if(senha.value === confirmSenha.value){
                confirmSenha.setCustomValidity('')
            } else {
                confirmSenha.setCustomValidity('Senhas não conferem');
                preventDefault();
            }
            break;
        case 'paciForm': 
            var senha = document.getElementById('paciSenha');
            var confirmSenha = document.getElementById('paciConfirmSenha');
            
            if(senha.value === confirmSenha.value){
                confirmSenha.setCustomValidity('')
            } else {
                confirmSenha.setCustomValidity('Senhas não conferem');
                preventDefault();
            }
            break;
    }
}

let responsavelInput = document.querySelectorAll("div.responsavel-form input");
let menorQue18 = false;

function showResponsavelForm(){
    let responsavelForm = document.getElementById('responsavelForm');
    if(document.getElementById('responsavelBox').checked){
        console.log("testeform")
        if(!responsavelForm.classList.contains('showBlock')){
            responsavelForm.classList.add('showBlock')
        }
        for (var i=0; i < responsavelInput.length; i++) {
            responsavelInput[i].removeAttribute('disabled');
        }
    } else {
        if(responsavelForm.classList.contains('showBlock')){
            responsavelForm.classList.remove('showBlock')
        } 
        for (var i=0; i < responsavelInput.length; i++) {
            responsavelInput[i].setAttribute('disabled', '');
        }
    }
}

let responsavelBox = document.getElementById('responsavelBox');
responsavelBox.addEventListener("click", showResponsavelForm);


let dataNasc = document.getElementById('dataNascPaci');
dataNasc.addEventListener('blur', compararDataNasc);

function compararDataNasc(){
    let dataAtual = new Date();

    let dataNascValue = dataNasc.value;
    let dataNascSplit = dataNascValue.split("-");

    let dataNascJs = new Date(dataNascSplit[0], dataNascSplit[1] -1, dataNascSplit[2]);
    let diferenca = dataAtual.getTime() - dataNascJs.getTime();

    let idade = Math.floor(diferenca / (1000 * 60 * 60 * 24 * 365.25));

    let responsavelBox = document.getElementById('responsavelBox');
    let checkText = document.getElementById('checkText');
    let checkDisabled = document.getElementById('checkDisabled');

    if(idade < 18){
        console.log("menos de 18");
        responsavelBox.checked = 'checked';
        checkText.style.display = 'block';
        checkDisabled.style.display = 'block';
        showResponsavelForm();
    } else {
        responsavelBox.checked = false;
        checkText.style.display = 'none';
        checkDisabled.style.display = 'none';
        showResponsavelForm();
    }


}

function searchPsico(){
    let input = document.getElementById('psiSearchBar').value;
    input = input.toLowerCase();
    let psiNome = document.getElementsByClassName('psi-paci-list');

    for (i = 0; i < psiNome.length; i++){
        console.log(psiNome[i].dataset.nome);
        if (!psiNome[i].dataset.nome.toLowerCase().includes(input)){
            psiNome[i].classList.add('hidden');
        } else {
            psiNome[i].classList.remove('hidden');
        }
    }
}

function searchPaci(){
    let input = document.getElementById('paciSearchBar').value;
    input = input.toLowerCase();
    let paciNome = document.getElementsByClassName('psi-paci-list');

    for (i = 0; i < paciNome.length; i++){
        console.log(paciNome[i].dataset.nome);
        if (!paciNome[i].dataset.nome.toLowerCase().includes(input)){
            paciNome[i].classList.add('hidden');
        } else {
            paciNome[i].classList.remove('hidden');
        }
    }
}

function clickPsicoCard(id){
    let psicoId = id;
    window.location = "../secretario/secreListarPsico.php?psicoId=" + psicoId; 
    
}

function clickPaciCard(id){
    let paciId = id;
    window.location = "../secretario/secreListarPaci.php?paciId=" + paciId; 
    
}

function voltarPsicoTable(id){
    console.log(id);
    if(id !== undefined){
        console.log(id);
        window.location = "../secretario/secreListarPsico.php?psicoId=" + id;
    } else {
        window.location = "../secretario/secreListarPsico.php";
    }
 
}
function voltarPaciTable(){
        window.location = "../secretario/secreListarPaci.php";
}
function agendaPsicologo(psicoId){

    window.location = "../secretario/agendaPsicologo.php?psicoId=" + psicoId;
}


function voltarPaciTable(){
    window.location = "../secretario/secreListarPaci.php"; 
}

function redirectPaci(paciId){
    window.location = "../secretario/secreListarPaci.php?paciId=" + paciId;
}

function editPsico(){
    let psicoTable = document.getElementById('editPsicoTable');

    psicoTable.classList.toggle('hidden');
}

function clickMenu(){
    let menu = document.getElementById('Itens');
    menu.classList.toggle('hidden-responsivo');
 }