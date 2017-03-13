<?php get_header(); ?>

    <div id="katalogDodaj">
        <div class="info container-block">
            <div class="container mainblock">
                <img src="<?php bloginfo( 'template_directory' ); ?>/img/sidebanner-left-computer.png"
                     class="sidebanner sidebanner-left" alt=""/>
                <header class="entry-header">
                    <h2 class="entry-title">Dodawanie materiału zakończone sukcesem.</h2>
                </header>
                <div class="entry-content">
                    <div class="col-xs-12 col-md-8 col-md-offset-2">
	                    <?php
	                    while ( have_posts() ) : the_post();
		                    the_content();
	                    endwhile;
	                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>
