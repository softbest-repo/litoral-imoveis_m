<?php
    include('info.php');
    include('../f/conf/config.php');

    $sqlConversa = "SELECT * FROM conversas WHERE codConversa = 5799 ORDER BY codConversa ASC";
    $resultConversa = $conn->query($sqlConversa);
    $dadosConversa = $resultConversa->fetch_assoc();

    $sqlMensagemLead = "SELECT * FROM mensagens WHERE codConversa = 5799 ORDER BY codMensagem ASC LIMIT 0,1";
    $resultMensagemLead = $conn->query($sqlMensagemLead);
    $dadosMensagemLead = $resultMensagemLead->fetch_assoc();	
    
    echo $dadosMensagemLead['mensagem'];
?>
