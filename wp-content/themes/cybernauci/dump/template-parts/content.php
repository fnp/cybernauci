<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Cybernauci
 * @since Cybernauci 1.0
 */
?>

<div class="col-xs-12 col-md-3">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <?php if (is_sticky() && is_home() && !is_paged()) : ?>
                <span class="sticky-post"><?php _e('Featured', 'cybernauci'); ?></span>
            <?php endif; ?>

            <?php $image = get_field('Image'); ?>
            <img class="img-responsive" src="<?php echo $image['url']; ?>" alt=""/>
            <small><?php echo get_the_date('d.m.Y'); ?></small>
            <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
        </header><!-- .entry-header -->

        <?php cybernauci_excerpt(); ?>

        <?php cybernauci_post_thumbnail(); ?>

        <div class="entry-content">
            <?php
            /* translators: %s: Name of current post */
            the_content(sprintf(
                __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'cybernauci'),
                get_the_title()
            ));

            wp_link_pages(array(
                'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'cybernauci') . '</span>',
                'after' => '</div>',
                'link_before' => '<span>',
                'link_after' => '</span>',
                'pagelink' => '<span class="screen-reader-text">' . __('Page', 'cybernauci') . ' </span>%',
                'separator' => '<span class="screen-reader-text">, </span>',
            ));
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
                '<span class="edit-link float-right">',
                '</span>'
            );
            ?>
        </footer><!-- .entry-footer -->
    </article><!-- #post-## -->
</div>