<?php
define('THEME_NAME', 'homehouse');
$template_directory_uri = get_template_directory_uri();

add_theme_support( 'post-thumbnails' );

add_theme_support( 'html5' );

add_editor_style('/css/editor-style.css');

register_nav_menus(array(
	'header_nav' => 'Main Header Menu',
	'footer_nav' => 'Footer Menu',
	)
);

add_image_size( 'slider', 1600, 700, true );

add_image_size( 'grid-rect-large', 1100, 500, true );

add_image_size( 'grid-rect-med', 800, 500, true );

add_image_size( 'grid-square', 525, 525, true );


add_action( 'wp_enqueue_scripts', 'custom_styles', 30 );

add_action( 'wp_enqueue_scripts', 'custom_scripts', 30 );

add_action( 'init', 'create_post_type' );

add_action( 'init', 'offer_category' );

add_action( 'widgets_init', 'custom_widgets_init' );

add_filter( 'widget_categories_args', 'exclude_widget_categories');

add_action( 'init', 'set_newuser_cookie');

add_action( 'login_enqueue_scripts', 'my_login_logo' );

add_action( 'profile_update', 'hh_profile_update', 10, 2);

add_action( 'wp_login_failed', 'login_failed' );

add_filter( 'authenticate', 'verify_username_password', 1, 3); 

add_action('after_setup_theme', 'remove_admin_bar');

add_filter( 'admin_bar_menu', 'replace_howdy',25 );

add_action( 'admin_menu', 'my_remove_menu_pages',999 );

add_action( 'show_user_profile', 'add_membership_id', 2 );

add_action( 'edit_user_profile', 'add_membership_id', 2 );

add_action( 'user_new_form', 'add_membership_id_new', 2 );

add_action( 'personal_options_update', 'save_membership_id' );

add_action( 'edit_user_profile_update', 'save_membership_id' );

add_action('user_register', 'save_membership_id');

add_action('AHEE__EE_Single_Page_Checkout__process_attendee_information__end', 'custom_EE_Single_Page_Checkout__process_attendee_information__end', 10, 2);

add_action( 'AHEE__EE_System__core_loaded_and_ready', 'custom_EE_System__core_loaded_and_ready', 20);

add_action( 'AHEE__EE_System__set_hooks_for_shortcodes_modules_and_addons', 'custom__EE_System__set_hooks_for_shortcodes_modules_and_addons', 20);

remove_action('wp_head', 'feed_links', 2);

remove_action('wp_head', 'feed_links_extra', 3);  

remove_action('wp_head', 'rsd_link');  

remove_action('wp_head', 'wlwmanifest_link');  

remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);  

remove_action('wp_head', 'wp_generator'); 

add_filter( 'FHEE__ticket_selector_chart_template__do_ticket_inside_row', 'custom_ticket_selector_chart_template__do_ticket_inside_row', 25, 9 );

//add_filter( 'FHEE__ticket_selector_chart_template__maximum_tickets_purchased_footnote', 'custom_max_number_ticket_text');

add_filter( 'FHEE__EE_Export__report_registrations__reg_csv_array', 'custom_EE_Export__report_registrations__reg_csv_array', 10, 2);

add_filter( 'FHEE__EE_Export__report_registration_for_event','custom__EE_Export__report_registration_for_event', 10, 2);

add_filter( 'FHEE__ticket_selector_chart_template__maximum_tickets_purchased_footnote', '__return_false');

add_filter( 'widget_title', '__return_false' );

add_shortcode('loggedin', 'check_user' );

add_shortcode('button', 'button');

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

// Filters


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


function custom_widgets_init() {
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


// WORDPRESS COOKIE
function set_newuser_cookie() {
	if ( !is_admin() && !isset($_COOKIE['HomehouseVisit'])) {
		setcookie('HomehouseVisit', 1, time()+3600*24*30, COOKIEPATH, COOKIE_DOMAIN, false);
	}
}


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


// EMAIL ON USER UPDATE


function hh_profile_update($user_id, $old_user_data ) {
	$user = get_userdata($user_id);

	$membership_id 	= $user->membership_id;
	$name 			= $user->display_name;
	$old_email 		= $old_user_data->user_email;
	$email 			= $user->user_email;
	$old_phone 		= $user->phone;
	$phone 			= ( !empty($_POST['phone']) ) ? $_POST['phone'] : null;	
  	$profile_updated = false;
	
	$admin_email = "membership@homehouse.co.uk";
	$headers[] = 'From: HomeHouse <membership@homehouse.co.uk>';
    $message = sprintf( __( 'This user has updated their profile on the HomeHouse website.' ) ) . "\r\n\r\n";
    $message .= sprintf( __( 'Display Name: %s' ), $name ). "\r\n\r\n";
    $message .= sprintf( __( 'Membership ID: %s' ), $membership_id ). "\r\n\r\n";

    if($old_email != $email){
 		$message .= sprintf( __( 'Old Email: %s' ), $old_email ). "\r\n\r\n";
		$message .= sprintf( __( 'New Email: %s' ), $email ). "\r\n\r\n";
   		$profile_updated = true;
    }

    if($old_phone != $phone){
		$message .= sprintf( __( 'Old Phone: %s' ), $old_phone ). "\r\n\r\n";
		$message .= sprintf( __( 'Phone: %s' ), $phone ). "\r\n\r\n";
   		$profile_updated = true;
    }

    if( $profile_updated ) {
	    wp_mail( $admin_email, sprintf( __( 'User Profile Update' ), get_option('blogname') ), $message, $headers );
	}
}

// LOGIN REDIRECTS
function login_failed() {
	$login_page  = home_url( '/login/' );
	wp_redirect( $login_page . '?login=failed' );
	exit;
}


function verify_username_password( $user, $username, $password ) {  
    $login_page  = home_url( '/login/' );  
    if( $username == "" || $password == "" ) {  
        wp_redirect( $login_page . "?login=empty" );  
        exit;  
    }  
}  


// SHORTCODES
function button($atts, $content = null) {
   extract(shortcode_atts(array('link' => '#','style' => 'primary', 'size'=> 'small'), $atts));
   return '<a class="button '.$style." ".$size.'" href="'.$link.'">' . do_shortcode($content) . '</a>';
}



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

// ADMIN BAR

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
function add_membership_id( $user ) {
    ?>
        <table class="form-table">
            <tr>
                <th><label for="membership_id">Membership ID</label></th>
                <td><input type="text" name="membership_id" value="<?php echo esc_attr(get_the_author_meta( 'membership_id', $user->ID )); ?>" class="regular-text" /></td>
            </tr>
        </table>
		<table class="form-table">
			<tr>
            	<th><label for="phone">Phone Number</label></th>
                <td><input type="text" name="phone" id="phone" value="<?php echo esc_attr( get_the_author_meta( 'phone', $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description">Please enter your phone number.</span>
                </td>
    	</tr>        
    	</table>
    <?php
}



function add_membership_id_new( $user ) {
    ?>
        <table class="form-table">
            <tr>
                <th><label for="membership_id">Membership ID</label></th>
                <td><input type="text" name="membership_id" value="" class="regular-text" /></td>
            </tr>
        </table>
		<table class="form-table">
			<tr>
            	<th><label for="phone">Phone Number</label></th>
                <td><input type="text" name="phone" id="phone" value="" class="regular-text" /><br />
                    <span class="description">Please enter your phone number.</span>
                </td>
    	</tr>        
    	</table>        
    <?php
}



function save_membership_id( $user_id ) {
    update_user_meta( $user_id,'membership_id', sanitize_text_field( $_POST['membership_id'] ) );
    update_user_meta( $user_id,'phone', sanitize_text_field( $_POST['phone'] ) );
}


// Custom ticket selector
function custom_ticket_selector_chart_template__do_ticket_inside_row( $new_row_content, $ticket, $max, $min, $required_ticket_sold_out, $ticket_price, $ticket_bundle, $ticket_status, $status_class ) {
	global $wpdb;

	$event_id = get_the_ID();

	if ( is_user_logged_in() ) {
	
		$ticket_name = $ticket->name();
	
		$user_id = get_current_user_id();
		$att_id = get_user_meta( $user_id, 'EE_Attendee_ID', true );

		//get the attached contact (EE_Attendee)
		$contact = EEM_Attendee::instance()->get_one_by_ID( $att_id );

		//now we can use that to get all the related registrations (an array of EE_Registrations objects)
		$registrations = $contact->get_many_related( 'Registration', array( array( 'EVT_ID' => $event_id, 'TKT_ID' => $ticket->ID() )) );

		$booked = 0;

		foreach( $registrations as $registration ) {
		
			$transaction = $registration->transaction();
	
			$status = $transaction instanceof EE_Transaction ? $transaction->status_ID() : EEM_Transaction::failed_status_code;

			if( $status == EEM_Transaction::complete_status_code ) {
				$booked++;
			}
		}

		if( $booked >= $max) {
			$new_row_content = '<td colspan="3">You have already booked ' . $max . ' of your ' . $ticket_name . ' ticket(s)!</td>';
			//$new_row_content .= '<input type="hidden" name="tkt-slctr-qty-'.$event_id.'[]" value="0" />';
			//$new_row_content .= '<input type="hidden" name="tkt-slctr-ticket-id-'.$event_id.'[]" value="'. $ticket->ID().'" />';
		}
	} 

    return $new_row_content;	
}


function custom_max_number_ticket_text( $max_atndz ) {
	echo $max_atndz;
}

function custom_EE_Export__report_registrations__reg_csv_array($reg_csv_array, $registration) {
	global $wpdb;	
	$users = get_users(array('meta_key' => 'EE_Attendee_ID', 'meta_value' => $registration->attendee_ID()));
	$user = current($users);
	$last_name = '';
	$first_name = '';
	$membership_id = '';
	
	if( !empty($user->ID) ) {
		$userdata = get_userdata($user->ID);
		$first_name = $userdata->first_name;
		$last_name = $userdata->last_name;
		$membership_id = get_user_meta($user->ID, 'membership_id', true);
	}
	
	$prepend = array(
		'Last Name' => $last_name, 
		'First Name' => $first_name, 
		'Membership ID' => $membership_id, 
	);
	
	$reg_csv_array = $prepend + $reg_csv_array;

	unset($reg_csv_array['Unique Code for this registration[REG_code]']);
	unset($reg_csv_array['Count of this registration in the group registration [REG_count]']);
	unset($reg_csv_array['Final Price of registration[REG_final_price]']);
	unset($reg_csv_array['Currency']);
	unset($reg_csv_array['Registration Status']);
	unset($reg_csv_array['Transaction Amount Due']);
	unset($reg_csv_array['Payment Date(s)']);
	unset($reg_csv_array['Payment Method(s)']);
	unset($reg_csv_array['Gateway Transaction ID(s)']);
	unset($reg_csv_array['Check-Ins']);
	unset($reg_csv_array['Ticket Name']);
	unset($reg_csv_array['Address Part 1[ATT_address]']);
	unset($reg_csv_array['Address Part 2[ATT_address2]']);
	unset($reg_csv_array['City[ATT_city]']);
	unset($reg_csv_array['State[STA_ID]']);
	unset($reg_csv_array['Country[CNT_ISO]']);
	unset($reg_csv_array['Attendee ID[ATT_ID]']);
	unset($reg_csv_array['Transaction ID[TXN_ID]']);
	unset($reg_csv_array['Country[CNT_ISO]']);
	unset($reg_csv_array['Registration ID[REG_ID]']);
	unset($reg_csv_array['First Name[ATT_fname]']);
	unset($reg_csv_array['Last Name[ATT_lname]']);
	unset($reg_csv_array['Datetimes of Ticket']);
	unset($reg_csv_array['Time registration occurred[REG_date]']);
	unset($reg_csv_array['Transaction Status']);
	unset($reg_csv_array['ZIP/Postal Code[ATT_zip]']);
	unset($reg_csv_array['Phone[ATT_phone]']);

	$event_id = $registration->event_ID();
	$attendee_id = $registration->attendee_ID();
	$transaction_id = $registration->transaction_ID();
	$registration_id = $registration->ID();
	
	$attendees = array();
	$status_id = EEM_Registration::status_id_approved;
	$user_registrations = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}esp_registration WHERE TXN_ID = {$transaction_id} AND STS_ID = '" . $status_id . "'" );

	if( !empty($user_registrations) ) {
		$i = 0;
		foreach( $user_registrations as $user_registration ) {
			if( $user_registration->ATT_ID == $attendee_id ) continue;

			$attendee = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}esp_attendee_meta WHERE ATT_ID = {$user_registration->ATT_ID}" );
			$fname = $attendee->ATT_fname;
			$lname = $attendee->ATT_lname;
			$attendees[] = $fname . ' ' .  $lname;
			$i++;
		}
	}
	$reg_csv_array['Total Attendees'] = count($attendees) + 1;
	$reg_csv_array['Attendees'] = implode( ', ', $attendees );

	return $reg_csv_array;
}


function custom_EE_Single_Page_Checkout__process_attendee_information__end( EE_SPCO_Reg_Step_Attendee_Information $spco, $valid_data) {
	$user_created = FALSE;
	$att_id = '';

	//use spco to get registrations from the
	$registrations = EED_WP_Users_SPCO::_get_registrations( $spco );
	foreach ($registrations as $registration) {

		//is this the primary registrant?  If not, continue
		if ( ! $registration->is_primary_registrant() ) {
			continue;
		}

		$attendee = $registration->attendee();

		if ( ! $attendee instanceof EE_Attendee ) {
			//should always be an attendee, but if not we continue just to prevent errors.
			continue;
		}

		//if user logged in, then let's just use that user.  Otherwise we'll attempt to get a
		//user via the attendee info.
		if ( is_user_logged_in() ) {
			$user = get_userdata( get_current_user_id() );
		} else {
			//is there already a user for the given attendee?
			$user = get_user_by( 'email', $attendee->email() );

			//does this user have the same att_id as the given att?  If NOT, then we do NOT update because it's possible there was a family member or something sharing the same email address but is a different attendee record.
			$att_id = $user instanceof WP_User ? get_user_meta( $user->ID, 'EE_Attendee_ID', TRUE ) : $att_id;
			if ( ! empty( $att_id ) && $att_id != $attendee->ID() ) {
				return;
			}
		}

		$event = $registration->event();

		//no existing user? then we'll create the user from the date in the attendee form.
		if ( ! $user instanceof WP_User ) {
			//if this event does NOT allow automatic user creation then let's bail.
			if ( ! EE_WPUsers::is_auto_user_create_on( $event ) ) {
				return; //no we do NOT auto create users please.
			}

			$password = wp_generate_password( 12, false );
			//remove our action for creating contacts on creating user because we don't want to loop!
			remove_action( 'user_register', array( 'EED_WP_Users_Admin', 'sync_with_contact') );
			$user_id = wp_create_user( apply_filters( 'FHEE__EED_WP_Users_SPCO__process_wpuser_for_attendee__username', $attendee->email(), $password, $attendee->email() ), $password, $attendee->email() );
			$user_created = TRUE;
			if ( $user_id instanceof WP_Error ) {
				return; //get out because something went wrong with creating the user.
			}
			$user = new WP_User( $user_id );
		}

		//if user created then send notification and attach attendee to user
		if ( $user_created ) {
			do_action( 'AHEE__EED_WP_Users_SPCO__process_wpuser_for_attendee__user_user_created', $user, $attendee, $registration, $password );
			//set user role
			$user->set_role( EE_WPUsers::default_user_create_role($event) );
			update_user_meta( $user->ID, 'EE_Attendee_ID', $attendee->ID() );
		}

		//failsafe just in case this is a logged in user not created by this system that has never had an attendee record attached.
		$att_id = empty( $att_id ) ? get_user_meta( $user->ID, 'EE_Attendee_ID', true ) : $att_id;
		if ( empty( $att_id ) ) {
			update_user_meta( $user->ID, 'EE_Attendee_ID', $attendee->ID() );
		}
	} //end registrations loop
}

function custom_EE_System__core_loaded_and_ready() {

	remove_action( 'AHEE__EE_Single_Page_Checkout__process_attendee_information__end', array('EED_WP_Users_SPCO', 'process_wpuser_for_attendee'), 10, 2);

}

function custom__EE_System__set_hooks_for_shortcodes_modules_and_addons(){

	remove_filter( 'FHEE__EEH_Form_Fields__generate_question_groups_html__after_question_group_questions', array( 'EED_WP_Users_SPCO', 'primary_reg_sync_messages' ), 10, 4 );

}

function custom__EE_Export__report_registration_for_event( $args, $event_id ) {

	return array(
		array(
			'STS_ID' => EEM_Registration::status_id_approved,
			'REG_count' => 1,
			'Ticket.TKT_deleted' => array( 'IN', array( true, false ) )
		),
		'order_by' => array('Attendee.ATT_lname' => 'asc'),
		'force_join' => array( 'Transaction', 'Ticket', 'Attendee' )
	);
}