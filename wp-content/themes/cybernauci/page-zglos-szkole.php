<?php get_header(); ?>

<div id="rejestracja">
    <div class="info container-block">
        <div class="container mainblock">
            <img src="<?php bloginfo('template_directory'); ?>/img/sidebanner-left-computer.png"
                 class="sidebanner sidebanner-left" alt=""/>
            <img src="<?php bloginfo('template_directory'); ?>/img/sidebanner-right-rockets.png"
                 class="sidebanner sidebanner-right" alt=""/>

            <header class="entry-header">
                <h2 class="entry-title">Formularz rejestracyjny</h2>
            </header>
            <div class="entry-content">
                <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <?php echo get_field('rejestracja_wprowadzenie'); ?>
                </div>
                <div class="innerBlock col-xs-12 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                    <? the_content(sprintf(
                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'cybernauci'),
                        get_the_title()
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
