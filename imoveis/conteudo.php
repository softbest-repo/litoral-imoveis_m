							<div id="conteudo-interno">
								<div id="conteudo-imoveis">
									<div id="bloco-titulo">
										<p class="titulo">Imóveis</p>
									</div>
									<div id="repete-filtro"  class="wow animate__animated animate__fadeIn">

<?php
	include('capa/filtro.php');
	
	if($cidadeFiltra != ""){
		$urlNumber = 5;
		$urlPag = "imoveis/".$url[3]."/".$url[4];		
	}else
	if($tipoImovel != ""){
		$urlNumber = 4;
		$urlPag = "imoveis/".$url[3];
	}else{
		$urlNumber = 3;
		$urlPag = "imoveis";
	}
?>
									</div>
									<div id="mostra-imoveis"  class="wow animate__animated animate__fadeIn">
<?php
	$cont = 0;
	
	$sqlConta = "SELECT count(DISTINCT I.codImovel) registros FROM imoveis I inner join imoveisImagens II on I.codImovel = II.codImovel inner join tipoImovel TI on I.codTipoImovel = TI.codTipoImovel inner join cidades C on I.codCidade = C.codCidade inner join bairros B on I.codBairro = B.codBairro WHERE I.statusImovel = 'T'".$filtraCodigo.$tipoSelecionado.$filtraImoveis.$filtraImovel.$filtraNegociacao.$filtraDormitorio.$filtraSuites.$filtraBanheiros.$filtraVagas.$filtraTipoV.$filtraCidade.$filtraBairro.$filtraPreco."";
	$resultConta = $conn->query($sqlConta);
	$dadosConta = $resultConta->fetch_assoc();
	$registros = $dadosConta['registros'];
		
	if($url[$urlNumber] == 1 || $url[$urlNumber] == ""){
		$pagina = 1;
		$sqlImoveis = "SELECT DISTINCT I.* FROM imoveis I inner join imoveisImagens II on I.codImovel = II.codImovel inner join tipoImovel TI on I.codTipoImovel = TI.codTipoImovel inner join cidades C on I.codCidade = C.codCidade inner join bairros B on I.codBairro = B.codBairro WHERE I.statusImovel = 'T'".$filtraCodigo.$tipoSelecionado.$filtraImoveis.$filtraImovel.$filtraNegociacao.$filtraDormitorio.$filtraSuites.$filtraBanheiros.$filtraVagas.$filtraTipoV.$filtraCidade.$filtraBairro.$filtraPreco." ORDER BY ".$ordenar."  I.destaqueImovel ASC, I.codImovel DESC LIMIT 0,28";
	}else{
		$pagina = $url[$urlNumber];
		$paginaFinal = $pagina * 28;
		$paginaInicial = $paginaFinal - 28;
		$sqlImoveis = "SELECT DISTINCT I.* FROM imoveis I inner join imoveisImagens II on I.codImovel = II.codImovel inner join tipoImovel TI on I.codTipoImovel = TI.codTipoImovel inner join cidades C on I.codCidade = C.codCidade inner join bairros B on I.codBairro = B.codBairro WHERE I.statusImovel = 'T'".$filtraCodigo.$tipoSelecionado.$filtraImoveis.$filtraImovel.$filtraNegociacao.$filtraSuites.$filtraDormitorio.$filtraBanheiros.$filtraVagas.$filtraTipoV.$filtraCidade.$filtraBairro.$filtraPreco." ORDER BY ".$ordenar."  I.destaqueImovel ASC, I.codImovel DESC LIMIT ".$paginaInicial.",28";
	}
	
	$resultImoveis = $conn->query($sqlImoveis);
	while($dadosImoveis = $resultImoveis->fetch_assoc()){
		$mostrando = $mostrando + 1;

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
										<br class="clear" />
									</div>
<?php
	$regPorPagina = 28;
	$area = $urlPag;
	include('f/conf/paginacao.php');
?>
								</div>
							</div>
