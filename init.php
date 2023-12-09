<?php

// constantes com as credenciais de acesso ao banco MySQL
define('DB_HOST', '10.16.0.79');
define('DB_USER', 'default');
define('DB_PASS', '123456');
define('DB_Cazal', 'cazal');
	
// habilita todas as exibições de erros
ini_set('display_errors', true);
error_reporting(E_ALL);

date_default_timezone_set('America/Sao_Paulo');

// inclui o arquivo de funçõees
require_once 'functions.php';


