<?php get_header(); ?>

<div id="kontakt">
    <div class="info container-block">
        <div class="container mainblock">
            <img src="<?php bloginfo('template_directory'); ?>/img/sidebanner-left-computer.png"
                 class="sidebanner sidebanner-left" alt=""/>
            <img src="<?php bloginfo('template_directory'); ?>/img/sidebanner-right-planet.png"
                 class="sidebanner sidebanner-right" alt=""/>

            <header class="entry-header">
                <h2 class="entry-title">Masz pytanie?</h2>
            </header>
            <div class="entry-content">
                <div class="info col-xs-12 col-md-10 col-md-offset-1">
                    <? echo get_field('info') ?>
                </div>
                <div class="aboutUs col-xs-12 col-md-10 col-md-offset-1">
                    <? echo get_field('about_us') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
