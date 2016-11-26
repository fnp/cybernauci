<?php get_header(); ?>

<div id="materialy-edukacyjne">
    <div class="info container-block">
        <div class="container mainblock">
            <header class="entry-header">
                <h2 class="entry-title">Materiały edukacyjne</h2>
                <h3 class="entry-subtitle">Rodzice<img
                            src="<?php bloginfo( 'template_directory' ); ?>/img/materialy-edukacyjne-rodzice.png"/></h3>
            </header>
        </div>
        <div class="materialy-content">
            <div class="container mainblock">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 materialy-rodzice">
					<?php
					while ( have_posts() ) : the_post();
						the_content();
					endwhile;
					?>
                    <div class="text-center">
                        <a class="button-link" href="/materialy-edukacyjne/quiz">ROZPOCZNIJ QUIZ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
