<section class="sec-blog container">     
    <div class="content">
        <h1 class="title-blog">Blog</h1>
        <article class="box-blog">
            <?php
                for($i = 1; $i<= 12; $i++){
            ?>
          
            <div class="row-blog">
                  <h6>Data: <span> 18/06/2018 </span></h6>
                <div class="thumb-blog">
                    <img src="<?= REQUIRE_PATH; ?>/images/blog/d4.jpg" >  
                </div>
                  
                <div class="info-blog">
                    <h1>Dinheiro</h1>
                    <p>
                        Evite carregar notas...
                    </p>
                    <a href="<?= HOME; ?>/artigo" class="btn btn-artigo">Saiba Mais</a>
                </div>
            </div>
            <?php
                }
            ?>
        </article>
    </div>
</section>