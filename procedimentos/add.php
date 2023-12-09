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


if (empty($cpf)) {
	echo "Erro ao Lançar Procedimento";
} else {
	// insere no banco

	$sql = "INSERT INTO procedimentos_realizados(cpf, nome, tipo_adendimento, tipo_consulta, tipo_procedimento, encaminhamento, obs, tipo_pagamento, valor, dt_procedimento ) VALUES(trim(:cpf), :nome, :adendimento, :consulta, :procedimento, :encaminhamento, :obs, :pagamento, :valor, :data)";
	$stmt = $PDO->prepare($sql);
	$stmt->bindParam(':cpf', $cpf);
	$stmt->bindParam(':nome', $nome);	
	$stmt->bindParam(':adendimento', $atendimento);
	$stmt->bindParam(':consulta', $consulta);
	$stmt->bindParam(':procedimento', $procedimento);
	$stmt->bindParam(':encaminhamento',$encaminhamento);
	$stmt->bindParam(':obs',$obs);
	$stmt->bindParam(':pagamento', $pagamento);
	$stmt->bindParam(':valor', $valor);	
	$stmt->bindParam(':data', $data);
	if ($stmt->execute()) {
		header('Location: procedimentos.php');
	} else {
		echo "Erro ao cadastrar";
		print_r($stmt->errorInfo());
		header('Location: procedimentos.php');
	}	
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>GI</title>
	<link rel="stylesheet" type="text/css" href="../stilo.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<meta name="author" content="">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width" scale="1">
	<!-- transforma a pagina em  responsivel-->
</head>

<body style="background: linear-gradient(to top,#004e92, #000428, #000000); background-attachment: fixed; background-size: 100% 100%; ">
	<header>
		<div class="container" id="interface" style="background-image:  url('../img/logo-pagina-inicial3.jpg'); background-repeat: no-repeat; background-attachment: fixed; background-size: 100% 100%; min-height: 500px; margin-top: 60px" align="center">
			<div class="alert alert-danger" role="alert">
				<h2 style="color: red">Erro ao cadastrar cliente!</h2>
				<h3>Todos os campos tem que ser preenchidos!</h3>
				<a class="nav-link" href="cadastro.php"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAAFAUlEQVRoge2ZXUwcVRTH/3d2WXBBUqCt4aMPiAKWxKQulpbGKI0PYktqH4q2aOODiWkBY+KjNcHE+FAftBFIG5MmJm1sqzG1tX1S2kRrTAOJTaN8CC9lCzF0KchH92Pm/H3YBZZddmd2d4AHOS+TM5mZ+/vfc+aeO2eADduw/7cpOx5y6BIdw9WTOw2yAQY8BKspLAaRRyFIzFJkjOAgdPTpmvQM7ym9DaVkXQU8f9e3TVeqlcI3SZSGYQkKAQLRfviIaN8LwTloqmu4ocy7pgJ2/D2zRQVDn5B4m0IXY2AtwIMCIOwHAZx1BvwfDTVVPVh1AZ7+6SMi8iXIwkh6ZAIfdR4+EbSN7i+/sCoCPL3MQt50Nw2+EzWoXfCLPsgzW8en2vverQ3ZJsDTO+am2/0dyMbVhF/whXJdOfMOjTWVzGcswNPLLLqnf1gr+PDzCJI/FYq+78/mmmAyPs10+vOmu9cBHhS+7KPjVEYReG5gugWGnFsH+KVrwDcmDm+/mLKAnf3/FuliDJDcvG7wYX8yoDmrZo6svMQmTCFd9E8zgjdoBzxIFLpCoY9TisCzd3xlDocaSbdIyfw85NEcVHYu4MrOBH7BD0LTnn54tOaepQg4HKotbfi5WRwodOJWYw2MR3N2wINCl4SMY9ZSiNQobEkX/tWCLJysK0eJ22UXPCLF4S1cuuQwFbDj7mQdibJ04T/f/SScSkXmwh74yFil+b5Kj6kAg2xIB76xwLkMHrAVPrKkyt5YXmdcBglqkQb8F7srlsEDAPQQjClfFDziBSkFZOeCmiM5PAkRxEUgTgDIypRe2CIXPqsrhyMWHoD36K64c7H2+9gU9l3pB9z5SeEjNaUq9v64FKJIsTX4OTQWOHEyAbxV21WyCWLopvARv9hUwNJnYBL4kI5nsnScWilt0jCL8CD5uKkAkwcshBLCjLmjxrQEH77OVAA5awYP5UC/X6H912HotEGJVXhixlyAcNzKxgzZblybCOCDWyMwMhDxm/choBxW4EHBeOz9KyyjHCJRY2VXiexcfD8+i8DNIXS+WAmntvx92Hr6F1BpIBKv89Cc4WXUFJ4QctBUAAS9BA+awUdH4uo/c+DNQXS9VLVMBJUDKr8AiEBgaVsAZT1tlsYS9sbixqWQrkmPVfilSLhxddyP4zcGoEe9aMlmPlV4CqFEekwFDO8pvU1yNNWPEeS4ceW+H8d/7l8UYSc8iXuhQH2fqQAoJRCcTwV+cdAcNy57/XivZwCjM34Qyi540OB5dMS3IlesQk/d8JZJyBgh6bIKH32NPJqDBPxA1mNAVnbm8MKACCpwov6+eQQARHqVZ9OBpxBwuaHcm+yCB4CvVoJPKAAAgqJ9SKoHqcIv+kixwibeWvskGEj4TZxQgPeVbZMibE8L3o6cX/Apx9DRkLDpm7SxNbq//ALIM+sGL+zCiRe+TcZo2pkb9Ve00uDlNYc3eA1G6H0zPvPWYrMy4MptIXl97WYeP0JymtHRoGcuAMBYU8n8uG/mNRCn1yRtjOBBdNSadqaBNH5wbPnmr9dpsJPEZpvhJ0hpNcv5WLMUgWibOLz9YsDQqiHsJhmwo0gB6GRIVacKD2T4k6/o6z9KdV1rg7CF5LaU4IFR6jwnRFeiIrXqAhatg1r+E3dqCdlrCDwgqygsJZlHIRQxK0KvkEMQ9iqRnlCgvm+lvc2GbdiGpWb/AZxiTkjb4r98AAAAAElFTkSuQmCC" /></a>
			</div>

		</div>
		<header>
			<!-- Optional JavaScript -->
			<!-- jQuery first, then Popper.js, then Bootstrap JS -->
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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