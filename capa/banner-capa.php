<div id="repete-banners">
	<div id="conteudo-banner">
		<div id="bloco-banner">
			<div class="owl-carrossel">
				<div class="row">
					<div class="large-12 columns">
						<div class="loop owl-carousel bannerCapa owl-loaded owl-drag">
<?php
	$cont = 0;

	$sqlBanner = "SELECT * FROM banners WHERE statusBanner = 'T' ORDER BY codOrdenacaoBanner ASC";
	$resultBanner = $conn->query($sqlBanner);
	while ($dadosBanner = $resultBanner->fetch_assoc()) {

		$sqlImagem = "SELECT * FROM bannersImagens WHERE codBanner = '" . $dadosBanner['codBanner'] . "' ORDER BY codBannerImagem DESC LIMIT 0,1";
		$resultImagem = $conn->query($sqlImagem);
		$dadosImagem = $resultImagem->fetch_assoc();

		if ($dadosImagem['extBannerImagem'] != "") {

			$cont++;

				
			switch ($dadosBanner['botaoBanner']) {
				case 'T': $botaoBanner = 'block'; break;
				case 'F': $botaoBanner = 'none'; break;
				default:  $botaoBanner = false; break;
			}


			if ($dadosBanner['linkBanner'] != '') {
				$temLink = true;
				$linkBanner = $dadosBanner['linkBanner'];
			} else {
				$temLink = false;
				$linkBanner = '';
			}



			if ($dadosImagem['extBannerImagem'] != "mp4" && $dadosImagem['extBannerImagem'] != "MP4") {

			switch ($dadosBanner['botaoBanner']) {
				case 'T':
					$botaoBannerDisplay = 'block';
					break;
				case 'F':
					$botaoBannerDisplay = 'none';
					break;
				default:
					$botaoBannerDisplay = 'none'; 
					break;
			}
			if (!empty($dadosBanner['linkBanner'])) {
				$temLink    = true;
				$linkBanner = $dadosBanner['linkBanner'];
				$targetLink = '_blank'; 
			} else {
				$temLink    = false;
				$linkBanner = '#';
				$targetLink = '_self';
			}
?>

					<div class="item">
						<div class="imagem-banner" style="width:100%; height:374px; background:transparent url('<?php echo $configUrlGer . 'f/banners/' . $dadosImagem['codBanner'] . '-' . $dadosImagem['codBannerImagem'] . '-O.' . $dadosImagem['extBannerImagem']; ?>') center center no-repeat; background-size:cover; display:grid; align-content:end;">

							<div id="alinha" style="width:90%; background:#00355dd9; margin:0 auto 12px; padding:10px; border-radius:10px;">
								<div id="titulo" style="text-align:center; font-size:16px; color:white;"> <?php echo $dadosBanner['tituloBanner']; ?> </div>
								<div id="descricao">
									<?php echo $dadosBanner['descricaoBanner']; ?>
								</div>
							</div>

							<div style="display:flex; justify-content:center; align-items:center; margin-bottom:12px;">
								<a href="#" style="text-align:center; display:<?php echo $botaoBannerDisplay; ?>; color:white; font-size:12px; background:#ff6801; padding:5px 30px; border-radius:5px;" onclick="abrirAcesso()">Conheça</a>
							</div>
						</div>
					</div>

<?php

			} else {
?>
				<div class="item">
					<video class="vid" disablePictureInPicture controlsList="nodownload" style="min-width: 100%; min-height: 100%; width: 100%; display:block;" src="<?php echo $configUrlGer . 'f/banners/' . $dadosImagem['codBanner'] . '-' . $dadosImagem['codBannerImagem'] . '-O.' . $dadosImagem['extBannerImagem']; ?>" type="video/mp4" loop muted autoplay></video>
				</div>
<?php
			}
		}
	}
?>
						</div>
					</div>
				</div>
			</div>
			<script>
				var $rfg = jQuery.noConflict();
				var owl = $rfg('.bannerCapa');
				owl.owlCarousel({
					autoplay: true,
					speed: 1500,
					autoplayTimeout: 10000,
					smartSpeed: 1000,
					fluidSpeed: 1000,
					items: 1,
					loop: true,
					videoHeight: 930,
					video: true,
					lazyLoad: true,
					lazyLoad: true,
					autoWidth: false,
					autoplayHoverPause: false,
					margin: 0,
					nav: false,
					dots: true
				});
			</script>
		</div>
	</div>
</div>
