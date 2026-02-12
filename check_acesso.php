<?php
include('f/conf/config.php');

echo "=== ÁREAS DISPONÍVEIS ===\n";
$result = $conn->query('SELECT codAreaAcesso, urlAreaAcesso FROM areasAcesso WHERE statusAreaAcesso = "T" ORDER BY urlAreaAcesso');
while($row = $result->fetch_assoc()) {
    echo $row['codAreaAcesso'] . ' - ' . $row['urlAreaAcesso'] . "\n";
}

echo "\n=== USUÁRIO ATUAL ===\n";
if(isset($_COOKIE['codAprovadoLitoralImoveis2025'])) {
    $codUsuario = $_COOKIE['codAprovadoLitoralImoveis2025'];
    echo "Código: " . $codUsuario . "\n";
    
    $userResult = $conn->query('SELECT nomeUsuario FROM usuarios WHERE codUsuario = ' . $codUsuario);
    $userData = $userResult->fetch_assoc();
    echo "Nome: " . $userData['nomeUsuario'] . "\n";
    
    echo "\n=== ÁREAS DO USUÁRIO ===\n";
    $areaResult = $conn->query('SELECT AC.urlAreaAcesso FROM areasAcesso AC inner join areaUsuario AU on AC.codAreaAcesso = AU.codAreaAcesso WHERE AU.codUsuario = ' . $codUsuario);
    while($area = $areaResult->fetch_assoc()) {
        echo '✓ ' . $area['urlAreaAcesso'] . "\n";
    }
    
    echo "\n=== VERIFICAÇÃO ESPECÍFICA ===\n";
    echo "Tem acesso a 'caracteristicas'? ";
    $charResult = $conn->query('SELECT AC.urlAreaAcesso FROM areasAcesso AC inner join areaUsuario AU on AC.codAreaAcesso = AU.codAreaAcesso WHERE AU.codUsuario = ' . $codUsuario . ' AND AC.urlAreaAcesso = "caracteristicas"');
    echo ($charResult->num_rows > 0) ? "SIM\n" : "NÃO\n";
    
    echo "Tem acesso a 'loteamentos'? ";
    $loteResult = $conn->query('SELECT AC.urlAreaAcesso FROM areasAcesso AC inner join areaUsuario AU on AC.codAreaAcesso = AU.codAreaAcesso WHERE AU.codUsuario = ' . $codUsuario . ' AND AC.urlAreaAcesso = "loteamentos"');
    echo ($loteResult->num_rows > 0) ? "SIM\n" : "NÃO\n";
    
} else {
    echo "Nenhum usuário logado\n";
}
?>
