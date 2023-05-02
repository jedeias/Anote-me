function buscaCep() {
    let cep = document.getElementById("paciCEP").value;
    if(cep !== ""){
        let url = "https://brasilapi.com.br/api/cep/v1/" + cep;

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
}

window.onload = function() {
    let cep = document.getElementById("paciCEP");
    cep.addEventListener("blur", buscaCep);
}