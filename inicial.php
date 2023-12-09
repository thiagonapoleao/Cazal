<?php
require_once 'init.php';
$PDO = db_connect();
$data = date('Y-m-d');
$convDate = dateConvert($data);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>GI - Gestão Integrada</title>
    <link rel="stylesheet" type="text/css" href="css/stillo.css">
    <link rel="stylesheet" href="css/style.css" />
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width" scale="1">
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <!-- transforma a pagina em  responsivel-->
    <!-- Adicionando JQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
    </script>
</head>

<body style="background-image:  url('./img/Cazal-logotipo.jpeg'); background-repeat: no-repeat; background-attachment: fixed; background-size:80%80%; font-size: 14px; ">
    <header>
        <nav class="navbar fixed-top navbar-expand navbar-light" style="background: linear-gradient(to bottom,  #00c6ff, #0072ff)">
            <a class="nav-link" data-toggle="modal" data-target="#viradatacontabil" href="" style="color: black; ">Cazal</a>
            <div id="collapse-navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Agenda
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="agenda/calendario.php">Calendario</a>
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cadastro
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="cadastro_pacientes/cadastro.php">Cadastro de Paciente</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="">Cadastro de Procedimentos</a>
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Procedimentos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="procedimentos/procedimentos.php">Novo Procedimento</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="">Consulta Procedimentos</a>
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <br>

    <footer>
        <!-- tag <footer> roda pé da pagina>-->
        <p style="color: black; margin-top: 40%; text-align: center;">Copyright &copy; 2023 - (GI) Gestão
            Integrada </p>
    </footer>
</body>

</html>