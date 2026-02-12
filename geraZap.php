<?php
    header("Content-Type: application/xml; charset=UTF-8");
    echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";

    include('f/conf/config.php');
?>
<ListingDataFeed xmlns="http://www.vivareal.com/schemas/1.0/VRSync"
                xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                xsi:schemaLocation="http://www.vivareal.com/schemas/1.0/VRSync  http://xml.vivareal.com/vrsync.xsd">
    <Header>
        <Provider>SoftBest</Provider>
        <Email>atendimento@softbest.com.br</Email>
        <ContactName>Elias Fermiano</ContactName>
        <PublishDate><?php echo date('c');?></PublishDate>
        <Telephone>(48) 99826-3849</Telephone>
    </Header>

    <Listings>
<?php
    $sqlImovel = "SELECT * FROM imoveis I INNER JOIN imoveisImagens II ON I.codImovel = II.codImovel WHERE I.statusImovel = 'T' and I.destaqueImovel = 'T' and I.metragemImovel != 0 GROUP BY I.codImovel ORDER BY I.codImovel DESC LIMIT 0,2000";
    $resImovel = $conn->query($sqlImovel);
    while ($imovel = $resImovel->fetch_assoc()) {

        
        // Se o número contém alguma letra, deixa vazio
        $numero = $imovel['numeroCompleteImovel'];
        if (preg_match('/[a-zA-Z]/', $numero)) {
            echo '';
        } else {
            echo $numero;
        }

        $sqlUsuario = "SELECT * FROM usuarios WHERE codUsuario = ".$imovel['codUsuario']." LIMIT 0,1";
        $resultUsuario = $conn->query($sqlUsuario);
        $dadosUsuario = $resultUsuario->fetch_assoc();

        $tipo = $conn->query("SELECT nomeTipoImovel FROM tipoImovel WHERE codTipoImovel='{$imovel['codTipoImovel']}'")->fetch_assoc()['nomeTipoImovel'];
        $cidade = $conn->query("SELECT * FROM cidades WHERE codCidade='{$imovel['codCidade']}'")->fetch_assoc();
        $bairro = $conn->query("SELECT nomeBairro FROM bairros WHERE codBairro='{$imovel['codBairro']}'")->fetch_assoc()['nomeBairro'];
        // Traduzir o tipo de imóvel para inglês
        $tipos_en = [
            'Apartamento' => 'Apartment',
            'Casa' => 'Home',
            'Geminados' => 'Home',
            'Cobertura' => 'Penthouse',
            'Sala Comercial' => 'Commercial',
            'Sobrado' => 'Sobrado',
            'Loja' => 'Store',
            'Pousada' => 'Commercial',
            'Terreno' => 'Land Lot',
            'Kitnet' => 'Kitnet',
            'Pousada' => 'Inn',
            'Fazenda/Sítio/Chácara' => 'Agricultural',
            'Sítio' => 'Agricultural',
            'Chácara' => 'Farm Ranch',
            'Galpão' => 'Industrial',
            'Prédio' => 'Edificio Comercial',
            'Flat' => 'Flat',
            'Terreno Comercial' => 'Land Lot',
            'Terreno Residencial' => 'Land Lot',
        ];
        $tipo_en = isset($tipos_en[$tipo]) ? $tipos_en[$tipo] : $tipo;

        /* --- mapeamentos/normalização --- */
        $transacao = $imovel['tipoCImovel'] == 'V' ? 'For Sale' : 'For Rent';
        $finalidade = in_array($tipo_en, ['Sala Comercial','Loja']) ? 'Commercial' : 'Residential';
        $propertyType = "$finalidade / $tipo_en";

        /* -- Título, descrição e vídeo escapados para XML -- */
        $titulo = htmlspecialchars($imovel['nomeImovel'], ENT_XML1 | ENT_QUOTES, 'UTF-8');
        $descricao = htmlspecialchars(strip_tags($imovel['descricaoImovel']), ENT_XML1 | ENT_QUOTES, 'UTF-8');
        $videoUrl = htmlspecialchars($imovel['videoImovel'], ENT_XML1 | ENT_QUOTES, 'UTF-8');
?>
        <Listing>
            <ListingID><?php echo explode(' ', trim($dadosUsuario['nomeUsuario']))[0]; ?><?php echo $imovel['codigoImovel'];?></ListingID>
            <Title><?php echo $titulo;?></Title>
            <TransactionType><?php echo $transacao;?></TransactionType>
            <PublicationType><?php echo $imovel['destaqueImovel']=='T'?'PREMIUM':'STANDARD';?></PublicationType>
            <DetailViewUrl><?php echo $configUrl."imoveis/{$imovel['codImovel']}-{$imovel['urlImovel']}/";?></DetailViewUrl>

            <Media>
<?php
    // Buscar imagens apenas em JPG
    $sqlImg = "
        SELECT * FROM imoveisImagens 
         WHERE codImovel='{$imovel['codImovel']}'
           AND (extImovelImagem = 'jpg' OR extImovelImagem = 'jpeg')
      ORDER BY ordenacaoImovelImagem ASC 
         LIMIT 0,30";
    $resImg = $conn->query($sqlImg);

    $imagens = [];
    while($img = $resImg->fetch_assoc()){
        // Caminho para JPG
        $pathJPG_O = "ger/f/imoveis/{$img['codImovel']}-{$img['codImovelImagem']}-O.".$img['extImovelImagem'];
        $urlJPG_O  = $configUrl . $pathJPG_O;
        $pathJPG_G = "ger/f/imoveis/{$img['codImovel']}-{$img['codImovelImagem']}-G.".$img['extImovelImagem'];
        $urlJPG_G  = $configUrl . $pathJPG_G;

        // Verifica se o arquivo -O existe, senão tenta o -G
        if (file_exists($pathJPG_O)) {
            $imagens[] = $urlJPG_O;
        } elseif (file_exists($pathJPG_G)) {
            $imagens[] = $urlJPG_G;
        }
    }

    // Se não houver pelo menos 6 imagens, duplicar até ter 6
    $totalImagens = count($imagens);
    if ($totalImagens < 6 && $totalImagens > 0) {
        for ($j = $totalImagens; $j < 6; $j++) {
            $imagens[] = $imagens[$j % $totalImagens];
        }
    }

    // Se não houver nenhuma imagem, não exibe nada
    $i = 0;
    foreach ($imagens as $imgUrl) {
?>
                <Item medium="image" caption="img<?php echo ++$i;?>" <?php echo $i==1?'primary="true"':'';?>><?php echo $imgUrl;?></Item>
<?php
    }
?>
            </Media>

            <Details>
                <UsageType><?php echo $finalidade;?></UsageType>
                <PropertyType><?php echo $propertyType;?></PropertyType>
                <Description><![CDATA[<?php echo nl2br($descricao);?>]]></Description>
                <ListPrice currency="BRL"><?php echo $imovel['precoImovel'];?></ListPrice>
                <LivingArea unit="square metres"><?php echo (float)$imovel['metragemImovel'];?></LivingArea>
                <Bedrooms><?php echo $imovel['quartosImovel'];?></Bedrooms>
                <Bathrooms><?php echo $imovel['banheirosImovel'];?></Bathrooms>
                <Suites><?php echo $imovel['suiteImovel'];?></Suites>
                <Garage><?php echo $imovel['garagemImovel'];?></Garage>
                <PropertyAdministrationFee currency="BRL"><?php echo $imovel['condominioImovel'];?></PropertyAdministrationFee>
                <YearlyTax currency="BRL"><?php echo $imovel['iptuImovel'];?></YearlyTax>                
            </Details>

            <Location displayAddress="Street">
                <Country abbreviation="BR">Brasil</Country>
                <State abbreviation="<?php echo $cidade['estadoCidade'];?>"><?php echo $cidade['estadoCidade'];?></State>
                <City><?php echo $cidade['nomeCidade'];?></City>
                <Neighborhood><?php echo $bairro;?></Neighborhood>
                <Address><?php echo $imovel['enderecoCompleteImovel'];?></Address>
                <StreetNumber><?php echo $numero;?></StreetNumber>
                <PostalCode><?php echo $imovel['cepCompleteImovel'];?></PostalCode>
                <!--  endereços opcionais ocultados: -->
            </Location>

            <ContactInfo>
                <Name><?php echo $nomeEmpresa;?></Name>
                <Email><?php echo $email;?></Email>
                <Website><?php echo $configUrl;?></Website>
                <Telephone><?php echo $celular;?></Telephone>
            </ContactInfo>
        </Listing>
<?php
} // while imóveis
?>
    </Listings>
</ListingDataFeed>
