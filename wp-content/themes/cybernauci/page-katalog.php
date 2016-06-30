<?php get_header(); ?>

<div id="katalog">
    <div class="info container-block">
        <div class="container mainblock">
            <img src="<?php bloginfo('template_directory'); ?>/img/sidebanner-left-computer.png"
                 class="sidebanner sidebanner-left" alt=""/>
            <img src="<?php bloginfo('template_directory'); ?>/img/sidebanner-right-planet.png"
                 class="sidebanner sidebanner-right" alt=""/>

            <header class="entry-header">
                <h2 class="entry-title">Katalog materiałów</h2>
            </header>
        </div>
        <div class="katalog-content">
            <div class="container mainblock">
                <div class="col-xs-12 col-md-3 katalog-meta">
                    <div class="katalog-meta-parent">Filtruj<i class="glyphicon pull-right"></i></div>
                    <ul class="katalog-meta-content">
                        <li class="addKatalogBtn">
                            <a href="/dodaj-material/">Dodaj nowy materiał</a>
                        </li>
                        <?php
                        $subTree = false;
                        $katalogID = get_category_by_slug('katalog')->cat_ID;
                        $categories = get_categories(array(
                            'orderby' => 'name',
                            'child_of' => get_category_by_slug('katalog')->cat_ID,
                            'title_li' => '',
                        ));
                        foreach ($categories as $cat) {
                            if ($cat->parent == $katalogID && $subTree) {
                                echo '</ul></li>';
                                $subTree = false;
                            }
                            if ($cat->parent !== $katalogID && !$subTree) {
                                echo '<ul class="children">';
                                $subTree = true;
                            }
                            echo '<li class="cat-item cat-item-' . $cat->cat_ID . '"><a href="/category/katalog/?filter_list=' . $cat->cat_ID . '">' . $cat->name . '</a>';
                        }
                        if ($subTree) {
                            echo '</ul></li>';
                            $subTree = false;
                        } else {
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-xs-12 col-md-9 katalog-list">
                    <?php
                    $args = array(
                        'category_name' => 'katalog',
                        'posts_per_page' => 999999
                    );
                    $wp_posts = query_posts($args);
                    if ($wp_posts) {
                        foreach ($wp_posts as $post):
                            setup_postdata($post); ?>
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <header class="entry-header">
                                        <?php $image = get_field('Image');
                                        if (!empty($image)) { ?>
                                            <div class="image-holder">
                                                <img class="img-responsive" src="<?php echo $image['url']; ?>" alt=""/>
                                            </div>
                                        <?php } ?>
                                        <h2 class="entry-title">
                                            <a href="<?php the_permalink() ?>" rel="bookmark">
                                                <?php if (strlen($post->post_title) > 35) {
                                                    echo substr(the_title($before = '', $after = '', FALSE), 0, 35) . '...';
                                                } else {
                                                    the_title();
                                                } ?>
                                            </a>
                                        </h2>
                                    </header>

                                    <div class="entry-content">
                                        <?php echo wp_trim_words(get_the_content(), 14) ?>
                                    </div>

                                    <footer class="entry-footer">
                                        <a class="readmore" href="<?php the_permalink() ?>" rel="bookmark"
                                           title="<?php echo sprintf(__('Continue reading %s', 'cybernauci'), get_the_title()) ?>"><? echo __('czytaj więcej', 'cybernauci') ?></a>
                                        <?php
                                        edit_post_link(
                                            sprintf(
                                                __('Edit<span class="screen-reader-text"> "%s"</span>', 'cybernauci'),
                                                get_the_title()
                                            ),
                                            '<span class="edit-link pull-right">',
                                            '</span>'
                                        );
                                        ?>
                                    </footer>
                                </article>
                            </div>
                        <? endforeach;
                    }

                    the_posts_pagination(array(
                        'prev_text' => '&laquo',
                        'next_text' => '&raquo'
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
