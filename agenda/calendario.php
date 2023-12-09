<?php
require_once '../init.php';

// abre a conexão
$PDO = db_connect();

$data = date("Y-m-d");

// sql_count para contar o total de registros
$sql_count = "SELECT count(cpf) FROM cadastro_cliente";
// conta o toal de registros
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();

// SQL para selecionar os registros
$sql_arry = "SELECT id, cpf, nome, dtnascimento, endereco, numero, bairro, cep, cidade, telefone, celular, dtcadastro FROM cadastro_cliente order BY nome asc ";
// seleciona os registros
$stmt_array = $PDO->prepare($sql_arry);
$stmt_array->execute();


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>GI - Gestão Integrada</title>
  <link rel="stylesheet" href="style.css" />
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width" scale="1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Stay organized with our user-friendly Calendar featuring events, reminders, and a customizable interface. Built with HTML, CSS, and JavaScript. Start scheduling today!" />
  <meta name="keywords" content="calendar, events, reminders, javascript, html, css, open source coding" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
  <!-- Adicionando JQuery -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
  </script>
</head>

<body style="background: linear-gradient(to bottom,  #00c6ff, #0072ff); background-repeat: no-repeat; background-attachment: fixed; background-size: 100% 100%;font-size: 14px ">
  <header>
    <!-- mais semantico, inverso footer -->
    <!-- MENU -->
    <nav class="navbar fixed-top navbar-expand navbar-light" style="background: linear-gradient(to bottom,  #00c6ff, #0072ff);">
      <a class="nav-link" data-toggle="modal" data-target="#viradatacontabil" href="" style="color: black; ">Cazal</a>
      <div id="collapse-navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav" >
          <li class="nav-item dropdown" >
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Agenda
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="font-size: 14px;" >
              <a class="dropdown-item" href="">Calendario</a>
              <div class="dropdown-divider"></div>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Cadastro
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="font-size: 14px;">
              <a class="dropdown-item" href="../cadastro_pacientes/cadastro.php">Cadastro de Paciente</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="">Cadastro de Procedimentos</a>
              <div class="dropdown-divider"></div>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Procedimentos
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="font-size: 14px;">
              <a class="dropdown-item" href="../procedimentos/procedimentos.php">Novo Procedimento</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="../procedimentos/procedimentos.php">Consulta Procedimentos</a>
              <div class="dropdown-divider"></div>
            </div>
          </li>
        </ul>
      </div>
      <img src="../img/Cazal-logotipo2.jpg" alt="Stickman" width="10%" height="10%" style="border-radius: 5px">
    </nav>
  </header>
  <div id="interface" style="background: linear-gradient(to top,#004e92, #000428, #000000); background-repeat: no-repeat; background-attachment: fixed; background-size: 100% 100%; margin-top: 80px;color: blanchedalmond; border-radius: 20px">
    <div class="container">
      <div class="left">
        <div class="calendar">
          <div class="month">
            <i class="fas fa-angle-left prev"></i>
            <div class="date">Dezembro 2023</div>
            <i class="fas fa-angle-right next"></i>
          </div>
          <div class="weekdays">
            <div>Dom</div>
            <div>Seg</div>
            <div>Ter</div>
            <div>Qua</div>
            <div>Qui</div>
            <div>Sex</div>
            <div>Sab</div>
          </div>
          <div class="days"></div>
          <div class="goto-today">
            <div class="goto">
              <input type="text" placeholder="mm/yyyy" class="date-input" />
              <button class="goto-btn">Go</button>
            </div>
            <button class="today-btn">Dia Atual</button>
          </div>
        </div>
      </div>
      <div class="right">
        <div class="today-date">
          <div class="event-day">wed</div>
          <div class="event-date">12 de dezembro 2023</div>
        </div>
        <div class="events"></div>
        <div class="add-event-wrapper">
          <div class="add-event-header">
            <div class="title">Adicionar Consulta</div>
            <i class="fas fa-times close"></i>
          </div>
          <div class="add-event-body">
            <div class="add-event-input">
              <input type="text" placeholder="Paciente" class="event-name" />
            </div>
            <div class="add-event-input">
              <input type="text" placeholder="Inicío da Consulta" class="event-time-from" />
            </div>
            <div class="add-event-input">
              <input type="text" placeholder="Fim da Consulta" class="event-time-to" />
            </div>
          </div>
          <div class="add-event-footer">
            <button class="add-event-btn">Marcar Consulta</button>
          </div>
        </div>
      </div>
      <button class="add-event">
        <i class="fas fa-plus"></i>
      </button>
    </div>

    <script src="script.js"></script>
  </div>

</body>

</html>

<script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function() {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
      .forEach(function(form) {
        form.addEventListener('submit', function(event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
  })()
</script>