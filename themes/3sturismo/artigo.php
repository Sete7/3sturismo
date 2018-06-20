<div class="main-artigo container">
    <div class="content">
        <h1>Artigos</h1>
        <div class="box-artigo">
            <h6>Publicação por Fulano, <span>19/06/18 - 11h56 - Atualizado em 19/06/18 - 12h12</span></h6>
            <div id="artigoDia" class="thumb-img-artigo">
                <img src="<?= REQUIRE_PATH; ?>/images/blog/d2.jpg" alt=""/>
                <div>
                    <p>Viajando com segurança</p>
                </div>
                
                 <div class="txt-artigo">
                    <p>
                        Deve ser acomodada sob o assento do passageiro ou em compartimento
                        próprio da aeronave, com peso máximo de cinco quilos e dimensão total
                        (altura, largura e comprimento) não excedendo 115 centímetros.
                        Pode-se carregar ainda, segundo o DAC: sobretudo, manta ou cobertor,
                        cadeira de rotas e/ou muletas, guarda-chuva ou bengala, laptop ou binóculo,
                        material de leitura para a viagem e uma cesta ou equivalente para criança de
                        colo. Obs.: O DAC determinou que fica proibido o transporte de lap-top / palm-top 
                        em bagagem despachada. Determinou ainda que os pontos de inspeção para
                        acesso às áreas restritas dos aeroportos no Brasil devem passar o equipamento
                        pelo raio-x, e solicitar ao proprietário que ligue o mesmo, deixando ligado pelo
                        tempo mínimo de 60 segundos. E também alertou que a recusa por parte do passageiro 
                        implicará que o equipamento seja tratado como equipamento suspeito, pelo que determinou
                        aos inspetores acionarem os meios disponíveis de segurança do Aeroporto.
                    </p>
                </div>
                
            </div>            

            <div class="artigos-recentes">
                <h2>Artigos Recentes</h2>

                <?php
                for ($i = 1; $i <= 4; $i++) {
                    ?>
                <a href="<?= HOME; ?>/artigo" class="box-art-thumb">               
                        <img src="<?= REQUIRE_PATH; ?>/images/blog/d<?= $i; ?>.jpg" alt=""/>
                        <div class="text-recente">
                            <h3>Deve ser</h3>
                            <p> 
                                Deve ser acomodada sob...
                            </p>
                        </div>
                    </a>
                    <?php
                }
                ?>
            </div>



            <div class="box-comentario">
                <h1>Deixe seu Comentário</h1>
                <form class="form-artigo">
                    <label>Nome:</label>
                    <input type="text" name="nome" placeholder="Nome*">
                    <label>Email:</label>
                    <input type="email" name="email" placeholder="Email*">
                    <label>Descrição:</label>
                    <textarea rows="5" cols="10"></textarea>
                    <input type="submit" name="submit" class="btn btn-comentario" value="Enviar">
                </form>
            </div>
        </div>
    </div>
</div>