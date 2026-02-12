<div id="conteudo-interno">
    <div id="repete-estadias">
            <div id="conteudo-estadias">
                <div id="bloco-titulo">
                    <p class="titulo">Hotéis e Restaurantes</p>
                </div>

                <div id="estadias-restaurantes">
                    <p class="titulo-rest">Pousadas</p>
                        <div id="bloco-ver-pousadas" style="position: relative;" >
                            <p class="ver-pousadas" style="margin-top: -133px; position: absolute; " >Ver restaurantes</p>
                        </div>
                        <script>
                            document.getElementById('bloco-ver-pousadas').addEventListener('click', function() {
                                var targetElement = document.getElementById('estadias-pousadas');
                                var targetPosition = targetElement.getBoundingClientRect().top + window.scrollY - 100;
                                window.scrollTo({ top: targetPosition, behavior: 'smooth' });
                            });
                        </script>
                     <div id="restaurantes">
<?php
        
        $sqlEstadias = "SELECT * FROM estadias WHERE statusEstadia = 'T'  AND  codCategoria  = 1 ";
        $resultEstadias = $conn->query($sqlEstadias);

        $cont = 0;
        while ($dadosEstadias = $resultEstadias->fetch_assoc()) {
            $sqlImagem = "SELECT * FROM estadiasImagens WHERE codEstadia = " . $dadosEstadias['codEstadia'] . " ";
            $resultImagem = $conn->query($sqlImagem);
            $dadosImagem = $resultImagem->fetch_assoc();


?>
                    
                        <div id="fundo-estadias" style="<?php echo $margin ?>">
                            <div id="bloco-imagem">
                                <a rel="lightbox[roadtrip]" title="<?php echo $dadosEstadias['nomeProduto'];?>" href="<?php echo $configUrlGer."f/estadias/".$dadosImagem['codEstadia']."-".$dadosImagem['codEstadiaImagem']."-O.".$dadosImagem['extEstadiaImagem'];?>" > <div id="imagem" style="background: transparent url('<?php echo $configUrlGer . 'f/estadias/' . $dadosImagem['codEstadia'] . '-' . $dadosImagem['codEstadiaImagem'] . '-O.' . $dadosImagem['extEstadiaImagem']; ?>') center center no-repeat; background-size: cover; height: 190px; width: 300px; border-radius: 20px;"></div></a>
                            </div>
                            <div id="conteudo">
                                <p class="titulo-estadia"><?php echo $dadosEstadias['nomeEstadia'] ?></p>
                                <div id="botoes">
                                      <a id="whats" target="_blank" title="Chame no WhatsApp" href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $dadosEstadias['numeroEstadia']); ?>?text=<?php echo urlencode('Olá, vim pelo Litoral Imóveis e gostaria de saber mais sobre o estabelecimento *'.$dadosEstadias['nomeEstadia'].'*.'); ?>"style="cursor: pointer; display:flex;"> Chamar no WhatsApp </a> 
                                    <a id="mapa" target="_blank" title="Como chegar" href="<?php echo $dadosEstadias['localEstadia']; ?>"> Como chegar </a>
                                </div>
                            </div>
                        </div> 
                                
<?php
    }
?>
                    </div> 
                </div>
                <div id="estadias-pousadas">
                    <p class="titulo-pousadas">Restaurantes</p>
                     <div id="pousadas">
                     <?php
        $cont2 = 0;
        $sqlEstadias = "SELECT * FROM estadias WHERE statusEstadia = 'T'  AND  codCategoria  = 2 ";
        $resultEstadias = $conn->query($sqlEstadias);


        while ($dadosEstadias = $resultEstadias->fetch_assoc()) {
            $sqlImagem = "SELECT * FROM estadiasImagens WHERE codEstadia = " . $dadosEstadias['codEstadia'] . " ";
            $resultImagem = $conn->query($sqlImagem);
            $dadosImagem = $resultImagem->fetch_assoc();

    ?>                
                        <div id="fundo-estadias" style="<?php echo $margin ?>">
                            <div id="bloco-imagem">
                                <a rel="lightbox[roadtrip]" title="<?php echo $dadosEstadias['nomeProduto'];?>" href="<?php echo $configUrlGer."f/estadias/".$dadosImagem['codEstadia']."-".$dadosImagem['codEstadiaImagem']."-O.".$dadosImagem['extEstadiaImagem'];?>" > <div id="imagem" style="background: transparent url('<?php echo $configUrlGer . 'f/estadias/' . $dadosImagem['codEstadia'] . '-' . $dadosImagem['codEstadiaImagem'] . '-O.' . $dadosImagem['extEstadiaImagem']; ?>') center center no-repeat; background-size: cover; height: 190px; width: 300px; border-radius: 20px;"></div></a>
                            </div>
                            <div id="conteudo">
                                <p class="titulo-estadia"><?php echo $dadosEstadias['nomeEstadia'] ?></p>
                                <div id="botoes">
                                    <a id="whats" target="_blank" title="Chame no WhatsApp" href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $dadosEstadias['numeroEstadia']); ?>?text=<?php echo urlencode('Olá, vim pelo Litoral Imóveis e gostaria de saber mais sobre o estabelecimento *'.$dadosEstadias['nomeEstadia'].'*.'); ?>"style="cursor: pointer; display:flex;"> Chamar no WhatsApp </a> 
                                    <a id="mapa" target="_blank" title="Como chegar" href="<?php echo $dadosEstadias['localEstadia']; ?>"> Como chegar </a>
                                </div>
                            </div>
                        </div>
                                
<?php
    }
?>
                    </div> 
                </div>
            </div>
        </div>
</div>
