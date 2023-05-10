function buscaCep(lugar) {

    let paciCep = document.getElementById("paciCEP").value;
    if(paciCep !== ""){
        let url = "https://brasilapi.com.br/api/cep/v1/" + paciCep;

        let req = new XMLHttpRequest();
        req.open("GET", url);
        req.send();

        //tratar a resposta da requisição

        req.onload = function() {
            if(req.status === 200){
                let endereco = JSON.parse(req.response);
                document.getElementById("paciRua").value = endereco.street;
                document.getElementById("paciBairro").value = endereco.neighborhood;
                document.getElementById("paciEstado").value = endereco.state;
                document.getElementById("paciCidade").value = endereco.city;


            }
        }

    }

    let psiCep = document.getElementById("psiCEP").value;
    if(psiCep !== ""){
        let url = "https://brasilapi.com.br/api/cep/v1/" + psiCep;

        let req = new XMLHttpRequest();
        req.open("GET", url);
        req.send();

        //tratar a resposta da requisição

        req.onload = function() {
            if(req.status === 200){
                let endereco = JSON.parse(req.response);
                document.getElementById("psiRua").value = endereco.street;
                document.getElementById("psiBairro").value = endereco.neighborhood;
                document.getElementById("psiEstado").value = endereco.state;
                document.getElementById("psiCidade").value = endereco.city;


            }
        }

    }
}

window.onload = function() {
    let paciCep = document.getElementById("paciCEP");
    paciCep.addEventListener("blur", buscaCep);

    let psiCep = document.getElementById("psiCEP");
    psiCep.addEventListener("blur", buscaCep);
}