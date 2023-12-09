<?php
session_start(); # Deve ser a primeira linha do arquivo
require_once '../init.php';

// abre a conexão
$PDO = db_connect();

$data = date("Y-m-d");

// sql_count para contar o total de registros
$sql_count = "SELECT count(cpf) FROM cadastro_pacientes";
// conta o toal de registros
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();

// SQL para selecionar os registros
$sql_arry = "SELECT id, cpf, nome, tipo_adendimento, tipo_consulta, tipo_procedimento, encaminhamento, tipo_pagamento, valor, dt_procedimento FROM procedimentos_realizados ";
// seleciona os registros
$stmt_array = $PDO->prepare($sql_arry);
$stmt_array->execute();

// SQL para selecionar os registros
$sql_arry_proc = "SELECT descricao FROM tipo_procedimento order BY descricao asc";
// seleciona os registros
$stmt_array_proc = $PDO->prepare($sql_arry_proc);
$stmt_array_proc->execute();

// SQL para selecionar os registros
$sql_arry_enc = "SELECT descricao FROM tipo_encaminhamento order BY descricao asc";
// seleciona os registros
$stmt_array_enc = $PDO->prepare($sql_arry_enc);
$stmt_array_enc->execute();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>GI - Gestão Integrada</title>
    <link rel="stylesheet" type="text/css" href="../css/stillo.css">
    <link rel="stylesheet" type="text/css" href="../css/variables.scss">
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width" scale="1">
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
                <ul class="nav navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Agenda
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../agenda/calendario.php">Calendario</a>
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cadastro
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../cadastro_pacientes/cadastro.php">Cadastro de Pacientes</a>
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
        <div class="container" style="margin-top: 10px">
            <h6 align="center">FICHA DE ATENDIMENTO ODONTOLÓGICO INDIVIDUAL</h6>
            <form action="novo_procedimento.php" method="post" class="needs-validation" id="formSearch" novalidate>
                <div align="center">
                    <div class="form-row">
                        <div class="col-sm-3 mb-1">
                            <label for="validationServer01">CPF</label>
                            <input type="number" name="cpf" id="cpf" class="form-control" autofocus required onblur="myFunction()">
                        </div>
                        <div class="col-sm-5 mb-1">
                            <label for="validationServer02">Nome</label>
                            <input type="text" name="nome" id="nome" class="form-control" disabled="">
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer03">Data de Nascimento</label>
                            <input type="date" name="dtnascimento" id="dtnascimento" class="form-control" disabled="">
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer08">CEP</label>
                            <input type="number" name="cep" id="cep" class="form-control" required>
                        </div>
                        <div class="col-sm-4 mb-1">
                            <label for="validationServer04">Endereço</label>
                            <input type="text" name="endereco" id="endereco" class="form-control" required>
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer05">Numero</label>
                            <input type="number" name="numero" id="numero" class="form-control" required>
                        </div>
                        <div class="col-sm-4 mb-1">
                            <label for="validationServer06">Bairro</label>
                            <input type="text" name="bairro" id="bairro" class="form-control" required>
                        </div>
                        <div class="col-sm-4 mb-1">
                            <label for="validationServer07">Cidade</label>
                            <input type="text" name="cidade" id="cidade" class="form-control" required>
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer09">Telefone</label>
                            <input type="number" name="telefone" id="telefone" class="form-control" required>
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer10">Celular</label>
                            <input type="number" name="celular" id="celular" class="form-control" required>
                        </div>
                        <div class="col-sm-2 mb-2">
                            <br>
                            <button type="submit" id="submit" name="Import" class="btn btn-primary">Gerar Procedimento</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="container" style="margin-top: 10px">
            <form action="form-edit-paciente.php" method="GET" class="needs-validation" novalidate>
                <div align="center">
                    <div class="form-row">
                        <div class="col-sm-2 mb-2">
                            <label for="validationServer01">Codigo de Cadastro</label>
                            <input type="number" name="id" id="id" class="form-control">
                        </div>
                        <div class="col-sm-2 mb-1">
                            <br>
                            <button type="submit" id="submit" name="Import" class="btn btn-primary">Editar Cadastro</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("cpf").onblur = function() {
            myFunction()
        };

        $("#cpf").blur(function() {
            $.ajax({
                url: '../searchs.php',
                type: 'post',
                dataType: 'json',
                data: {
                    searchAdress: 1,
                    cpf: $("#cpf").val()
                }
            }).done(function(data) {
                if (data) {
                    $("#cpf").val(data.cpf);
                    $("#id").val(data.id);
                    $("#nome").val(data.nome);
                    $("#dtnascimento").val(data.dtnascimento);
                    $("#endereco").val(data.endereco);
                    $("#numero").val(data.numero);
                    $("#bairro").val(data.bairro);
                    $("#cidade").val(data.cidade);
                    $("#cep").val(data.cep);
                    $("#telefone").val(data.telefone);
                    $("#celular").val(data.celular);
                    $("#dtcadastro").val(data.dtcadastro);
                } else {
                    $("#id").val("");
                    $("#nome").val("");
                    $("#dtnascimento").val("");
                    $("#endereco").val("");
                    $("#bairro").val("");
                    $("#cidade").val("");
                    $("#cep").val("");
                    $("#telefone").val("");
                    $("#celular").val("");
                    $("#dtcadastro").val("");
                }
            }).fail(function(data) {
                console.log(data)
            })
        });
    </script>
</body>

</html>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>