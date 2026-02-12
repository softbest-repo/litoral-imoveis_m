<?php
	header("Content-Type: application/xml; charset=UTF-8");
	echo '<?xml version="1.0" encoding="UTF-8"?>';
		
	include('f/conf/config.php');
?>				
	<Document>
		<imoveis>
<?php
	$sqlImovel = "SELECT * FROM imoveis I inner join imoveisImagens II on I.codImovel = II.codImovel WHERE I.statusImovel = 'T' GROUP BY I.codImovel ORDER BY I.codImovel DESC LIMIT 0,2000";
	$resultImovel = $conn->query($sqlImovel);
	while($dadosImovel = $resultImovel->fetch_assoc()){
		
		$sqlTipoImovel = "SELECT * FROM tipoImovel WHERE codTipoImovel = '".$dadosImovel['codTipoImovel']."' ORDER BY codTipoImovel ASC LIMIT 0,1";
		$resultTipoImovel = $conn->query($sqlTipoImovel);
		$dadosTipoImovel = $resultTipoImovel->fetch_assoc();
		
		$sqlCidade = "SELECT * FROM cidades WHERE codCidade = '".$dadosImovel['codCidade']."' ORDER BY codCidade ASC LIMIT 0,1";
		$resultCidade = $conn->query($sqlCidade);
		$dadosCidade = $resultCidade->fetch_assoc();
		
		$sqlBairro = "SELECT * FROM bairros WHERE codBairro = '".$dadosImovel['codBairro']."' ORDER BY codBairro ASC LIMIT 0,1";
		$resultBairro = $conn->query($sqlBairro);
		$dadosBairro = $resultBairro->fetch_assoc();
		
		if($dadosImovel['tipoCImovel'] == "V"){
			$transacao = "V";
		}else{
			$transacao = "L";
		}
		
		if($dadosImovel['destaqueImovel'] == "T"){
			$destaque = 1;
		}else{
			$destaque = 0;
		}
				
		if($dadosTipoImovel['nomeTipoImovel'] == "Apartamento"){
			$tipo = "Apartamento";
			$finalidade = "RE";
		}else
		if($dadosTipoImovel['nomeTipoImovel'] == "Casa"){
			$tipo = "Casa / Sobrado";
			$finalidade = "RE";
		}else
		if($dadosTipoImovel['nomeTipoImovel'] == "Sobrado"){
			$tipo = "Casa / Sobrado";
			$finalidade = "RE";
		}else
		if($dadosTipoImovel['nomeTipoImovel'] == "Sala Comercial"){
			$tipo = "Conj. Comercial / Sala";
			$finalidade = "CO";
		}else
		if($dadosTipoImovel['nomeTipoImovel'] == "Flat"){
			$tipo = "Flat";
			$finalidade = "RE";
		}else
		if($dadosTipoImovel['nomeTipoImovel'] == "Terreno"){
			$tipo = "Terreno / Lote";
			$finalidade = "RE";
		}else
		if($dadosTipoImovel['nomeTipoImovel'] == "Loft"){
			$tipo = "Loft";
			$finalidade = "RE";
		}else
		if($dadosTipoImovel['nomeTipoImovel'] == "Kitnet / Stúdio"){
			$tipo = "Kitnet / Stúdio";
			$finalidade = "RE";
		}else
		if($dadosTipoImovel['nomeTipoImovel'] == "Cobertura"){
			$tipo = "Cobertura";
			$finalidade = "RE";
		}else
		if($dadosTipoImovel['nomeTipoImovel'] == "Geminados"){
			$tipo = "Geminados";
			$finalidade = "RE";
		}else
		if($dadosTipoImovel['nomeTipoImovel'] == "Sítio"){
			$tipo = "Sítio / Chácara";
			$finalidade = "RE";
		}
		
		$linkVideo = str_replace("&", "&amp;", $dadosImovel['videoImovel']);
		$linkVideo = str_replace("&", "&amp;", $linkVideo);
		$linkVideo = str_replace("&", "&amp;", $linkVideo);
		
		$nomeImovel = str_replace("&", "&amp;", $dadosImovel['nomeImovel']);
		$nomeImovel = str_replace("&", "&amp;", $nomeImovel);
		$nomeImovel = str_replace("&", "&amp;", $nomeImovel);
		$nomeImovel = str_replace("&", "&amp;", $nomeImovel);
		$nomeImovel = str_replace("&", "&amp;", $nomeImovel);
		
		$descricao = html_entity_decode(trim(strip_tags($dadosImovel['descricaoImovel'])));
		$descricao = nl2br($descricao);
		
		if($dadosImovel['metragemImovel'] == ""){
			$metragem = 0;
		}else{
			$metragem = $dadosImovel['metragemImovel'];
		}
?>
			<imovel>
				<referencia><?php echo $dadosImovel['codigoImovel'];?></referencia>
				<codigo_cliente><?php echo $dadosImovel['codImovel'];?></codigo_cliente>
				<link_cliente><?php echo $configUrl.'imoveis/'.$dadosImovel['codImovel'].'-'.$dadosImovel['urlImovel'].'/';?></link_cliente>
				<titulo><?php echo $nomeImovel;?></titulo>
				<transacao><?php echo $transacao;?></transacao>
				<transacao2></transacao2>
				<finalidade><?php echo $finalidade;?></finalidade>
				<finalidade2></finalidade2>
				<destaque><?php echo $destaque;?></destaque>
				<tipo><?php echo $tipo;?></tipo>
				<tipo2></tipo2>
				<valor><?php echo $dadosImovel['precoImovel'];?></valor>
				<valor_locacao></valor_locacao>
				<valor_iptu></valor_iptu>
				<valor_condominio></valor_condominio>
				<area_total></area_total>
				<area_util><?php echo number_format($metragem, 2, ".", ",");?></area_util>
				<conservacao></conservacao>
				<quartos><?php echo $dadosImovel['quartosImovel'];?></quartos>
				<suites><?php echo $dadosImovel['suiteImovel'];?></suites>
				<garagem><?php echo $dadosImovel['garagemImovel'];?></garagem>
				<banheiro><?php echo $dadosImovel['banheirosImovel'];?></banheiro>
				<closet></closet>
				<salas></salas>
				<despensa></despensa>
				<bar></bar>
				<cozinha></cozinha>
				<quarto_empregada></quarto_empregada>
				<escritorio></escritorio>
				<area_servico></area_servico>
				<lareira></lareira>
				<varanda></varanda>
				<lavanderia></lavanderia>
				<estado><?php echo $dadosCidade['estadoCidade'];?></estado>
				<cidade><?php echo $dadosCidade['nomeCidade'];?></cidade>
				<bairro><?php echo $dadosBairro['nomeBairro'];?></bairro>
				<cep></cep>
				<endereco></endereco>
				<numero></numero>
				<complemento></complemento>
				<esconder_endereco_imovel>1</esconder_endereco_imovel>
				<descritivo><![CDATA[<?php echo $descricao;?>]]></descritivo>
				<fotos_imovel>
<?php
	$sqlImagens = "SELECT * FROM imoveisImagens WHERE codImovel = '".$dadosImovel['codImovel']."' ORDER BY ordenacaoImovelImagem ASC LIMIT 0,30";
	$resultImagens = $conn->query($sqlImagens);
	while($dadosImagens = $resultImagens->fetch_assoc()){
		
		//~ if(file_exists("ger/f/imoveis/".$dadosImagens['codImovel']."-".$dadosImagens['codImovelImagem']."-W.webp")){
			//~ echo $configUrlGer."f/imoveis/".$dadosImagens['codImovel']."-".$dadosImagens['codImovelImagem']."-W.webp";
			$imagem = $configUrlGer."f/imoveis/".$dadosImagens['codImovel']."-".$dadosImagens['codImovelImagem']."-W.webp";
		//~ }else{
			//~ $imagem = $configUrlGer."f/imoveis/".$dadosImagens['codImovel']."-".$dadosImagens['codImovelImagem']."-G.".$dadosImagens['extImovelImagem'];
		//~ }		
?>					
					<foto>
						<url><?php echo $imagem;?></url>
						<data_atualizacao></data_atualizacao>
					</foto>
<?php
	}
?>					
				</fotos_imovel>
				<data_atualizacao><?php echo $dadosImovel['alteracaoImovel'];?></data_atualizacao>
				<latitude></latitude>
				<longitude></longitude>
				<video><?php echo $linkVideo;?></video>
				<area_comum>
				<item></item>
				</area_comum>
				<area_privativa>
				<item></item>
				</area_privativa>
				<aceita_troca></aceita_troca>
				<periodo_locacao></periodo_locacao>			
			</imovel>
<?php
	}
?>			
		</imoveis>	
	</Document>
