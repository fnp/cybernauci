<?php get_header(); ?>

<div id="materialy-edukacyjne">
    <div class="info container-block">
        <div class="container mainblock">
            <header class="entry-header">
                <h2 class="entry-title">Materiały edukacyjne</h2>
            </header>
        </div>
        <div class="materialy-content">
            <div class="container mainblock">
                <div class="col-xs-12 materialy-main-page">
                    <?php
                    while (have_posts()) : the_post();
                        the_content();
                    endwhile;
                    ?>
                </div>
                <div class="col-xs-12 materialy-main-page">
                    <div class="link podstawowa col-xs-12 col-sm-6">
                        <div class="title">Uczniowie</div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="subtitle">Szkoła podstawowa</div>
                                <a href="/materialy-edukacyjne/podstawowa" target="_self">
                                    <img src="<?php bloginfo( 'template_directory' ); ?>/img/materialy-edukacyjne-podstawowa.png"/>
                                </a>
                            </div>
                            <div class="col-xs-6">
                                <div class="subtitle">Gimnazjum i szkoły ponadgimnazjalne</div>
                                <a href="/materialy-edukacyjne/gimnazjum" target="_self">
                                    <img src="<?php bloginfo( 'template_directory' ); ?>/img/materialy-edukacyjne-gimnazjum.png"/>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="link rodzice col-xs-12 col-sm-3">
                        <div class="title">Rodzice i Opiekunowie</div>
                        <a href="/materialy-edukacyjne/rodzice" target="_self">
                            <img src="<?php bloginfo( 'template_directory' ); ?>/img/materialy-edukacyjne-rodzice.png"/>
                        </a>
                    </div>
                    <div class="link nauczyciele col-xs-12 col-sm-3">
                        <div class="title">Nauczyciele</div>
                        <a href="/materialy-edukacyjne/nauczyciele" target="_self">
                            <img src="<?php bloginfo( 'template_directory' ); ?>/img/materialy-edukacyjne-nauczyciele.png"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
