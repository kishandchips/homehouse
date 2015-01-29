<?php
define('THEME_NAME', 'Homehouse');
$template_directory_uri = get_template_directory_uri();

// Enable Features
	add_theme_support( 'post-thumbnails' );
	add_editor_style('/css/editor-style.css');
	register_nav_menus(array(
		'header_nav' => 'Main Header Menu',
		'footer_nav' => 'Footer Menu',
		)
	);

// Image sizes
	// Slider
	add_image_size( 'slider', 1600, 700, true );
	// add_image_size( 'slider-tablet', 768, 600, true);
	// add_image_size( 'slider-mob', 480, 350, true);

	// Grid large rectangle eg.bedrooms
	add_image_size( 'grid-rect-large', 1100, 500, true );
	// add_image_size( 'grid-rect-large-tablet', 725, 350, true );
	// add_image_size( 'grid-rect-large-mob', 470, 250, true );
	
	// Grid medium rectangle eg.restaurants on home
	add_image_size( 'grid-rect-med', 800, 500, true );
	// add_image_size( 'grid-rect-med-tablet', 374, 350, true );
	// add_image_size( 'grid-rect-med-mob', 350, 250, true );


	//GRID Square
	add_image_size( 'grid-square', 525, 525, true );
	// add_image_size( 'grid-square-tablet', 246, 246, true );
	// add_image_size( 'grid-square-mob', 230, 230, true );	

// Remove unnecessary code
	remove_action('wp_head', 'feed_links', 2);  
	remove_action('wp_head', 'feed_links_extra', 3);  
	remove_action('wp_head', 'rsd_link');  
	remove_action('wp_head', 'wlwmanifest_link');  
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);  
	remove_action('wp_head', 'wp_generator'); 

// Scripts Etc
function custom_styles(){
	wp_enqueue_style('googlefonts', 'http://fonts.googleapis.com/css?family=Crimson+Text');
	wp_enqueue_style('fonts', '//fast.fonts.net/cssapi/7c3154b6-84d1-41cf-880b-8d493e275dd8.css');
	wp_enqueue_style('main', get_template_directory_uri() . '/css/main.css');
}

function custom_scripts(){
	global $template_directory_uri;
	
	wp_register_script('mapkey', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCHQcusxyrL3CHhKQ_Ui_MF78sMeOs84es', array('jquery'), '', true);
	wp_enqueue_script('modernizr', $template_directory_uri . '/js/vendor/modernizr-2.6.1.min.js', array('jquery'), '', true);
	wp_enqueue_script('video', $template_directory_uri . '/js/plugins/video.dev.js', array('jquery'), '', true);
	wp_enqueue_script('flexslider', $template_directory_uri . '/js/plugins/jquery.flexslider.js', array('jquery'), '', true);
	wp_enqueue_script('imagesloaded', $template_directory_uri . '/js/plugins/imagesloaded.js', array('jquery'), '', true);
	wp_enqueue_script('isotope', $template_directory_uri . '/js/plugins/isotope.js', array('jquery'), '', true);
	wp_enqueue_script('lazy', $template_directory_uri . '/js/plugins/blazy.min.js', array('jquery'), '', true);
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

// Filters
	add_filter( 'widget_title', '__return_false' );

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

// EMAIL ON USER UPDATE
add_action( 'profile_update', 'hh_profile_update', 10, 2);

function hh_profile_update($user_id, $old_user_data ) {
	$user = get_userdata($user_id);

	$membership_id 	= $user->membership_id;
	$name 			= $user->display_name;
	$old_email 		= $old_user_data->user_email;
	$email 			= $user->user_email;
	$old_phone 		= $user->event_espresso_phone;
	if ( !empty ( $_POST['event_espresso_phone'] ) )
	$phone 			= esc_attr( $_POST['event_espresso_phone'] );	

	$admin_email = "yogesh@homehouse.co.uk";
	$headers[] = 'From: HomeHouse <info@homehouse.co.uk>';
    $message = sprintf( __( 'This user has updated their profile on the HomeHouse website.' ) ) . "\r\n\r\n";
    $message .= sprintf( __( 'Display Name: %s' ), $name ). "\r\n\r\n";
    $message .= sprintf( __( 'Membership ID: %s' ), $membership_id ). "\r\n\r\n";

    if($old_email != $email){
 		$message .= sprintf( __( 'Old Email: %s' ), $old_email ). "\r\n\r\n";
		$message .= sprintf( __( 'New Email: %s' ), $email ). "\r\n\r\n";   	
    }

    if($old_phone != $phone){
		$message .= sprintf( __( 'Old Phone: %s' ), $old_phone ). "\r\n\r\n";
		$message .= sprintf( __( 'Phone: %s' ), $phone ). "\r\n\r\n";
    }

    wp_mail( $admin_email, sprintf( __( 'User Profile Update' ), get_option('blogname') ), $message, $headers );
}

// LOGIN REDIRECTS
function login_failed() {
	$login_page  = home_url( '/login/' );
	wp_redirect( $login_page . '?login=failed' );
	exit;
}
add_action( 'wp_login_failed', 'login_failed' );

function verify_username_password( $user, $username, $password ) {  
    $login_page  = home_url( '/login/' );  
    if( $username == "" || $password == "" ) {  
        wp_redirect( $login_page . "?login=empty" );  
        exit;  
    }  
}  
add_filter( 'authenticate', 'verify_username_password', 1, 3); 

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

// ADMIN BAR
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	  show_admin_bar(false);
	}
}

function replace_howdy( $wp_admin_bar ) {
    $my_account=$wp_admin_bar->get_node('my-account');
    $newtitle = str_replace( 'Howdy,', 'Hello,', $my_account->title );
    $wp_admin_bar->add_node( array(
        'id' => 'my-account',
        'title' => $newtitle,
    ) );
}
add_filter( 'admin_bar_menu', 'replace_howdy',25 );

// REMOVE MENU ITEMS & UPDATES
add_action( 'admin_menu', 'my_remove_menu_pages',999 );

function my_remove_menu_pages() {
    $admins = array( 
        'admin', 
    );

    $current_user = wp_get_current_user();

    if( !in_array( $current_user->user_login, $admins ) ){
	    remove_menu_page('edit-comments.php');
	    remove_menu_page('plugins.php');
	    remove_menu_page('tools.php');
	    remove_menu_page('edit.php?post_type=acf-field-group');
	}
}

function remove_core_updates(){
global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_core_updates');
add_filter('pre_site_transient_update_plugins','remove_core_updates');
add_filter('pre_site_transient_update_themes','remove_core_updates');