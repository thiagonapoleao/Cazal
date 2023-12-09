<?php
require_once '../init.php';

// pega o ID da URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

// valida o ID
if (empty($id)) {
    echo "ID para alteração não definido"; 
    exit;
}


// abre a conexão
$PDO = db_connect();

// busca os dados do usuário a ser editado
$sql = "SELECT id, cpf, nome, dtnascimento, endereco, numero, bairro, cep, cidade, telefone, celular, dtcadastro FROM cadastro_pacientes WHERE id = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// se o método fetch() não retornar um array, significa que o ID não corresponde a um usuário válido
if (!is_array($user)) {
    echo "Nenhum usuário encontrado";
    exit;
}

// sql_count para contar o total de registros
$sql_count = "SELECT count(cpf) FROM cadastro_pacientes";
// conta o toal de registros
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();

// SQL para selecionar os registros
$sql_arry = "SELECT id, cpf, nome, dtnascimento, endereco, numero, bairro, cep, cidade, telefone, celular, dtcadastro FROM cadastro_pacientes  order BY cpf asc ";
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
        <nav class="navbar fixed-top navbar-expand navbar-light" style="background: linear-gradient(to bottom,  #00c6ff, #0072ff)">
            <a class="nav-link" data-toggle="modal" data-target="#viradatacontabil" href="" style="color: black;">Cazal</a>
            <div id="collapse-navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="inicial.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Agenda
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item"  href="../agenda/calendario.php">Calendario</a>
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cadastro
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="cadastro.php">Cadastro de Pacientes</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="">Cadastro de Pacientes</a>
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Procedimentos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../procedimentos/procedimentos.php">Procedimentos</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="">Consulta Procedimentos</a>
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>
                </ul>
            </div>
            <img src="../img/Cazal-logotipo2.jpg" alt="Stickman" width="10%" height="10%" style="border-radius: 5px">
        </nav>
    </header>
    <div id="interface" style="background: linear-gradient(to top,#004e92, #000428, #000000); background-repeat: no-repeat; background-attachment: fixed; background-size: 100% 100%; border-radius: 20px;margin-top: 80px;color: blanchedalmond">
        <div class="container" style="margin-top: 10px">
            <form action="edit-cadastro.php" method="post" class="needs-validation" novalidate>
            <div align="center">
                    <div class="row justify-content-md-center">
                        <div class="col-sm-3 mb-1">
                            <label for="validationServer01">CPF</label>
                            <input type="number" name="cpf" id="cpf" value="<?php echo $user['cpf'] ?>" class="form-control">
                        </div>
                        <div class="col-sm-5 mb-1">
                            <label for="validationServer02">Nome</label>
                            <input type="text" name="nome" id="nome" value="<?php echo ucwords($user['nome']) ?>" class="form-control">
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer03">Data de Nascimento</label>
                            <input type="date" name="dtnascimento" id="dtnascimento" value="<?php echo $user['dtnascimento'] ?>" class="form-control">
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer10">Data de Cadastro</label>
                            <input type="date" name="dtcadastro" id="dtcadastro" value="<?php echo $user['dtcadastro'] ?>" class="form-control">
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer08">CEP</label>
                            <input type="number" name="cep" id="cep" value="<?php echo $user['cep'] ?>" class="form-control">
                        </div>
                        <div class="col-sm-4 mb-1">
                            <label for="validationServer04">Endereço</label>
                            <input type="text" name="endereco" id="endereco" value="<?php echo ucwords($user['endereco']) ?>" class="form-control">
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer05">Numero</label>
                            <input type="number" name="numero" id="numero" value="<?php echo $user['numero'] ?>" class="form-control">
                        </div>
                        <div class="col-sm-4 mb-1">
                            <label for="validationServer06">Bairro</label>
                            <input type="text" name="bairro" id="bairro" value="<?php echo ucwords($user['bairro']) ?>" class="form-control">
                        </div>
                        <div class="col-sm-4 mb-1">
                            <label for="validationServer07">Cidade</label>
                            <input type="text" name="cidade" id="cidade" value="<?php echo ucwords($user['cidade']) ?>" class="form-control">
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer09">Telefone</label>
                            <input type="number" name="telefone" id="telefone" value="<?php echo $user['telefone'] ?>" class="form-control">
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer10">Celular</label>
                            <input type="number" name="celular" id="celular" value="<?php echo $user['celular'] ?>" class="form-control">
                        </div>
                        <div class="col-sm-2 mb-1">
                            <br>
                            <button type="submit" id="submit" name="Import" class="btn btn-primary" >Cadastrar</button>
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                        </div>
                    </div>
                </div>
            </form>
        </div>      
    </div>
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