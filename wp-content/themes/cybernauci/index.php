<?php get_header(); ?>

<div id="index">
  <div class="info container-block">
    <div class="container mainblock">
      <img src="<?php bloginfo( 'template_directory' ); ?>/img/sidebanner-left-computer.png"
           class="sidebanner sidebanner-left" alt=""/>
      <img src="<?php bloginfo( 'template_directory' ); ?>/img/sidebanner-right-planet.png"
           class="sidebanner sidebanner-right" alt=""/>

      <header class="entry-header">
        <h2 class="entry-title">Cybernauci - kompleksowy projekt kształtowania bezpiecznych zachowań w sieci</h2>
      </header>
      <div class="entry-content">
        <div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
          <p>jest skierowany do osób pracujących w szkołach, uczniów i uczennic oraz ich rodziców i opiekunów
            realizowaliśmy w latach 2015-2018.
          </p>
          <p>Jego celem było podniesienie kompetencji wszystkich wymienionych grup w zakresie bezpiecznego
            korzystania z cyberprzestrzeni oraz reagowania na zagrożenia.</p>
          <p>Zachęcamy do korzystania z materiałów
            przygotowanych w ramach projektu, katalogu materiałów z zakresu bezpieczeństwa w sieci oraz dobrych praktyk
            - działań szkół na rzecz bezpieczeństwa w sieci.
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="aktualnosci-list list-sorted container-block">
    <div class="container mainblock">
      <h2>Aktualności</h2>
		<?php
		$args     = array(
			'cat'       => array(
				'-' . get_category_by_slug( "katalog" )->cat_ID,
				'-' . get_category_by_slug( "dobre-praktyki" )->cat_ID,
			),
			'showposts' => 4,
		);
		$wp_posts = query_posts( $args );
		if ( $wp_posts ) {
			foreach ( $wp_posts as $post ):
				setup_postdata( $post ); ?>
              <div class="col-xs-12 col-sm-6 col-md-3">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                  <header class="entry-header">
					  <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
                        <span class="sticky-post"><?php _e( 'Featured', 'cybernauci' ); ?></span>
					  <?php endif; ?>

					  <?php $image = get_field( 'Image' );
					  if ( ! empty( $image ) ) { ?>
                        <img class="img-responsive" src="<?php echo $image['url']; ?>" alt=""/>
					  <?php } ?>
                    <small><?php echo get_the_date( 'd.m.Y' ); ?></small>
					  <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">',
						  esc_url( get_permalink() ) ),
						  '</a></h2>' ); ?>
                  </header>

					<?php cybernauci_excerpt(); ?>

					<?php cybernauci_post_thumbnail(); ?>

                  <div class="entry-content">
					  <?php echo wp_trim_words( get_the_content(), 30 ) ?>
                  </div>

                  <footer class="entry-footer">
                    <a class="readmore" href="<?php the_permalink() ?>" rel="bookmark"
                       title="<?php echo sprintf( __( 'Continue reading %s', 'cybernauci' ),
						   get_the_title() ) ?>"><? echo __( 'czytaj więcej', 'cybernauci' ) ?></a>
					  <?php
					  edit_post_link(
						  sprintf(
							  __( 'Edit<span class="screen-reader-text"> "%s"</span>', 'cybernauci' ),
							  get_the_title()
						  ),
						  '<span class="edit-link pull-right">',
						  '</span>'
					  );
					  ?>
                  </footer>
                </article>
              </div>
			<?php endforeach;
			wp_reset_postdata();
		}
		?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
