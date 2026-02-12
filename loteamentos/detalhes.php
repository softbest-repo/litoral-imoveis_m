							<div id="conteudo-interno">
								<div id="bloco-titulo">
									<p class="titulo">Loteamentos</p>
										<a  id="botao-topo" style="top: 151%;" href="<?php echo $configUrl.'loteamentos/' ?>">Voltar</a>
								</div>
								<div id="repete-loteamentos-detalhes">
<?php 
	$quebraUrl = explode("-", $url[3]);
	
 	$sqlLoteamento = "SELECT * FROM loteamentos WHERE codLoteamento = '".$quebraUrl[0]."' and statusLoteamento = 'T' LIMIT 0,1";
	$resultLoteamento = $conn->query($sqlLoteamento);
	$dadosLoteamento = $resultLoteamento->fetch_assoc();								

	$sqlCidade = "SELECT * FROM cidades WHERE statusCidade = 'T' and codCidade = ".$dadosLoteamento['codCidade']." LIMIT 0,1";
	$resultCidade = $conn->query($sqlCidade);
	$dadosCidade = $resultCidade->fetch_assoc();

	$sqlBairro = "SELECT * FROM bairros WHERE statusBairro = 'T' and codBairro = ".$dadosLoteamento['codBairro']." LIMIT 0,1";
	$resultBairro = $conn->query($sqlBairro);
	$dadosBairro = $resultBairro->fetch_assoc();	
?>
									<div id="conteudo-loteamentos">				
										<div id="bloco-imagem">
											<div class="owl-imagens">
												<div class="row">
													<div class="large-12 columns">
														<div class="loop owl-carousel loteamentos-detalhes owl-loaded owl-drag">	

<?php
	$sqlImagens = "SELECT * FROM loteamentosImagens WHERE codLoteamento = '".$dadosLoteamento['codLoteamento']."' and tipoLoteamentoImagem = 'F' ORDER BY ordenacaoLoteamentoImagem ASC, codLoteamentoImagem ASC";
	$resultImagens = $conn->query($sqlImagens);
	while($dadosImagens = $resultImagens->fetch_assoc()){
		
		if($dadosImagens['extLoteamentoImagem'] == "mp4"){
			
?>
															<li style="width:100%; height:230px;"><span><video id="video" class="vid" disablePictureInPicture controlsList="nodownload" constrols style="max-height:100%; position:absolute; left:50%; transform:translateX(-50%);" src="<?php echo $configUrlGer.'f/loteamentos/'.$dadosImagens['codLoteamento'].'-'.$dadosImagens['codLoteamentoImagem'].'-O.'.$dadosImagens['extLoteamentoImagem'];?>" type="video/mp4" controls="true"></video></span></li>
<?php
		}else{
?>
															<li><a rel="lightbox[roadtrip]" href="<?php echo $configUrlGer.'f/loteamentos/'.$dadosImagens['codLoteamento'].'-'.$dadosImagens['codLoteamentoImagem'].'-W.webp';?>" style=" height:230px;   display:block; background:transparent url('<?php echo $configUrlGer.'f/loteamentos/'.$dadosImagens['codLoteamento'].'-'.$dadosImagens['codLoteamentoImagem'].'-W.webp';?>') center center no-repeat; background-size:cover, 100%;"></a></li>
															
<?php		
		}
	}
?>	
														</div>
													</div>
												</div>
											</div>																												
											<script>
												var $gt = jQuery.noConflict();
												var owl = $gt('.loteamentos-detalhes');
													owl.owlCarousel({
														center: false,
														items:1,
														loop: true,
														autoWidth:false,
														margin:15,
														nav: false,
														dots: false
													});
											</script>																							
										</div>
										<div id="mostra-informacoes">
											<div id="col-esq-loteamentos">
												<div id="bloco-dados">
													<p class="titulo"><span class="loteamento">Loteamento </span><br/><?php echo $dadosLoteamento['nomeLoteamento'];?></p>
													<div class="descricao"><?php echo $dadosLoteamento['descricaoLoteamento'];?></div>													
												</div>	
											</div>
<?php
												if($dadosLoteamento['mapaLoteamento'] != ""){
?>				
										<div id="repete-localizacao">
											<div id="conteudo-localizacao">
												<p class="titulo">Localização</p>	
												<a target="_blank" title="Clique aqui para ver a localização no Mapa" href="<?php echo $dadosLoteamento['linkLocalizacaoLoteamento'];?>">
													<p class="endereco"><?php echo $dadosLoteamento['localizacaoLoteamento'];?></p>
												</a>
												<div id="col-esq-localizacao">
													<?php echo $dadosLoteamento['mapaLoteamento'];?>
												</div>
												<br class="clear"/>
												<script>
													var $tg = jQuery.noConflict();

													function mudaTamanho() {
														var iframe = $tg("#col-esq-localizacao iframe");

														if (iframe.length) {
															iframe.attr("width", "100%");
															iframe.attr("height", "300px");
															iframe.css("border-radius", "10px");
														} else {
															console.error("Iframe não encontrado!");
														}
													}

													$tg(document).ready(function() {
														setTimeout(mudaTamanho, 0);
													});
												</script>						
											</div>
										</div>

<?php
	}
?>										
											<br class="clear"/>	
										</div>	
<?php
	$sqlCaracteristicas = "SELECT DISTINCT C.codCaracteristica, C.* FROM caracteristicasLoteamentos CL inner join caracteristicas C on CL.codCaracteristica = C.codCaracteristica inner join caracteristicasImagens CI on C.codCaracteristica = CI.codCaracteristica WHERE C.statusCaracteristica = 'T' and CL.codLoteamento = '".$dadosLoteamento['codLoteamento']."' ORDER BY C.codOrdenacaoCaracteristica ASC LIMIT 0,1";
	$resultCaracteristicas = $conn->query($sqlCaracteristicas);
	$dadosCaracteristicas = $resultCaracteristicas->fetch_assoc();
	
	if($dadosCaracteristicas['codCaracteristica'] != ""){
?>
										<div id="repete-caracteristicas">
											<div id="caracteristicas">
												<p class="titulo">Características</p>
												<div id="conteudo-caracteristica">
<?php
		$sqlCaracteristicas = "SELECT DISTINCT * FROM caracteristicasLoteamentos CL inner join caracteristicas C on CL.codCaracteristica = C.codCaracteristica inner join caracteristicasImagens CI on C.codCaracteristica = CI.codCaracteristica WHERE C.statusCaracteristica = 'T' and CL.codLoteamento = '".$dadosLoteamento['codLoteamento']."' ORDER BY C.codOrdenacaoCaracteristica ASC";
		$resultCaracteristicas = $conn->query($sqlCaracteristicas);
		while($dadosCaracteristicas = $resultCaracteristicas->fetch_assoc()){
?>												
													<p class="item-caracteristica"><span class="icone"><img style="display:block;" src="<?php echo $configUrlGer.'f/caracteristicas/'.$dadosCaracteristicas['codCaracteristica'].'-'.$dadosCaracteristicas['codCaracteristicaImagem'].'-O.'.$dadosCaracteristicas['extCaracteristicaImagem'];?>" width="35"/></span><span class="texto"><?php echo $dadosCaracteristicas['nomeCaracteristica'];?></span></p>
<?php
		}
?>	
												</div>
											</div>											
										</div>	
<?php
	}
	if($dadosLoteamento['videoLoteamento'] != "" || $dadosLoteamento['link360Loteamento'] != ""){
?>
										<div id="video-360">
											<div id="mostra-alinha">
<?php
		if($dadosLoteamento['videoLoteamento'] != ""){

			$pegaCodigoVideo = explode("=", $dadosLoteamento['videoLoteamento']);
			$pegaCodigoVideo = explode("&", $pegaCodigoVideo[1]);
			$montaLink = "//www.youtube.com/embed/".$pegaCodigoVideo[0];
			
			if($pegaCodigoVideo[0] == "" || $pegaCodigoVideo[0] == "shared"){
				$pegaCodigoVideo = str_replace("?feature=shared", "", $dadosLoteamento['videoLoteamento']);
				$pegaCodigoVideo = str_replace("https://youtu.be/", "", $pegaCodigoVideo);
				$montaLink = "//www.youtube.com/embed/".$pegaCodigoVideo;
			}		
?>	
												<div class="link-video">
													<iframe width="100%" height="400" src="<?php echo $montaLink;?>" frameborder="0" allowfullscreen></iframe>
												</div>									
<?php
		}
	
		if($dadosLoteamento['link360Loteamento'] != ""){	
?>	
												<div class="iframe-360">
													<?php echo $dadosLoteamento['link360Loteamento'];?>
												</div>									
<?php
		}
?>
											</div>
											<script>
												var $tg = jQuery.noConflict();
												$tg(".iframe-360 iframe").css("width", "100%");
												$tg(".iframe-360 iframe").css("height", "400px");
											</script>
										</div>
<?php
	}
	$valorParcelado = number_format($dadosLoteamento['entradaLoteamento'], 2, ',', '.');
	list($reaisParcelado, $centavosParcelado) = explode(',', $valorParcelado);

	$valorAVista = number_format($dadosLoteamento['precoAvistaLoteamento'], 2, ',', '.');
	list($valorAVistaReais, $valorAVistaCentaos) = explode(',', $valorAVista);
?>
										<div id="conteudo-preco">																
<?php 
	 if (floatval($dadosLoteamento['precoAvistaLoteamento']) == 0.00 || floatval($dadosLoteamento['precoAvistaLoteamento']) == '') {
?>
											<p class="a-partir">A partir de</p>
											<p class="preco"> 
												R$ <?php echo $reaisParcelado; ?><span class="centavos">,<?php echo $centavosParcelado; ?></span>
											</p>
											<p class="parcela">+ <?php echo $dadosLoteamento['nParcelaLoteamento']; ?>x de R$ <?php echo number_format( $dadosLoteamento['precoLoteamento'], 2, ",", "."); ?>  </p>
<?php 
	}else if( $dadosLoteamento['entradaLoteamento'] == 0.00 || $dadosLoteamento['entradaLoteamento'] == '') {
?>
											<p class="a-partir">À Vista</p> 
											<p class="preco">
												R$ <?php echo $valorAVistaReais; ?><span class="centavos">,<?php echo $valorAVistaCentaos; ?></span>
											</p>
<?php										
	}else{
?>
											<p class="a-partir">A partir de</p> 
											<p class="preco">
												R$ <?php echo $valorAVistaReais; ?><span class="centavos">,<?php echo $valorAVistaCentaos; ?></span>
											</p>
											<p class="a-partir">ou</p>
											<p class="preco" style="font-size: 40px;"> 
												R$ <?php echo $reaisParcelado; ?><span class="centavos" style="font-size: 25px;">,<?php echo $centavosParcelado; ?></span>
											</p>
											<p class="parcela" style="font-size: 23px;">+ <?php echo $dadosLoteamento['nParcelaLoteamento']; ?>x de R$ <?php echo number_format( $dadosLoteamento['precoLoteamento'], 2, ",", "."); ?>  </p>
								
<?php 
	}
?>
										</div>  
										<div id="whatz">
											<div id="fundo" target="_blank" title="Converse com a gente através do WhatsApp!" onClick="abrirAcesso();">
												<div id="dir">
													<img src=" <?php echo $configUrl.'f/i/quebrado/whatsapp.svg' ?> " width="60%" alt="">
												</div>
												<div id="esq">
													<p class="whatz">WhatsApp</p>
													<p class="descricao">Fale conosco agora!</p>
												</div>
											</div>
										</div>										 																										
									</div>
								</div>				
							</div>
