<?php
	  $sqlEmpresa = "SELECT * FROM empresa LIMIT 0,1";
	$resultEmpresa = $conn->query($sqlEmpresa);
	$dadosEmpresa = $resultEmpresa->fetch_assoc();
	
	$sqlImagemP = "SELECT * FROM empresaImagens WHERE capaEmpresaImagem = 'T' AND codEmpresa =  ".$dadosEmpresa['codEmpresa']." ORDER BY codEmpresaImagem ASC LIMIT 1;";
	$resultImagemP = $conn->query($sqlImagemP);
	$dadosImagemP = $resultImagemP->fetch_assoc();
	
	$sqlImagemS = "SELECT * FROM empresaImagens WHERE codEmpresa = ".$dadosEmpresa['codEmpresa']." ORDER BY capaEmpresaImagem ASC, codEmpresaImagem ASC LIMIT 1,1";
	
	$resultImagemS = $conn->query($sqlImagemS);
	$dadosImagemS = $resultImagemS->fetch_assoc();
?>	
					<div id="conteudo-interno">
						<div id="bloco-titulo">
							<p class="titulo">Sobre</p>
						</div>	
						<div id="conteudo-empresa">
<?php
	if($dadosImagemP['codEmpresaImagem'] != ""){
?>
							<p class="imagem-empresa wow animate__animated animate__fadeIn"><a title="<?php echo $nomeEmpresaMenor; ?>" rel="lightbox[roadtrip]" href="<?php echo $configUrlGer.'f/empresa/'.$dadosImagemP['codEmpresa'].'-'.$dadosImagemP['codEmpresaImagem'].'-O.'.$dadosImagemP['extEmpresaImagem']?>"><img style="width:400px; display:block; "src="<?php echo $configUrlGer.'f/empresa/'.$dadosImagemP['codEmpresa'].'-'.$dadosImagemP['codEmpresaImagem'].'-O.'.$dadosImagemP['extEmpresaImagem'];?>" alt=""></a></p>
<?php
	}
?>
							<div class="descricao"><?php echo $dadosEmpresa['descricaoEmpresa'];?></div>
						
								<br class="clear"/>
<?php
	$cont = 0;
	
	$sqlImagemConta = "SELECT count(codEmpresa) total FROM empresaImagens WHERE codEmpresa = ".$dadosEmpresa['codEmpresa']." and codEmpresaImagem != ".$dadosImagemP['codEmpresaImagem']."";
	$resultImagemConta = $conn->query($sqlImagemConta);
	$dadosImagemConta = $resultImagemConta->fetch_assoc();
	
	if($dadosImagemConta['total'] = 2){
?>
							<div id="mais-imagens">
<?php
		$sqlImagem = "SELECT * FROM empresaImagens WHERE codEmpresa = ".$dadosEmpresa['codEmpresa']." and codEmpresaImagem != ".$dadosImagemP['codEmpresaImagem']." ORDER BY  codEmpresaImagem ASC";
		$resultImagem = $conn->query($sqlImagem);
		while($dadosImagems = $resultImagem->fetch_assoc()){
			$cont++;
			
		
?>								
								<p class="imagem" style="<?php echo $margin;?>"><a rel="lightbox[roadtrip]" href="<?php echo $configUrlGer.'f/empresa/'.$dadosImagems['codEmpresa'].'-'.$dadosImagems['codEmpresaImagem'].'-O.'.$dadosImagems['extEmpresaImagem'];?>" style="width:100%; height:180px; display:block; background:transparent url('<?php echo $configUrlGer.'f/empresa/'.$dadosImagems['codEmpresa'].'-'.$dadosImagems['codEmpresaImagem'].'-O.'.$dadosImagems['extEmpresaImagem']?>') center center no-repeat; background-size:cover, 100%; border-radius: 10px;"></a></p>
<?php
		}
?>
								<br class="clear"/>
							</div>
<?php
	}
?>
						</div>
						
					</div>
