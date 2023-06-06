let redFlagContainers = document.getElementsByClassName('red-flag-container');
let redFlagButtons = document.getElementsByClassName('red-flag-button');
let redFlagInputs = document.getElementsByClassName('red-flag-select');
let redFlagConfirms = document.getElementsByClassName('red-flag-confirm');


console.log(redFlagInputs);

for (var i=0; i < redFlagInputs.length; i++) {
  redFlagInputs[i].addEventListener('change', mudarCor);
  let id = redFlagInputs[i].id.replace(/\D/g, "");
  let noteHeader = document.getElementById('activityHeader' + id);
  console.log(noteHeader);
  let cor = redFlagInputs[i].value;
  function mudarCor(){
    if(cor === 'verde'){
        noteHeader.style.backgroundColor = "#22b573";
    }
    else if(cor === 'amarelo'){
        noteHeader.style.backgroundColor = "#ffd129";
    }
    else if (cor === 'vermelho'){
        noteHeader.style.backgroundColor = "#ff2949";
    }
  }  
}

for (var i=0; i < redFlagContainers.length; i++) {
    let redFlagButton = redFlagButtons[i];
    let redFlagContainer = redFlagContainers[i];
    document.addEventListener('click', listarRed);
    function listarRed(e){
        if(!redFlagContainer.contains(e.target) && !redFlagButton.contains(e.target)){
            redFlagContainer.classList.add('hidden')
        }
    }
}

function redFlagClick(anotacao){
    let redFlagContainer = document.getElementById('redFlagContainer' + anotacao);
    redFlagContainer.classList.toggle('hidden');
}