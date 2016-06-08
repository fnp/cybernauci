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
                    <h3>Adresaci</h3>
                    <ul>
                        <li>test</li>
                        <li class="active">test2</li>
                        <li>test3</li>
                    </ul>
                    <h3>Adresaci2</h3>
                    <ul>
                        <li>test11</li>
                        <li>test222</li>
                        <li>test3333</li>
                    </ul>
                </div>
                <div class="col-xs-12 col-md-9 katalog-list">
                    //test
                    <?php
                    $args = array(
                        'form_id' => 11,
                    );
                    /*$args = array(
                        'form_id'   => 11,
                        'fields'    => array(
                            '34'      => 'checked',
                            '54'      => 'Hello World',
                        ),
                    );*/
                    $subs = Ninja_Forms()->subs()->get($args);
                    print_r($subs);
                    foreach ($subs as $sub) {
                        $form_id = $sub->form_id;
                        $all_fields = $sub->get_all_fields();

                        echo $sub->get_field(50); ?>
                        <div class="col-xs-12 col-md-3">
                            <article id="post-<?php echo $sub->get_field('sub_id') ?>">
                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="#"
                                                               rel="bookmark"><? echo $sub->get_field(50); ?></a></h2>
                                </header>

                                <div class="entry-content">
                                    <?php echo $sub->get_field(49) ?>
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
                    <?
                    }

                    the_posts_pagination(array(
                        'prev_text' => __('Previous page', 'cybernauci'),
                        'next_text' => __('Next page', 'cybernauci'),
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'cybernauci') . ' </span>',
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
