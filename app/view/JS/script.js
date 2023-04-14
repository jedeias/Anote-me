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

    let activityButton = document.getElementById('activityButton');
    let activityTable = document.getElementById('activityTable');

    if(!activityTable.contains(e.target) && !activityButton.contains(e.target)){
        if(!activityTable.classList.contains('hidden')){
            activityTable.classList.toggle('hidden')
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
    window.location.href = "secreCadastro.html";
});

var btnVoltarPsicologo = document.getElementById("backButtonPsicologo");

btnVoltarPsicologo.addEventListener("click", function() {
    window.location.href = "secreCadastro.html";
});

function selecionarPaciente(numero){
    location.href = '../psicologo/psiPacientes.php?paciente=' + numero;

}

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