<?php

require_once 'init.php';

// abre a conexão
$PDO = db_connect();

if(isset($_POST['searchAdress'])){
    $cpf = $_POST['cpf'];

    $sql = "SELECT id, cpf, nome, dtnascimento, endereco, numero, bairro, cep, cidade, telefone, celular, dtcadastro FROM cadastro_pacientes where cpf = $cpf";
    $stmt_array = $PDO->prepare($sql);
    $stmt_array->execute();
    $return = $stmt_array->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode($return);
}
