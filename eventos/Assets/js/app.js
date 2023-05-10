var myModal = new bootstrap.Modal(document.getElementById('myModal'));
let frm = document.getElementById('formulario');
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      //themeSystem: 'bootstrap5',
      dayMaxEventRows: true,
      height: 700,
      locale: 'pt-br',
      events: base_url + 'Home/listar',
      dateClick: function(info){
            //console.log(info);
            frm.reset();
            document.getElementById('id').value = '';
            document.getElementById('btnEditar').classList.add('d-none');
            document.getElementById('start').value = info.dateStr;
            document.getElementById('btnAcao').textContent = 'registrar';
            document.getElementById('titulo').textContent = 'Registrar evento';
            myModal.show();
      },
      eventClick: function(info){
          console.log(info);
          document.getElementById('btnEditar').classList.remove('d-none');
          document.getElementById('titulo').textContent = 'Editar evento';
          document.getElementById('btnAcao').textContent = 'Editar';
          document.getElementById('id').value = info.event.id;
          document.getElementById('title').value = info.event.title;
          document.getElementById('start').value = info.event.startStr;
          document.getElementById('color').value = info.event.backgroundColor;
          myModal.show();
      }
    });
    calendar.render();
    frm.addEventListener('submit', function(e){
        e.preventDefault();
        const title = document.getElementById('title').value;
        const data = document.getElementById('start').value;
        const color = document.getElementById('color').value;
        if(title == '' || data == '' || color == ''){
            Swal.fire(
                'Aviso',
                'Todos os campos precisam ser preenchidos'
            )
        }else{
            const url = base_url + 'Home/registrar';
            const http = new XMLHttpRequest();
            http.open('POST', url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    //console.log(this.responseText);
                    const result = JSON.parse(this.responseText);
                    console.log(result);
                    if(result.estado){
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
  });