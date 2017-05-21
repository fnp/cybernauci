<?php get_header(); ?>

<div id="aktualnosci">
    <div class="info container-block">
        <div class="container mainblock">
            <img src="<?php bloginfo( 'template_directory' ); ?>/img/sidebanner-left-computer.png"
                 class="sidebanner sidebanner-left" alt=""/>
            <img src="<?php bloginfo( 'template_directory' ); ?>/img/sidebanner-right-planet.png"
                 class="sidebanner sidebanner-right" alt=""/>
        </div>

        <div class="aktualnosci-list list-sorted">
            <div class="container mainblock">
	            <?php
	            while ( have_posts() ) : the_post();
		            ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
	                        <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
                                <span class="sticky-post"><?php _e( 'Featured', 'cybernauci' ); ?></span>
	                        <?php endif; ?>

	                        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                        </header><!-- .entry-header -->

	                    <?php cybernauci_excerpt(); ?>

	                    <?php cybernauci_post_thumbnail(); ?>

                        <div class="entry-content">
	                        <?php
	                        /* translators: %s: Name of current post */
	                        the_content( sprintf(
		                        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'cybernauci' ),
		                        get_the_title()
	                        ) );

	                        wp_link_pages( array(
		                        'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'cybernauci' ) . '</span>',
		                        'after'       => '</div>',
		                        'link_before' => '<span>',
		                        'link_after'  => '</span>',
		                        'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'cybernauci' ) . ' </span>%',
		                        'separator'   => '<span class="screen-reader-text">, </span>',
	                        ) );
	                        ?>
                        </div><!-- .entry-content -->

                        <footer class="entry-footer">
	                        <?php cybernauci_entry_meta(); ?>
	                        <?php
	                        edit_post_link(
		                        sprintf(
		                        /* translators: %s: Name of current post */
			                        __( 'Edit<span class="screen-reader-text"> "%s"</span>', 'cybernauci' ),
			                        get_the_title()
		                        ),
		                        '<span class="edit-link">',
		                        '</span>'
	                        );
	                        ?>
                        </footer><!-- .entry-footer -->
                    </article><!-- #post-## -->
		            <?
	            endwhile;
	            ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
