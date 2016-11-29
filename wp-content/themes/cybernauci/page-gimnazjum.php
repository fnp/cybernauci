<?php get_header(); ?>

<div id="materialy-edukacyjne">
    <div class="info container-block">
        <div class="container mainblock">
            <header class="entry-header">
                <h2 class="entry-title">Materiały edukacyjne</h2>
                <h3 class="entry-subtitle">Uczniowie szkół ponadpodstawowych<img
                            src="<?php bloginfo( 'template_directory' ); ?>/img/materialy-edukacyjne-gimnazjum.png"/>
                </h3>
            </header>
        </div>
        <div class="materialy-content">
            <div class="container mainblock">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 materialy-gimnazjum">
                    <ul>
		                <?php
		                $args      = array(
			                'post_type'   => 'attachment',
			                'post_status' => 'any',
			                'tax_query'   => array(
				                array(
					                'taxonomy' => 'media_category',
					                'field'    => 'slug',
					                'terms'    => 'gimnazjum-i-liceum',
				                ),
			                )
		                );
		                $the_query = new WP_Query( $args );

		                if ( $the_query->have_posts() ) {
			                while ( $the_query->have_posts() ) {
				                $the_query->the_post();
				                echo '<li><strong>' . get_the_title() . '</strong>' . wp_get_attachment_image( get_the_ID(), 'large' ) . '<div class="options"><a href="' . get_template_directory_uri() . '/libs/pdfjs/web/viewer.html?file=' . wp_get_attachment_url( $id ) . '">czytaj on-line</a>' . wp_get_attachment_link( $id, '', false, false, 'pobierz PDF' ) . '</div></li>';
			                }
		                } else {
			                // no attachments found
		                }
		                wp_reset_postdata();
		                ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
