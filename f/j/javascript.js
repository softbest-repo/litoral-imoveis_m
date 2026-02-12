function soNumeros(v){
    return v.replace(/\D/g,"")
}

function telefone(v){
    v=v.replace(/\D/g,"")                 //Remove tudo o que não é dígito
    v=v.replace(/^(\d\d)(\d)/g,"($1) $2") //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d{4})(\d)/,"$1-$2")    //Coloca hífen entre o quarto e o quinto dígitos
    return v
}

function cpf(v){
    v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
                                             //de novo (para o segundo bloco de números)
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
    return v
}

function cep(v){
    v=v.replace(/D/g,"")                //Remove tudo o que não é dígito
    v=v.replace(/^(\d{5})(\d)/,"$1-$2") //Esse é tão fácil que não merece explicações
    return v
}

function cnpj(v){
    v=v.replace(/\D/g,"")                           //Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d)/,"$1.$2")             //Coloca ponto entre o segundo e o terceiro dígitos
    v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3") //Coloca ponto entre o quinto e o sexto dígitos
    v=v.replace(/\.(\d{3})(\d)/,".$1/$2")           //Coloca uma barra entre o oitavo e o nono dígitos
    v=v.replace(/(\d{4})(\d)/,"$1-$2")              //Coloca um hífen depois do bloco de quatro dígitos
    return v
}

function romanos(v){
    v=v.toUpperCase()             //Maiúsculas
    v=v.replace(/[^IVXLCDM]/g,"") //Remove tudo o que não for I, V, X, L, C, D ou M
    //Essa é complicada! Copiei daqui: http://www.diveintopython.org/refactoring/refactoring.html
    while(v.replace(/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/,"")!="")
        v=v.replace(/.$/,"")
    return v
}

function site(v){
    //Esse sem comentarios para que você entenda sozinho ;-)
    v=v.replace(/^http:\/\/?/,"")
    dominio=v
    caminho=""
    if(v.indexOf("/")>-1)
        dominio=v.split("/")[0]
        caminho=v.replace(/[^\/]*/,"")
    dominio=dominio.replace(/[^\w\.\+-:@]/g,"")
    caminho=caminho.replace(/[^\w\d\+-@:\?&=%\(\)\.]/g,"")
    caminho=caminho.replace(/([\?&])=/,"$1")
    if(caminho!="")dominio=dominio.replace(/\.+$/,"")
    v="http://"+dominio+caminho
    return v
}

/*consistencia se o valor do CPF e um valor valido
seguindo os criterios da Receita Federal do territorio nacional*/
function consistenciaCPF(campo) {
		
	  cpf = campo.replace(/\./g, '').replace(/\-/g, '');
      erro = new String;
      if (cpf.length < 11) erro += "Sao necessarios 11 digitos para verificacao do CPF! \n\n";
      var nonNumbers = /\D/;
      if (cpf == "00000000000" || cpf == "11111111111"
           || cpf == "22222222222" || cpf == "33333333333"
           || cpf == "44444444444" || cpf == "55555555555"
           || cpf == "66666666666" || cpf == "77777777777"
           || cpf == "88888888888" || cpf == "99999999999"){
              erro += "Numero de CPF invalido!"
     }
     var a = [];
     var b = new Number;
     var c = 11;
     for (i=0; i<11; i++){
             a[i] = cpf.charAt(i);
             if (i < 9) b += (a[i] * --c);
     }
     if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }
     b = 0;
     c = 11;
     for (y=0; y<10; y++) b += (a[y] * c--);
     if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }
     if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10])){
             erro +="Digito verificador com problema!";
     }
     if (erro.length > 0){
        document.getElementById("validaCpf").style.border="1px solid red";
        document.getElementById("erroCpf").style.display="inline";
        document.getElementById("confereCpf").value="falso";
        return true;
     }else{
        document.getElementById("validaCpf").style.border="1px solid #626460";		 
		document.getElementById("erroCpf").style.display="none";
        document.getElementById("confereCpf").value="verdadeiro";
	 }
     return false;
}


        function validaCNPJ(campo) {
                CNPJ = campo;
                erro = new String;
                if (CNPJ.length < 18) erro += "É necessario preencher corretamente o número do CNPJ! "; 
                if ((CNPJ.charAt(2) != ".") || (CNPJ.charAt(6) != ".") || (CNPJ.charAt(10) != "/") || (CNPJ.charAt(15) != "-")){
                if (erro.length == 0) erro += "É necessário preencher corretamente o número do CNPJ! ";
                 }
               //substituir os caracteres que não são números
               if(document.layers && parseInt(navigator.appVersion) == 4){
                       x = CNPJ.substring(0,2);
                       x += CNPJ. substring (3,6);
                       x += CNPJ. substring (7,10);
                       x += CNPJ. substring (11,15);
                       x += CNPJ. substring (16,18);
                       CNPJ = x; 
               } else {
                       CNPJ = CNPJ. replace (".","");
                       CNPJ = CNPJ. replace (".","");
                       CNPJ = CNPJ. replace ("-","");
                       CNPJ = CNPJ. replace ("/","");
               }
               var nonNumbers = /\D/;
               if (nonNumbers.test(CNPJ)) erro += "A verificação de CNPJ suporta apenas números! "; 
               var a = [];
               var b = new Number;
               var c = [6,5,4,3,2,9,8,7,6,5,4,3,2];
               for (i=0; i<12; i++){
                       a[i] = CNPJ.charAt(i);
                       b += a[i] * c[i+1];
 }
               if ((x = b % 11) < 2) { a[12] = 0 } else { a[12] = 11-x }
               b = 0;
               for (y=0; y<13; y++) {
                       b += (a[y] * c[y]); 
               }
               if ((x = b % 11) < 2) { a[13] = 0; } else { a[13] = 11-x; }
               if ((CNPJ.charAt(12) != a[12]) || (CNPJ.charAt(13) != a[13])){
                       erro +="Dígito verificador com problema!";
               }
               if (erro.length > 0){
                       document.getElementById("cnpjConfere").style.border="1px solid red";
                       document.getElementById("erroCNPJ").style.display="inline";
                       document.getElementById("confereCnpj").value="falso";
                       return false;
               } else {
                       document.getElementById("cnpjConfere").style.border="1px solid #626460";
                       document.getElementById("erroCNPJ").style.display="none";
                       document.getElementById("confereCnpj").value="verdadeiro";
              }
               return true;
       }


