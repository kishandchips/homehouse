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

        <div id="login">

            <div class="login-overlay"></div><!-- .login overlay -->
            <div class="login-modal valign">
                <button class="button login-close" aria-role="toggle login form">
                    <i class="icon-cross"></i>
                </button>

                <?php if ( !is_user_logged_in() ) : ?>
                    
                    <p class="heading">Registered Members</p>

                    <?php wp_login_form(); ?>
                    
                    <p class="instructions-prompt">If you have trouble logging in, click on the info icon for login instructions. It would be helpful to have your membership card handy.  
                        <button class="button info-toggle" aria-role="toggle login info">
                            <i  class="icon-info"></i>
                        </button>
                    </p>

                    <ul class="instructions">
                        <li>Your username is your name, <b>only</b> as is written on your membership card.</li>
                        <li>Your password is your <b>membership number</b> as written on your membership card.</li>
                        <li>If after trying the instructions above, you still have trouble logging into the site,
                        please <a href="mailto:oana@homehouse.co.uk?subject:Website%20Login">get in touch.</a></li>
                    </ul>
                <?php endif; ?>

            </div><!-- .login -->   
        </div><!-- #login -->

        <div id="login-bar" class="clearfix">
            <div class="login-options">
                <ul class="clearfix">
                    <li><a href="<?php bloginfo('url' ); ?>/my-membership">Members Area</a></li>
                    <?php $user = wp_get_current_user(); ?>
                    <li>
                        <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">Logout - <?php echo $user->display_name; ?></a>
                    </li>
                </ul>                
            </div>   
        </div><!-- #login-bar -->

        <header id="header">
            <button class="js-login">
                <span>Login</span>
            </button> 

            <div class="logo-big">
                <a href="<?php echo bloginfo('url'); ?> ">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo-header.png" alt="">
                </a>
            </div>
            <div class="logo-small">
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