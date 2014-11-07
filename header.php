<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php bloginfo('name'); ?></title>
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width">
        <?php wp_head(); ?>
    </head>
	<body <?php body_class(); ?>>

    <div id="kanye-west">
        
        <div id="login-wrapper" class="clearfix">

            <div class="login">

                <?php if ( !is_user_logged_in() ) : ?>
                    <?php wp_login_form(); ?>
                <?php endif; ?>
               
                <ul class="login-options clearfix">
                    <li><a href="<?php bloginfo('url' ); ?>/my-membership">Members Area</a></li>
                    <li><a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">Logout</a></li>
                </ul>                
            </div>

            <button class="js-login">
                <i class="icon-login"></i>
                <span>Members Login</span>
            </button>    
        </div><!-- .login -->

        <header id="header" class="mega">
            <div class="logo-big">
                <a href="<?php echo bloginfo('url'); ?> ">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo-header.png" alt="">
                </a>
            </div>
            <div class="logo-small halign">
                <a href="<?php echo bloginfo('url'); ?> ">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo-footer.png" alt="">
                </a>
            </div>

            <nav id="nav" class="clearfix">
                <div class="mobile-menu left">
                    <button aria-role="Mobile Menu Button" class="mob-button">
                        <i class="icon-menu"></i>
                        <span>Menu</span>
                    </button>
                </div>

                <?php 
                    $args = array(
                        'theme_location' => 'header_nav',
                        'menu' => '',
                        'container' => '',
                    );

                    wp_nav_menu( $args ); 
                ?>
            </nav>
        </header>