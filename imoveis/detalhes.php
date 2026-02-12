							<div id="conteudo-interno" style="width:100%;">
								<div id="repete-imoveis-detalhes">
									<div id="bloco-titulo">
										<p class="titulo">Imóveis</p>	
										<a  id="botao-topo" href="<?php echo $configUrl.'imoveis/' ?>">Voltar</a>
									</div>
									<div id="conteudo-imoveis-interno">				
										<div id="detalhes-imovel">
<?php
	$quebraUrl = explode("-", $url[3]);
	$cont = 1;

	$sqlImovel = "SELECT * FROM imoveis WHERE codImovel = '".$quebraUrl[0]."' and statusImovel = 'T' LIMIT 0,1";
	$resultImovel = $conn->query($sqlImovel);
	$dadosImovel = $resultImovel->fetch_assoc();

	$sqlTipoImovel = "SELECT * FROM tipoImovel WHERE codTipoImovel = ".$dadosImovel['codTipoImovel']." LIMIT 0,1";
	$resultTipoImovel = $conn->query($sqlTipoImovel);
	$dadosTipoImovel = $resultTipoImovel->fetch_assoc();
		
	$imovel = $dadosTipoImovel['nomeTipoImovel'];
	
	if($dadosImovel['tipoCImovel'] == 'V'){
		$comercial = "Venda";
	}else{
		$comercial = "Aluguel";
	}
	
	if($dadosImovel['precoImovel'] != "0.00"){
		$valor = "R$ ".number_format($dadosImovel['precoImovel'], 2, ",", ".");
	}else{
		$valor = "A consultar";
	}
	
	$sqlCidade = "SELECT * FROM cidades WHERE statusCidade = 'T' and codCidade = ".$dadosImovel['codCidade']." LIMIT 0,1";
	$resultCidade = $conn->query($sqlCidade);
	$dadosCidade = $resultCidade->fetch_assoc();
	
	$sqlBairro = "SELECT * FROM bairros WHERE statusBairro = 'T' and codBairro = ".$dadosImovel['codBairro']." LIMIT 0,1";
	$resultBairro = $conn->query($sqlBairro);
	$dadosBairro = $resultBairro->fetch_assoc();	
?>
			
<?php
	$sqlImagens = "SELECT * FROM imoveisImagens WHERE codImovel = '".$dadosImovel['codImovel']."' ORDER BY ordenacaoImovelImagem ASC, codImovelImagem ASC";
	$resultImagens = $conn->query($sqlImagens);
	$numImagens = $resultImagens->num_rows;
?>

<div id="bloco-imagem">
											<div class="owl-estampas">
												<div class="row">
													<div class="large-12 columns">
														<div class="loop owl-carousel imoveis-detalhes owl-loaded owl-drag">	

<?php
	while($dadosImagens = $resultImagens->fetch_assoc()){
		
		if($dadosImagens['extImovelImagem'] == "mp4"){
			
?>
															<li style="width:100%; height:250; position:relative; background-color:#b17d4a;"><span><video id="video" class="vid" disablePictureInPicture controlsList="nodownload" constrols style="max-height:100%; position:absolute; left:50%; transform:translateX(-50%);" src="<?php echo $configUrlGer.'f/imoveis/'.$dadosImagens['codImovel'].'-'.$dadosImagens['codImovelImagem'].'-O.'.$dadosImagens['extImovelImagem'];?>" type="video/mp4" controls="true"></video></span></li>
<?php
		}else{
?>
															<li style="position: relative; width: 100%; height: 250px; border-radius: 15px; overflow: hidden;"><a rel="lightbox[roadtrip]" href="<?php echo $configUrlGer.'f/imoveis/'.$dadosImagens['codImovel'].'-'.$dadosImagens['codImovelImagem'].'-W.webp'; ?>" style="display: block; width: 100%; height: 100%; background: transparent url('<?php echo $configUrlGer.'f/imoveis/'.$dadosImagens['codImovel'].'-'.$dadosImagens['codImovelImagem'].'-W.webp'; ?>') center center no-repeat; background-size: cover, 100%; "></a>
															<a href="<?php echo $configUrlGer.'f/imoveis/'.$dadosImagens['codImovel'].'-'.$dadosImagens['codImovelImagem'].'-MD.'.$dadosImagens['extImovelImagem']; ?>" download class="btn-download"> Baixar </a>
														
<?php		
		}
	}
?>	
														</div>
													</div>
												</div>
											</div>
											<?php 
											if($numImagens < 3 ){ ?>
											<script>
												var $gt = jQuery.noConflict();
												var owl = $gt('.imoveis-detalhes');
													owl.owlCarousel({
														center: false,
														items:1,
														loop: false,
														autoWidth:false,
														margin:5,
														nav: false,
														dots: false
													});
											</script>	
<?php
	}else{
?>
											<script>
												var $gt = jQuery.noConflict();
												var owl = $gt('.imoveis-detalhes');
													owl.owlCarousel({
														center: true,
														items:1,
														loop: true,
														autoWidth:false,
														margin:5,
														nav: false,
														dots: false
													});
											</script>	
<?php 
	}
?>												
										</div>
										<div id="centraliza">
										<div id="mostra-informacoes">
											<div id="bloco-nome">	
												<div id="limita-nome">	
													<p class="nome-imovel"><?php echo $dadosImovel['nomeImovel'];?></p>
												</div>	
											</div>
											<div id="icones">
												<p class="quartos" style="<?php echo $dadosImovel['quartosImovel'] == 0 ? 'display:none;' : '';?>">Quartos:<br/><span><?php echo $dadosImovel['quartosImovel'];?></span></p>
												<p class="suite" style="<?php echo $dadosImovel['suiteImovel'] == 0 ? 'display:none;' : '';?>">Suítes:<br/><span><?php echo $dadosImovel['suiteImovel'];?></span></p>
												<p class="banheiros" style="<?php echo $dadosImovel['banheirosImovel'] == 0 ? 'display:none;' : '';?>">Banheiros:<br/><span><?php echo $dadosImovel['banheirosImovel'];?></span></p>
												<p class="garagem" style="<?php echo $dadosImovel['garagemImovel'] == 0 ? 'display:none;' : '';?>">Garagem:<br/><span><?php echo $dadosImovel['garagemImovel'];?></span></p>
												<p class="area-c" style="<?php echo $dadosImovel['metragemCImovel'] == 0 ? 'display:none;' : '';?>">Área Construída:<br/><span><?php echo $dadosImovel['metragemCImovel'];?>m²</span></p>
												<p class="largura" style="<?php echo $dadosImovel['frenteImovel'] == "" ? 'display:none;' : '';?>">Frente:<br/><span><?php echo $dadosImovel['frenteImovel'];?>m</span></p>
												<p class="fundos" style="<?php echo $dadosImovel['fundosImovel'] == 0 ? 'display:none;' : '';?>">Fundos:<br/><span><?php echo $dadosImovel['fundosImovel'];?>m</span></p>
												<p class="area" style="<?php echo $dadosImovel['metragemImovel'] == 0 ? 'display:none;' : '';?>">Área do Terreno:<br/><span><?php echo $dadosImovel['metragemImovel'];?><?php echo $dadosImovel['siglaMetragem']; ?></span></p>
												<p class="posicao" style="<?php echo $dadosImovel['posicaoImovel'] == "" ? 'display:none;' : '';?>">Posição Solar:<br/><span><?php echo $dadosImovel['posicaoImovel'];?></span></p>
												<br class="clear"/>
											</div>	
											<div id="col-esq-imoveis">
												<div id="bloco-dados">
													<div id="alinha">
														<div id="alinha-denovo">	
															<p class="outros-imovel" style="float:right;"><span class="bold">Cidade: </span><?php echo $dadosCidade['nomeCidade'];?></p>
															<p class="outros-imovel"><span class="bold">Bairro: </span><?php echo $dadosBairro['nomeBairro'];?></p>
															<p class="outros-imovel" style="float:right;"><span class="bold">Código: </span><?php echo $dadosImovel['codigoImovel'];?></p>
															<p class="outros-imovel"><span class="bold">Tipo Imóvel: </span><?php echo $imovel;?></p>
															<br class="clear"/>
														</div>
											
													</div>
													<p class="preco-imovel"><?php echo $valor;?></p>
												</div>	
												<div id="bloco-desc">
												<p class="titulo">Informações sobre o imóvel</p>	
												<div class="descricao"><?php echo $dadosImovel['descricaoImovel'];?></div>

<?php	
	$sqlCorretor = "SELECT * FROM usuarios WHERE codUsuario = ".$dadosImovel['codUsuario']." LIMIT 0,1";
	$resultCorretor = $conn->query($sqlCorretor);
	$dadosCorretor = $resultCorretor->fetch_assoc();
	if($dadosCorretor['codUsuario'] != ""){
?>
												<p class="titulo-corretor">Fale com o nosso Corretor</p>
												<div id="corretor">
<?php
		$sqlImagem = "SELECT * FROM usuariosImagens WHERE codUsuario = ".$dadosCorretor['codUsuario']." ORDER BY codUsuarioImagem DESC LIMIT 0,1";
		$resultImagem = $conn->query($sqlImagem);
		$dadosImagem3 = $resultImagem->fetch_assoc();
		
		$limpaCelular = str_replace("(", "", $dadosCorretor['celularUsuario']);
		$limpaCelular = str_replace(")", "", $limpaCelular);
		$limpaCelular = str_replace("-", "", $limpaCelular);
		$limpaCelular = str_replace(" ", "", $limpaCelular);
?>
													<div id="esq-corretor">
<?php
		if($dadosImagem3['codUsuarioImagem'] != ""){
?>
														<div class="imagem"><p style="width:71px; height:71px; display:table-cell; vertical-align:middle;"><img style="display:block;" src="<?php echo $configUrlGer.'configuracoes/minha-foto/'.$dadosImagem3['codUsuario'].'-'.$dadosImagem3['codUsuarioImagem'].'-G.'.$dadosImagem3['extUsuarioImagem'];?>" width="71"/></p></div>
<?php
		}else{
?>
														<p class="imagem"><img style="display:block;" src="<?php echo $configUrl;?>f/i/quebrado/defalt.png" width="47"/></p>
<?php
		}
?>
														<div class="dados">
															<p class="nome"><?php echo $dadosCorretor['nomeUsuario'];?></p>
															<p class="telefone"><?php echo $dadosCorretor['celularUsuario'];?></p>
															<p class="email"><a href="mailto:<?php echo $dadosCorretor['emailUsuario'];?>"><?php echo $dadosCorretor['emailUsuario'];?></a></p>
														</div>
													</div>
													<div id="dir-corretor">
														<p class="botao-whatsapp-2"><a target="_blank" title="Chame-nos no WhatsApp"  onClick="abrirAcesso();" >Iniciar conversa<br/>no Whatsapp</a></p>
														<br class="clear"/>
													</div>
													<br class="clear"/>
												</div>
<?php
	}
?>												
											</div>

												<div id="compartilhar" style="margin-bottom: 20px;">
													<p class="titulo" style="margin-bottom:10px;">Compartilhe este imóvel</p>
													<p class="facebook" style="float:left; cursor:pointer; margin-right:15px;"><a target="resource window" title="Clique aqui para compartilhar este imóvel no Facebook" onClick="window.open('https://www.facebook.com/sharer.php?u=<?php echo $configUrl.$arquivoRetornar;?>&t=<?php echo $dadosImovel['nomeImovel'];?>','pagename','resizable,height=400,width=400');"><img style="border-radius:3px; display:block;" src="<?php echo $configUrl;?>f/i/quebrado/icone-facebook-1.png" width="40"/></a></p>
													<div id="twitter" style="float:left; cursor:pointer; margin-right:15px;"><a target="resource window" title="Clique aqui para compartilhar este imóvel no Twitter" onClick="window.open('https://twitter.com/share?url=<?php echo $configUrl.$arquivoRetornar;?>%3Futm_source%3Dtwitter%26utm_medium%3Dshare-bar-desktop%26utm_campaign%3Dshare-bar&text=<?php echo $dadosImovel['nomeImovel'];?>','pagename','resizable,height=400,width=400');"><img style="border-radius:3px; display:block;" src="<?php echo $configUrl;?>f/i/quebrado/icone-twitter-1.png" width="40"></a></div>
													<div id="whatsapp2" style="float:left; cursor:pointer;"><a title="Clique aqui para compartilhar este imóvel no Whatsapp" href="whatsapp://send?text=<?php echo $configUrlSeg.$arquivoRetornar;?>"><img style="border-radius:3px; display:block;" src="<?php echo $configUrl;?>f/i/quebrado/icone-whatspp.png" width="40"></a></div>
													<br class="clear"/>
												</div>
											</div>	
<?php
	if($dadosImovel['videoImovel'] != ""){

		$pegaCodigoVideo = explode("=", $dadosImovel['videoImovel']);
		$pegaCodigoVideo = explode("&", $pegaCodigoVideo[1]);
		$montaLink = "//www.youtube.com/embed/".$pegaCodigoVideo[0];
		
		if($pegaCodigoVideo[0] == "" || $pegaCodigoVideo[0] == "shared"){
			$pegaCodigoVideo = str_replace("?feature=shared", "", $dadosImovel['videoImovel']);
			$pegaCodigoVideo = str_replace("https://youtu.be/", "", $pegaCodigoVideo);
			$montaLink = "//www.youtube.com/embed/".$pegaCodigoVideo;
		}		
?>	
											<div class="link-video" style="width:100%;"><iframe width="100%" src="<?php echo $montaLink;?>" frameborder="0" allowfullscreen></iframe></div>									
<?php
	}
?>
											<br/>
											<br/>
										<a  id="botao-baixo" href="<?php echo $configUrl.'imoveis/' ?>">Voltar</a>	
											<br/>
											<br/>
									</div>	
<?php
	$sqlImoveisConta = "SELECT count(DISTINCT I.codImovel) total FROM imoveis I inner join imoveisImagens II on I.codImovel = II.codImovel WHERE I.statusImovel = 'T' and I.codTipoImovel = ".$dadosImovel['codTipoImovel']." and I.codBairro = ".$dadosImovel['codBairro']." and I.codImovel != ".$dadosImovel['codImovel']."";
	$resultImoveisConta = $conn->query($sqlImoveisConta);
	$dadosImoveisConta = $resultImoveisConta->fetch_assoc();

	if($dadosImoveisConta['total'] >= 1){
?>												
										<div id="recomendado">
											<p class="veja">Veja mais <strong><?php echo $imovel;?>s</strong> no bairro <strong><?php echo $dadosBairro['nomeBairro'];?></strong></p>
<?php
		$cont = 0;
		$cont2 = 0;
		
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
											<br class="clear"/>
										</div>
<?php
	}
	?>										</div>
										</div>
									</div>
								</div>				
							</div>
<?php
	$_SESSION['erro'] = "";
?>
									<style>
										ul li {margin-bottom:0px;}
									</style>
