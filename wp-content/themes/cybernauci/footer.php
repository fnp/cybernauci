</div><!-- #accessibility-skip-to-content -->
<div class="site-container">
  <div class="container">
    <div class="container-block overflowHidden">
      <footer class="site-footer" role="contentinfo">
        <div class="col-xs-12">
			<?php if ( has_nav_menu( 'primary' ) ) : ?>
              <nav class="main-navigation" role="navigation"
                   aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'cybernauci' ); ?>">
				  <?php
				  wp_nav_menu( array(
					  'theme_location' => 'primary',
					  'menu_class'     => 'primary-menu pull-left',
				  ) );
				  ?>
              </nav><!-- .main-navigation -->
			<?php endif; ?>

			<?php if ( has_nav_menu( 'social' ) ) : ?>
              <nav class="social-navigation" role="navigation"
                   aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'cybernauci' ); ?>">
				  <?php
				  wp_nav_menu( array(
					  'theme_location' => 'social',
					  'menu_class'     => 'social-links-menu pull-left',
					  'depth'          => 1,
					  'link_before'    => '<span class="screen-reader-text">',
					  'link_after'     => '</span>',
				  ) );
				  ?>
              </nav><!-- .social-navigation -->
			<?php endif; ?>
        </div>
        <div class="site-info">
          <div class="col-xs-12">
            <p><span>Projekt realizowany przez: <a href="https://nowoczesnapolska.org.pl/"
                                                   target="_blank"><img
                      src="<?php bloginfo( 'template_directory' ); ?>/img/footer-logo-nowoczesna_polska.png"
                      alt=""/></a></span>
              <span>Partner: <a href="http://www.civitas.edu.pl/" target="_blank"><img
                      src="<?php bloginfo( 'template_directory' ); ?>/img/footer-logo-collegium_civitas.png"
                      alt=""/></a></span>
              <span>Patronat honorowy: <a href="https://mc.gov.pl/" target="_blank"><img
                      src="<?php bloginfo( 'template_directory' ); ?>/img/footer-logo-ministerstwo_cyfryzacji.png"
                      alt=""/></a><a href="http://brpd.gov.pl/" target="_blank"><img
                      src="<?php bloginfo( 'template_directory' ); ?>/img/footer-logo-rzecznik_praw_dziecka.png"
                      alt=""/></a><a href="http://www.ore.edu.pl/" target="_blank"><img
                      src="<?php bloginfo( 'template_directory' ); ?>/img/footer-logo-ore.png"
                      alt=""/></a></span></p>
            <p>Projekt jest finansowany ze środków: <a href="https://men.gov.pl/" target="_blank"><img
                    src="<?php bloginfo( 'template_directory' ); ?>/img/footer-logo-ministerstwo_edukacji_narodowej.png"
                    alt=""/></a></p>
          </div>
          <div class="col-xs-12">
            <p>Jeśli nie oznaczono inaczej, wszystkie materiały na stronie są objęte wolną licencją Creative
              Commons Uznanie autorstwa – Na tych samych warunkach 3.0.</p>
          </div>
        </div>
        <ul class="col-xs-12 site-info-footer">
          <li>
            <a href="https://nowoczesnapolska.org.pl/prywatnosc/" target="_blank">Polityka prywatności</a>
          </li>
        </ul>
      </footer>
    </div>
  </div>

	<?php wp_footer(); ?>
</div>

<script src="<?php bloginfo( 'template_directory' ); ?>/libs/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="<?php bloginfo( 'template_directory' ); ?>/js/theme.js"></script>

<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || []
  _paq.push(['setDomains', ['*.cybernauci.edu.pl', '*.cybernauci.edu.pl']])
  _paq.push(['trackPageView'])
  _paq.push(['enableLinkTracking']);
  (function () {
    var u = '//piwik.nowoczesnapolska.org.pl/'
    _paq.push(['setTrackerUrl', u + 'piwik.php'])
    _paq.push(['setSiteId', 25])
    var d = document, g = d.createElement('script'), s = d.getElementsByTagName('script')[0]
    g.type = 'text/javascript'
    g.async = true
    g.defer = true
    g.src = u + 'piwik.js'
    s.parentNode.insertBefore(g, s)
  })()
</script>
<noscript><p><img src="//piwik.nowoczesnapolska.org.pl/piwik.php?idsite=25" style="border:0;" alt=""/></p></noscript>
<!-- End Piwik Code -->

</body>
</html>
