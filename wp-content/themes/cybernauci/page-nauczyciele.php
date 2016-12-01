<?php get_header(); ?>

<div id="materialy-edukacyjne">
    <div class="info container-block">
        <div class="container mainblock">
            <header class="entry-header">
                <h2 class="entry-title">Materiały edukacyjne</h2>
                <h3 class="entry-subtitle">Nauczyciele<img
                            src="<?php bloginfo( 'template_directory' ); ?>/img/materialy-edukacyjne-nauczyciele.png"/>
                </h3>
            </header>
        </div>
        <div class="materialy-content">
            <div class="container mainblock">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 materialy-nauczyciele">
                    <?php
                    while (have_posts()) : the_post();
                        the_content();
                    endwhile;
                    ?>
                    <h3><a href="/materialy-edukacyjne/nauczyciele/nauczyciele-klasy-i-iii-szkoly-podstawowej/"
                           target="_self">Klasy I-III szkoły podstawowej</a></h3>
                    <h3><a href="/materialy-edukacyjne/nauczyciele/nauczyciele-klasy-iv-vi-szkoly-podstawowej/"
                           target="_self">Klasy IV-VI szkoły podstawowej</a></h3>
                    <h3><a href="/materialy-edukacyjne/nauczyciele/nauczyciele-gimnazjum/" target="_self">Gimnazjum</a></h3>
                    <h3><a href="/materialy-edukacyjne/nauczyciele/nauczyciele-szkola-ponadgimnazjalna/" target="_self">Szkoła
                            ponadgimnazjalna</a></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
