<?php
require_once '../init.php';

// pega o ID da URL
$codigo = isset($_GET['codigo']) ? (int) $_GET['codigo'] : null;

// abre a conexão
$PDO = db_connect_tratativa();

// busca os dados do usuário a ser editado
$sql = "SELECT  nome FROM separadores WHERE codigo = :codigo";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
