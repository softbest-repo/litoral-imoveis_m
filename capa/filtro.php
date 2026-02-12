<div id="conteudo-filtro">								
<?php
	if($_POST['busca'] != ""){
		$busca = $_POST['busca'];
		
		$_SESSION['busca'] = str_replace("'", "&#39;", $busca);
		$_SESSION['pedacos'] = explode(" ", $_SESSION['busca']);
		$_SESSION['numero'] = count($_SESSION['pedacos']);
		
		$order = explode(" ", $_SESSION['busca']);
		
		$_SESSION['cidade-busca'] = "";		
		$_SESSION['bairro-filtro'] = "";
		$_SESSION['bairro-busca'] = "";
		$_SESSION['tipoImovel'] = "";
		$_SESSION['imovel-busca'] = "";
		$_SESSION['rangeLeft'] = "";
		$_SESSION['rangeRight'] = "";
		$_SESSION['minBar'] = 0;
		$_SESSION['maxBar'] = 1000000;
		$_SESSION['min'] = "0";
		$_SESSION['max'] = "1.000.000,00";
		$_SESSION['ordenar'] = "";
	}else{
		$_SESSION['busca'] = "";
		$_SESSION['numero'] = "";
		$_SESSION['pedacos'] = "";
		
		if(isset($_POST['cidade-busca'])){
			if($_POST['cidade-busca'] == ""){
				$_SESSION['cidade-busca'] = "";
			}else{
				$_SESSION['cidade-busca'] = $_POST['cidade-busca'];
			}
		}
				
		if($_SESSION['cidade-busca'] != ""){
			$filtraCidade = " and I.codCidade = '".$_SESSION['cidade-busca']."'";
		}
					
		if(isset($_POST["cidade-busca"]) || isset($_POST["bairro"])){
			if($_POST["bairro"] != ""){
				$optionArray = $_POST["bairro"];
				for($i = 0; $i < count($optionArray); $i++){								
					if($i == 0){
						$filtraBairro .= " and (I.codBairro = ".$optionArray[$i]."";
					}else{
						$filtraBairro .= " or I.codBairro = ".$optionArray[$i]."";
					}						
				}	

			}	

			if($filtraBairro != ""){
				$filtraBairro .= ")";
				$_SESSION['bairro-filtro'] = $filtraBairro;			
				$_SESSION['bairro-busca'] = $_POST["bairro"];			
			}else{
				$_SESSION['bairro-filtro'] = "";
				$_SESSION['bairro-busca'] = "";
			}
		}
			
		if(isset($_POST['bairro-gaivota'])){
			$_SESSION['bairro-filtro'] = "and (I.codBairro = ".$_POST['bairro-gaivota'].")";
			$_SESSION['bairro-busca'] = array(0 => $_POST['bairro-gaivota']);
		}
				
		if($_SESSION['bairro-filtro'] != ""){
			$filtraBairro = $_SESSION['bairro-filtro'];
		}
			
				
		if(isset($_POST['ordenar'])){
			$_SESSION['ordenar'] = $_POST['ordenar'];
		}

		$ordenar = "";

		if(isset($_SESSION['ordenar']) && $_SESSION['ordenar'] != ""){
			
			if($_SESSION['ordenar'] == "asc"){
				$ordenar = " I.precoImovel ASC, ";
			}else if($_SESSION['ordenar'] == "desc"){
				$ordenar = " I.precoImovel DESC, ";
			}
		}
	}

	if (isset($_POST['codigo']) && $_POST['codigo'] != "") {

		$_SESSION['codigo'] = $_POST['codigo'];
		$filtraCodigo = " AND I.codigoImovel = '" . $_POST['codigo'] . "' ";

	} else {

		$_SESSION['codigo'] = "";
		$filtraCodigo = "";
	}

	if(isset($_POST['minBar'])){
    $_SESSION['minBar'] = $_POST['minBar'] != "" ? $_POST['minBar'] : 0;
	}

	if(isset($_POST['maxBar'])){
		$_SESSION['maxBar'] = $_POST['maxBar'] != "" ? $_POST['maxBar'] : 1000000;
	}

	if(!isset($_SESSION['minBar'])) $_SESSION['minBar'] = 0;
	if(!isset($_SESSION['maxBar'])) $_SESSION['maxBar'] = 1000000;

	$min = (float) $_SESSION['minBar'];
	$max = (float) $_SESSION['maxBar'];

	if($max >= 1000000){
		$filtraPreco = " AND I.precoImovel >= '".$min."'";
	}else{
		$filtraPreco = " AND I.precoImovel BETWEEN '".$min."' AND '".$max."'";
	}

	if(isset($_POST['tipoImovel'])){
		$_SESSION['tipoImovel'] = $_POST['tipoImovel'];
	}

	if(!isset($_SESSION['tipoImovel'])){
		$_SESSION['tipoImovel'] = "";
	}

	$tipoSelecionado = "";
	if($_SESSION['tipoImovel'] != ""){
		$tipoSelecionado = " AND I.codTipoImovel = '".intval($_SESSION['tipoImovel'])."' ";
	}

	if(isset($_SESSION['busca']) != ""){
		$sqlRef = "SELECT I.codImovel FROM imoveis I inner join imoveisImagens II on I.codImovel = I.codImovel WHERE I.statusImovel = 'T' and I.codigoImovel = '".$_SESSION['busca']."' LIMIT 0,1";
		$resultRef = $conn->query($sqlRef);
		$dadosRef = $resultRef->fetch_assoc();
		
		if($dadosRef['codImovel'] != ""){
			$filtraImovel = " and I.codImovel = '".$dadosRef['codImovel']."'";
		}else
		if($_SESSION['numero'] >= 1){
			$filtraImovel = " and I.nomeImovel LIKE '%".$order[0]."%' and I.nomeImovel LIKE '%".$order[1]."%' and I.nomeImovel LIKE '%".$order[2]."%'";
		}else{
			$filtraImovel = "";		
		}		
	}		
?>

								<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
								<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>

								<div id="filtro">
									<div id="bloco-filtro">
										<form action="<?php echo $configUrl;?>imoveis/" method="post">
											<div id="filtra-tipoImovel">
 <?php
			$sqlTipoImovel = "SELECT * FROM tipoimovel WHERE statusTipoImovel = 'T' ORDER BY nomeTipoImovel ASC";
			$resultTipoImovel = $conn->query($sqlTipoImovel);
			while($dadosTipoImovel = $resultTipoImovel->fetch_assoc()){
						
?>
												<p class="tipoImovel tipo-imovel<?php echo $ativo;?>" id="tipo-imovel<?php echo $dadosTipoImovel['codTipoImovel'];?>" onClick="tipoImovel('<?php echo $dadosTipoImovel['codTipoImovel'];?>', <?php echo $dadosTipoImovel['codTipoImovel'];?>);"><?php echo $dadosTipoImovel['nomeTipoImovel'];?></p>
<?php 
			}
?>
												<input type="hidden" value="<?php echo $_SESSION['tipoImovel'];?>" name="tipoImovel" id="tipoImovel"/>
											</div>
											<script type="text/javascript">
												function carregaBairro(codCidade){
													var $B = jQuery.noConflict();
													$B('#carrega-bairro').load("<?php echo $configUrl;?>carrega-bairros.php?codCidade="+codCidade+"");				
												}
												function tipoImovel(codTipo, id){
													var hidden = document.getElementById("tipoImovel");
													var elemento = document.getElementById("tipo-imovel" + id);
													var itens = document.querySelectorAll(".tipoImovel");

													if(hidden.value == codTipo){
														elemento.classList.remove("ativo");
														hidden.value = "";
														return;
													}

													itens.forEach(function(item){
														item.classList.remove("ativo");
													});

													elemento.classList.add("ativo");
													hidden.value = codTipo;
												}
												document.addEventListener('DOMContentLoaded', function(){
													var tipoSelecionado = document.getElementById("tipoImovel").value;
													if(tipoSelecionado){
														var elemento = document.getElementById("tipo-imovel" + tipoSelecionado);
														if(elemento){
															elemento.classList.add("ativo");
														}
													}
												});
											</script>
											<style>.tipoImovel.ativo { background-color: #ff6801 !important; color: white !important;font-weight: bold;}</style>
											<div id="outros-filtros">
												<p class="cidade campo-select">
													<select class="select-cidade" style="width:100%;" name="cidade-busca" onClick="carregaBairro(this.value);" onKeyDown="carregaBairro(this.value);" onKeyPress="carregaBairro(this.value);" onKeyUp="carregaBairro(this.value)">
														<option value="">Cidade</option>	
<?php
		$sql = "SELECT DISTINCT C.* FROM cidades C inner join imoveis I on C.codCidade = I.codCidade WHERE C.statusCidade = 'T' and I.statusImovel = 'T' ORDER BY C.nomeCidade ASC";
		$result = $conn->query($sql);
		while($dadosCidade = $result->fetch_assoc()){			
?>	
														<option value="<?php echo $dadosCidade['codCidade']; ?>" <?php echo $dadosCidade['codCidade'] == $_SESSION['cidade-busca'] ? '/SELECTED/' : ''; ?>><?php echo $dadosCidade['nomeCidade']; ?></option>
<?php																											
		}
?>	
													</select>										
												</p>
												<div id="carrega-bairro">	
<?php
	if($_SESSION['cidade-busca'] != ""){
?>												
													<p class="bairro-busca campo-select">
														<select class="select2 form-control campo" id="idSelect2" name="bairro[]" multiple="" style="width:100%; display: none;" placeholder="Selecione os bairros">
															<optgroup label="Selecione os bairros">
<?php
		$sql = "SELECT DISTINCT B.* FROM bairros B inner join imoveis I on B.codBairro = I.codBairro WHERE B.statusBairro = 'T' and I.statusImovel = 'T' and I.codCidade = ".$_SESSION['cidade-busca']." ORDER BY B.nomeBairro ASC";
		$result = $conn->query($sql);
		while($dadosBairro = $result->fetch_assoc()){	
			
			if($_SESSION['bairro-busca'] != ""){
				$optionArray = $_SESSION['bairro-busca'];

				for($i = 0; $i < count($optionArray); $i++){						
					if($dadosBairro['codBairro'] == $optionArray[$i]){
						$codBairro = $optionArray[$i];
						break;
					}
				}	
			}						
?>
															<option value="<?php echo $dadosBairro['codBairro'];?>" <?php echo $codBairro == $dadosBairro['codBairro'] ? '/SELECTED/' : '';?>><?php echo $dadosBairro['nomeBairro'];?></option>	
<?php
		}
?>
														</select>										
													</p>
<?php
	}else{
?>
													<p class="bairro-busca campo-select">
														<select class="select select2 form-control campo" id="idSelect2" name="bairro[]" multiple="" style="width:100%; display: none;" >
															<optgroup label="Selecione os bairros">

<?php
		$sql = "SELECT DISTINCT B.* FROM bairros B inner join imoveis I on B.codBairro = I.codBairro WHERE B.statusBairro = 'T' and I.statusImovel = 'T' ORDER BY B.nomeBairro ASC";
		$result = $conn->query($sql);
		while($dadosBairro = $result->fetch_assoc()){	

			if($_SESSION['bairro-busca'] != ""){
			
				$optionArray = $_SESSION['bairro-busca'];
						
				for($i = 0; $i < count($optionArray); $i++){						
					if($dadosBairro['codBairro'] == $optionArray[$i]){
						$codBairro = $optionArray[$i];
						break;
					}
				}
			
			}				
?>
															<option value="<?php echo $dadosBairro['codBairro'];?>" <?php echo $codBairro == $dadosBairro['codBairro'] ? '/SELECTED/' : '';?>><?php echo $dadosBairro['nomeBairro'];?></option>	
<?php
		}
?>
														</select>										
													</p>
<?php
	}
?>
												</div>
												<div id="filtrar-ordenar">
													<select name="ordenar" id="ordenar" style="width:100%;">
														<option value="">Ordenar Por</option>
														<option value="asc" <?php if(isset($_SESSION['ordenar']) && $_SESSION['ordenar'] == "asc"){ echo "selected"; } ?>>Menor → Maior</option>
														<option value="desc" <?php if(isset($_SESSION['ordenar']) && $_SESSION['ordenar'] == "desc"){ echo "selected"; } ?>>Maior → Menor</option>
													</select>
												</div>
												<div id="filtrar-codigo">
													<p class="campo-codigo"><input style="width: 100%; outline: none;" type="text" value="<?php echo $_SESSION['codigo'];?>" name="codigo" placeholder="Código..."/></p>
												</div>
												<div style="display: flex; align-items: center; padding: 20px 15px; justify-content: center;">
													<link rel="stylesheet" href="<?php echo $configUrl;?>f/c/style.css">								
													<div class="range" style=" position: relative; top: 5px;">
														<div class="range-input">
															<input type="range" class="min" min="0" name="minBar" max="1000000" value="<?php echo $_SESSION['minBar'];?>" step="10000">
															<input type="range" class="max" min="0" name="maxBar" max="1000000" value="<?php echo $_SESSION['maxBar'];?>" step="10000">
														</div>
														<div class="range-slider">
															<span class="range-selected" style="<?php echo $_SESSION['rangeLeft'];?> <?php echo $_SESSION['rangeRight'];?>"></span>
															<input type="hidden" id="rangeLeft" name="rangeLeft" value="<?php echo $_SESSION['rangeLeft'];?>"/>
															<input type="hidden" id="rangeRight" name="rangeRight" value="<?php echo $_SESSION['rangeRight'];?>"/>
														</div>
														<div class="range-price">      
															<span style="color :white; font-weight: 300; font-size: 13px;">de R$ <input style=" font-weight: 300; font-size: 13px;" class="campo" type="text" readonly name="min" value="<?php echo $_SESSION['min'];?>">   </span>   
															<span style="color :white ; font-weight: 300; font-size: 13px;">a R$ <input style=" font-weight: 300; font-size: 13px;" class="campo" type="text" readonly name="max" value="<?php echo $_SESSION['max'];?>"> </span>
														</div>
													</div>  
													<script type="text/javascript">
														function limpaPreco(){
															document.getElementById("limpaPrice").value="S";
															document.getElementById("alteraFiltro").submit();
														}								
													</script>
													<script src="<?php echo $configUrl;?>f/j/js/script.js"></script>
												</div>																																															

												<p class="botao-buscar"><input type="submit" class="submit-buscar" value="Buscar" name="buscar"/></p>
											</div>
										</form>
									</div>
								</div>															
							</div>
							<script>
								var $rf = jQuery.noConflict();
								$rf(".select2").select2({
									placeholder: "Bairros",
									multiple: true,
									allowClear: true						
								});				
							</script>
							<script>
								var $rf = jQuery.noConflict();
								$rf(".select-cidade").select2({
									placeholder: "Cidade",
									allowClear: true
								});
							</script>