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
// add_action( 'profile_update', 'hh_profile_update', 10, 2);

// function hh_profile_update($user_id, $old_user_data ) {
// 	$user = get_userdata($user_id);

// 	$membership_id 	= $user->membership_id;
// 	$name 			= $user->display_name;
// 	$old_email 		= $old_user_data->user_email;
// 	$email 			= $user->user_email;
// 	$old_phone 		= $user->event_espresso_phone;
// 	$phone 			= ( !empty($_POST['event_espresso_phone']) ) ? $_POST['event_espresso_phone'] : null;	
	
// 	$admin_email = "membership@homehouse.co.uk";
// 	$headers[] = 'From: HomeHouse <info@homehouse.co.uk>';
//     $message = sprintf( __( 'This user has updated their profile on the HomeHouse website.' ) ) . "\r\n\r\n";
//     $message .= sprintf( __( 'Display Name: %s' ), $name ). "\r\n\r\n";
//     $message .= sprintf( __( 'Membership ID: %s' ), $membership_id ). "\r\n\r\n";

//     if($old_email != $email){
//  		$message .= sprintf( __( 'Old Email: %s' ), $old_email ). "\r\n\r\n";
// 		$message .= sprintf( __( 'New Email: %s' ), $email ). "\r\n\r\n";   	
//     }

//     if($old_phone != $phone){
// 		$message .= sprintf( __( 'Old Phone: %s' ), $old_phone ). "\r\n\r\n";
// 		$message .= sprintf( __( 'Phone: %s' ), $phone ). "\r\n\r\n";
//     }

//     wp_mail( $admin_email, sprintf( __( 'User Profile Update' ), get_option('blogname') ), $message, $headers );
// }

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
        'root'
    );

    $current_user = wp_get_current_user();

    if( !in_array( $current_user->user_login, $admins ) ){
	    remove_menu_page('edit-comments.php');
	    remove_menu_page('plugins.php');
	    remove_menu_page('tools.php');
	    remove_menu_page('edit.php?post_type=acf-field-group');
	}
}

// function remove_core_updates(){
// global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
// }
// add_filter('pre_site_transient_update_core','remove_core_updates');
// add_filter('pre_site_transient_update_plugins','remove_core_updates');
// add_filter('pre_site_transient_update_themes','remove_core_updates');



// Creating ,and saving Membership_ID on user profiles
add_action( 'show_user_profile', 'add_membership_id', 2 );
add_action( 'edit_user_profile', 'add_membership_id', 2 );

function add_membership_id( $user )
{
    ?>
        <table class="form-table">
            <tr>
                <th><label for="membership_id">Membership ID</label></th>
                <td><input type="text" name="membership_id" value="<?php echo esc_attr(get_the_author_meta( 'membership_id', $user->ID )); ?>" class="regular-text" /></td>
            </tr>
        </table>
    <?php
}

add_action( 'personal_options_update', 'save_membership_id' );
add_action( 'edit_user_profile_update', 'save_membership_id' );

function save_membership_id( $user_id )
{
    update_user_meta( $user_id,'membership_id', sanitize_text_field( $_POST['membership_id'] ) );
}


// Custom ticket selector
function custom_ticket_selector( $new_row_content, $ticket, $max, $min, $required_ticket_sold_out, $ticket_price, $ticket_bundle, $ticket_status, $status_class ) {
	global $wpdb;

	$event_id = get_the_ID();

	if ( is_user_logged_in() ) {
	
		$current_user = wp_get_current_user();
		$attendee_id = get_user_meta( $current_user->ID, 'EE_Attendee_ID', true);
		$user_booked = false;
		$ticket_id = $ticket->ID();
		$ticket_type = $ticket->name();
		$booked = 0;
		
		$user_registrations = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}esp_registration WHERE ATT_ID = {$attendee_id} AND EVT_ID = {$event_id}" );

		if( !empty($user_registrations)) {
			foreach( $user_registrations as $user_registration ) {
				$booked += $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}esp_registration WHERE TXN_ID = {$user_registration->TXN_ID} AND TKT_ID = {$ticket_id}" );
			} 
		}

		//print_r($booked);

		$regged = false;

		if( $booked >= $max) {
			$new_row_content = '<td colspan="3">You already booked ' . $booked . ' of your ' . $ticket_type . ' ticket(s)!</td><input name="name="tkt-slctr-qty-4473[]" value="0" type="hidden" />';
			$regged = true;
		}

		if ($regged) {
			$new_row_content = '<td colspan="3">You already booked ' . $booked . ' of your ' . $ticket_type . ' ticket(s)!</td><input name="name="tkt-slctr-qty-4473[]" value="0" type="hidden" />';			
		}
	} 

    return $new_row_content;	
}
add_filter( 'FHEE__ticket_selector_chart_template__do_ticket_inside_row', 'custom_ticket_selector', 25, 9 );


function custom_max_number_ticket_text( $max_atndz ) {
	$new_text = 'Please note that a maximum number of %d tickets can be purchased for this event.';
	return $new_text ;
}

add_filter( 'FHEE__ticket_selector_chart_template__maximum_tickets_purchased_footnote', 'custom_max_number_ticket_text');







add_filter( 'FHEE__EE_Export__report_registrations__reg_csv_array', 'hh_custom_csv', 10, 2);
function hh_custom_csv($reg_csv_array, $registration) {

	//print_r($registration);
	
	$users = get_users(array('meta_key' => 'EE_Attendee_ID', 'meta_value' => $registration->attendee_ID()));
	$user = current($users);
	$event_id = $registration->event_ID();
	$attendee_ID = $registration->attendee_ID();

	$attendees = array();
	global $wpdb;

	$user_transactions = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}esp_registration WHERE ATT_ID = {$attendee_ID} AND EVT_ID = {$event_id}" );

	if( !empty($user_transactions)) {
		foreach( $user_transactions as $transaction ) {	
			$ticket_id = $transaction->TKT_ID;		
			$booked = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}esp_registration WHERE TXN_ID = {$transaction->TXN_ID}" );
			
			foreach ($booked as $book) {
			    if ($book->ATT_ID != '') {
			        $items[] = $book->ATT_ID;
			    }
			}
		} 
	}

	if (!empty($items)) {
		$i = 0;
		foreach ($items as $item) {
			$attendee_names = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}esp_attendee_meta WHERE ATT_ID = {$item}" );
			$attendee = current($attendee_names);
			$fname = $attendee->ATT_fname;
			$lname = $attendee->ATT_lname;
			$reg_csv_array['Attendee_'.$i.' ID: '.$attendee->ATT_ID] = $fname . ' ' .  $lname;
			$i++;
		}
	}

	if( !empty($user) ) {
		$membership_id = get_user_meta($user->ID, 'membership_id', true);
		$reg_csv_array['Membership_id'] = $membership_id;
	} else {	
		//return false;		
	}

	print_r($reg_csv_array);
	die;
}

//remove_action('AHEE__EE_Single_Page_Checkout__process_attendee_information__end', array('EED_WP_Users_SPCO', 'process_wpuser_for_attendee'), 10, 2);

//add_action('AHEE__EE_Single_Page_Checkout__process_attendee_information__end', 'custom_process_wpuser_for_attendee', 10, 2);

// function custom_process_wpuser_for_attendee( EE_SPCO_Reg_Step_Attendee_Information $spco, $valid_data) {
// 	die;
// 	$user_created = FALSE;
// 	$att_id = '';

// 	//use spco to get registrations from the
// 	$registrations = self::_get_registrations( $spco );
// 	foreach ($registrations as $registration) {

// 		//is this the primary registrant?  If not, continue
// 		if ( ! $registration->is_primary_registrant() ) {
// 			continue;
// 		}

// 		$attendee = $registration->attendee();

// 		if ( ! $attendee instanceof EE_Attendee ) {
// 			//should always be an attendee, but if not we continue just to prevent errors.
// 			continue;
// 		}

// 		//if user logged in, then let's just use that user.  Otherwise we'll attempt to get a
// 		//user via the attendee info.
// 		if ( is_user_logged_in() ) {
// 			$user = get_userdata( get_current_user_id() );
// 		} else {
// 			//is there already a user for the given attendee?
// 			$user = get_user_by( 'email', $attendee->email() );

// 			//does this user have the same att_id as the given att?  If NOT, then we do NOT update because it's possible there was a family member or something sharing the same email address but is a different attendee record.
// 			$att_id = $user instanceof WP_User ? get_user_meta( $user->ID, 'EE_Attendee_ID', TRUE ) : $att_id;
// 			if ( ! empty( $att_id ) && $att_id != $attendee->ID() ) {
// 				return;
// 			}
// 		}

// 		$event = $registration->event();

// 		//no existing user? then we'll create the user from the date in the attendee form.
// 		if ( ! $user instanceof WP_User ) {
// 			//if this event does NOT allow automatic user creation then let's bail.
// 			if ( ! EE_WPUsers::is_auto_user_create_on( $event ) ) {
// 				return; //no we do NOT auto create users please.
// 			}

// 			$password = wp_generate_password( 12, false );
// 			//remove our action for creating contacts on creating user because we don't want to loop!
// 			remove_action( 'user_register', array( 'EED_WP_Users_Admin', 'sync_with_contact') );
// 			$user_id = wp_create_user( apply_filters( 'FHEE__EED_WP_Users_SPCO__process_wpuser_for_attendee__username', $attendee->email(), $password, $attendee->email() ), $password, $attendee->email() );
// 			$user_created = TRUE;
// 			if ( $user_id instanceof WP_Error ) {
// 				return; //get out because something went wrong with creating the user.
// 			}
// 			$user = new WP_User( $user_id );
// 		}

		
// 		//if user created then send notification and attach attendee to user
// 		if ( $user_created ) {
// 			do_action( 'AHEE__EED_WP_Users_SPCO__process_wpuser_for_attendee__user_user_created', $user, $attendee, $registration, $password );
// 			//set user role
// 			$user->set_role( EE_WPUsers::default_user_create_role($event) );
// 			update_user_meta( $user->ID, 'EE_Attendee_ID', $attendee->ID() );
// 		}

// 		//failsafe just in case this is a logged in user not created by this system that has never had an attendee record attached.
// 		$att_id = empty( $att_id ) ? get_user_meta( $user->ID, 'EE_Attendee_ID', true ) : $att_id;
// 		if ( empty( $att_id ) ) {
// 			update_user_meta( $user->ID, 'EE_Attendee_ID', $attendee->ID() );
// 		}
// 	} //end registrations loop
// } 

// remove_filter( 'FHEE_EE_Single_Page_Checkout__save_registration_items__find_existing_attendee', array( 'EED_WP_Users_SPCO', 'maybe_sync_existing_attendee' ), 10, 3 );