<?php 
	ob_start();

	ini_set('display_errors', '0');
	error_reporting(E_ALL | E_STRICT);

	include ('f/conf/config.php');
	include ('f/conf/conexao.php');
		
	setcookie("politica".$cookie, 1, time()+3600, "/");					
?>
