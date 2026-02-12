<?php
	header("Content-Type: application/xml; charset=UTF-8");
	echo '<?xml version="1.0" encoding="UTF-8"?>';
	
	include('f/conf/config.php');

 
	$hoje = date('Y-m-d');
?>
	<urlset
		xmlns="https://www.sitemaps.org/schemas/sitemap/0.9"
		xmlns:xsi="https://www.w3.org/2001/XMLSchema-instance"
		xsi:schemaLocation="https://www.sitemaps.org/schemas/sitemap/0.9
		https://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
		<url>
			<loc>https://litoralimoveisgaivota.com.br/</loc>
			<lastmod><?php echo $hoje;?></lastmod>		
			<changefreq>daily</changefreq>
			<priority>1.00</priority>
		</url>
		<url>
			<loc>https://litoralimoveisgaivota.com.br/sobre/</loc>
			<lastmod><?php echo $hoje;?></lastmod>				
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
		</url>
		<url>
			<loc>https://litoralimoveisgaivota.com.br/imoveis/</loc>
			<lastmod><?php echo $hoje;?></lastmod>		
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
		</url>					
		<url>
			<loc>https://litoralimoveisgaivota.com.br/loteamentos/</loc>
			<lastmod><?php echo $hoje;?></lastmod>		
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
		</url>
		<url>
			<loc>https://litoralimoveisgaivota.com.br/novidades/</loc>
			<lastmod><?php echo $hoje;?></lastmod>		
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
		</url>
		<url>
			<loc>https://litoralimoveisgaivota.com.br/depoimentos/</loc>
			<lastmod><?php echo $hoje;?></lastmod>		
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
		</url>
		<url>
			<loc>https://litoralimoveisgaivota.com.br/hoteis-e-restaurantes/</loc>
			<lastmod><?php echo $hoje;?></lastmod>		
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
		</url>
		<url>
			<loc>https://litoralimoveisgaivota.com.br/trabalhe-conosco/</loc>
			<lastmod><?php echo $hoje;?></lastmod>		
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
		</url>
		<url>
			<loc>https://litoralimoveisgaivota.com.br/onde-estamos/</loc>
			<lastmod><?php echo $hoje;?></lastmod>		
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
		</url>
		<url>
			<loc>https://litoralimoveisgaivota.com.br/contato/</loc>
			<lastmod><?php echo $hoje;?></lastmod>		
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
		</url>
<?php
	$sqlNoticia = "SELECT codNoticia, urlNoticia FROM noticias WHERE statusNoticia = 'T' ORDER BY codNoticia DESC";
	$resultNoticia = $conn->query($sqlNoticia);
	while($dadosNoticia = $resultNoticia->fetch_assoc()){
			
		echo "<url>
				<loc>https://litoralimoveisgaivota.com.br/noviades/".$dadosNoticia['codNoticia']."-".$dadosNoticia['urlNoticia']."/</loc>
				<lastmod>".$hoje."</lastmod>
				<changefreq>daily</changefreq>
				<priority>0.80</priority>
			</url>";
	}
	
	$sqlImovel = "SELECT codImovel, urlImovel FROM imoveis WHERE statusImovel = 'T' ORDER BY codImovel DESC";
	$resultImovel = $conn->query($sqlImovel);
	while($dadosImovel = $resultImovel->fetch_assoc()){
			
		echo "<url>
				<loc>https://litoralimoveisgaivota.com.br/imoveis/".$dadosImovel['codImovel']."-".$dadosImovel['urlImovel']."/</loc>
				<lastmod>".$hoje."</lastmod>
				<changefreq>daily</changefreq>
				<priority>0.80</priority>
			</url>";
	}

	$sqlImovel = "SELECT codLoteamento, urlLoteamento FROM loteamentos WHERE statusLoteamento = 'T' ORDER BY codLoteamento DESC";
	$resultImovel = $conn->query($sqlImovel);
	while($dadosImovel = $resultImovel->fetch_assoc()){
			
		echo "<url>
				<loc>https://litoralimoveisgaivota.com.br/loteamentos/".$dadosImovel['codLoteamento']."-".$dadosImovel['urlLoteamento']."/</loc>
				<lastmod>".$hoje."</lastmod>
				<changefreq>daily</changefreq>
				<priority>0.80</priority>
			</url>";
	}
?>				
	</urlset>
