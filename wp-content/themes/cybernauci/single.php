<?php get_header(); ?>

<?php if (has_category('katalog')) { ?>
    <div id="katalog" class="single">
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
                        <a title="wróć do listy" rel="bookmark"
                           href="<?php echo esc_url(get_permalink(get_page_by_title('Katalog'))); ?>"
                           class="back-to-list">wróć do listy</a>
                        <div class="katalog-meta-parent">Informacje<i class="glyphicon pull-right"></i></div>
                        <ul class="katalog-meta-content disabled">
                            <?php
                            $post_category = [];
                            foreach (wp_get_post_categories($post->ID) as $cat) {
                                $category = explode('/', get_category_parents($cat));
                                if (count($category) == 4) {
                                    $post_category[$category[1]] = $post_category[$category[1]] . ', ' . $category[2];
                                }
                            }
                            ksort($post_category);
                            foreach ($post_category as $l => $c) {
                                echo '<li class="cat-item"><strong>' . $l . '</strong>';
                                echo '<ul class="children">';
                                echo '<li class="cat-item">' . substr($c, 2) . '</li>';
                                echo '</ul>';
                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-md-9 katalog-list">
                        <?php
                        while (have_posts()) : the_post();
                            get_template_part('template-parts/content-katalog', 'single');

                            $prev_post = get_previous_post(true, '');
                            $next_post = get_next_post(true, '');

                            if (!empty($prev_post) || !empty($next_post)) {
                                echo '<h3 class="more-article">Podobne materiały</h3><div class="row">';
                                if (!empty($prev_post)) { ?>
                                    <div class="col-xs-12 col-md-6">
                                        <article id="post-<?php echo $prev_post->ID ?>">
                                            <header class="entry-header">
                                                <?php $image = get_field('Image', $prev_post->ID);
                                                if (!empty($image)) { ?>
                                                    <img class="img-responsive" src="<?php echo $image['url']; ?>"
                                                         alt=""/>
                                                <?php } ?>
                                                <small><?php echo get_the_date('d.m.Y', $prev_post->ID); ?></small>
                                                <h2 class="entry-title"><a
                                                        href="<? echo esc_url(get_permalink($prev_post->ID)); ?>"
                                                        rel="bookmark"><?php echo get_the_title($prev_post->ID); ?></a>
                                                </h2>
                                            </header>

                                            <div class="entry-content">
                                                <?php echo wp_trim_words($prev_post->post_content, 30) ?>
                                            </div>

                                            <footer class="entry-footer">
                                                <a class="readmore" href="<?php the_permalink($prev_post->ID) ?>"
                                                   rel="bookmark"
                                                   title="<?php echo sprintf(__('Continue reading %s', 'cybernauci'), get_the_title($prev_post->ID)) ?>"><? echo __('czytaj więcej', 'cybernauci') ?></a>
                                            </footer>
                                        </article>
                                    </div>
                                <? }
                                if (!empty($next_post)) { ?>
                                    <div class="col-xs-12 col-md-6">
                                        <article id="post-<?php echo $next_post->ID ?>">
                                            <header class="entry-header">
                                                <?php $image = get_field('Image', $next_post->ID);
                                                if (!empty($image)) { ?>
                                                    <img class="img-responsive" src="<?php echo $image['url']; ?>"
                                                         alt=""/>
                                                <?php } ?>
                                                <small><?php echo get_the_date('d.m.Y', $next_post->ID); ?></small>
                                                <h2 class="entry-title"><a
                                                        href="<? echo esc_url(get_permalink($next_post->ID)); ?>"
                                                        rel="bookmark"><?php echo get_the_title($next_post->ID); ?></a>
                                                </h2>
                                            </header>

                                            <div class="entry-content">
                                                <?php echo wp_trim_words($next_post->post_content, 30) ?>
                                            </div>

                                            <footer class="entry-footer">
                                                <a class="readmore" href="<?php the_permalink($next_post->ID) ?>"
                                                   rel="bookmark"
                                                   title="<?php echo sprintf(__('Continue reading %s', 'cybernauci'), get_the_title($next_post->ID)) ?>"><? echo __('czytaj więcej', 'cybernauci') ?></a>
                                            </footer>
                                        </article>
                                    </div>
                                    <?
                                }
                                echo '</div>';
                            }
                        endwhile;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div id="aktualnosci" class="single">
        <div class="info container-block">
            <div class="container mainblock">
                <img src="<?php bloginfo('template_directory'); ?>/img/sidebanner-left-computer.png"
                     class="sidebanner sidebanner-left" alt=""/>
                <img src="<?php bloginfo('template_directory'); ?>/img/sidebanner-right-planet.png"
                     class="sidebanner sidebanner-right" alt=""/>

                <header class="entry-header">
                    <h2 class="entry-title">Najnowsze informacje o projekcie</h2>
                </header>
            </div>

            <div class="aktualnosci-list">
                <div class="container mainblock">
                    <div class="col-xs-12 col-md-2">
                        <a title="wróć do listy" rel="bookmark"
                           href="<?php echo esc_url(get_permalink(get_page_by_title('Aktualności'))); ?>"
                           class="back-to-list">wróć
                            do listy</a>
                        <? if (is_singular('attachment')) {
                            the_post_navigation(array(
                                'prev_text' => _x('<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'cybernauci'),
                            ));
                        } ?>
                    </div>
                    <div class="col-xs-12 col-md-6 col-md-offset-1">
                        <?php
                        while (have_posts()) : the_post();
                            get_template_part('template-parts/content-aktualnosci', 'single');

                            $prev_post = get_previous_post(true, '');
                            $next_post = get_next_post(true, '');

                            if (!empty($prev_post) || !empty($next_post)) {
                                echo '<h3 class="more-article">Czytaj również</h3><div class="row">';
                                if (!empty($prev_post)) { ?>
                                    <div class="col-xs-12 col-md-6">
                                        <article id="post-<?php echo $prev_post->ID ?>">
                                            <header class="entry-header">
                                                <?php $image = get_field('Image', $prev_post->ID);
                                                if (!empty($image)) { ?>
                                                    <img class="img-responsive" src="<?php echo $image['url']; ?>"
                                                         alt=""/>
                                                <?php } ?>
                                                <small><?php echo get_the_date('d.m.Y', $prev_post->ID); ?></small>
                                                <h2 class="entry-title"><a
                                                        href="<? echo esc_url(get_permalink($prev_post->ID)); ?>"
                                                        rel="bookmark"><?php echo get_the_title($prev_post->ID); ?></a>
                                                </h2>
                                            </header>

                                            <div class="entry-content">
                                                <?php echo wp_trim_words($prev_post->post_content, 30) ?>
                                            </div>

                                            <footer class="entry-footer">
                                                <a class="readmore" href="<?php the_permalink($prev_post->ID) ?>"
                                                   rel="bookmark"
                                                   title="<?php echo sprintf(__('Continue reading %s', 'cybernauci'), get_the_title($prev_post->ID)) ?>"><? echo __('czytaj więcej', 'cybernauci') ?></a>
                                            </footer>
                                        </article>
                                    </div>
                                <? }
                                if (!empty($next_post)) { ?>
                                    <div class="col-xs-12 col-md-6">
                                        <article id="post-<?php echo $next_post->ID ?>">
                                            <header class="entry-header">
                                                <?php $image = get_field('Image', $next_post->ID);
                                                if (!empty($image)) { ?>
                                                    <img class="img-responsive" src="<?php echo $image['url']; ?>"
                                                         alt=""/>
                                                <?php } ?>
                                                <small><?php echo get_the_date('d.m.Y', $next_post->ID); ?></small>
                                                <h2 class="entry-title"><a
                                                        href="<? echo esc_url(get_permalink($next_post->ID)); ?>"
                                                        rel="bookmark"><?php echo get_the_title($next_post->ID); ?></a>
                                                </h2>
                                            </header>

                                            <div class="entry-content">
                                                <?php echo wp_trim_words($next_post->post_content, 30) ?>
                                            </div>

                                            <footer class="entry-footer">
                                                <a class="readmore" href="<?php the_permalink($next_post->ID) ?>"
                                                   rel="bookmark"
                                                   title="<?php echo sprintf(__('Continue reading %s', 'cybernauci'), get_the_title($next_post->ID)) ?>"><? echo __('czytaj więcej', 'cybernauci') ?></a>
                                            </footer>
                                        </article>
                                    </div>
                                    <?
                                }
                                echo '</div>';
                            }
                        endwhile;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<? } ?>

<?php get_footer(); ?>
