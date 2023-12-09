<?php
session_start(); # Deve ser a primeira linha do arquivo
require_once 'init.php';

// pega os dados do formuário
$user = isset($_POST['user']) ? $_POST['user'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;


$PDO = db_connect();

$sql_count = "select count(*) acessos from login where user = '" . $user . "' and password  = '" . $password . "'";
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();

$sql_id = "SELECT id from login where user = '" . $user . "' ";
$stmt_id = $PDO->prepare($sql_id);
$stmt_id->execute();
$id = $stmt_id->fetchColumn();

$sql_nome = "SELECT nome from login where user = '" . $user . "' ";
$stmt_nome = $PDO->prepare($sql_nome);
$stmt_nome->execute();
$nome = $stmt_nome->fetchColumn();

$sql_acesso = "SELECT role from login where user = '" . $user . "' ";
$stmt_acesso = $PDO->prepare($sql_acesso);
$stmt_acesso->execute();
$roller = $stmt_acesso->fetchColumn();

$_SESSION['nome'] = $nome;
$_SESSION['user'] = $user;

$data = date('Y-m-d');

$acersso = 0;
$port = 4;

if ($total == 1)
{
	$PDO = db_connect();
	$sql = "UPDATE login SET ultimo_acesso = :ultimo_acesso WHERE id = :id";
	$stmt = $PDO->prepare($sql);
	$stmt->bindParam(':ultimo_acesso', $data);	
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();

	if((int)$roller == $acersso){
		header('Location: produtividade/setor.php');
	} elseif((int)$roller == 6){
		header('Location: cancelamento/estacao.php');
	} elseif((int)$roller == $port){
		header('Location: portaria/inicial.php');
	}else {
		header('Location: inicial.php');
	}		

}
else
{
	echo ("<script LANGUAGE='JavaScript'>
	window.alert('Matricula ou Senha não confere, tente novamente!');
	window.location.href='index.php';
	</script>");
}

