<div id="conteudo-interno">
	<div id="repete-loteamentos">
			<div id="conteudo-loteamentos">
				<div id="bloco-titulo">
					<p class="titulo">Loteamentos</p>
				</div>

				<div id="bloco-imagem">
<?php	
		$cont2 = 0;
		$sqlLoteamentos = " SELECT * FROM loteamentos WHERE statusLoteamento = 'T'  ORDER BY rand() LIMIT 10 ";
		$resultLoteamentos = $conn->query($sqlLoteamentos);
		while($dadosLoteamentos = $resultLoteamentos->fetch_assoc()){
			$cont2 ++;
			$sqlImagem = "SELECT * FROM loteamentosImagens  WHERE codLoteamento = ".$dadosLoteamentos['codLoteamento']." AND tipoLoteamentoImagem = 'T' LIMIT 1";
			$resultImagem = $conn->query($sqlImagem);
			$dadosImagem = $resultImagem->fetch_assoc();


			$sqlCidade = "SELECT * FROM cidades  WHERE codCidade = ".$dadosLoteamentos['codCidade']."  LIMIT 1";
			$resultCidade = $conn->query($sqlCidade);
			$dadosCidade = $resultCidade->fetch_assoc();

?>
										<div id="bloco-loteamentos">
											<a title="Pesquiser pelo loteamento <?php echo $dadosLoteamentos['nomeLoteamento']; ?>" href="<?php echo $configUrl . "loteamentos/" . $dadosImagem['codLoteamento'] . "-" . $dadosLoteamentos['urlLoteamento'] . "/"; ?>">
												<div id="mostra-imagem">
													<div id="imagem" style=" background:transparent url('<?php echo $configUrlGer.'f/loteamentos/'.$dadosImagem['codLoteamento'].'-'.$dadosImagem['codLoteamentoImagem'].'-O.'.$dadosImagem['extLoteamentoImagem']; ?>') center center no-repeat; background-size: cover;"></div>
												</div>
												<div id="info">
	 												<p id="nome"><?php echo $dadosLoteamentos['nomeLoteamento']; ?></p>
													<div style="display: flex; justify-content: center;">
														<p id="cidade"><?php echo $dadosCidade['nomeCidade']; ?>, <?php echo $dadosCidade['estadoCidade']; ?></p>
													</div>
													<div id="ver" style="display: flex; justify-content: center;"><p>Ver mais</p></div>
												</div>
											</a>
										</div>
<?php
		}
?>
			</div>
<?php
			if($cont2 == 0){
?>							
							<p class="embreve" style="font-size: 16px; font-weight: bold; text-align: center; color: #4f7649; padding-top: 159px;">Em Breve</p>
<?php
	}
?>		
				</div>
		</div>
	</div>