<?php

require_once '../init.php';

// resgata os valores do formulário
$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
$nome = ucwords(isset($_POST['nome'])) ? $_POST['nome'] : null;
$dtnascimento = isset($_POST['dtnascimento']) ? $_POST['dtnascimento'] : null;
$endereco = ucwords(isset($_POST['endereco'])) ? $_POST['endereco'] : null;
$numero = isset($_POST['numero']) ? $_POST['numero'] : null;
$bairro = ucwords(isset($_POST['bairro'])) ? $_POST['bairro'] : null;
$cidade = ucwords(isset($_POST['cidade'])) ? $_POST['cidade'] : null;
$cep = isset($_POST['cep']) ? $_POST['cep'] : null;
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
$celular = isset($_POST['celular']) ? $_POST['celular'] : null;
$dtcadastro = isset($_POST['dtcadastro']) ? $_POST['dtcadastro'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;


// atualiza o banco
$PDO = db_connect();
$sql = "UPDATE cadastro_pacientes SET cpf = :cpf, nome = :nome, dtnascimento = :dtnascimento, endereco = :endereco, numero = :numero, bairro = :bairro, cidade = :cidade, cep = :cep, telefone = :telefone, celular = :celular,  dtcadastro = :dtcadastro WHERE id = :id";
$stmt = $PDO->prepare($sql);
	$stmt->bindParam(':cpf', $cpf);
	$stmt->bindParam(':nome', $nome);
	$stmt->bindParam(':dtnascimento', $dtnascimento);
	$stmt->bindParam(':endereco', $endereco);
	$stmt->bindParam(':numero', $numero);
	$stmt->bindParam(':bairro', $bairro);
	$stmt->bindParam(':cidade', $cidade);
	$stmt->bindParam(':cep', $cep);
	$stmt->bindParam(':telefone', $telefone);
	$stmt->bindParam(':celular', $celular);
	$stmt->bindParam(':dtcadastro', $dtcadastro);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
	header('Location: procedimentos.php');
} else {
	echo "Erro ao alterar";
	print_r($stmt->errorInfo());
}
