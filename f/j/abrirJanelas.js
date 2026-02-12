function abrirRadio(url){
	window.open(url, "Radio", "width=473, height=213, scrollbars=no, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no");
}

function abrirARTV(url){
	window.open(url, "ARTV", "width=450, height=400");
}

function abrirJogoAoVivo(url){
	window.open(url, "Jogos", "width=620, height=880, top=0, left=350, scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no");
}

function abrirDadosMusica(id){
	var i = 1;
	var nome = "musica"; 
	for(i=1; i<=10; i++){
		if(nome+i == id && document.getElementById(id).style.display == 'none'){
		  document.getElementById(id).style.display = 'block';
		}else
			if(nome+i == id && document.getElementById(id).style.display == 'block'){
				document.getElementById(id).style.display = 'none';
			}else{
			  document.getElementById(nome+i).style.display = 'none';
			}
	}
}	

