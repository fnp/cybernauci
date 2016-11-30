<?php get_header(); ?>

<div id="materialy-edukacyjne">
    <div class="info container-block">
        <div class="container mainblock">
            <header class="entry-header">
                <h2 class="entry-title">Materiały edukacyjne</h2>
                <h3 class="entry-subtitle">Nauczyciele<img
                            src="<?php bloginfo('template_directory'); ?>/img/materialy-edukacyjne-nauczyciele.png"/>
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

                    $args = array(
                        'post_type' => 'attachment',
                        'post_status' => 'inherit',
                        'post_mime_type' => 'application/zip',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'media_category',
                                'field' => 'slug',
                                'terms' => 'klasy-i-iii-szkoly-podstawowej',
                            ),
                        )
                    );
                    $query = new WP_Query($args);
                    if ($query->have_posts()) {
                        echo '<h3>Klasy I-III szkoły podstawowej</h3>';
                        echo '<ul>';
                        while ($query->have_posts()) {
                            $query->the_post();
                            echo '<li><strong>' . get_the_title() . '</strong><div class="options"><a href="' . get_the_content() . '" target="_blank">zobacz w serwisie Edukacja medialna</a>' . wp_get_attachment_link($id, '', false, false, 'pobierz') . '</div></li>';
                        }
                        echo '</ul>';
                    } else {
                        // no PDFs found
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
