</div><!-- #accessibility-skip-to-content -->
<div class="site-container">
    <div class="container">
        <div class="container-block">
            <footer class="site-footer" role="contentinfo">
                <div class="col-xs-12">
                    <?php if (has_nav_menu('primary')) : ?>
                        <nav class="main-navigation" role="navigation"
                             aria-label="<?php esc_attr_e('Footer Primary Menu', 'cybernauci'); ?>">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_class' => 'primary-menu pull-left',
                            ));
                            ?>
                        </nav><!-- .main-navigation -->
                    <?php endif; ?>

                    <?php if (has_nav_menu('social')) : ?>
                        <nav class="social-navigation" role="navigation"
                             aria-label="<?php esc_attr_e('Footer Social Links Menu', 'cybernauci'); ?>">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'social',
                                'menu_class' => 'social-links-menu pull-left',
                                'depth' => 1,
                                'link_before' => '<span class="screen-reader-text">',
                                'link_after' => '</span>',
                            ));
                            ?>
                        </nav><!-- .social-navigation -->
                    <?php endif; ?>
                </div>

                <div class="site-info">
                    <div class="col-xs-12">
                        <p><span>Projekt realizowany przez: <img
                                    src="<?php bloginfo('template_directory'); ?>/img/footer-logo-nowoczesna_polska.png"
                                    alt=""/></span>
                            <span>Partner: <img
                                    src="<?php bloginfo('template_directory'); ?>/img/footer-logo-collegium_civitas.png"
                                    alt=""/></span>
                            <span>Patronat honorowy: <img
                                    src="<?php bloginfo('template_directory'); ?>/img/footer-logo-ministerstwo_cyfryzacji.png"
                                    alt=""/><img
                                    src="<?php bloginfo('template_directory'); ?>/img/footer-logo-rzecznik_praw_dziecka.png"
                                    alt=""/></span></p>
                        <p>Projekt jest finansowany ze środków: <img
                                src="<?php bloginfo('template_directory'); ?>/img/footer-logo-ministerstwo_edukacji_narodowej.png"
                                alt=""/></span></p>
                    </div>
                    <div class="col-xs-12">
                        <p>Jeśli nie oznaczono inaczej, wszystkie materiały na stronie są objęte wolną licencją Creative
                            Commons Uznanie autorstwa – Na tych samych warunkach 3.0.</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <?php wp_footer(); ?>
</div>

<script src="<?php bloginfo('template_directory'); ?>/libs/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>
