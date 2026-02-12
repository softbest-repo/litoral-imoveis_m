<?php
    include('info.php');
    include('../f/conf/config.php');

    function padronizarNumeroCom9($numero) {
        $numero = preg_replace('/\D/', '', $numero);

        if (substr($numero, 0, 2) === '55') {
            $numero = substr($numero, 2);
        }

        if (strlen($numero) < 10) {
            return $numero;
        }

        $ddd = substr($numero, 0, 2);
        $telefone = substr($numero, 2);

        $prefixosSem9 = ['2000', '2100', '2200', '2400', '3300'];

        if (strlen($telefone) === 9 && $telefone[0] === '9') {
            return $ddd . $telefone;
        }

        if (strlen($telefone) === 8) {
            foreach ($prefixosSem9 as $prefixo) {
                if (strpos($telefone, $prefixo) === 0) {
                    return $ddd . $telefone;
                }
            }
            return $ddd . '9' . $telefone;
        }

        return $ddd . $telefone;
    }

    $cont = 0;
    $numerosUnicos = [];

    $sqlLogWhats = "SELECT * FROM logWhats WHERE DATE(data_recebimento) = '2025-07-01' ORDER BY data_recebimento ASC";
    $resultLogWhats = $conn->query($sqlLogWhats);
    if (!$resultLogWhats) {
        die("Erro na consulta: " . $conn->error);
    }

    while($dadosLogWhats = $resultLogWhats->fetch_assoc()){		
        $data = json_decode($dadosLogWhats['json_recebido'], true);

        $numero = '';
        $nome = '';
        $isAd = "F";
        $sourceUrl = null;

        if (!empty($data['entry'])) {
            foreach ($data['entry'] as $entry) {
                foreach ($entry['changes'] as $change) {
                    $value = $change['value'];

                    if (!empty($value['contacts'])) {
                        $contact = $value['contacts'][0];
                        $nome = $contact['profile']['name'];
                        $numero = $contact['wa_id'];
                    }

                    // Corrigido: buscar o source/referral corretamente dentro de messages
                    if (!empty($value['messages'])) {
                        foreach ($value['messages'] as $message) {
                            if (isset($message['referral'])) {
                                $isAd = "T";
                                $sourceUrl = $message['referral']['source_url'] ?? null;
                                break;
                            }
                        }
                    }

                    break 2; // Pega só o primeiro contato
                }
            }
        }

        if (!$numero || in_array($numero, $numerosUnicos)) {
            continue; // Já processado
        }

        $numerosUnicos[] = $numero;

        // Remove o 55 do início do número, se existir
        $numeroSem55 = padronizarNumeroCom9(preg_replace('/^55/', '', $numero));
        $sqlUsuario = "SELECT * FROM usuarios WHERE REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(celularUsuario, '(', ''), ')', ''), ' ', ''), '-', ''), '.', '') = '$numeroSem55' ORDER BY codUsuario DESC LIMIT 1";

        $resultUsuario = $conn->query($sqlUsuario);
        $dadosUsuario = $resultUsuario->fetch_assoc();

        if (empty($dadosUsuario['codUsuario'])) {

            $sqlConfere = "SELECT codConversa FROM conversas WHERE numero = '".$numero."' LIMIT 1";
            $resultConfere = $conn->query($sqlConfere);
            $dadosConfere = $resultConfere->fetch_assoc();

            if (empty($dadosConfere['codConversa'])) {
                if($isAd == "T"){
                    echo "<br>Número não está na tabela conversas: $numero ($nome) - id logWhats: " . $dadosLogWhats['id']." source: ".$sourceUrl;
                    $cont++;
                }  
            }else{
                if($isAd == "T"){
                    echo "<br>Esta: $numero ($nome) - id logWhats: " . $dadosLogWhats['id']." source: ".$sourceUrl;
                    $cont++;
                }                
            }
        }
    }

    echo "<br>Total de Leads não salvos: " . $cont;
?>
