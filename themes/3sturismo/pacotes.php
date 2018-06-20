<div class="main_pacote container">
    <div class="pacotes">
        <img src="<?= REQUIRE_PATH; ?>/images/pacotes.jpg">
        <h1 class="al-center">CONFIRA NOSSOS PACOTES!</h1>
    </div>

    <div class="content">
        <div class="sidebar">
            <form class="form-pacote">
                <h2>Buscar</h2>
                <input type="text" placeholder="Pesquisar...">
            </form>

            <ul>
                <li><a href="<?= HOME; ?>#"> GUAIBIM - BA+MORRO...</a></li>
                <li><a href="<?= HOME; ?>#">CALDAS NOVAS...</a></li>
                <li><a href="<?= HOME; ?>#"> PORTO SEGURO ...</a></li>
                <li><a href="<?= HOME; ?>#">  PORTO SEGURO ...</a></li>             
            </ul>
        </div>

        <section class="sec-thumb-pacotes">
            <h1>Nossos Pacotes</h1>
            <?php
            for ($i = 0; $i <= 8; $i++) {
                ?>
                <article class="row-pacotes">
                    <a href="<?= HOME; ?>/single" class="box-thumb-pac">
                        <div class="thumb-pacote">
                            <img src="<?= REQUIRE_PATH; ?>/images/pacote/pac1.jpg">
                            <div class="box-hover-pacotes">
                                <button class="btn btn-veja">Confira</button>
                            </div>     
                        </div>           
                        <h1>Porto Seguro - BA</h1>

                    </a>
                </article>
                <?php
            }
            ?>

        </section>
    </div>
</div>
