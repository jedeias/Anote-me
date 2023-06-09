function ClockTime() {
    let date = new Date();
    let hour = date.getHours();
    let minute = date.getMinutes();
    
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();
 
    if (hour == 0) {
    hour = 24;
    } else {
    if (hour > 24) {
    hour = hour - 24;
    }
    }
 
    hour = update(hour);
    minute = update(minute);
    if (month > 9){
    document.getElementById("digital-date").innerText = day + "/" + month + "/" + year;
    }
    else {
        document.getElementById("digital-date").innerText = day + "/" + "0"+ month + "/" + year;
    }
    document.getElementById("digital-clock").innerText = hour + " : " + minute;
    
    setTimeout(ClockTime, 1000);
    }
    function update(t) {
    if (t < 10) {
    return "0" + t;
    }
    else {
    return t;
    }
}
ClockTime();
   
function ClickPerfil(){
    let wrapper = document.getElementById("wrapper-content");
    wrapper.classList.toggle('hidden');
}

function ClickEmoji(){
    let emojiTab = document.getElementById("emojiTab");
    emojiTab.classList.toggle('hidden');
}


//* Detectar quando clicar fora das abas
document.addEventListener('click', function(e) {

    let wrapper = document.getElementById("wrapper-content");
    
    let wrapperButton = document.getElementById("wrapperButton");
    let emojiButton = document.getElementById("emojiButton");
    if(!emojiTab.contains(e.target) && !emojiButton.contains(e.target)){
        if(!emojiTab.classList.contains('hidden')){
            emojiTab.classList.toggle('hidden');
        }
    }
    if(!wrapper.contains(e.target) && !wrapperButton.contains(e.target)){
        if(!wrapper.classList.contains('hidden')){
            wrapper.classList.toggle('hidden');
        }

    }
} )

function toogle() {
    const element = document.body;
    element.classList.toggle("dark");

    const className = element.className;

    switch (className) {

        case "dark":
            console.log("DARK")
            localStorage.setItem('dark-mode', true)
            break;

        case "":
            console.log("CLEAR")
            localStorage.clear()
            break;
    }

}

let emojiSelect = document.getElementById("emojiSelect");
function onChange(){
    var SelectedEmoji = emojiSelect.value;
    if(SelectedEmoji == "indiferente"){
        emojiButton.innerText = "😶"
    } else if(SelectedEmoji == "feliz"){
        emojiButton.innerText = "😃"
    } else if(SelectedEmoji == "triste"){
        emojiButton.innerText = "😥"
    } else if(SelectedEmoji == "ansioso"){
        emojiButton.innerText = "😰"
    } else if(SelectedEmoji == "raiva"){
        emojiButton.innerText = "😠"
    } else if(SelectedEmoji == "medo"){
        emojiButton.innerText = "😱"
    }
}


emojiSelect.onchange = onChange;
onChange();

function modalclick() {
    const modal = document.getElementById('janela-modal');

    modal.classList.add('abrir')

    modal.addEventListener('click', (e) => {
        if(e.target.id == 'fechar' || e.target.id == 'janela-modal'){
            modal.classList.remove('abrir')
        }
    })
}


let numAnotacoes = parseInt(document.getElementById("numAnotacoes").getAttribute("data-valor"));

let selAnotacao = numAnotacoes + 1;

function DescartarAnotacao(){

    let textArea = document.getElementById('textarea');
    if(textArea.value != ''){
        if(confirm('Deseja mesmo descartar esta anotação?') == true){
            textArea.value = '';
    }
    }

}

let notepadCount = document.getElementById('notepad-count');

notepadCount.innerText = selAnotacao + '/' + numAnotacoes;

function prevNote(){
    let curNote = document.getElementById('anotacao' + selAnotacao);

    if(selAnotacao !== 1){
        var incomingNote = selAnotacao - 1;
    } else {
        var incomingNote = selAnotacao;
    }
    let prevNote = document.getElementById('anotacao' + incomingNote);

    curNote.classList.remove('active');
    prevNote.classList.add('active');

    if(selAnotacao > 1 && selAnotacao != 1){
        selAnotacao = selAnotacao - 1;
    }

    textToEmoji(selAnotacao);
    notepadCount.innerText = selAnotacao + '/' + numAnotacoes;
}

function nextNote(){
    let curNote = document.getElementById('anotacao' + selAnotacao);
    if(selAnotacao !== numAnotacoes + 1){
        var incomingNote = selAnotacao + 1;
    } else {
        var incomingNote = selAnotacao;
    }
    let nextNote = document.getElementById('anotacao' + incomingNote);

    curNote.classList.remove('active');
    nextNote.classList.add('active');

    if(selAnotacao < numAnotacoes + 1){
        selAnotacao = selAnotacao + 1;
    }

    notepadCount.innerText = selAnotacao + '/' + numAnotacoes;
}

function textToEmoji(id){
    let emocaoText = document.getElementById('emojiAnotacao' + id);
    if(emocaoText.innerHTML == "indiferente"){
        emocaoText.innerText = "😶"
    } else if(emocaoText.innerHTML == "feliz"){
        emocaoText.innerText = "😃"
    } else if(emocaoText.innerHTML == "triste"){
        emocaoText.innerText = "😥"
    } else if(emocaoText.innerHTML == "ansioso"){
        emocaoText.innerText = "😰"
    } else if(emocaoText.innerHTML == "raiva"){
        emocaoText.innerText = "😠"
    } else if(emocaoText.innerHTML == "medo"){
        emocaoText.innerText = "😱"
    }
}

function deleteAlertAnotacao(e){
    var confirmacao = confirm("Deseja mesmo excluir esta anotação?");

    if(!confirmacao){
        e.preventDefault();
    }
}


function clickMenu(){
    let menu = document.getElementById('Itens');
    menu.classList.toggle('hidden-responsivo');
 }

console.log(selAnotacao);
