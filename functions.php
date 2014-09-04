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
	add_image_size( '', 300, 300, true );

// Scripts Etc
function custom_styles(){
	wp_enqueue_style('fonts', 'http://fonts.googleapis.com/css?family=Playfair+Display:400,700,900,400italic,700italic,900italic' );
	wp_enqueue_style('main', get_template_directory_uri() . '/css/main.css');
}

function custom_scripts(){
	global $template_directory_uri;
	
	wp_register_script('mapkey', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCHQcusxyrL3CHhKQ_Ui_MF78sMeOs84es', array('jquery'), '', false);

	wp_enqueue_script('modernizr', $template_directory_uri . '/js/vendor/modernizr-2.6.1.min.js', array('jquery'), '', false);
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

// Sidebar

add_action( 'widgets_init', 'my_sidebars' );

function my_sidebars() {

	// require(get_template_directory().'/inc/widgets/Mcwidget.php');

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
}

// Shortcode
function button($atts, $content = null) {
   extract(shortcode_atts(array('link' => '#','style' => 'primary', 'size'=> 'small'), $atts));
   return '<a class="button '.$style." ".$size.'" href="'.$link.'">' . do_shortcode($content) . '</a>';
}
add_shortcode('button', 'button');

// Filters
add_filter( 'widget_title', '__return_false' );
