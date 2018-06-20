<div class="main-quem-somos container">
    <div class="content quem-somos">
        <div class="row">
            <div class="column column-5 row-imagem-quem">
                <img src="<?= REQUIRE_PATH; ?>/images/quem-somos.jpg">                
            </div>            
            <div class="column column-7">
                <p>A 3S Turismo é uma empresa líder no mercado há 20 anos, que trabalha com seriedade e compromisso com o seu bem estar.
                    Estamos sempre em busca de inovações, com investimento em equipamento e melhoria do atendimento.
                    Disponibilizamos de uma equipe familiar, capacitada e responsável para melhor atendê-lo. Qualidade e preços acessíveis são o nosso forte.</p>
                <p>Você cliente, é o nosso maior patrimônio e tem total exclusividade em nossos serviços!</p>
                <p>Venha conhecer o Brasil conosco!</p>
            </div>
        </div>
    </div>

    <div class="container main-our-bus">
        <div class="content">
            <?php
            for ($i = 1; $i <= 4; $i++) {
                ?>
                <div class="nossos-onibus">
                    <img src="<?= REQUIRE_PATH; ?>/images/0<?= $i; ?>.png">  
                </div>           
                <?php
            }
            ?>
        </div>
        <div class="clear"></div>
    </div>
</div>