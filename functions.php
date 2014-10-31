<?php
define('THEME_NAME', 'Homehouse');
$template_directory_uri = get_template_directory_uri();

// Enable Features
	add_theme_support( 'post-thumbnails' );
	add_editor_style('/css/editor-style.css');
	register_nav_menus(array(
		'header_nav' => 'Main Header Menu',
		'footer_nav' => 'Footer Menu',
		'' => '')
	);

// Image sizes
	add_image_size( 'slider', 1600, 700, true );
	add_image_size( 'grid-square', 525, 525, true );
	add_image_size( 'grid-rect-med', 800, 500, true );
	add_image_size( 'grid-rect-large', 1100, 500, true );

// Scripts Etc
function custom_styles(){
	wp_enqueue_style('fonts', 'http://fonts.googleapis.com/css?family=Crimson+Text');
	wp_enqueue_style('main', get_template_directory_uri() . '/css/main.css');
}

function custom_scripts(){
	global $template_directory_uri;
	
	wp_register_script('mapkey', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCHQcusxyrL3CHhKQ_Ui_MF78sMeOs84es', array('jquery'), '', false);

	wp_enqueue_script('modernizr', $template_directory_uri . '/js/vendor/modernizr-2.6.1.min.js', array('jquery'), '', false);
	wp_enqueue_script('videojs', '//vjs.zencdn.net/4.9/video.js', array('jquery'), '');
	wp_enqueue_script('flexslider', $template_directory_uri . '/js/plugins/jquery.flexslider.js', array('jquery'), '', true);
	wp_enqueue_script('imagesloaded', $template_directory_uri . '/js/plugins/imagesloaded.js', array('jquery'), '', true);
	wp_enqueue_script('isotope', $template_directory_uri . '/js/plugins/isotope.js', array('jquery'), '', true);
	wp_enqueue_script('matchheight', $template_directory_uri . '/js/plugins/matchheight.js', array('jquery'), '', true);
	wp_enqueue_script('main', $template_directory_uri . '/js/main.js', array('jquery'), '', true);
	
	wp_localize_script( 'main', 'url', array(
		'template' => $template_directory_uri,
		'base' => site_url(),
	));
}

// Add Actions
	add_action( 'wp_enqueue_scripts', 'custom_styles', 30 );
	add_action( 'wp_enqueue_scripts', 'custom_scripts', 30 );
	add_action( 'init', 'create_post_type' );
	add_action( 'init', 'offer_category' );

// Custom Post Type
function create_post_type() {
	register_post_type( 'love-from-cedric',
		array(
			'labels' => array(
				'name' => __( 'Love from Cedric' ),
				'singular_name' => __( 'Love from Cedric' ),
				'add_new' => __('Add Offer'),
				'search_items' => __('Search Offers'),
				'not_found' => __('No Offers Found')
			),
		'public' => true,
		'hierarchical' => true,
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'page-attributes'
			)
		)
	);
}

// Register Taxonomy
function offer_category() {

	$labels = array(
		'name'					=> _x( 'Offer Categories', 'Taxonomy plural name', 'text-domain' ),
		'singular_name'			=> _x( 'Offer Category', 'Taxonomy singular name', 'text-domain' ),
		'search_items'			=> __( 'Search Offer Categories', 'text-domain' ),
		'popular_items'			=> __( 'Popular Offer Categories', 'text-domain' ),
		'all_items'				=> __( 'All Offer Categories', 'text-domain' ),
		'parent_item'			=> __( 'Parent Offer Category', 'text-domain' ),
		'parent_item_colon'		=> __( 'Parent Offer Category', 'text-domain' ),
		'edit_item'				=> __( 'Edit Offer Category', 'text-domain' ),
		'update_item'			=> __( 'Update Offer Category', 'text-domain' ),
		'add_new_item'			=> __( 'Add New Offer Category', 'text-domain' ),
		'new_item_name'			=> __( 'New Offer Category', 'text-domain' ),
		'add_or_remove_items'	=> __( 'Add or remove Offer Category', 'text-domain' ),
		'choose_from_most_used'	=> __( 'Choose from most used Offer Categories', 'text-domain' ),
		'menu_name'				=> __( 'Offer Category', 'text-domain' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => true,
		'hierarchical'      => false,
		'show_tagcloud'     => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
		'capabilities'      => array(),
	);

	register_taxonomy( 'offer-category', array( 'love-from-cedric' ), $args );
}

// SIDEBAR
add_action( 'widgets_init', 'my_sidebars' );

function my_sidebars() {
	/* Register the 'primary' sidebar. */
	register_sidebar(
		array(
			'id' => 'primary',
			'name' => __( 'Sidebar' ),
			'description' => __( 'Sidebar' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);
	/* Register the 'blog' sidebar. */
	register_sidebar(
		array(
			'id' => 'blog',
			'name' => __( 'Blog' ),
			'description' => __( 'Blog Sidebar' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);
}

// EXCLUDE CATEGORIES FROM CATEGORIES WIDGET
function exclude_widget_categories($args){
$exclude = "13,14,15"; //House 19,20,21 - The IDs of the excluding categories 
$args["exclude"] = $exclude;
return $args;
}
add_filter("widget_categories_args","exclude_widget_categories");


// WORDPRESS COOKIE

function set_newuser_cookie() {
	if ( !is_admin() && !isset($_COOKIE['HomehouseVisit'])) {
		setcookie('HomehouseVisit', 1, time()+3600*24*30, COOKIEPATH, COOKIE_DOMAIN, false);
	}
}
add_action( 'init', 'set_newuser_cookie');


// WORDPRESS LOGO

function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/site-login-logo.jpg);
           	background-size: cover;
			height: 150px;
			width: 150px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );


// SHORTCODES

function button($atts, $content = null) {
   extract(shortcode_atts(array('link' => '#','style' => 'primary', 'size'=> 'small'), $atts));
   return '<a class="button '.$style." ".$size.'" href="'.$link.'">' . do_shortcode($content) . '</a>';
}
add_shortcode('button', 'button');

function check_user ($params, $content = null){
  //check that the user is logged in
  if ( is_user_logged_in() ){
    //user is logged in so show the content
    return $content;
  }
  else{
    //user is not logged in so hide the content
    return;
  }
}
add_shortcode('loggedin', 'check_user' );

// Filters
add_filter( 'widget_title', '__return_false' );

add_action( 'profile_update', 'hh_profile_update', 10, 2);

function hh_profile_update($user_id, $old_user_data ) {
	$new_data = get_userdata($user_id);
	$membership_id = get_user_meta($user_id, 'membership_id', true);
	$phone = get_user_meta($user_id, 'event_espresso_phone', true);

	$admin_email = "last-spartan@hotmail.com";
	$headers[] = 'From: HomeHouse <info@homehouse.co.uk>';
    $message = sprintf( __( 'This user has updated their profile on the HomeHouse.' ) ) . "\r\n\r\n";
    $message .= sprintf( __( 'Display Name: %s' ), $new_data->display_name ). "\r\n\r\n";
    $message .= sprintf( __( 'Membership ID: %s' ), $membership_id ). "\r\n\r\n";
    $message .= sprintf( __( 'Email: %s' ), $new_data->user_email ). "\r\n\r\n";
    $message .= sprintf( __( 'Phone: %s' ), $phone ). "\r\n\r\n";

    wp_mail( $admin_email, sprintf( __( 'User Profile Update' ), get_option('blogname') ), $message, $headers );
}
