<?php get_header(); ?>

<div id="rejestracja">
    <div class="info container-block">
        <div class="container mainblock">
            <img src="<?php bloginfo( 'template_directory' ); ?>/img/sidebanner-left-computer.png"
                 class="sidebanner sidebanner-left" alt=""/>
            <img src="<?php bloginfo( 'template_directory' ); ?>/img/sidebanner-right-rockets.png"
                 class="sidebanner sidebanner-right" alt=""/>

            <header class="entry-header">
                <h2 class="entry-title">Ups!</h2>
            </header>
            <div class="entry-content">
                <div class="innerBlock col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                    <p>Stronę, którą poszukujesz nie znajduje się już w naszym serwisie (bądź nigdy jej nie było).<br/>
                        Nie martw się - na pocieszenie masz sweet foteczkę kotka.</p>

                    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                        <img class="img-responsive"
                             src="https://placekitten.com/800/600?image=<?php echo mt_rand( 0, 15 ); ?>" alt=""/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
