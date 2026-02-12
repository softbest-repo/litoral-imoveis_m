<?php
ini_set('display_errors', '0');
error_reporting(E_ALL | E_STRICT);

include ('f/conf/config.php');

$codCidade = $_GET['codCidade'];

$codCidade = str_replace("N-", "", $codCidade);
?>
<p class="bairro campo-select">
	<select class="select2 form-control campo" id="idSelect2" name="bairro[]" multiple="" style="width:170px; display: none;">
		<optgroup label="Selecione os bairros">

<?php
		$sql = "SELECT B.*, I.* FROM bairros B inner join imoveis I on B.codBairro = I.codBairro WHERE B.codCidade = '".$codCidade."' GROUP BY B.codBairro ORDER BY B.nomeBairro ASC";
		$result = $conn->query($sql);
		while($dadosBairro = $result->fetch_assoc()){	
?>
			<option value="<?php echo $dadosBairro['codBairro'];?>" <?php echo $_SESSION['bairro'] == $dadosBairro['codBairro'] ? '/SELECTED/' : '';?>><?php echo $dadosBairro['nomeBairro'];?></option>	
<?php
		}
?>
	</select>
</p>
<script>
	var $rf = jQuery.noConflict();
	$rf(".select2").select2({
		placeholder: "Bairros",
		multiple: true,
		allowClear: true						
	});				
</script>