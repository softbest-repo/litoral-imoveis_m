<?php
	$msg = "";
    $display = "display:none;";
	if(isset($_POST['nome'])){

		$nome       = $conn->real_escape_string($_POST['nome']);
		$telefone   = $conn->real_escape_string($_POST['telefone']);
		$creci      = $conn->real_escape_string($_POST['creci']);
		$descricao  = $conn->real_escape_string($_POST['descricao']);

		$sqlInsert = " INSERT INTO trabalhe  (nomeTrabalhe, numeroTrabalhe, creciTrabalhe, descricaoTrabalhe, statusTrabalhe, urlTrabalhe) VALUES ('$nome', '$telefone', '$creci', '$descricao', 'T', '')";
		if($conn->query($sqlInsert)){
			$codTrabalhe = $conn->insert_id;

			if(isset($_FILES['curriculo']) && $_FILES['curriculo']['error'] == 0){

				$permitidos = ['pdf','doc','docx'];
				$nomeArquivo = $_FILES['curriculo']['name'];
				$extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));

				if(in_array($extensao, $permitidos)){

					$pasta = "ger/f/trabalhe/";

					if(!is_dir($pasta)){
						mkdir($pasta, 0755, true);
					}

					$sqlImagem = " INSERT INTO trabalheimagens (codTrabalhe, capaTrabalheImagem, extTrabalheImagem) VALUES ('$codTrabalhe', 'T', '$extensao')";

					if($conn->query($sqlImagem)){

						$codTrabalheImagem = $conn->insert_id;
						$nomeFinal = $codTrabalhe . "-" . $codTrabalheImagem . "-O." . $extensao;
						move_uploaded_file($_FILES['curriculo']['tmp_name'], $pasta.$nomeFinal);
					}
				}
			}
			
			$msg = "Cadastro enviado com sucesso!";
			$display = "display:block;";
		}else{
			echo "<script>alert('Erro ao enviar cadastro.');</script>";
		}
	}
	if($msg != ""){
?>
				<script>
					document.addEventListener("DOMContentLoaded", function(){
						var msg = document.getElementById("msg");

						if(msg && msg.style.display === "block"){
							setTimeout(function(){
								msg.classList.add("fade-out");

								setTimeout(function(){
									msg.style.display = "none";
								}, 500);
							}, 2000);
						}
					});
				</script>
				<style> #msg{opacity: 1; transition: opacity 0.5s ease;} #msg.fade-out{opacity: 0;}</style>
<?php
	}
?>

				<div id="conteudo-interno" style="position: relative;">				
						<div id="bloco-titulo">
							<p class="titulo trabalhe">Trabalhe Conosco</p>							
						</div>
						<div id="sub">*Preencha o formulário abaixo e nossa equipe entrará em contato com você!</div>
						<div id="conteudo-trabalhe"class="wow animate__animated animate__fadeIn">
							<form id="form-trabalhe" method="post" action="" enctype="multipart/form-data">			
								<div class="campo">
									<label>Nome completo</label>
									<input type="text" name="nome" required>
								</div>

								<div class="campo">
									<label>Número de telefone</label>
									<input type="tel" name="telefone" required onKeyDown="Mascara(this,novoTelefone);" onKeyPress="Mascara(this,novoTelefone);" onKeyUp="Mascara(this,novoTelefone);" >
								</div>

								<div class="campo">
									<label>CRECI <span>(opcional)</span></label>
									<input type="text" name="creci">
								</div>

								<div class="campo">
									<label>Descrição <span>(máx. 300 caracteres)</span></label>
									<textarea name="descricao" maxlength="300"></textarea>
									<div class="contador">0 / 300</div>
								</div>
								<div class="campo">
									<label>Anexar currículo <span>(PDF ou DOC - máx 5MB)</span></label>
									<input type="file" name="curriculo" id="curriculo" accept=".pdf,.doc,.docx">
								</div>
								<div class="campo">
									<button type="submit">Enviar Cadastro</button>
								</div>
							</form>
						</div>
						<div id="msg" style="<?php echo $display?> position: absolute; bottom: 20px; right: 50%; transform: translateX(50%); background: #01b24a; padding: 5px 20px; border-radius: 5px; color: white; width: 227px; "><?php echo $msg ?></div> 
					</div>
					<script>
						const textarea = document.querySelector('textarea[name="descricao"]');
						const contador = document.querySelector('.contador');
						const max = 300;

						contador.innerText = max + " caracteres restantes";

						textarea.addEventListener('input', function(){
							let restante = max - this.value.length;
							contador.innerText = restante + " caracteres restantes";
						});
					</script>
