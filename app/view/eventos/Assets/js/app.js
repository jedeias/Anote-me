var idPsicologo;
var idPaciente;
var armazenarHorario;
var myModal = new bootstrap.Modal(document.getElementById('myModal'));
let frm = document.getElementById('formulario');
let apagar = document.getElementById('btnApagar');
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        right: 'today prev next',
        left: 'dayGridMonth timeGridWeek listWeek'
      },
      themeSystem: 'bootstrap5',
      dayMaxEventRows: true,
      height: 700,
      locale: 'pt-br',
      events: base_url + 'Home/listar',
      editable: true,
      dateClick: function(info){
            //console.log(info);
            frm.reset();
            document.getElementById('id').value = '';
            apagar.classList.add('d-none');
            document.getElementById('start').value = info.dateStr;
            document.getElementById('btnAcao').textContent = 'registrar';
            document.getElementById('titulo').textContent = 'Registrar evento';
            myModal.show();
      },
      eventClick: (info) => {
        console.log(info);
        apagar.classList.remove('d-none');
        document.getElementById('titulo').textContent = 'Editar evento';
        document.getElementById('btnAcao').textContent = 'Editar';
        document.getElementById('id').value = info.event.id;
        document.getElementById('title').value = info.event.title;
        document.getElementById('start').value = info.event.startStr;
        document.getElementById('color').value = info.event.backgroundColor;
        document.getElementById('psicologo').value = info.event.extendedProps.psicologo;
        document.getElementById('paciente').value = info.event.extendedProps.paciente;
        armazenarHorario = info.event.extendedProps.horario;
        document.getElementById('horario').value = armazenarHorario;
        myModal.show();
      },
      eventDrop: function (info){
            const id = info.event.id;
            const data = info.event.startStr;
            const url = base_url + 'Home/drop';
            const http = new XMLHttpRequest();
            const day = new FormData();
            day.append('id', id);
            day.append('start', data);
            http.open('POST', url, true);
            http.send(day);
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    console.log(this.responseText);
                    const result = JSON.parse(this.responseText);
                    console.log(result);
                    if(result.estado){
                        calendar.refetchEvents();
                    }
                    Swal.fire(
                        'Aviso',
                        result.msg,
                        result.tipo
                    )
                }
            }
        }
    });
    calendar.render();
    function obterIdPsicologo() {
        var psicologoInput = document.getElementById('psicologo');
        var selectedOption = psicologoInput.value;  // Obter o valor selecionado
        var dataList = document.getElementById('listaPsicologos');
        var options = Array.from(dataList.options);
        
        var selectedData = options.find(function(option) {
            return option.value === selectedOption;
        });
        
        if (selectedData) {
            idPsicologo = selectedData.getAttribute('data-id');
        } else {
            idPsicologo = '';  // Definir um valor padrão se nenhum psicólogo for selecionado
        }
        
        return idPsicologo;
        
    }
    function obterIdPaciente() {
        var pacienteInput = document.getElementById('paciente');
        var selectedOption = pacienteInput.value;  // Obter o valor selecionado
        var dataList = document.getElementById('listaPacientes');
        var options = Array.from(dataList.options);
        
        var selectedData = options.find(function(option) {
            return option.value === selectedOption;
        });
        
        if (selectedData) {
            idPaciente = selectedData.getAttribute('data-id');
        } else {
            idPaciente = '';  // Definir um valor padrão se nenhum psicólogo for selecionado
        }
        
        return idPaciente;
       
    }
    frm.addEventListener('submit', function(e){
        e.preventDefault();
        const idPsicologo = obterIdPsicologo();
        const idPaciente = obterIdPaciente();
        const psicologo = document.getElementById('psicologo').value;
        const paciente = document.getElementById('paciente').value;
        const horario = document.getElementById('horario').value;
        const title = document.getElementById('title').value;
        const data = document.getElementById('start').value;
        const color = document.getElementById('color').value;
       
        armazenarHorario = horario;
        

        if(paciente == '' || psicologo == '' || title == '' || data == '' || horario == '' || color == ''){
            Swal.fire(
                'Aviso',
                'Todos os campos precisam ser preenchidos'
            )
        }else{
            const url = base_url + 'Home/registrar';
            const http = new XMLHttpRequest();
            const formData = new FormData(frm);
            formData.append('idPsicologo', idPsicologo); // Adicione o ID do psicólogo ao formulário
            formData.append('idPaciente', idPaciente); // Adicione o ID do paciente ao formulário
            http.open('POST', url, true);
            http.send(formData);
            http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                const result = JSON.parse(this.responseText);
                console.log(result);
                if (result.estado) {
                    calendar.refetchEvents();
                }
                myModal.hide();
                Swal.fire(
                    'Aviso',
                    result.msg,
                    result.tipo
                    )
                }
            }
        }
    })
    apagar.addEventListener('click', function(){
        //console.log('1apagar');
        myModal.hide();
        Swal.fire({
            title: 'Tem certeza?',
            text: "Não podera reverter!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, apagar!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {
                const id = document.getElementById('id').value;
                const url = base_url + 'Home/apagar/' + id;
                const http = new XMLHttpRequest();
                http.open('GET', url, true);
                http.send(frm);
                http.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        console.log(this.responseText);
                        const result = JSON.parse(this.responseText);
                        console.log(result);
                        if(result.estado){
                            calendar.refetchEvents();
                        }
                        Swal.fire(
                            'Aviso',
                            result.msg,
                            result.tipo
                        )
                    }
                }
            }
        })
    })
});