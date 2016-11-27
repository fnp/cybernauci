<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
    <link
            href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic,300italic,300&subset=latin,latin-ext'
            rel='stylesheet' type='text/css'>
    <link href="<?php bloginfo( 'template_directory' ); ?>/libs/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="cybernauci-site" class="container">
    <div class="container-block">
        <a class="skip-link screen-reader-text"
           href="#accessibility-skip-to-content"><?php _e( 'Skip to content', 'cybernauci' ); ?></a>

        <header class="site-header" role="banner">
            <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4">
	            <?php if ( is_front_page() && is_home() ) {
		            echo '<h1 class="site-title">';
	            } else {
		            echo '<p class="site-title">';
	            } ?>

                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>"><img
                            src="<?php bloginfo( 'template_directory' ); ?>/img/logo.png" alt=""/></a>

	            <?php if ( is_front_page() && is_home() ) {
		            echo '</h1>';
	            } else {
		            echo '</p>';
	            } ?>
            </div>


	        <?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>
                <div class="site-header-menu col-xs-12 col-sm-6 col-md-7 col-lg-8">
	                <?php if ( has_nav_menu( 'primary' ) ) : ?>
                        <nav id="site-navigation" class="main-navigation" role="navigation"
                             aria-label="<?php esc_attr_e( 'Primary Menu', 'cybernauci' ); ?>">
	                        <?php
	                        wp_nav_menu( array(
		                        'theme_location' => 'primary',
		                        'menu_class'     => 'primary-menu',
	                        ) );
	                        ?>
                        </nav><!-- .main-navigation -->
	                <?php endif; ?>

	                <?php if ( has_nav_menu( 'social' ) ) : ?>
                        <nav id="social-navigation" class="social-navigation" role="navigation"
                             aria-label="<?php esc_attr_e( 'Social Links Menu', 'cybernauci' ); ?>">
	                        <?php
	                        wp_nav_menu( array(
		                        'theme_location' => 'social',
		                        'menu_class'     => 'social-links-menu pull-right',
		                        'depth'          => 1,
		                        'link_before'    => '<span class="screen-reader-text">',
		                        'link_after'     => '</span>',
	                        ) );
	                        ?>
                        </nav><!-- .social-navigation -->
	                <?php endif; ?>
                </div><!-- .site-header-menu -->
	        <?php endif; ?>

        </header><!-- .site-header -->
    </div>
</div>
<div id="accessibility-skip-to-content">