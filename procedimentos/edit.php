<?php

require_once '../init.php';
$PDO = db_connect();

// pega os dados do formuário
$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$atendimento = isset($_POST['atendimento']) ? $_POST['atendimento'] : null;
$consulta = isset($_POST['consulta']) ? $_POST['consulta'] : null;
$procedimento = isset($_POST['procedimento']) ? $_POST['procedimento'] : null;
$encaminhamento = isset($_POST['encaminhamento']) ? $_POST['encaminhamento'] : null;
$pagamento = isset($_POST['pagamento']) ? $_POST['pagamento'] : null;
$valor = isset($_POST['valor']) ? $_POST['valor'] : null;
$data = isset($_POST['data']) ? $_POST['data'] : null;
$obs = isset($_POST['obs']) ? $_POST['obs'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;

if($id <> ""){

// atualiza o banco
$PDO = db_connect();
$sql = "UPDATE procedimentos_realizados SET cpf = :cpf, nome = :nome, tipo_adendimento = :atendimento, tipo_consulta = :consulta, tipo_procedimento = :procedimento, encaminhamento = :encaminhamento, tipo_pagamento = :pagamento, valor = :valor, dt_procedimento = :data,  obs = :obs WHERE id = :id";
$stmt = $PDO->prepare($sql);
	$stmt->bindParam(':cpf', $cpf);
	$stmt->bindParam(':nome', $nome);
	$stmt->bindParam(':data', $data);
	$stmt->bindParam(':atendimento', $atendimento);
	$stmt->bindParam(':consulta', $consulta);
	$stmt->bindParam(':procedimento', $procedimento);
	$stmt->bindParam(':encaminhamento', $encaminhamento);
	$stmt->bindParam(':pagamento', $pagamento);
	$stmt->bindParam(':valor', $valor);
	$stmt->bindParam(':obs', $obs);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
	header('Location: procedimentos.php');
} else {
	echo "Erro ao alterar";
	print_r($stmt->errorInfo());
}

} 

header('Location: procedimentos.php');	
