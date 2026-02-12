<?php
	ob_start();
	session_start();
	error_reporting(1);
	ini_set('display_errors', 1);
	include ('f/conf/config.php');
	include ('f/conf/functions.php');

	$url = explode("/", $aux.$_SERVER['REQUEST_URI']);

	$quebraUrl2 = explode("=", $url[2]);
	$quebraUrl3 = explode("=", $url[3]);
	$quebraUrl4 = explode("=", $url[4]);

	if($quebraUrl2[0] == "?fbclid" || $quebraUrl2[0] == "?gclid"){
		$url[2] = "";
	}
	if($quebraUrl3[0] == "?fbclid" || $quebraUrl3[0] == "?gclid" || $quebraUrl3[0] == "?numero"){
		$url[3] = "";
	}
	if($quebraUrl4[0] == "?fbclid" || $quebraUrl4[0] == "?gclid"){
		$url[4] = "";
	}
		
	if($url[4] != ""){ 
		$arquivoRetornar = $url[2].'/'.$url[3].'/'.$url[4].'/';
			if(is_numeric($url[4])){
				if(file_exists($url[2].'/'.$url[3].'/conteudo.php')){
					$arquivo = $url[2].'/'.$url[3].'/conteudo.php';
				}else
					if(file_exists($url[2].'/'.$url[3].'/detalhes.php')){
						$arquivo = $url[2].'/'.$url[3].'/detalhes.php';
					}else
						if(file_exists($url[2].'/'.$url[3].'.php')){
							$arquivo = $url[2].'/'.$url[3].'.php';
						}else
							if(file_exists($url[2].'/conteudo.php')){
								$arquivo = $url[2].'/conteudo.php';
							}else{
								$arquivo = '404/conteudo.php';
							}
					
			}else						
				if(file_exists($url[2].'/detalhes.php')){
					$arquivo = $url[2].'/detalhes.php';
				}else
					if(file_exists($url[2].'/conteudo.php')){
						$arquivo = $url[2].'/conteudo.php';
					}else
						if(file_exists($url[2].'/'.$url[3].'/'.$url[4].'.php')){
							$arquivo = $url[2].'/'.$url[3].'/'.$url[4].'.php';
						}else{
							$arquivo = '404/conteudo.php';
						}
	}else
		if($url[3] != ""){
			$arquivoRetornar = $url[2].'/'.$url[3].'/';
			
			if(is_numeric($url[3])){  
				if(file_exists($url[2].'/conteudo.php')){
					$arquivo = $url[2].'/conteudo.php';
				}else										
					if(file_exists($url[2].'/conteudo.php')){
						$arquivo = $url[2].'/conteudo.php';
					}
			}else	
				if(!is_numeric($url[3])){  
					if(file_exists($url[2].'/detalhes.php')){
						$arquivo = $url[2].'/detalhes.php';												
					}else
					if(file_exists($url[2].'/'.$url[3].'.php')){
						$arquivo = $url[2].'/'.$url[3].'.php';
					}										
				}else
				if($url[3] == "contato-whatsapp-enviado"){
					$arquivo = 'contato-whatsapp-enviado.php';
				}else															
				if(file_exists($url[2].'/'.$url[3].'/conteudo.php')){
					$arquivo = $url[2].'/'.$url[3].'/conteudo.php';																						
				}else
					if(file_exists($url[2].'/detalhes.php')){
						$arquivo = $url[2].'/detalhes.php';												
					}else								
						if(file_exists($url[2].'/'.$url[3].'.php')){
							$arquivo = $url[2].'/'.$url[3].'.php';
						}else
							if(file_exists($url[2].'/conteudo.php')){
								$arquivo = $url[2].'/conteudo.php';
							}else
								if($url[2] == "busca"){
									$arquivo = $url[2].'/conteudo.php';
								}else{
									$arquivo = '404/conteudo.php';
								}
				
		}else
			if($url[2] != ""){
				$arquivoRetornar = $url[2].'/';

				if($url[2] == "contato-whatsapp-enviado"){
					$arquivo = 'contato-whatsapp-enviado.php';
				}else								
				if(file_exists($url[2].'/conteudo.php')){
					$arquivo = $url[2].'/conteudo.php';
				}else
					if(file_exists($url[2].'.php')){
						$arquivo = $url[2].'.php';
					}else{
						$arquivo = '404/conteudo.php';
					}	
			}else
				if($url[2] == ""){
					$arquivoRetornar = "";
					
					$arquivo = 'capa/conteudo.php';
				}else{
					$arquivo = '404/conteudo.php';
				}	
				
	include ('f/conf/titles.php');			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt" lang="pt">
	<head>
		<title><?php echo $title;?></title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="author" content="SoftBest" />
		<meta name="description" content="<?php echo $description;?>" />
		<meta name="keywords" content="<?php echo $keywords;?>" />
		<meta name="language" content="<?php echo $linguagem;?>"/>
		<meta name="city" content="<?php echo $cidade;?>"/>
		<meta name="state" content="<?php echo $estado;?>"/>
		<meta name="country" content="<?php echo $pais;?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">		
		<meta name="theme-color" content="<?php echo $cor1;?>">
		<meta name="apple-mobile-web-app-status-bar-style" content="<?php echo $cor1;?>">
		<meta name="msapplication-navbutton-color" content="<?php echo $cor1;?>">	
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php
	if($arquivo != "404/conteudo.php"){
?>
		<meta name="robots" content="index,follow"/>	
<?php
	}else{
?>
		<meta name="robots" content="noindex">
<?php
	}
?>
		<link rel="canonical" href="<?php echo $dominio;?>/<?php echo $arquivoRetornar;?>" />	
		<link rel="shortcut icon" href="<?php echo $configUrl;?>f/i/icon.png" />
		<link rel="stylesheet" type="text/css" href="<?php echo $configUrl;?>f/c/estilo.css" media="all" title="Layout padrão" />
		<link rel="stylesheet" type="text/css" href="<?php echo $configUrl;?>f/j/carousel/skin.css" media="all" title="Layout padrão" />
		<link rel="stylesheet" type="text/css" href="<?php echo $configUrl;?>f/j/new-carousel/jquery.bxslider.css" media="all" title="Layout padrão" />
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
		<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $chaveSite;?>"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.min.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
		<script>new WOW().init();</script>
		<script>
			if (typeof lightbox !== 'undefined') {
			lightbox.option({
				'resizeDuration': 200,
				'wrapAround': true
			});
			}
		</script>
		<script type="text/javascript" src="<?php echo $configUrl;?>f/j/javascript.js"></script>
		<script type="text/javascript" src="<?php echo $configUrl;?>f/j/new-carousel/jquery.bxslider.min.js"></script>
		<script type="text/javascript" src="<?php echo $configUrl;?>f/j/new-carousel/jquery.bxslider.js"></script>
		<script type="text/javascript" src="<?php echo $configUrl;?>f/j/js/mascaras.js"></script>
<?php
	if($configUrlSeg != ""){
?>		

		<script>
			var ua = navigator.userAgent.toLowerCase();
			var uMobile = '';
			uMobile = '';
			uMobile += 'iphone;ipod;ipad;windows phone;android;iemobile 8';
			v_uMobile = uMobile.split(';');
			var boolMovel = false;
			
			for (i=0;i<=v_uMobile.length;i++){
				if (ua.indexOf(v_uMobile[i]) != -1){
					boolMovel = true;
				}
			}

			if (boolMovel == true){
			}else{
				location.href="<?php echo $configUrlSeg.$arquivoRetornar.$ancora;?>";	  			  
			}
		</script>		
<?php
	}
if($url[2] != "imoveis" && $url[2] != "noticias"){
?>
		<meta property="og:title" content="<?php echo $title;?>"/>
		<meta property="og:image" content="<?php echo $configUrl;?>f/i/comp.png"/>
		<meta property="og:description" content="<?php echo $description;?>"/>
		<meta property="og:url" content="<?php echo $configUrl.$arquivoRetornar;?>"/>
		<link href="<?php echo $configUrl;?>f/i/comp.png" rel="image_src" />
<?php
	}else	
	if($url[2] == "imoveis"){
		
		if($url[3] != ""){
			
			$quebraUrl = explode('-', $url[3]);			
						
			$sqlPrimeiroImovel = "SELECT P.*, I.* FROM imoveis P inner join imoveisImagens I on P.codImovel = I.codImovel WHERE P.statusImovel = 'T' and P.codImovel = '".$quebraUrl[0]."' LIMIT 0,1";
			$resultPrimeiroImovel = $conn->query($sqlPrimeiroImovel);
			$dadosPrimeiroImovel = $resultPrimeiroImovel->fetch_assoc();

 			$sqlImagem = "SELECT * FROM imoveisImagens WHERE codImovel = '".$dadosPrimeiroImovel['codImovel']."' ORDER BY ordenacaoImovelImagem ASC, codImovelImagem ASC LIMIT 0,1";
			$resultImagem = $conn->query($sqlImagem);
			$dadosImagem = $resultImagem->fetch_assoc();
		
			if(file_exists("ger/f/imoveis/".$dadosImagem['codImovel']."-".$dadosImagem['codImovelImagem']."-W.webp")){
				$imagem = $configUrlGer."f/imoveis/".$dadosImagem['codImovel']."-".$dadosImagem['codImovelImagem']."-W.webp";
			}else{
				$imagem = $configUrlGer."f/imoveis/".$dadosImagem['codImovel']."-".$dadosImagem['codImovelImagem']."-M.".$dadosImagem['extImovelImagem'];
			}
?>
		<meta property="og:title" content="<?php echo $dadosPrimeiroImovel['nomeImovel'];?> | <?php echo $nomeEmpresa;?>"/>
		<meta property="og:description" content="<?php echo $description;?>"/>
		<meta property="og:image" content="<?php echo $imagem;?>" />				
		<meta property="og:url" content="<?php echo $configUrl.$arquivoRetornar;?>"/>
		<link href="<?php echo $imagem;?>" rel="image_src" />
<?php
		}
	
	}else
	if($url[2] == "noticias"){
		
		if($url[3] != ""){
			
			$quebraUrl = explode('-', $url[3]);			
						
			$sqlPrimeiroNoticia = "SELECT P.*, I.* FROM noticias P inner join noticiasImagens I on P.codNoticia = I.codNoticia WHERE P.statusNoticia = 'T' and P.codNoticia = '".$quebraUrl[0]."' LIMIT 0,1";
			$resultPrimeiroNoticia = $conn->query($sqlPrimeiroNoticia);
			$dadosPrimeiroNoticia = $resultPrimeiroNoticia->fetch_assoc();

			$sqlImagem = "SELECT * FROM noticiasImagens WHERE codNoticia = ".$dadosPrimeiroNoticia['codNoticia']." ORDER BY capaNoticiaImagem ASC, codNoticiaImagem ASC LIMIT 0,1";
			$resultImagem = $conn->query($sqlImagem);
			$dadosImagem = $resultImagem->fetch_assoc();

?>
		
		<meta property="og:title" content="<?php echo $dadosPrimeiroNoticia['nomeNoticia'];?> | <?php echo $nomeEmpresa;?>"/>
		<meta property="og:description" content="<?php echo $description;?>"/>
		<meta property="og:image" content="<?php echo $configUrlGer.'f/noticias/'.$dadosImagem['codNoticia'].'-'.$dadosImagem['codNoticiaImagem'].'-M.'.$dadosImagem['extNoticiaImagem'];?>" />				
		<meta property="og:url" content="<?php echo $configUrl.$arquivoRetornar;?>"/>
		<link href="<?php echo $configUrlGer.'f/noticias/'.$dadosImagem['codNoticia'].'-'.$dadosImagem['codNoticiaImagem'].'-M.'.$dadosImagem['extNoticiaImagem'];?>" rel="image_src" />

<?php					
		}
	}		

	$dominio = "http://".$_SERVER['SERVER_NAME']."/litoral-imoveis/";
?>	
		<style type="text/css">
			* {font-family: 'Poppins', sans-serif;}
		</style>
<?php
	$tagsHead = str_replace("&#39;", "'", $tagsHead);
	echo html_entity_decode($tagsHead);
?>		
	</head>
<?php
	if(isset($_COOKIE['politica'.$cookie]) == ""){
		$load = "onLoad='fadeInPolitica();'";
	}
?>	
	<body <?php echo $load;?>>
<?php
	$tagsBody = str_replace("&#39;", "'", $tagsBody);
	echo html_entity_decode($tagsBody);
?>

		<div id="tudo">

			<div id="topo" >
<?php
	 	$celularWhats = str_replace("(", "", $celular);
		$celularWhats = str_replace(")", "", $celularWhats);
		$celularWhats = str_replace(" ", "", $celularWhats);
		$celularWhats = str_replace("-", "", $celularWhats);
		$whatsAppCelular = $currentWhatsApp;
		$whatsAppNumero = $currentWhatsAppNumero;

		$whatsAppMsg = "Olá, vim através do site e gostaria de solicitar um contato!";
		$whatsAppRetornar = $configUrl.$arquivoRetornar;	

	include('capa/topo.php');
?>
			</div>	
			<div id="conteudo">
<?php 
	include($arquivo);
?>
			</div>
			<div id="rodape" >
<?php 
	include('capa/rodape.php');
?>
			</div>	
			<script type="text/javascript" src="<?php echo $configUrl;?>f/j/js/wow.min.js"></script>	
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>		
			<script>
				document.addEventListener('DOMContentLoaded', () => {

					function scanFavoritesInDOM() {
						document.querySelectorAll('.favoritos').forEach(el => {
							const cod = el.dataset.imovel;
							if (getCookie('favorito_' + cod) === '1') {
								marcarTodos(cod);
							}
						});
					}
					scanFavoritesInDOM();
					document.addEventListener('click', (ev) => {
						const fav = ev.target.closest('.favoritos');
						if (!fav) return;
						ev.preventDefault();

						const cod = fav.dataset.imovel;
						const nome = 'favorito_' + cod;

						if (fav.classList.contains('ativo')) {
							desmarcarTodos(cod);
							deleteCookie(nome);
						} else {
							marcarTodos(cod);
							setCookie(nome, '1', 30);
						}
					});
					const observer = new MutationObserver(mutations => {
						let found = false;
						for (const m of mutations) {
							if (m.addedNodes && m.addedNodes.length) {
								m.addedNodes.forEach(node => {
									if (node.nodeType === 1) {
										if (node.matches && node.matches('.favoritos')) found = true;
										if (node.querySelector && node.querySelector('.favoritos')) found = true;
									}
								});
							}
						}
						if (found) scanFavoritesInDOM();
					});
					observer.observe(document.body, { childList: true, subtree: true });

					function marcarTodos(cod){
						document.querySelectorAll(`.favoritos[data-imovel="${cod}"]`).forEach(el => {
							el.classList.add('ativo');
							if (el.dataset.cor) el.style.setProperty('--cor-fav', el.dataset.cor);
						});
					}
					function desmarcarTodos(cod){
						document.querySelectorAll(`.favoritos[data-imovel="${cod}"]`).forEach(el => {
							el.classList.remove('ativo');
							el.style.removeProperty('--cor-fav');
						});
					}

					function setCookie(nome, valor, dias){
						const d = new Date();
						d.setTime(d.getTime() + dias * 24 * 60 * 60 * 1000);
						document.cookie = `${nome}=${valor};expires=${d.toUTCString()};path=/`;
					}

					function deleteCookie(nome){
						document.cookie = `${nome}=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/`;
					}

					function getCookie(nome){
						const match = document.cookie.split('; ').find(row => row.startsWith(nome + '='));
						return match ? match.split('=')[1] : null;
					}
				});
			</script>			
		</div>
	</body>
</html>
<?php
	$conn->close();
?>
