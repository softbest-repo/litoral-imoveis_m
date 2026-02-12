<?php

	error_reporting(1);
	ini_set('display_errors', 1);

	$configServer = "localhost"; 
	$configLogin = "root"; 
	$configSenha = ""; 
	$configBaseDados = "litoral-imoveis";
	

	$configUrl = "https://".$_SERVER['HTTP_HOST']."/litoral-imoveis_m/";
	$configUrlSeg = "https://".$_SERVER['HTTP_HOST']."/litoral-imoveis/";
	$configUrlGer = "https://".$_SERVER['HTTP_HOST']."/litoral-imoveis/ger/";

	$conn = new mysqli($configServer, $configLogin, $configSenha, $configBaseDados);
	$conn->set_charset("utf8mb4");
	
	if ($conn->connect_error) {
		die("Erro de conexão: " . $conn->connect_error);
	}

	$sqlSession = "SET SESSION sql_mode = ''";
	$resultSession = $conn->query($sqlSession);
	
	$nomeEmpresa = "Litoral Imóveis - Imobiliária em Balneário Gaivota";
	$nomeEmpresaMenor = "Litoral Imóveis";
	
	$cookie = "litoralImoveisSite";

	$urlUpload = "/ger";
	// $senhaIntegrador = "Litoral2026@";
	// $codigoImobiliaria = 5;
	// $linkIntegrador = "https://sbintegracao.com.br/integrador.php";
	// $senhaIntegra = "SoftBest2026";

	$sql = "SELECT * FROM informacoes WHERE codInformacao = 1";
	$result = $conn->query($sql);
	$dadosInformacao = $result->fetch_assoc();

	$endereco = $dadosInformacao['enderecoInformacao'];
	$endereco2 = $dadosInformacao['endereco2Informacao'];
	$endereco3 = $dadosInformacao['endereco3Informacao'];

	$rota = $dadosInformacao['rotaInformacao'];
	$rota2 = $dadosInformacao['rota2Informacao'];
	$rota3 = $dadosInformacao['rota3Informacao'];


	$estado = "Santa Catarina";
	$cidade = "Balneário Gaivota";

	$telefone = $dadosInformacao['telefoneInformacao'];
	$celular = $dadosInformacao['celularInformacao'];

	$email = $dadosInformacao['emailInformacao'];
	
	$creci = $dadosInformacao['creciInformacao'];
	
	$facebook = $dadosInformacao['facebookInformacao'];
	$instagram = $dadosInformacao['instagramInformacao'];
	
	$mapa = $dadosInformacao['mapaInformacao'];

	$hostEmail = "srv214.prodns.com.br";
	$dominio = "https://litoralimoveisgaivota.com.br";
	$dominioSem = "litoralimoveisgaivota.com.br";
	
	// $chaveSite = "6Le-U7kpAAAAAN2qQAMBCRWI9gH18fFOJQBAGLCQ";
	// $chaveSecreta = "6Le-U7kpAAAAAGRuvX1ofhyk1nKbREPJ2dJ9CO_k";

	$chaveSite = "6Lcf_40qAAAAABj2Mh24GvTcutl8b_299JrKrsOU";
	$chaveSecreta = "6Lcf_40qAAAAAIDMDoww_YgGHq88QWP0T9op_TVy";
	
	$cor1 = "#06496E";
	$cor2 = "#06496E";
?>
	
