<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        <?php $image = get_field('Image'); ?>
        <img class="img-responsive" src="<?php echo $image['url']; ?>" alt=""/>
    </header><!-- .entry-header -->

    <?php cybernauci_excerpt(); ?>

    <?php cybernauci_post_thumbnail(); ?>

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(array(
            'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'cybernauci') . '</span>',
            'after' => '</div>',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'pagelink' => '<span class="screen-reader-text">' . __('Page', 'cybernauci') . ' </span>%',
            'separator' => '<span class="screen-reader-text">, </span>',
        ));

        if ('' !== get_the_author_meta('description')) {
            get_template_part('template-parts/biography');
        }
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php
        edit_post_link(
            sprintf(
            /* translators: %s: Name of current post */
                __('Edit<span class="screen-reader-text"> "%s"</span>', 'cybernauci'),
                get_the_title()
            ),
            '<span class="edit-link pull-right">',
            '</span>'
        );
        ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
