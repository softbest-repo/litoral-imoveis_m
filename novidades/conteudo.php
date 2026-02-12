						<div id="conteudo-interno">
							<div id="bloco-titulo">	
								<p class="titulo">Novidades</p>
							</div>
							<div id="conteudo-noticias"  class="wow animate__animated animate__fadeIn">
<?php
	$sqlConta = "SELECT count(codNoticia) registros FROM noticias WHERE statusNoticia = 'T'";
	$resultConta = $conn->query($sqlConta);
	$dadosConta = $resultConta->fetch_assoc();
	$registros = $dadosConta['registros'];
	
	if($url[3] == 1 || $url[3] == ""){
		$pagina = 1;
		$sqlNoticia = "SELECT * FROM noticias WHERE statusNoticia = 'T' ORDER BY dataNoticia DESC, codNoticia DESC LIMIT 0,12";
	}else{
		$pagina = $url[3];
		$paginaFinal = $pagina * 12;
		$paginaInicial = $paginaFinal - 12;
		$sqlNoticia = "SELECT * FROM noticias WHERE statusNoticia = 'T' ORDER BY dataNoticia DESC, codNoticia DESC LIMIT ".$paginaInicial.",12";
	}

		$cont = 0;
		$resultNoticia = $conn->query($sqlNoticia);
		while($dadosNoticia = $resultNoticia->fetch_assoc()){
					
			$sqlImagem = "SELECT * FROM noticiasImagens WHERE codNoticia = ".$dadosNoticia['codNoticia']." ORDER BY capaNoticiaImagem ASC, codNoticiaImagem ASC LIMIT 0,1";
			$resultImagem = $conn->query($sqlImagem);
			$dadosImagem = $resultImagem->fetch_assoc();
			
			if($dadosImagem['codNoticia'] != ""){

				$mostrando = $mostrando + 1;

?>
								<div id="bloco-noticia" style="<?php echo $margin;?>">
									<div class="imagem-noticia"><a title="<?php echo $dadosNoticia['nomeNoticia'];?>" href="<?php echo $configUrl.'novidades/'.$dadosNoticia['codNoticia'].'-'.$dadosNoticia['urlNoticia'].'/';?>" style=" height:208px; display:block; background:transparent url('<?php echo $configUrlGer.'f/noticias/'.$dadosImagem['codNoticia'].'-'.$dadosImagem['codNoticiaImagem'].'-M.'.$dadosImagem['extNoticiaImagem'];?>') center center no-repeat; background-size:cover; border-radius:10px;"></a></div>
									<div class="nome-res">
										<p class="nome-noticia"><a title="<?php echo $dadosNoticia['nomeNoticia'];?>" href="<?php echo $configUrl.'novidades/'.$dadosNoticia['codNoticia'].'-'.$dadosNoticia['urlNoticia'].'/';?>"><?php echo $dadosNoticia['nomeNoticia'];?></a></p>
										<div class="resumo-noticia"><?php echo $dadosNoticia['descricaoNoticia']?></div>
										<p class="leia-mais"><a href="<?php echo $configUrl.'novidades/'.$dadosNoticia['codNoticia'].'-'.$dadosNoticia['urlNoticia'].'/';?>">Leia mais</a></p>
									</div>
									<br class="clear"/>
								</div>

<?php
			}
		}
?>		
							</div>
<?php
	$regPorPagina = 12;
	$area = "novidades";
	include ('f/conf/paginacao.php');
?>	
						<br class="clear"/>
						</div>
