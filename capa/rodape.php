

<?php		
	if(isset($_COOKIE['politica'.$cookie]) == ""){
?>
				<script>
					function salvaPolitica(){
						var $pol = jQuery.noConflict();															
						$pol("#politica-privacidade").fadeOut(200);
						$pol.post("<?php echo $configUrl;?>salva-politica.php", {cod: 1},function(data){
							$pol("#politica-privacidade").fadeOut(200);							
						});  																						
					}	
					
					function fadeInPolitica(){
						var $polF = jQuery.noConflict();															
						$polF("#politica-privacidade").fadeIn(200);						
					}			
				</script>
				<div id="politica-privacidade" style="display:none;" class="animate__animated animate__pulse animate__slow animate__infinite">
					<p class="texto">Ao navegar este site você concorda com as <a target="_blank" class="texto" href="<?php echo $configUrl;?>politica-de-privacidade/">políticas de privacidade</a>. <br><br> <a class="botao-ok" onClick="salvaPolitica();">Ok</a> </p>
				</div>
<?php
	}
?>	
		<script type="text/javascript">
			function retiraCaptcha() {
				var $gt = jQuery.noConflict();
				$gt(".grecaptcha-badge").fadeOut("slow");
			}

			setTimeout("retiraCaptcha();", 2000);
		</script>

		<div id="repete-rodape">
			<div id="conteudo-rodape">
				<div id="ld-esq" style="display: flex; justify-content: center; position: relative;">
					<div id="mapa-site" >
						<div>
							<li class="<?php echo $url[2] == "" ? 'ativo' : 'p';?>"><a href="<?php echo $configUrl;?>">Home</a></li>
							<li class="<?php echo $url[2] == "sobre" ? 'ativo' : 'p';?>"><a href="<?php echo $configUrl;?>sobre/">Sobre</a></li>
							<li class="<?php echo $url[2] == "imoveis" ? 'ativo' : 'p';?>"><a href="<?php echo $configUrl;?>imoveis/">Imóveis</a></li>
							<li class="<?php echo $url[2] == "loteamentos" ? 'ativo' : 'p';?>"><a href="<?php echo $configUrl;?>loteamentos/">Loteamentos</a></li>
							<li class="<?php echo $url[2] == "novidades" ? 'ativo' : 'p';?>" style="margin-bottom:0px;"><a href="<?php echo $configUrl;?>novidades/">Novidades</a></li>
						</div>
						<div>
							<li class="<?php echo $url[2] == "onde-estamos" ? 'ativo' : 'p';?>" ><a href="<?php echo $configUrl;?>onde-estamos/">Onde Estamos</a></li>
							<li class="<?php echo $url[2] == "hoteis-e-restaurantes" ? 'ativo' : 'p';?>"><a href="<?php echo $configUrl;?>hoteis-e-restaurantes/">Hotéis e Restaurantes</a></li>
							<li class="<?php echo $url[2] == "depoimentos" ? 'ativo' : 'p';?>"><a href="<?php echo $configUrl;?>depoimentos/">Depoimentos</a></li>
							<li class="<?php echo $url[2] == "trabalhe-conosco" ? 'ativo' : 'p';?>"><a href="<?php echo $configUrl;?>trabalhe-conosco/">Trabalhe Conosco</a></li>
							<li class="<?php echo $url[2] == "contato" ? 'ativo' : 'p';?>" style="margin-bottom:0px; cursor:pointer;" onclick="abrirAcesso()"><a >Contato</a></li>
						</div>
					</div>
				</div>
				<div id="logo-rodape">
					<p class="logo"><a title="<?php echo $nomeEmpresa; ?>" href="<?php echo $configUrl; ?>"><img style="display:block; width: 199px; " src="<?php echo $configUrl; ?>f/i/quebrado/logo.png" width="100%" /></a></p>
				</div>
				<div id="ld-dir" >
					<p id="titulo">Nossas unidades</p>
					<a id="unidade" target="_blank" href="<?php echo  $rota; ?>"><?php echo $endereco; ?></a>
					<a id="unidade" target="_blank" href="<?php echo  $rota2; ?>"><?php echo $endereco2; ?></a>
					<a id="unidade" target="_blank" href="<?php echo  $rota3; ?>"><?php echo $endereco3; ?></a>
					<div id="creci">
						<p>CRECI: <?php echo $creci; ?></p>
					</div>
				</div>
			</div>
        </div>
        <div id="repete-copy">
            <div id="conteudo-copy">
				<div >
					<p class="politica" style=""><a style="display:block; color:#444444; font-size:14px; line-height: 100%;" href="<?php echo $configUrl; ?>politica-de-privacidade/">Política de Privacidade - Copyright 2026  </a></p>
					<p class="copy">Todos os direitos reservados - <?php echo $nomeEmpresaMenor; ?></p> 
				</div>
                <p class="softbest"><a target="_blank" title="Desenvolvido por: www.softbest.com.br" href="http://www.softbest.com.br" style="display: flex; justify-content: center;"><img style="display:block; " src="<?php echo $configUrl; ?>f/i/logo-softbest-colorida.svg" width="60" /></a></p>
            </div>
        </div>