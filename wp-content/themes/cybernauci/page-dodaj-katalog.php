<?php get_header(); ?>

    <div id="katalog">
        <div class="info container-block">
            <div class="container mainblock">
                <img src="<?php bloginfo('template_directory'); ?>/img/sidebanner-left-computer.png"
                     class="sidebanner sidebanner-left" alt=""/>
                <img src="<?php bloginfo('template_directory'); ?>/img/sidebanner-right-rockets.png"
                     class="sidebanner sidebanner-right" alt=""/>

                <header class="entry-header">
                    <h2 class="entry-title">Dodawanie katalogu</h2>
                </header>
                <div class="entry-content">git status
                    <div class="innerBlock col-xs-12 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                        <? if (function_exists('ninja_forms_display_form')) {
                            ninja_forms_display_form(11);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php get_footer(); ?>