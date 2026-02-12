<?php
	if($url[2] == ""){
		$sqlHistorico = "SELECT * FROM empresa LIMIT 0,1";
		$resultHistorico = $conn->query($sqlHistorico);
		$dadosHistorico = $resultHistorico->fetch_assoc();

		$title = $nomeEmpresa;
		$description = strip_tags($dadosHistorico['descricaoEmpresa']);
	}else
	if($url[2] == "sobre"){
		$sqlHistorico = "SELECT * FROM empresa LIMIT 0,1";
		$resultHistorico = $conn->query($sqlHistorico);
		$dadosHistorico = $resultHistorico->fetch_assoc();
		
		$title = "Sobre | ".$nomeEmpresa;
		$description = strip_tags($dadosHistorico['descricaoEmpresa']);
	}else
	if($url[2] == "onde-estamos"){
		$title = "Onde Estamos | ".$nomeEmpresa;
		$description = strip_tags($dadosHistorico['descricaoEmpresa']);
	}else
	if($url[2] == "hoteis-e-restaurantes"){
		$title = "Hotéis e Restaurantes | ".$nomeEmpresa;
		$description = strip_tags($dadosHistorico['descricaoEmpresa']);
	}else
	if($url[2] == "trabalhese-conosco"){
		$title = "Trabalhe Conosco | ".$nomeEmpresa;
		$description = strip_tags($dadosHistorico['descricaoEmpresa']);
	}else
	if($url[2] == "novidades"){
		$title = "Novidades | ".$nomeEmpresa;
		
		if($url[3] != ""){
			$quebraUrl = explode("-", $url[3]);
		
			$sqlNoticia = "SELECT nomeNoticia, descricaoNoticia FROM noticias WHERE codNoticia = '".$quebraUrl[0]."' LIMIT 0,1";
			$resultNoticia = $conn->query($sqlNoticia);
			$dadosNoticia = $resultNoticia->fetch_assoc();

			$title = $dadosNoticia['nomeNoticia']." - Novidades | ".$nomeEmpresa;
			$description = strip_tags($dadosNoticia['descricaoNoticia']);
		}
	}else
	if($url[2] == "loteamentos"){
		$title = "Loteamentos | ".$nomeEmpresa;
		
		if($url[3] != ""){
			$quebraUrl = explode("-", $url[3]);
		
			$sqlNoticia = "SELECT nomeLoteamento, descricaoLoteamento FROM loteamentos WHERE codLoteamento = '".$quebraUrl[0]."' LIMIT 0,1";
			$resultNoticia = $conn->query($sqlNoticia);
			$dadosNoticia = $resultNoticia->fetch_assoc();

			$title = $dadosNoticia['nomeLoteamento']." - Loteamentos | ".$nomeEmpresa;
			$description = strip_tags($dadosNoticia['descricaoLoteamento']);
		}
	}else
	if($url[2] == "imoveis"){
		$title = "Imóveis | ".$nomeEmpresa;
		$description = "";		

		$sqlTipoImovelUrl = "SELECT * FROM tipoImovel WHERE urlTipoImovel = '".$url[3]."' ORDER BY codTipoImovel ASC LIMIT 0,1";
		$resultTipoImovelUrl = $conn->query($sqlTipoImovelUrl);
		$dadosTipoImovelUrl = $resultTipoImovelUrl->fetch_assoc();
		
		if($dadosTipoImovelUrl['codTipoImovel'] != "" && $url[2] == "imoveis"){		
			$title = $dadosTipoImovelUrl['nomeTipoImovel']." - Imóveis | ".$nomeEmpresa;

			$sqlCidadeUrl = "SELECT * FROM cidades WHERE urlCidade = '".$url[4]."' ORDER BY codCidade ASC LIMIT 0,1";
			$resultCidadeUrl = $conn->query($sqlCidadeUrl);
			$dadosCidadeUrl = $resultCidadeUrl->fetch_assoc();		
			
			$title = $dadosTipoImovelUrl['nomeTipoImovel']." em ".$dadosCidadeUrl['nomeCidade']." - Imóveis | ".$nomeEmpresa;
				
		}else		
		if($url[3] != "" && !is_numeric($url[3])){

			$quebraUrl = explode('-', $url[3]);

			$sqlImovel = "SELECT * FROM imoveis WHERE codImovel = ".$quebraUrl[0]." LIMIT 0,1";
			$resultImovel = $conn->query($sqlImovel);
			$dadosImovel = $resultImovel->fetch_assoc();
			
			$sqlCidade = "SELECT * FROM cidades WHERE codCidade = ".$dadosImovel['codCidade']." LIMIT 0,1";
			$resultCidade = $conn->query($sqlCidade);
			$dadosCidade = $resultCidade->fetch_assoc();
			
			$sqlBairro = "SELECT * FROM bairros WHERE codBairro = ".$dadosImovel['codBairro']." LIMIT 0,1";
			$resultBairro = $conn->query($sqlBairro);
			$dadosBairro = $resultBairro->fetch_assoc();

			$text = strip_tags($dadosImovel['descricaoImovel']);		

			$title = $dadosImovel['nomeImovel']." em ".$dadosCidade['nomeCidade']." - ".$dadosBairro['nomeBairro']." - Imóveis | ".$nomeEmpresa;
			$description = $text;
		}
	
	}else	
	if($url[2] == "depoimentos"){
		$title = "Depoimentos | ".$nomeEmpresa;
		$description = "Confira os depoimentos sobres nós";
	}else	
	if($url[2] == "anuncie-seu-imovel"){
		$title = "Anúncie seu Imóvel | ".$nomeEmpresa;
		$description = "Para anúnciar seu imóvel com a Litoral Imóveis, basta você preencher todos os campos abaixo, enviar e em breve entramos em contato com você.";
	}else
	if($url[2] == "land-incorporacoes"){
		$title = "Land Incorporações | ".$nomeEmpresa;
		$description = "";
	}else		
	if($url[2] == "imoveis-litoral"){
		$title = "Loteadora Litoral | ".$nomeEmpresa;
		$description = "";
	}else		
	if($url[2] == "imoveis-wc"){
		$title = "Loteadora WC | ".$nomeEmpresa;
		$description = "";
	}else		
	if($url[2] == "politica-de-privacidade"){
		$title = "Política de Privacidade | ".$nomeEmpresa;
		$description = "";
	}else		
	if($url[2] == "atualizar"){
		$title = "Atualizar Imóveis | ".$nomeEmpresa;
		$description = "";
	}else		
	if($url[2] == "contato"){
		$title = "Contato | ".$nomeEmpresa;
		$description = "Para entrar em contato com a Litoral Imóveis, basta você preencher todos os campos, enviar e em breve entramos em contato com você.";
		
		if($url[3] == "enviado-com-sucesso"){
			$title = "Contato enviado com sucesso | ".$nomeEmpresa;
			$description = "";
		}			
	}else	
	if($url[2] == "contato-whatsapp-enviado"){
		$title = "WhatsApp enviado com sucesso | ".$nomeEmpresa;
		$description = "";
	}	

	
	$keywords = "litoral imóveis, litoral imoveis gaivota, litoral imóveis em balneário gaivota, litoral imóveis balneáio, comprar imóvel em balneário gaivota, comprar casa em balneário gaivota, comprar terreno em balneário gaivota, casas em balneário gaivota, terrenos em balneário gaivota."; 
?>

