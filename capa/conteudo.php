     

	   <div id="repete-conteudo">
<?php

include('capa/banner-capa.php');
?>


			<div id="repete-imoveis">
				<div id="conteudo-imoveis" class="wow animate__animated animate__fadeIn">
					<div id="bloco-titulo">
						<p class="titulo">Bem-Vindo<br><span>a Litoral Imóveis</span></p>
						<p class="subtitulo">Sua mudança começa no seu imóvel</p>
					</div>
					<div id="repete-filtro">
<?php
isset($_COOKIE['favorito_'.$codImovel]);
include('capa/filtro.php');
?>
          		  	</div>
					<div id="mostra-imoveis">							
<?php
	$cont = 0;

	$sqlImoveis = "SELECT * FROM imoveis I inner join imoveisImagens II on I.codImovel = II.codImovel WHERE I.statusImovel = 'T' AND II.tipoImagem = 'I' GROUP BY I.codImovel ORDER BY rand() LIMIT 0,21";
	$resultImoveis = $conn->query($sqlImoveis);
	while($dadosImoveis = $resultImoveis->fetch_assoc()){

		$cont++;

		$sqlCidade = "SELECT * FROM cidades WHERE codCidade = ".$dadosImoveis['codCidade']." LIMIT 0,1";
		$resultCidade = $conn->query($sqlCidade);
		$dadosCidade = $resultCidade->fetch_assoc();

		$sqlTipoImovel = "SELECT * FROM tipoimovel WHERE statusTipoImovel = 'T' AND codTipoImovel = ".$dadosImoveis['codTipoImovel']." LIMIT 0,1";
		$resultTipoImovel = $conn->query($sqlTipoImovel);
		$dadosTipoImovel = $resultTipoImovel->fetch_assoc();
						
		$sqlBairro = "SELECT * FROM bairros WHERE codBairro = ".$dadosImoveis['codBairro']." LIMIT 0,1";
		$resultBairro = $conn->query($sqlBairro);
		$dadosBairro = $resultBairro->fetch_assoc();
		
		$sqlImagem = "SELECT * FROM imoveisImagens WHERE codImovel = ".$dadosImoveis['codImovel']."  AND tipoImagem = 'I' ORDER BY ordenacaoImovelImagem ASC, codImovelImagem ASC LIMIT 0,1";
		$resultImagem = $conn->query($sqlImagem);
		$dadosImagem = $resultImagem->fetch_assoc();

		if(file_exists("ger/f/imoveis/".$dadosImagem['codImovel']."-".$dadosImagem['codImovelImagem']."-W.webp")){
			$imagem = $configUrlGer."f/imoveis/".$dadosImagem['codImovel']."-".$dadosImagem['codImovelImagem']."-W.webp";
		}else{
			$imagem = $configUrlGer."f/imoveis/".$dadosImagem['codImovel']."-".$dadosImagem['codImovelImagem']."-O.".$dadosImagem['extImovelImagem'];
		}
						
		if($dadosImoveis['precoImovel'] != "0.00"){
			$preco = "R$ ".number_format($dadosImoveis['precoImovel'], 2, ",", ".");
		}else{
			$preco = "A consultar";
		}
		if($dadosImoveis['exclusividadeImovel'] == "Sim"){
			$cor = "#ff6801";
			$exclusivo = "Imóvel exclusivo da ".$nomeEmpresaMenor;
		}else{
			$cor = "#0000007d";
			$exclusivo = "Não exclusivo";
		}
		$distancia = '';
		if (!empty($dadosImoveis['distanciaMarImovel']) && $dadosImoveis['distanciaMarImovel'] != '0') {
			$distancia = $dadosImoveis['distanciaMarImovel'] . 'm';
		}
?>
						<div id="bloco-imovel">
							<a title="<?php echo $dadosImoveis['nomeImovel'];?>" href="<?php echo $configUrl.'imoveis/'.$dadosImoveis['codImovel'].'-'.$dadosImoveis['urlImovel'].'/';?>">
								<div class="imagem-imovel" style="background:#FFF url('<?php echo $imagem;?>') center center no-repeat; background-size: cover;">
									<div id="dMar" style="<?php echo $distancia != "" ? 'display:block;' : 'display:none;'; ?>">
	 									<div id="dMar-destaque"> <?php echo $distancia; ?> DO MAR </div>
									</div>
									<div id="topo-img">
	 									<div id="exclusividade" title="<?php echo $exclusivo ?>" style="background: <?php echo $cor ?>  url('<?php echo $configUrl;?>f/i/quebrado/destaque.svg') center center no-repeat; background-size: 15px;"></div>
										<div class="favoritos" title="Favoritos" data-imovel="<?php echo $dadosImoveis['codImovel']; ?>" data-cor="<?php echo $cor; ?>" style="background:#0000007d url('<?php echo $configUrl;?>f/i/quebrado/fav.svg') center center no-repeat; background-size:15px;"></div> 		
										<div id="detalhes" title="Ver detalhes do imóvel" style="background: #0000007d  url('<?php echo $configUrl;?>f/i/quebrado/olho.svg') center center no-repeat; background-size: 15px;"></div>
									</div>
								</div>
								<div id="info" style="padding: 15px; border-bottom: 2px solid #66666624;">
									<div id="bloco-nome">
										<p class="nome"><?php echo $dadosImoveis['nomeImovel'];?></p>
									</div>
									<p class="cidade"><?php echo mb_strimwidth($dadosBairro['nomeBairro']." , ".$dadosCidade['nomeCidade'], 0, 60, "...");?></p>
									<div id="icones">
										<div id="alinha-icones">
											<p class="tipo"><?php echo $dadosTipoImovel['nomeTipoImovel'];?></p>
											<p class="quartos" style="<?php echo $dadosImoveis['quartosImovel'] == 0 ? 'display:none;' : '';?>"> <?php echo $dadosImoveis['quartosImovel'];?></p>
											<p class="banheiros" style="<?php echo $dadosImoveis['banheirosImovel'] == 0 ? 'display:none;' : '';?>"> <?php echo $dadosImoveis['banheirosImovel'];?></p>
											<p class="garagem" style="<?php echo $dadosImoveis['garagemImovel'] == 0 ? 'display:none;' : '';?>"> <?php echo $dadosImoveis['garagemImovel'];?></p>
											<p class="area" style="<?php echo $dadosImoveis['metragemImovel'] == 0 ? 'display:none;' : '';?>"> <?php echo $dadosImoveis['metragemImovel'];?>m²</p>
										</div>
									</div>
								</div>
								<div id="preco">
									<p class="preco"><?php echo $preco;?></p>
									<p class="cod">COD <?php echo $dadosImoveis['codigoImovel'];?></p>
								</div>	
							</a>							
						</div> 
<?php		
	}
?>
					
					</div>
					<div class="ver-todos">
						<a title="Ver todos os imóveis" href="<?php echo $configUrl;?>imoveis/">
							Ver todos os imóveis			
						</a>
					</div>
				</div>	
			</div>
			<div id="repete-oportunidades">
				<div id="conteudo-oportunidades">
	 				<div style="display: flex; align-items: center; justify-content:space-between;">
						<div id="bloco-titulo">
							<p class="titulo">Oportunidades</p>
							<p class="subtitulo">Confira oportunidades de negócio para conquistar seu imóvel próprio</p>
						</div>
					</div>
					<div id="mostra-oportunidades">							
<?php
	$cont = 0;

	$sqlImoveis = "SELECT * FROM imoveis I inner join imoveisImagens II on I.codImovel = II.codImovel WHERE I.statusImovel = 'T' AND II.tipoImagem = 'I' AND I.exclusividadeImovel = 'Sim' GROUP BY I.codImovel ORDER BY rand() LIMIT 0,3";
	$resultImoveis = $conn->query($sqlImoveis);
	while($dadosImoveis = $resultImoveis->fetch_assoc()){

		$cont++;

		$sqlCidade = "SELECT * FROM cidades WHERE codCidade = ".$dadosImoveis['codCidade']." LIMIT 0,1";
		$resultCidade = $conn->query($sqlCidade);
		$dadosCidade = $resultCidade->fetch_assoc();

		$sqlTipoImovel = "SELECT * FROM tipoimovel WHERE statusTipoImovel = 'T' AND codTipoImovel = ".$dadosImoveis['codTipoImovel']." LIMIT 0,1";
		$resultTipoImovel = $conn->query($sqlTipoImovel);
		$dadosTipoImovel = $resultTipoImovel->fetch_assoc();
						
		$sqlBairro = "SELECT * FROM bairros WHERE codBairro = ".$dadosImoveis['codBairro']." LIMIT 0,1";
		$resultBairro = $conn->query($sqlBairro);
		$dadosBairro = $resultBairro->fetch_assoc();
		
		$sqlImagem = "SELECT * FROM imoveisImagens WHERE codImovel = ".$dadosImoveis['codImovel']."  AND tipoImagem = 'I' ORDER BY ordenacaoImovelImagem ASC, codImovelImagem ASC LIMIT 0,1";
		$resultImagem = $conn->query($sqlImagem);
		$dadosImagem = $resultImagem->fetch_assoc();

		if(file_exists("ger/f/imoveis/".$dadosImagem['codImovel']."-".$dadosImagem['codImovelImagem']."-W.webp")){
			$imagem = $configUrlGer."f/imoveis/".$dadosImagem['codImovel']."-".$dadosImagem['codImovelImagem']."-W.webp";
		}else{
			$imagem = $configUrlGer."f/imoveis/".$dadosImagem['codImovel']."-".$dadosImagem['codImovelImagem']."-O.".$dadosImagem['extImovelImagem'];
		}
						
		if($dadosImoveis['precoImovel'] != "0.00"){
			$preco = "R$ ".number_format($dadosImoveis['precoImovel'], 2, ",", ".");
		}else{
			$preco = "A consultar";
		}
		if($dadosImoveis['exclusividadeImovel'] == "Sim"){
			$cor = "#ff6801";
			$exclusivo = "Imóvel exclusivo da ".$nomeEmpresaMenor;
		}else{
			$cor = "#0000007d";
			$exclusivo = "Não exclusivo";
		}
		$distancia = '';
		if (!empty($dadosImoveis['distanciaMarImovel']) && $dadosImoveis['distanciaMarImovel'] != '0') {
			$distancia = $dadosImoveis['distanciaMarImovel'] . 'm';
		}
?>
						<div id="bloco-imovel">
							<a title="<?php echo $dadosImoveis['nomeImovel'];?>" href="<?php echo $configUrl.'imoveis/'.$dadosImoveis['codImovel'].'-'.$dadosImoveis['urlImovel'].'/';?>">
								<div class="imagem-imovel" style="background:#FFF url('<?php echo $imagem;?>') center center no-repeat; background-size: cover;">
									<div id="dMar" style="<?php echo $distancia != "" ? 'display:block;' : 'display:none;'; ?>">
	 									<div id="dMar-destaque"> <?php echo $distancia; ?> DO MAR </div>
									</div>
									<div id="topo-img">
	 									<div id="exclusividade" title="<?php echo $exclusivo ?>" style="background: <?php echo $cor ?>  url('<?php echo $configUrl;?>f/i/quebrado/destaque.svg') center center no-repeat; background-size: 15px;"></div>
										<div class="favoritos" title="Favoritos" data-imovel="<?php echo $dadosImoveis['codImovel']; ?>" data-cor="<?php echo $cor; ?>" style="background:#0000007d url('<?php echo $configUrl;?>f/i/quebrado/fav.svg') center center no-repeat; background-size:15px;"></div> 		
										<div id="detalhes" title="Ver detalhes do imóvel" style="background: #0000007d  url('<?php echo $configUrl;?>f/i/quebrado/olho.svg') center center no-repeat; background-size: 15px;"></div>
									</div>
								</div>
								<div id="info" style="padding: 15px; border-bottom: 2px solid #66666624;">
									<div id="bloco-nome">
										<p class="nome"><?php echo $dadosImoveis['nomeImovel'];?></p>
									</div>
									<p class="cidade"><?php echo mb_strimwidth($dadosBairro['nomeBairro']." , ".$dadosCidade['nomeCidade'], 0, 60, "...");?></p>
									<div id="icones">
										<div id="alinha-icones">
											<p class="tipo"><?php echo $dadosTipoImovel['nomeTipoImovel'];?></p>
											<p class="quartos" style="<?php echo $dadosImoveis['quartosImovel'] == 0 ? 'display:none;' : '';?>"> <?php echo $dadosImoveis['quartosImovel'];?></p>
											<p class="banheiros" style="<?php echo $dadosImoveis['banheirosImovel'] == 0 ? 'display:none;' : '';?>"> <?php echo $dadosImoveis['banheirosImovel'];?></p>
											<p class="garagem" style="<?php echo $dadosImoveis['garagemImovel'] == 0 ? 'display:none;' : '';?>"> <?php echo $dadosImoveis['garagemImovel'];?></p>
											<p class="area" style="<?php echo $dadosImoveis['metragemImovel'] == 0 ? 'display:none;' : '';?>"> <?php echo $dadosImoveis['metragemImovel'];?>m²</p>
										</div>
									</div>
								</div>
								<div id="preco">
									<p class="preco"><?php echo $preco;?></p>
									<p class="cod">COD <?php echo $dadosImoveis['codigoImovel'];?></p>
								</div>	
							</a>							
						</div> 
<?php		
	}	
?>
					</div>
				</div>	
			</div>
			<div id="repete-bairros">
				<div id="conteudo-bairros">
					<div id="bloco-titulo">
						<p class="titulo">Bairros</p>
						<p class="subtitulo">Confira os imóveis disponíveis por lote</p>
					</div>
					<div id="mostra-bairros" class="wow animate__animated animate__fadeInRight">
						<div class="owl-carrossel">
							<div class="row">
								<div class="large-12 columns">
									<div class="loop owl-carousel bairrosCarrossel owl-loaded owl-drag">
<?php
		$sqlBairros = " SELECT  b.*, COUNT(i.codImovel) AS qtdImoveisBairro FROM bairros b INNER JOIN imoveis i  ON i.codBairro = b.codBairro  AND i.statusImovel = 'T' WHERE b.statusBairro = 'T' GROUP BY b.codBairro HAVING qtdImoveisBairro > 0 ORDER BY RAND() LIMIT 10 ";
		$resultBairros = $conn->query($sqlBairros);
		while($dadosBairros = $resultBairros->fetch_assoc()){

			$sqlImagem = "SELECT * FROM bairrosImagens  WHERE codBairro = ".$dadosBairros['codBairro']."  LIMIT 1";
			$resultImagem = $conn->query($sqlImagem);
			$dadosImagem = $resultImagem->fetch_assoc();

			$sqlCidade = "SELECT * FROM cidades  WHERE codCidade = ".$dadosBairros['codCidade']."  LIMIT 1";
			$resultCidade = $conn->query($sqlCidade);
			$dadosCidade = $resultCidade->fetch_assoc();
?>
										<div id="bloco-bairros">
											<a title="Pesquiser pelo bairro <?php echo $dadosBairros['nomeBairro']; ?>" href="<?php echo $configUrl.'imoveis/'; ?>">
												<div id="fundo" style=" background:transparent url('<?php echo $configUrlGer.'f/bairros/'.$dadosImagem['codBairro'].'-'.$dadosImagem['codBairroImagem'].'-G.'.$dadosImagem['extBairroImagem']; ?>') center center no-repeat; background-size: cover;">
													<div id="topo-img">
														<div class="detalhes" title="Ver detalhes do imóvel" style="background: #0000007d  url('<?php echo $configUrl;?>f/i/quebrado/olho.svg') center center no-repeat; background-size: 15px;"></div>
													</div>
													<div id="sombra">
														<p id="nome"><?php echo $dadosBairros['nomeBairro']; ?></p>
														<p id="cidade">
															<?php echo $dadosCidade['nomeCidade']; ?>,
															<?php echo $dadosCidade['estadoCidade']; ?>
														</p>
														<div id="linha"></div>
														<p id="quantidade"> <?php echo $dadosBairros['qtdImoveisBairro']; ?>  imóveis disponíveis </p>
													</div>
												</div>
											</a>
										</div>
	<?php
		}
?>
									</div>
								</div>
							</div>
						</div>
						<script>
							var $rfgs = jQuery.noConflict();
							var owl = $rfgs('.bairrosCarrossel');
							owl.owlCarousel({
								autoplay: false,
								autoplayTimeout: 20000,
								smartSpeed: 1000,
								fluidSpeed: 10000,
								items: 1,
								loop: true,
								autoWidth: false,
								margin: 20,
								nav: false,
								dots: true
							});
						</script>
					</div>
				</div>
			</div>
			<div id="repete-loteamentos">
				<div id="conteudo-loteamentos">
					<div id="bloco-titulo">
						<p class="titulo">Loteamentos</p>
						<p class="subtitulo">Confira os imóveis disponíveis por lote</p>
					</div>
					<div id="mostra-loteamentos" class="wow animate__animated animate__fadeInLeft">
						<div class="owl-carrossel">
							<div class="row">
								<div class="large-12 columns">
									<div class="loop owl-carousel loteamentosCarrossel owl-loaded owl-drag">
<?php
		$sqlLoteamentos = " SELECT * FROM loteamentos WHERE statusLoteamento = 'T'  ORDER BY rand() LIMIT 10 ";
		$resultLoteamentos = $conn->query($sqlLoteamentos);
		while($dadosLoteamentos = $resultLoteamentos->fetch_assoc()){

			$sqlImagem = "SELECT * FROM loteamentosImagens  WHERE codLoteamento = ".$dadosLoteamentos['codLoteamento']." AND tipoLoteamentoImagem = 'T' LIMIT 1";
			$resultImagem = $conn->query($sqlImagem);
			$dadosImagem = $resultImagem->fetch_assoc();


			$sqlCidade = "SELECT * FROM cidades  WHERE codCidade = ".$dadosLoteamentos['codCidade']."  LIMIT 1";
			$resultCidade = $conn->query($sqlCidade);
			$dadosCidade = $resultCidade->fetch_assoc();

?>
										<div id="bloco-loteamentos">
											<a title="Pesquiser pelo loteamento <?php echo $dadosLoteamentos['nomeLoteamento']; ?>" href="<?php echo $configUrl.'loteamentos/'; ?>">
												<div id="mostra-imagem">
													<div id="imagem" style=" background:transparent url('<?php echo $configUrlGer.'f/loteamentos/'.$dadosImagem['codLoteamento'].'-'.$dadosImagem['codLoteamentoImagem'].'-O.'.$dadosImagem['extLoteamentoImagem']; ?>') center center no-repeat; background-size: cover;"></div>
												</div>
												<div id="info">
	 												<p id="nome"><?php echo $dadosLoteamentos['nomeLoteamento']; ?></p>
													<div style="display: flex; justify-content: center;">
														<p id="cidade"><?php echo $dadosCidade['nomeCidade']; ?>, <?php echo $dadosCidade['estadoCidade']; ?></p>
													</div>
													<div id="ver" style="display: flex; justify-content: center;"><p>Ver mais</p></div>
												</div>
											</a>
										</div>
<?php
		}
?>
									</div>
								</div>
							</div>
						</div>
						<script>
							var $rfgs = jQuery.noConflict();
							var owl = $rfgs('.loteamentosCarrossel');
							owl.owlCarousel({
								autoplay: false,
								autoplayTimeout: 20000,
								smartSpeed: 1000,
								fluidSpeed: 10000,
								items: 1,
								loop: true,
								autoWidth: false,
								margin: 30,
								nav: false,
								dots: true
							});
						</script>
					</div>
				</div>
			</div>

			<div id="repete-empresa" class="wow animate__animated animate__fadeIn">
				<div id="conteudo-empresa">
					<div id="bloco-empresa">
<?php
 	$sqlEmpresa = "SELECT * FROM empresa WHERE codEmpresa = 1 LIMIT 0,1";
	$resultEmpresa = $conn->query($sqlEmpresa);
	$dadosEmpresa = $resultEmpresa->fetch_assoc();

	$sqlImagem = "SELECT * FROM empresaImagens WHERE codEmpresa = " . $dadosEmpresa['codEmpresa'] ." AND capaEmpresaImagem = 'T'  LIMIT 0,1";
	$resultImagem = $conn->query($sqlImagem);
	$dadosImagem = $resultImagem->fetch_assoc();
?>
						<a href="<?php echo $configUrl; ?>sobre/">
							<div id="imagem" style="background:transparent url('<?php echo $configUrlGer . 'f/empresa/' . $dadosImagem['codEmpresa'] . '-' . $dadosImagem['codEmpresaImagem'] . '-G.' . $dadosImagem['extEmpresaImagem']; ?>') center center no-repeat; background-size: cover;">
								<div id="borda"></div>
							</div>
							<div id="bloco-dados">
								<div id="bloco-titulo">
									<p class="titulo">Conheça mais <br><span>Sobre nós</span></p>
								</div>
								<div title="Ver mais..." class="descricao"><?php echo $dadosEmpresa['descricaoEmpresa']; ?></div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div id="repete-especiais">
				<div id="conteudo-especiais">
					<div id="bloco-titulo">
						<p class="titulo">O que nos torna <span>especiais</span></p>
					</div>
					<div id="mostra-especiais" class="wow animate__animated animate__fadeInLeft">
						<div id="mostra-especiais">
<?php
	$sqlEspeciais = "SELECT * FROM servicos WHERE statusServico = 'T' ORDER BY codOrdenacaoServico ASC";
	$resultEspeciais = $conn->query($sqlEspeciais);
	while ($dadosEspeciais = $resultEspeciais->fetch_assoc()) {
		$sqlImagem = "SELECT * FROM servicosImagens WHERE codServico = " . $dadosEspeciais['codServico'] . " ORDER BY codServicoImagem ASC LIMIT 0,1";
		$resultImagem = $conn->query($sqlImagem);
		$dadosImagem = $resultImagem->fetch_assoc();
?>
							<div id="bloco-especiais">
								<div id="imagem" style="background:#ff6801 url('<?php echo $configUrlGer . 'f/servicos/' . $dadosImagem['codServico'] . '-' . $dadosImagem['codServicoImagem'] . '-O.' . $dadosImagem['extServicoImagem']; ?>') center center no-repeat; background-size: 45px;"></div>
	 							<div id="descricao"><?php echo $dadosEspeciais['descricaoServico']; ?></div>
							</div>
<?php
}
?>
						</div>
					</div>
				</div>
			</div>


<?php
	$sqlDepoimento = "SELECT count(codDepoimento) total FROM depoimentos WHERE statusDepoimento = 'T'";
	$resultDepoimento = $conn->query($sqlDepoimento);
	$dadosDepoimento = $resultDepoimento->fetch_assoc();

	if ($dadosDepoimento['total'] >= 1 && $url[2] != "depoimentos") {
?>
					<div id="repete-depoimentos" class="wow animate__animated animate__fadeInRight">
						<div id="conteudo-depoimentos">
							<div id="bloco-titulo">
								<p class="titulo">Comentários <br> <span>dos clientes</span></p>
							</div>
							<div id="mostra-depoimentos" >
								<div class="owl-carrossel">
									<div class="row">
										<div class="large-12 columns">
											<div class="loop owl-carousel depoimentosCarrossel owl-loaded owl-drag">
<?php
	$cont2 = 0;
	$sqlDepoimento = "SELECT * FROM depoimentos WHERE statusDepoimento = 'T' ORDER BY codOrdenacaoDepoimento ASC";
	$resultDepoimento = $conn->query($sqlDepoimento);
	while ($dadosDepoimento = $resultDepoimento->fetch_assoc()) {

		$cont2++;

		$sqlImagem = "SELECT * FROM depoimentosImagens WHERE codDepoimento = " . $dadosDepoimento['codDepoimento'] . " ORDER BY codDepoimentoImagem ASC LIMIT 0,1";
		$resultImagem = $conn->query($sqlImagem);
		$dadosImagem = $resultImagem->fetch_assoc();
?>
												<li class="carrosel-depoimento">
													<a title="<?php echo $dadosDepoimento['nomeDepoimento']; ?>" href="<?php echo $configUrl; ?>depoimentos/">
														<div id="mostra-nome">
<?php 
	if($dadosImagem['codDepoimento'] != "" &&  $dadosImagem['codDepoimento'] == $dadosImagem['codDepoimento'] ){
?>
															<p class="imagem-depoimentos" style="background:transparent url('<?php echo $configUrlGer . 'f/depoimentos/' . $dadosImagem['codDepoimento'] . '-' . $dadosImagem['codDepoimentoImagem'] . '-O.' . $dadosImagem['extDepoimentoImagem']; ?>') center center no-repeat; background-size:auto 100%; "></p>
<?php 
	}else{		
?> 															<p class="imagem-depoimentos" style="background:transparent url('<?php echo $configUrl . 'f/i/quebrado/defalt.png'; ?>') center center no-repeat; background-size:auto 100%; "></p>
<?php
	}
?> 	
															<div id="nome">
																<p class="nome-depoimentos"><?php echo $dadosDepoimento['nomeDepoimento']; ?></p>
																<img src="<?php echo $configUrl.'f/i/quebrado/estrelas.png';?>" style="width:60px!important;" alt="">
															</div>
														</div>
														<div id="mostra-depoimento">
															<p class="titulo"><?php echo $dadosDepoimento['cidadeDepoimento'];?></p>
															<div id="depoimento"><?php echo $dadosDepoimento['descricaoDepoimento'];?></div>
														</div>
													</a>
												</li>
<?php
	}
?>
											</div>
										</div>
									</div>
								</div>
							</div>
						<script>
							var $rfgs = jQuery.noConflict();
							$rfgs(function () {
								var owlProdutos = $rfgs('.depoimentosCarrossel');
								owlProdutos.owlCarousel({
								autoplay: false,
								autoplayTimeout: 20000,
								smartSpeed: 1000,
								fluidSpeed: 10000,
								items: 1,
								loop: true,
								autoWidth: false,
								margin: 25,
								nav: false,
								dots: true,
								dotsEach: true
								});
							});
						</script>
						</div>
					</div>				
<?php
	}
?>


					<div id="repete-instagram" class="wow animate__animated animate__fadeIn">
						<div id="conteudo-instagram">
							<div id="bloco-titulo">
								<p class="titulo">Siga-nos no <span> Instagram</span></p>
								<a id="instagram"target="_blank" title="Siga-nos no Instagram" href="https://www.instagram.com/<?php echo $instagram; ?>">@<?php echo $instagram ?></a>
									<div class="embedsocial-hashtag insta" data-ref="8df9400428a9b999092cec141e5b877687f396ed"> 
										<a class="feed-powered-by-es feed-powered-by-es-slider-img es-widget-branding" href="https://embedsocial.com/social-media-aggregator/" target="_blank" title="Instagram widget"> 
											<img src="https://embedsocial.com/cdn/icon/embedsocial-logo.webp" alt="EmbedSocial">
											<div class="es-widget-branding-text">Instagram widget</div> 
										</a> 
									</div>
									<script> (function(d, s, id) { var js; if (d.getElementById(id)) {return;} js = d.createElement(s); js.id = id; js.src = "https://embedsocial.com/cdn/ht.js"; d.getElementsByTagName("head")[0].appendChild(js); }(document, "script", "EmbedSocialHashtagScript")); </script>
								<style>a.feed-powered-by-es.es-widget-branding { display: none !important;} </style>
							</div>
						</div>
					</div>
				</div>
