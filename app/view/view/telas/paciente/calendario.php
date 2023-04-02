<!DOCTYPE html>
<html lang='pt-br'>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src='js/index.global.min.js'></script>
  <link rel="stylesheet" href="../../CSS/calendario.css">
  <script>

    document.addEventListener('DOMContentLoaded', function () {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'pt-br',

      });
      calendar.render();

    });

  </script>
</head>
<body>
  <header class="header-container">
    <h1>ANOTE-ME</h1>
    <img src="../../img/Default/default.jpg" class="perfil" alt="perfil">
  </header>
  <section class="activity-container">
    <section class="menu-container">
      <nav class="menu">
        <ul>
          <a href="./anotacoes.html">
            <li class="anotacoes">
              <p>Anotações</p>
            </li>
          </a>
          <a hre>
            <a href="./atividades.html">
              <li class="agenda-consultas">
                <p>Atividades Recomendadas</p>
              </li>
            </a>
          </a>
            <li class="agenda-consultas">
              <p>Agenda</p>
            </li>
        </ul>
      </nav>
    </section>
    <div id='calendar'></div>
</body>

</html>