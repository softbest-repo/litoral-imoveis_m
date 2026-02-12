<?php				
	$celularWhats = str_replace("(", "", $celular); 
	$celularWhats = str_replace(")", "", $celularWhats); 
	$celularWhats = str_replace(" ", "", $celularWhats); 
	$celularWhats = str_replace("-", "", $celularWhats); 
	
	if($url[2] == "imoveis" && !empty($url[3])){

		$quebraUrl = explode("-", $url[3]);
		$codImovel = (int)$quebraUrl[0]; 

		$sqlImovel = "SELECT codImovel, codigoImovel, urlImovel, codUsuario  FROM imoveis  WHERE codImovel = ".$codImovel."  LIMIT 1";
		$resultImovel = $conn->query($sqlImovel);
		$dadosImovel = $resultImovel->fetch_assoc();

		$mensagem = "Olá, gostaria de receber mais informações sobre o imóvel [".$dadosImovel['codigoImovel']."] link: ".$configUrl."imoveis/".$dadosImovel['codImovel']."-".$dadosImovel['urlImovel']."/";

		if($dadosCorretor['codUsuario'] != ""){
			$celularWhats = str_replace("(", "", $dadosCorretor['celularUsuario']); 
			$celularWhats = str_replace(")", "", $celularWhats); 
			$celularWhats = str_replace(" ", "", $celularWhats); 
			$celularWhats = str_replace("-", "", $celularWhats); 
		}

	}elseif($url[2] == "loteamentos" && !empty($url[3])){

		$quebraUrl = explode("-", $url[3]);
		$codLoteamento = (int)$quebraUrl[0]; 

		$sqlLote = "SELECT codLoteamento, nomeLoteamento, urlLoteamento  FROM loteamentos  WHERE codLoteamento = ".$codLoteamento."  LIMIT 1";
		$resultLote = $conn->query($sqlLote);
		$dadosLote = $resultLote->fetch_assoc();

		$mensagem = "Olá, gostaria de receber mais informações sobre o loteamento [".$dadosLote['nomeLoteamento']."] link: ".$configUrl."loteamentos/".$dadosLote['codLoteamento']."-".$dadosLote['urlLoteamento']."/";

	}else{

		$codImovel = 0;
		$mensagem = "Olá, vim através do site e gostaria de solicitar contato de um corretor.";

	}
?>

				<script type="text/javascript">
					function leadWhatsApp(cod, area){
						var $FL = jQuery.noConflict();
						var nomeLead = document.getElementById("nomeContato"+cod).value;
						var celularLead = document.getElementById("celularContato"+cod).value;
						var siteLocal = area;
						
						$FL("#loading-fundo").fadeIn(250);
						$FL("#loading-icone").fadeIn(250);	 							
						grecaptcha.execute('<?php echo $chaveSite;?>', {action: 'action_form'}).then(function(token) { 
							$FL.post("<?php echo $configUrl;?>salvaLead.php", {nomeLead: nomeLead, celularLead: celularLead, siteLocal: siteLocal, token: token, action: "action_form"}, function(data){
								if(data.trim() == "ok"){
									$FL("#nomeContato"+cod).val("");									
									$FL("#celularContato"+cod).val("");	
									$FL("#loading-fundo").fadeOut(250);
									$FL("#loading-icone").fadeOut(250);
									$FL(".blackout").fadeOut(250);
									$FL("#popup").fadeOut(250);
									window.location.href = "<?php echo $configUrl;?>contato-whatsapp-enviado/?numero=<?php echo $celularWhats;?>&msg=<?php echo $mensagem;?>";
								}else
								if(data.trim() == "erro sql lead"){
									alert("Houve um erro ao iniciar conversa no WhatsApp. Erro: #100");
								}else
								if(data.trim() == "erro captcha"){
									alert("Houve um erro ao iniciar conversa no WhatsApp. Erro: #200");
								}else{
									alert("Houve um erro ao iniciar conversa no WhatsApp. Erro: desconhecido");
								}
								
								return false										
							});
						});
						
						return false;
						
						//Erro #100: Erro ao inserir Lead;
						//Erro #200: Erro ao Captcha;
					}	

					function fechaAcesso(){
						var $FLs = jQuery.noConflict();
						$FLs(".blackout").fadeOut(250);
						$FLs("#popup").fadeOut(250);
					}														

					function abrirAcesso(){
						var $FLgs = jQuery.noConflict();
						$FLgs(".blackout").fadeIn(250);
						$FLgs("#popup").fadeIn(250);
					}														
				</script> 
<?php
	if($url[2] == ""){
?>							
				<script type="text/javascript">
					var $gh2 = jQuery.noConflict();
					$gh2(document).ready(function(){
						$gh2(window).scroll(function(){
							if($gh2(this).scrollTop() >= 50){
								$gh2("#repete-topo").removeClass("normal").addClass("scroll");
								document.getElementById("imagem-logo").src="<?php echo $configUrl;?>f/i/quebrado/logo.png";
							}else{
								$gh2("#repete-topo").removeClass("scroll").addClass("normal");
								document.getElementById("imagem-logo").src="<?php echo $configUrl;?>f/i/quebrado/logo.png";
							}
						});
					});
	
					$gh2(window).scroll(function(){
						if($gh2(this).scrollTop() >= 50){
							$gh2("#repete-topo").removeClass("normal").addClass("scroll");
							document.getElementById("imagem-logo").src="<?php echo $configUrl;?>f/i/quebrado/logo.png";
						}else{
							$gh2("#repete-topo").removeClass("scroll").addClass("normal");
							document.getElementById("imagem-logo").src="<?php echo $configUrl;?>f/i/quebrado/logo.png";
						}
					});					
				</script>
				<div id="repete-topo" class="normal"> 
<?php
	}else{
?>				
				<script type="text/javascript">
					var $gh2 = jQuery.noConflict();
					$gh2(document).ready(function(){
						$gh2(window).scroll(function(){
							if($gh2(this).scrollTop() >= 50){
								$gh2("#repete-topo").removeClass("interno").addClass("scroll");
                                document.getElementById("imagem-logo").src="<?php echo $configUrl;?>f/i/quebrado/logo.png";
							}else{
								$gh2("#repete-topo").removeClass("scroll").addClass("interno");
                                document.getElementById("imagem-logo").src="<?php echo $configUrl;?>f/i/quebrado/logo.png";
							}
						});
					});
	
					$gh2(window).scroll(function(){
						if($gh2(this).scrollTop() >= 50){
							$gh2("#repete-topo").removeClass("interno").addClass("scroll");
                            document.getElementById("imagem-logo").src="<?php echo $configUrl;?>f/i/quebrado/logo.png";
						}else{
							$gh2("#repete-topo").removeClass("scroll").addClass("interno");
                            document.getElementById("imagem-logo").src="<?php echo $configUrl;?>f/i/quebrado/logo.png";
						}
					});					
				</script>
				<div id="repete-topo" class="interno"> 
				<?php
					}
				?>
				<p class="blackout" style="display:none;" onClick="fechaAcesso();"></p>
				<div id="popup" style="display:none;">
					<p class="x" translate="no" onClick="fechaAcesso();">X</p>
					<p class="logo"><img style="display:block;" src="<?php echo $configUrl;?>f/i/quebrado/logo-whats-2.svg" width="230"/></p>
					<p class="titulo">Chame-nos no WhatsApp.</p>
					<p class="titulo2">Converse com um de nossos corretores!</p>
					<form id="targetFormTopo" action="<?php echo $configUrl;?>" method="post" onSubmit="return false, leadWhatsApp('P', 'S');">
						<p class="campo-nome"><input type="text" id="nomeContatoP" value="" placeholder="Nome" required /></p>
						<p class="campo-whats"><input type="text" id="celularContatoP" value="" placeholder="WhatsApp" required onKeyDown="Mascara(this,novoTelefone);" onKeyPress="Mascara(this,novoTelefone);" onKeyUp="Mascara(this,novoTelefone);" /></p>
						<p class="botao-envia"><input type="submit" value="Iniciar Atendimento"/></p>
					</form>
				</div> 
					<p id="loading-fundo" style="width:100%; height:100%; display:none; position:fixed; z-index:100000002; left:0; top:0; right:0; background:rgba(0,0,0,0.7);"></p>
					<p id="loading-icone" style="widht:100px; height:100px; display:none; position:fixed; z-index:100000002; top:50%; left:50%; color:#FFF; text-align:center; transform:translate(-50%, -50%);"><img style="display:table; margin:0 auto;" src="<?php echo $configUrl;?>f/i/quebrado/loading.svg" width="100"/> Aguarde... Estamos lhe redirecionando para o WhatsApp!</p>			

					<div id="conteudo-topo">
						<div style="display: flex; justify-content: space-between;">
							<div id="ld-esq">
								<div id="logo-topo">
									<p class="logo"><a title="<?php echo $nomeEmpresa;?>" href="<?php echo $configUrl;?>"><img id="imagem-logo"  style="display:block;" src="<?php echo $configUrl;?>f/i/quebrado/logo.png" width="100%"/></a></p>
								</div>
							</div>
							<div id="ld-dir">
								<div id="redes">
									<a id="whats"   onclick="abrirAcesso(event, this)"  target="_blank" title="Chame no WhatsApp"></a>
									<a id="facebook" target="_blank" title="Siga-nos no Facebook" href="https://www.facebook.com/<?php echo $facebook; ?>"></a>
									<a id="instagram" target="_blank" title="Siga-nos no Instagram" href="https://www.instagram.com/<?php echo $instagram; ?>"></a>
								</div>
								<p class="icone-menu" onClick="abreMenu();"><img style="display:block;" src="<?php echo $configUrl;?>f/i/quebrado/menu.svg"/></p>
								<div id="ajuste-menu">
									<div id="menu">
										<div id="mostra-menu" style="display:none;">
											<p class="<?php echo $url[2] == "sobre" ? 'ativo' : ''; ?>"><a href="<?php echo $configUrl; ?>sobre/">Sobre</a></p>
											<p class="<?php echo $url[2] == "imoveis" ? 'ativo' : ''; ?>"><a href="<?php echo $configUrl; ?>imoveis/">Imóveis</a></p>
											<p class="<?php echo $url[2] == "loteamentos" ? 'ativo' : ''; ?>"><a href="<?php echo $configUrl; ?>loteamentos/">Loteamentos</a></p>
											<p class="<?php echo $url[2] == "novidades" ? 'ativo' : ''; ?>"><a href="<?php echo $configUrl; ?>novidades/">Novidades</a></p>     
											<p class="<?php echo $url[2] == "onde-estamos" ? 'ativo' : ''; ?>"><a href="<?php echo $configUrl; ?>onde-estamos/">Onde Estamos</a></p>     
											<p class="<?php echo $url[2] == "hoteis-e-restaurantes" ? 'ativo' : ''; ?>"><a href="<?php echo $configUrl; ?>hoteis-e-restaurantes/">Hotéis e Restaurantes</a></p>     
											<p class="<?php echo $url[2] == "depoimentos" ? 'ativo' : ''; ?>"><a href="<?php echo $configUrl; ?>depoimentos/">Depoimentos</a></p>     
											<p class="<?php echo $url[2] == "trabalhe-conosco" ? 'ativo' : ''; ?>"><a href="<?php echo $configUrl; ?>trabalhe-conosco/">Trabalhe Conosco</a></p>     
											<p class="<?php echo $url[2] == "contato" ? 'ativo' : ''; ?>" style="margin-right:0px;"><a  style="cursor:pointer;"  onclick="abrirAcesso()" >Contato</a></p>
										</div>
									</div> 
								</div>
							</div>
						</div>
						<script type="text/javascript">
							function abreMenu(){
								var $rr = jQuery.noConflict();
								$rr("#mostra-menu").toggle(200);
							}
						</script>						
					</div>
                </div>
				<div id="botao-whats"  onclick="abrirAcesso(event, this)" >
					<div id="whats">
						<img src="<?php echo $configUrl ?>f/i/quebrado/whatsapp.svg" alt="">
					</div>
				</div>