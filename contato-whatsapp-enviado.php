<?php
	if(isset($_GET['numero'])){
		$numero = $_GET['numero'];
	}
	
	if(isset($_GET['msg'])){
		$msg = "&text=".$_GET['msg'];
	}
	
	if(isset($_GET['retornar'])){
		$retornar = $_GET['retornar'];
	}
?>
				<!-- Event snippet for Contato Whatsapp conversion page -->
				<script>
				  gtag('event', 'conversion', {'send_to': 'AW-699132300/zBvFCJnS0NoYEIzTr80C'});
				</script>
<?php	
	if($quebraUrl3[0] != "?gtm_debug"){
?>
				<script type="text/javascript">
					setTimeout(function() {
						location.href = "https://api.whatsapp.com/send?1=pt_BR&phone=55<?php echo $numero;?><?php echo $msg;?>";				
					}, 3000);
				</script>	
<?php
	}
?>				
<style>
	.loading {width:80px; height:80px; top:50%; left:50%; transform:translate(-50% -50%);}
</style> 
<div id="conteudo-interno">
	<div class="loading-bloco">
		<div class="loader">
		  <div class="dot"></div>
		  <div class="dot"></div>
		  <div class="dot"></div>
		</div>
	</div>	

<style>
	.loading-bloco {position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);}
  .loader {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 5px;
  }

  .dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: #FF6801;
    animation: bounce 1.2s infinite ease-in-out;
  }

  .dot:nth-child(1) {
    animation-delay: -0.4s;
  }

  .dot:nth-child(2) {
    animation-delay: -0.2s;
  }

  .dot:nth-child(3) {
    animation-delay: 0s;
  }

  @keyframes bounce {
    0%, 100% {
      transform: translateY(0);
    }
    50% {
      transform: translateY(-15px);
    }
  }
</style>
</div>
