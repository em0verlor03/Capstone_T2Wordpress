<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Utopia
 * @since Utopia 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
    <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
        <!--[if lt IE 9]>
        <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
        <![endif]-->
              <?php wp_head(); ?>
<?php
    $utopia_logo = get_theme_mod( 'logo_placement' );
    if( $utopia_logo != '' ) {
        switch ( $utopia_logo ) {
            case 'center':
                // Do nothing. The theme already aligns the logo to the left
                break;
            case 'right':
                echo '<style type="text/css">';
                echo '.site-header h1, .site-header h2{ text-align: right; }';
                echo '</style>';
                break;
            case 'left':
                echo '<style type="text/css">';
                echo '.site-header h1, .site-header h2{ text-align: left; }';
                  echo '</style>';
                break;
        }
    }
?>


    </head>

    <body <?php body_class(); ?>>

        <div class="wrapper">
            <?php
            // Display Top Navigation
            if (has_nav_menu('secondary')) :
                ?>
                <nav class="navbar navbar-default" role="navigation">
                    <!-- Mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#topnav-menu">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <nav id="topnav" class="clearfix" role="navigation">
                        <p id="topnav-icon"></p>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'secondary',
                            'container' => false,
                            'menu_id' => 'topnav-menu',
                             'menu_class' => 'collapse navbar-collapse main-nav',
                            'fallback_cb' => '',
                            'depth' =>3,
                              'walker' => new wp_bootstrap_navwalker()
                            )
                        );
                        ?>
                    </nav> 
                </nav>
            <?php endif; ?>
            <div class="container main" id="top">
                <header id="masthead" class="site-header" role="banner">                 
                    <hgroup>
                            <?php if (get_theme_mod('utopia_logo')) :; ?>
                            <div class="site-logo">
                                <h1 class="site-title"><a href='<?php echo esc_url(home_url('/')); ?>' title='<?php echo esc_attr(get_bloginfo('name', 'display')); ?>' rel='home'><img src='<?php echo esc_url(get_theme_mod('utopia_logo')); ?>' alt='<?php echo esc_attr(get_bloginfo('name', 'display')); ?>'></h1>
                                        </div>
                                        <?php else : ?>
                                        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                                        <h2 class="site-description"><?php bloginfo('description'); ?></h2>
                                        </hgroup>
                                    <?php endif;
                                    ?>
                                    <?php if (get_header_image()) : ?>
                                        <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php header_image(); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
                                        <?php endif; ?>
                                   <nav class="navbar navbar-default" role="navigation">
                                        <!-- Mobile display -->
                                        <div class="navbar-header">
                                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu">
                                                <span class="sr-only">Toggle navigation</span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                            </button>
                                        </div>
                                        <nav role="navigation" class="site-navigation main-navigation">
                                            <?php
                                            wp_nav_menu(array('theme_location' => 'primary',
                                                'container' => false, 
                                                 'menu_class' => 'collapse navbar-collapse main-nav',
                                                 'fallback_cb' => '',
                                                'menu_id' => 'main-menu',
                                                'depth' => 3,
                                                'walker' => new wp_bootstrap_navwalker()));
                                            ?>
                                        </nav> 
                                    </nav>
                                    </header><!-- #masthead -->
                                    <div class="row">