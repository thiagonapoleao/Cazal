<?php
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
$sql_arry = "SELECT id, cpf, nome, dtnascimento, endereco, numero, bairro, cep, cidade, telefone, celular, dtcadastro FROM cadastro_pacientes order BY nome asc ";
// seleciona os registros
$stmt_array = $PDO->prepare($sql_arry);
$stmt_array->execute();


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
            <a class="nav-link" data-toggle="modal" data-target="#viradatacontabil" href="inicial.php" style="color: black; ">Cazal</a>
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
                            <a class="dropdown-item" href="cadastro.php">Cadastro de Paciente</a>
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
    <div id="interface" style="background: linear-gradient(to top,#004e92, #000428, #000000); background-repeat: no-repeat; background-attachment: fixed; background-size: 100% 100%; margin-top: 80px;color: blanchedalmond; border-radius: 20px; font-size: 12px">
        <div class="container" style="margin-top: 10px">
            <form action="add.php" method="post" class="needs-validation" novalidate>
                <div align="center">
                    <div class="row justify-content-md-center">
                        <div class="col-sm-3 mb-1"> 
                            <label for="validationServer01">CPF</label>
                            <input type="number" name="cpf" id="cpf" class="form-control" required>
                        </div>
                        <div class="col-sm-5 mb-1">
                            <label for="validationServer02">Nome</label>
                            <input type="text" name="nome" id="nome" class="form-control" required>
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer03">Data de Nascimento</label>
                            <input type="date" name="dtnascimento" id="dtnascimento" class="form-control" required>
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer11">Data de Cadastro</label>
                            <input type="date" name="dtcadastro" id="dtcadastro" value="<?php echo $data ?>" class="form-control" required>
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
                        <div class="col-sm-2 mb-1">
                            <br>
                            <button type="submit" id="submit" name="Import" class="btn btn-primary" >Cadastrar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div align="center" style="margin-top: 10px;">
            <div class="border border-danger" style="background-color: white; color: black; width: 99%; border-radius: 20px; font-size: 12px; min-height: 350px;">
                <div style="width:99%">
                    <from>
                        <p>Total de Pacientes Cadastrados: <?php echo $total ?></p>
                        <?php if ($total > 0) : ?>
                            <div class="table-responsive">
                                <table table-responsive>
                                    <thead>
                                        <tr style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                            <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                ID</th>
                                            <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                CPF</th>
                                            <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                Nome</th>
                                            <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                Data Nascimento</th>
                                            <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                Endereço</th>
                                            <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                Numero</th>
                                            <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                Bairro</th>
                                            <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                Cidade</th>
                                            <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                CEP</th>
                                            <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                Telefone</th>
                                            <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                Celular</th>
                                            <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                Data de Cadastro</th>
                                            <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                Edit</th>
                                            <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                Excluir</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($cadastro = $stmt_array->fetch(PDO::FETCH_ASSOC)) : ?>
                                            <tr style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                    <?php echo $cadastro['id'] ?></td>
                                                <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                    <?php echo $cadastro['cpf'] ?></td>
                                                <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                    <?php echo ucwords($cadastro['nome']) ?></td>
                                                <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                    <?php echo $cadastro['dtnascimento'] ?></td>
                                                <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                    <?php echo ucwords($cadastro['endereco']) ?></td>
                                                <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                    <?php echo $cadastro['numero'] ?></td>
                                                <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                    <?php echo ucwords($cadastro['bairro']) ?></td>
                                                <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                    <?php echo ucwords($cadastro['cidade']) ?></td>
                                                <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                    <?php echo $cadastro['cep'] ?></td>
                                                <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                    <?php echo $cadastro['telefone'] ?></td>
                                                <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                    <?php echo $cadastro['celular'] ?></td>
                                                <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                    <?php echo $cadastro['dtcadastro'] ?></td>
                                                <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                    <a href="form-edit.php?id=<?php echo $cadastro['id'] ?>"><svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd" />
                                                            <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 00.5.5H4v.5a.5.5 0 00.5.5H5v.5a.5.5 0 00.5.5H6v-1.5a.5.5 0 00-.5-.5H5v-.5a.5.5 0 00-.5-.5H3z" clip-rule="evenodd" />
                                                        </svg></a>
                                                </td>
                                                <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                    <a href="delete.php?id=<?php echo $cadastro['id'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');">
                                                        <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z" />
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd" />
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else : ?>
                            <p>Nenhum Cliente Cadastrado!</p>
                        <?php endif; ?>
                        </form>
                </div>
            </div>
        </div>
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