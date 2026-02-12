					<div id="conteudo-interno">				
						<div id="bloco-titulo">
							<p class="titulo como-chegar">Onde Estamos</p>							
						</div>
						<div id="conteudo-como-chegar"class="wow animate__animated animate__fadeIn">
							<div id="unidades">
								<p id="titulo">Nossas unidades</p>
								<div id="selecione">*Selecione uma de nossas unidades</div>
								<a href="javascript:void(0);" class="unidade" data-endereco="<?php echo $endereco; ?>">
									<?php echo $endereco; ?>
								</a>

								<a href="javascript:void(0);" class="unidade" data-endereco="<?php echo $endereco2; ?>">
									<?php echo $endereco2; ?>
								</a>

								<a href="javascript:void(0);" class="unidade" style="margin-bottom: 0px;" data-endereco="<?php echo $endereco3; ?>">
									<?php echo $endereco3; ?>
								</a>
							</div>
							<div id="mapa" >
								<div id="borda"></div>
								<div id="mostra-mapa" style="position:relative;">
									<div id="map-loading"></div>
									<iframe  id="iframe-mapa" src="https://www.google.com/maps?q=<?php echo urlencode($endereco); ?>&output=embed" width="100%" height="300" style="border:0; display:block; transition: opacity .4s ease;" allowfullscreen loading="lazy">     </iframe>
								</div>
								
							</div>

							<script>
								var iframe = document.getElementById('iframe-mapa');
								var loading = document.getElementById('map-loading');
								document.querySelectorAll('.unidade').forEach(function(item){
									item.addEventListener('click', function(){
										document.querySelectorAll('.unidade').forEach(function(el){
											el.classList.remove('active');
										});
										this.classList.add('active');
										var endereco = this.getAttribute('data-endereco');
										loading.style.opacity = "1";
										loading.style.pointerEvents = "all";
										iframe.style.opacity = "0.3";
										iframe.src = "https://www.google.com/maps?q=" + encodeURIComponent(endereco) + "&output=embed";
									});

								});
								iframe.addEventListener('load', function(){
									iframe.style.opacity = "1";
									loading.style.opacity = "0";
									loading.style.pointerEvents = "none";
								});
								var unidades = document.querySelectorAll('.unidade');
								if(unidades.length > 0){
									unidades[0].classList.add('active');
								}
							</script>
						</div>
					</div>	