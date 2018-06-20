<main class="main_content container">
    <!--slider-->
    <section class="slider container">
        <h1 class="font-zero">Últimas do site:</h1>
        <div class="slider_controll">
            <div class="slide_nav back"><<</div>
            <div class="slide_nav go">>></div>
        </div>
        <article class="slider_item first">
            <a href="<?= HOME; ?>ver" title="Fortaleza">
                <picture alt="Fortaleza">
                    <source media="(min-width: 1280px)" srcset="tim.php?src=uploads/caldas.jpg&w=1366&h=400" />
                </picture>
                <img src="<?= REQUIRE_PATH; ?>/images/caldas.jpg" alt="" title="">
            </a>                        
        </article>
        <article class="slider_item">
            <a href="<?= HOME; ?>/#ver" title="Fortaleza">
                <picture alt="Fortaleza">
                    <source media="(min-width:1600px)" srcset="tim.php?src=uploads/01.jpg&w=200&h=600">
                </picture>
                <img src="<?= REQUIRE_PATH; ?>/images/sl4.jpg" alt="" title="">
            </a>                        
        </article>
        <article class="slider_item">
            <a href="<?= HOME; ?>/#ver" title="Fortaleza">
                <picture alt="Fortaleza">
                    <source media="(min-width:1600px)" srcset="tim.php?src=uploads/01.jpg&w=200&h=600">
                </picture>
                <img src="<?= REQUIRE_PATH; ?>/images/sl5.jpg" alt="" title="">
            </a>                        
        </article>
    </section>

    <div class="clear"></div>
</main>          
<!--slider-->

<!--PROMOÇÕES - FROTA - PACOTES-->
<section class="container bg-light">
    <h1 class="font-zero">Veja mais que 3s turismo tem a oferecer</h1>
    <div class="content">
        <div class="main-oferecer">
            
            <article class="row-oferecer">
                <div class="row-thumb-text">
                    <div class="thumb">
                        <img src="<?= REQUIRE_PATH; ?>/images/cart.png">
                    </div>
                    <div class="text">
                        <h1>Promoções</h1>
                        <p>Durante toda a semana postamos em nosso blog promoções para você e toda a sua família.</p>
                    </div>
                </div>
            </article>

            <article class="row-oferecer row-space">
                <div class="row-thumb-text">
                    <div class="thumb">
                        <img src="<?= REQUIRE_PATH; ?>/images/bus.png">
                    </div>
                    <div class="text">
                        <h1>Nossa Frota</h1>
                        <p>Nosso veiculos são totalmente confortáveis para que você tenha total conforto em sua viagens.</p>
                    </div>
                </div>
            </article>                    
            <article class="row-oferecer">
                <div class="row-thumb-text">
                    <div class="thumb">
                        <img src="<?= REQUIRE_PATH; ?>/images/ag.png">
                    </div>
                    <div class="text">
                        <h1>Pacotes</h1>
                        <p class="text-pacotes">Pacotes fechados para ciades em todo Brasil e exterior.</p>
                    </div>
                </div>
            </article>                    
        </div>
    </div>
    <div class="clear"></div>
</section>

<!--AS MELHORES OFERTAS -->
<section class="container bg-light main-ofertas">    
    <div class="content">
        <h1 class="al-center">AS MELHORES OFERTAS VOCÊ ENCONTRA AQUI!</h1>
        <?php for ($i = 0; $i < 4; $i++): ?>                    
            <article class="row-ofertas">
                <a href="<?= HOME; ?>/pacotes">
                    <h1>PORTO SEGURO EM JANEIRO 2018</h1>
                    <img src="<?= REQUIRE_PATH; ?>/images/pacote/pac1.jpg" alt="">
                    <p>06 NOITES EM FRENTE A PRAIA COM MUITO SOL E LAZER </p>
                    <p>DATA:23/01/2018   A 31/01/2018</p>    
                    <p>Bus DD + Hospedagem + cafe da manha + jantar + city tour</p>    
                    <p>Barramares + AxeMoi + ToaToa + cidade historica</p>    
                    <p>VALOR:  R$ 1100,00  OU  1+5X  de R$190,00 apts triplos</p>    
                    <p>PACOTE: Ônibus + hospedagem + café + jantar + city...</p>                   
                    <button href="<?= HOME; ?>/blog" class="btn btn-ofertas">Confira!</button>
                </a>
            </article>
        <?php endfor; ?>
    </div>
    <div class="clear"></div>
</section>

<!--BLOG -->
<section class="container bg-light main-ofertas">
    <h1 class="al-center" style="margin-top: 4rem;">ÚLTIMAS DO BLOG</h1>
    <div class="content">
         <?php
            for($i = 1; $i <=4; $i++){
        ?>
        <article class="row-ofertas content">
            <h1>DINHEIRO</h1>
            <img src="<?= REQUIRE_PATH; ?>/images/blog/d4.jpg" alt="">
            <p>Evite carregar notas de valores altos, leve um ou mais cartões de crédito internacionais. Traveller s cheques são seguros e bem aceitos, mas para trocar é necessária a apresentação do...</p>
            <a href="<?= HOME; ?>/blog" class="btn btn-confira">Confira!</a>
        </article>
        <?php
            }
        ?>
    </div>
    <div class="clear"></div>
</section>

<!--QUEM SOMOS -->
<section class="container section-quem-somos">
    <div class="sect-thumb">
        <img class="thumb" src="<?= REQUIRE_PATH; ?>/images/pessoasG.png">
    </div>

    <div class="sect-text">
        <div class="quem-text">
            <h1>Quem Somos</h1>
            <p>A 3S Turismo é uma empresa líder no mercado há 20 anos,
                que trabalha com seriedade e compromisso com o seu bem estar. 
                Estamos sempre em busca de inovações, com investimento em equipamento
                e melhoria do atendimento. Disponibilizamos de uma equipe familiar,
                capacitada e responsável para melhor atendê-lo.
            </p>
            
            <a href="<?= HOME; ?>/quem-somos" class="btn btn-confira-mais">Confira Mais...</a>
        </div>
    </div>
    <div class="clear"></div>
</section>