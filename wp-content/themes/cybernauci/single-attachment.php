<?php get_header(); ?>

<div id="aktualnosci" class="single">
    <div class="info container-block">
        <div class="container mainblock">
            <img src="<?php bloginfo( 'template_directory' ); ?>/img/sidebanner-left-computer.png"
                 class="sidebanner sidebanner-left" alt=""/>
            <img src="<?php bloginfo( 'template_directory' ); ?>/img/sidebanner-right-planet.png"
                 class="sidebanner sidebanner-right" alt=""/>

            <header class="entry-header">
                <h2 class="entry-title">Przegląd materiałów edukacyjnych</h2>
            </header>
        </div>

        <div class="aktualnosci-list">
            <div class="container mainblock">
                <div class="col-xs-12 col-md-2">
                    <a title="wróć do listy" rel="bookmark"
                       href="<?php echo esc_url( get_permalink( get_page_by_title( 'Materiały edukacyjne' ) ) ); ?>"
                       class="back-to-list">wróć do listy</a>
                </div>
                <div class="col-xs-12 col-md-6 col-md-offset-1">
					<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/content-aktualnosci', 'single' );
					endwhile;
					?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
