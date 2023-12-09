<?php
require_once '../init.php';

// pega o ID da URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$cpf = isset($_GET['cpf']) ? (int) $_GET['cpf'] : null;

// valida o ID
if (empty($id)) {
    echo "ID para alteração não definido";
    exit;
}


// abre a conexão
$PDO = db_connect();

// busca os dados do usuário a ser editado
$sql = "SELECT id, cpf, nome, tipo_adendimento, tipo_consulta, tipo_procedimento, encaminhamento, obs, tipo_pagamento, valor, dt_procedimento FROM procedimentos_realizados WHERE id = :id";
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
$sql_count_proc = "SELECT count(id) FROM procedimentos_realizados where cpf='$user[cpf]'";
// conta o toal de registros
$stmt_count_proc = $PDO->prepare($sql_count_proc);
$stmt_count_proc->execute();
$total_proc = $stmt_count_proc->fetchColumn();

// SQL para selecionar os registros
$sql_arry = "SELECT id, cpf, nome, tipo_adendimento, tipo_consulta, tipo_procedimento, encaminhamento, obs, tipo_pagamento, valor, dt_procedimento FROM procedimentos_realizados where cpf = '$user[cpf]'";
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

// SQL para selecionar os registros
$sql_arry_cliente = "SELECT id, cpf, nome, dtnascimento, endereco, numero, bairro, cep, cidade, telefone, celular, dtcadastro FROM cadastro_cliente where cpf= '$cpf' ";
// seleciona os registros
$stmt_array_cliente  = $PDO->prepare($sql_arry_cliente);
$stmt_array_cliente->execute();

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
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
            <form action="edit.php" method="post" class="needs-validation" id="formSearch" novalidate>
                <div align="center">
                    <div class="row justify-content-md-center">
                        <div class="col-sm-3 mb-1">
                            <label for="validationServer01">CPF</label>
                            <input type="text" name="cpf" id="cpf" class="form-control" value="<?php echo ($user['cpf']) ?>">
                        </div>
                        <div class="col-sm-5 mb-1">
                            <label for="validationServer02">Nome</label>
                            <input type="text" name="nome" id="nome" class="form-control" value="<?php echo ucwords($user['nome']) ?>">
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer11">Data</label>
                            <input type="date" name="data" id="data" class="form-control" value="<?php echo ($user['dt_procedimento']) ?>">
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-sm-3 mb-1">
                            <label for="validationServer02">Tipo atendimento</label>
                            <input list="atendimentos" name="atendimento" id="atendimento" class="form-control" value="<?php echo ucwords($user['tipo_adendimento']) ?>" required autofocus>
                            <datalist id="atendimentos">
                                <option value="Escuta inicial/Orientação">
                                <option value="Consulta no dia">
                                <option value="Atendimento de urgência">
                            </datalist>
                        </div>
                        <div class="col-sm-3 mb-1">
                            <label for="validationServer02">Tipo de consulta</label>
                            <input list="consultas" name="consulta" id="consulta" class="form-control" value="<?php echo ucwords($user['tipo_consulta']) ?>" required>
                            <datalist id="consultas">
                                <option value="Primeira consulta odontológica programática">
                                <option value="Consulta de retorno em odontologia">
                                <option value="Consulta de manutenção em odontologia">
                            </datalist>
                        </div>
                        <div class="col-sm-5 mb-1">
                            <label for="validationServer02">Tipo de procedimento</label>
                            <input list="procedimentos" name="procedimento" id="procedimento" class="form-control" value="<?php echo ucwords($user['tipo_procedimento']) ?>" required>
                            <datalist id="procedimentos">
                                <?php while ($procedimento = $stmt_array_proc->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <option value=" <?php echo $procedimento['descricao'] ?>">
                                    <?php endwhile; ?>
                            </datalist>
                        </div>
                        <div class="col-sm-5 mb-1">
                            <label for="validationServer02">Encaminhamento</label>
                            <input list="encaminhamentos" name="encaminhamento" id="encaminhamento" class="form-control" value="<?php echo ucwords($user['encaminhamento']) ?>" required>
                            <datalist id="encaminhamentos">
                                <?php while ($encaminhamento = $stmt_array_enc->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <option value=" <?php echo $encaminhamento['descricao'] ?>">
                                    <?php endwhile; ?>
                            </datalist>
                        </div>
                        <div class="col-sm-4 mb-1">
                            <label for="validationServer02">Obs</label>
                            <input type="text" name="obs" id="obs" class="form-control" value="<?php echo ucwords($user['obs']) ?>" required>
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer02">Tipo Pagametno</label>
                            <input list="pagamentos" name="pagamento" id="pagamento" class="form-control" value="<?php echo ucwords($user['tipo_pagamento']) ?>" required>
                            <datalist id="pagamentos">
                                <option value="Boleto">
                                <option value="Cartão">
                                <option value="Dinheiro">
                                <option value="Plano de saúde">
                            </datalist>
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer06">Valor</label>
                            <input type="number" name="valor" id="valor" class="form-control" value="<?php echo ucwords($user['valor']) ?>" required>
                        </div>
                        <div class="col-sm-2 mb-1">
                            <br>
                            <button type="submit" id="submit" name="Import" class="btn btn-primary" >Gravar</button>
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div align="center" style="margin-top: 10px;">
        <div class="border border-danger" style="margin-top: 5px;background-color: white; color: black; width: 80%; border-radius: 20px; font-size: 12px; min-height: 350px;">
            <div style="width:99%">
                <from>
                    <p>Total de Procedimentos Realizados: <?php echo $total_proc ?></p>
                    <?php if ($total_proc > 0) : ?>
                        <div class="table-responsive">
                            <table table-responsive>
                                <thead>
                                    <tr style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                        <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                            Procedimento</th>
                                        <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                            Tipo atendimento</th>
                                        <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                            Tipo de consulta</th>
                                        <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                            Tipo de procedimento</th>
                                        <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                            Encaminhamento</th>
                                        <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                            Observação</th>
                                        <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                            Tipo Pagametno</th>
                                        <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                            Valor</th>
                                        <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                            Data da Consulta</th>
                                        <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                            Edit</th>
                                        <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                            Excluir</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($cadastro = $stmt_array->fetch(PDO::FETCH_ASSOC)) : ?>
                                        <tr style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                            <td style="text-align: center; border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                <?php echo $cadastro['id'] ?></td>
                                            <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                <?php echo ucwords($cadastro['tipo_adendimento']) ?></td>
                                            <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                <?php echo $cadastro['tipo_consulta'] ?></td>
                                            <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                <?php echo ucwords($cadastro['tipo_procedimento']) ?></td>
                                            <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                <?php echo ucwords($cadastro['encaminhamento']) ?></td>
                                            <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                <?php echo ucwords($cadastro['obs']) ?></td>
                                            <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                <?php echo $cadastro['tipo_pagamento'] ?></td>
                                            <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                R$<?php echo  $cadastro['valor'] ?></td>
                                            <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                                <?php echo $cadastro['dt_procedimento'] ?></td>
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