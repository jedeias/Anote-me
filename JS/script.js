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
    if(click.style.display == 'block'){
        click.style.display = 'none'
    }else {
        click.style.display = 'block'
    }
}

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

function modalclick() {
    const modal = document.getElementById('janela-modal');

    modal.classList.add('abrir')

    modal.addEventListener('click', (e) => {
        if(e.target.id == 'fechar' || e.target.id == 'janela-modal'){
            modal.classList.remove('abrir')
        }
    })
}

