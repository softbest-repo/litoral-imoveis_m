						<div id="conteudo-interno">
							
							<div id="bloco-titulo">	
								<p class="titulo noticias">Novidades</p>
								<a  id="botao-topo" href="<?php echo $configUrl.'novidades/' ?>">Voltar</a>
							</div>
<?php
	$quebraUrl = explode("-", $url[3]);
	
	$sqlNoticia = "SELECT * FROM noticias WHERE statusNoticia = 'T' and codNoticia = '".$quebraUrl[0]."' LIMIT 0,1";
	$resultNoticia = $conn->query($sqlNoticia);
	$dadosNoticia = $resultNoticia->fetch_assoc();

	$sqlImagem = "SELECT * FROM noticiasImagens WHERE codNoticia = ".$dadosNoticia['codNoticia']." ORDER BY capaNoticiaImagem ASC, codNoticiaImagem ASC LIMIT 0,1";
	$resultImagem = $conn->query($sqlImagem);
	$dadosImagem = $resultImagem->fetch_assoc();
?>
							<div id="conteudo-noticias-detalhes"  class="wow animate__animated animate__fadeIn">
								<div id="mostra-detalhes">
									<div id="imagem-detalhes">
										<p class="imagem-noticias"><a rel="lightbox[roadtrip]" title="<?php echo $dadosNoticia['nomeNoticia'];?>" href="<?php echo $configUrlGer.'f/noticias/'.$dadosImagem['codNoticia'].'-'.$dadosImagem['codNoticiaImagem'].'-O.'.$dadosImagem['extNoticiaImagem'];?>"><img style="display:block;" src="<?php echo $configUrlGer.'f/noticias/'.$dadosImagem['codNoticia'].'-'.$dadosImagem['codNoticiaImagem'].'-O.'.$dadosImagem['extNoticiaImagem'];?>" width="100%"/></a></p>															
									</div>
									<div id="dados-detalhes">
										<p class="nome-noticias"><?php echo $dadosNoticia['nomeNoticia'];?></p>
										<div class="descricao-noticias"><?php echo $dadosNoticia['descricaoNoticia'];?></div>
										<p class="fonte-noticias"><?php echo $dadosNoticia['fonteNoticia'];?></p>
									</div>
									<br class="clear"/>
								</div>
<?php
	$sqlConta1 = "SELECT * FROM noticiasImagens WHERE codNoticia = '".$dadosNoticia['codNoticia']."' and codNoticiaImagem != ".$dadosImagem['codNoticiaImagem'];
	$resultConta1 = $conn->query($sqlConta1);
	$dadosConta1 = $resultConta1->fetch_assoc();
	$registros1 = mysqli_num_rows($resultConta1);
	if($registros1 > 0){
?>
								<div id="outras">
									<div id="bloco-titulo" style="padding-top:0px">	
										<p class="titulo noticias" style="font-size: 24px; margin-bottom:20px">Mais Imagens</p>
									</div>
<?php								
		$contO = 0;
		$sqlImagens = "SELECT * FROM noticiasImagens WHERE codNoticia = '".$dadosNoticia['codNoticia']."' and codNoticiaImagem != '".$dadosImagem['codNoticiaImagem']."' ORDER BY capaNoticiaImagem ASC, codNoticiaImagem ASC";
		$resultImagens = $conn->query($sqlImagens);
		while($dadosImagens = $resultImagens->fetch_assoc()){				

			$contO++;

			if($contO == 4){
				$contO = 0; 
				$margin = "margin-right:0px;";
			}else{
				$margin = "";
			}
?>		
									<p class="imagem-outras" style="<?php echo $margin;?>"><a rel="lightbox[roadtrip]" title="<?php echo $dadosNoticia['nomeNoticia'];?>" href="<?php echo $configUrlGer.'f/noticias/'.$dadosImagens['codNoticia'].'-'.$dadosImagens['codNoticiaImagem'].'-O.'.$dadosImagens['extNoticiaImagem'];?>" style="display:block; background:transparent url('<?php echo $configUrlGer.'f/noticias/'.$dadosImagens['codNoticia'].'-'.$dadosImagens['codNoticiaImagem'].'-O.'.$dadosImagens['extNoticiaImagem'];?>') center center no-repeat; background-size:cover, 100%;"></a></p>
<?php
		}
?>
									<br class="clear"/>
								</div>
<?php
	}
?>
								
							</div>
							<div style="display: flex; justify-content: center;"> <a  id="botao-baixo" href="<?php echo $configUrl.'novidades/' ?>">Voltar</a> </div>

						</div>
