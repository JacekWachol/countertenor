<?php

if ( ! isset( $content_width ) ) {
	$content_width = 1200;
}


    // Function for hooking up css (helper function )
    function wpi_theme_styles() {
       wp_enqueue_style('bootstrap_css', get_template_directory_uri() . '/css/bootstrap.min.css');
       wp_enqueue_style('main_css', get_template_directory_uri() . '/style.css');
   
      

    }

     add_action('wp_enqueue_scripts', 'wpi_theme_styles');    // plugging in the css helper function into wp

     //Function for hooking up scripts (helper function )

      function wpi_theme_js() {

        global $wp_scripts;

        wp_register_script('html5_shiv', 'https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js', '', '', false);
        wp_register_script('respond_js', 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js', '', '', false);

        $wp_scripts->add_data('html5_shiv', 'conditional', 'lt IE 9');
        $wp_scripts->add_data('respond_js', 'conditional', 'lt IE 9');
/**
 * Load javascripts used by the theme
 */



       
        wp_enqueue_script('main_js', get_template_directory_uri(). '/js/main.js', array('jquery'), '', true);
        wp_enqueue_script('bootstrap_js', get_template_directory_uri(). '/js/bootstrap.min.js', array('jquery'), '', true);
        
          
  
          

    }

    add_action('wp_enqueue_scripts', 'wpi_theme_js');  // plugging in the script helper function into wp



// Menu registration

function register_menus() {
  register_nav_menus(
    array(
    'header-menu' => __( 'Menu Główne' ),
        'photo-menu' => __( 'Photo Menu' )
    
      
    )
  );
}
add_action( 'init', 'register_menus' );




// Featured image register

add_theme_support( 'post-thumbnails' );

//body class based on page slug(name)

add_filter('body_class','body_class_slugs');
function body_class_slugs($classes) {
    global $post;

    
            $classes[] = $post->post_name.'-page';
    
    return $classes;
}


//Tilled gallery mods
function filter_media_comment_status( $open, $post_id ) {
	$post = get_post( $post_id );
	if( $post->post_type == 'attachment' ) {
		return false;
	}
	return $open;
}
add_filter( 'comments_open', 'filter_media_comment_status', 10 , 2 );


//register Engagements post type


/*
* Creating a function to create
*/

function custom_post_type() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Engagements', 'Post Type General Name'),
		'singular_name'       => _x( 'Engagement', 'Post Type Singular Name'),
		'menu_name'           => __( 'Engagements'),
		'all_items'           => __( 'All Engagements'),
		'view_item'           => __( 'View Engagement'),
		'add_new_item'        => __( 'Add New Engagement'),
		'add_new'             => __( 'Add New'),
		'edit_item'           => __( 'Edit Engagement'),
		'update_item'         => __( 'Update Engagement')

		
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'engagements'),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor'),
        
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
        'rewrite' => array("slug" => "engagements"),
        'register_meta_box_cb' => 'add_engagements_metaboxes' // function hooking up metaboxes
	);
	
	// Registering your Custom Post Type
	register_post_type( 'engagements', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/

add_action( 'init', 'custom_post_type', 0 );

//add in metaboxes for engagements

function add_engagements_metaboxes() {
	add_meta_box('wpt_engagements_date', 'Engagements Date', 'wpt_engagements_date', 'engagements', 'normal', 'default');
    add_meta_box('wpt_engagements_event_page_link', 'Engagements Event Page Link', 'wpt_engagements_event_page_link', 'engagements', 'normal', 'default');
    add_meta_box('wpt_engagements_buy_ticket_link', 'Engagements Buy Ticket Link', 'wpt_engagements_buy_ticket_link', 'engagements', 'normal', 'default');
    add_meta_box('wpt_engagements_type', 'Engagement Type', 'wpt_engagements_type', 'engagements', 'side', 'default');
}


function wpt_engagements_date($post){
    wp_nonce_field( basename( __FILE__ ), 'engagements_date_box_nonce' );
    $current_date = get_post_meta( $post->ID, '_engagements_date', true );
   echo 
'<input type="text" name="engagements_date" value="'.$current_date.'" class="widefat" />';

}
function wpt_engagements_event_page_link($post){
    wp_nonce_field( basename( __FILE__ ), 'engagements_event_link_box_nonce' );
    $current_event_link = get_post_meta( $post->ID, '_engagements_event_link', true );
    echo 
'<input type="text" name="engagements_event_link" value="'.$current_event_link.'" class="widefat" />';
    
}
function wpt_engagements_buy_ticket_link($post){
    wp_nonce_field( basename( __FILE__ ), 'engagements_ticket_link_box_nonce' );
    $current_ticket_link = get_post_meta( $post->ID, '_engagements_ticket_link', true );
    echo '<input type="text" name="engagements_ticket_link" value="'.$current_ticket_link.'" class="widefat" />';
}

function wpt_engagements_type($post){
    wp_nonce_field( basename( __FILE__ ), 'engagements_type_box_nonce' );
    $current_type = get_post_meta( $post->ID, '_engagements_type', true );?>

    <input type="radio" name="engagements_type" value="current" <?php checked( $current_type, 'current' ); ?> /> Current
    <br />
    <input type="radio" name="engagements_type" value="past" <?php checked( $current_type, 'past' ); ?> /> Past

    <?php }


/**
 * Save custom field meta box data
 *
 * @param int $post_id The post ID.
 */
function engagements_save_date( $post_id ){
	if ( !isset( $_POST['engagements_date_box_nonce'] ) || !wp_verify_nonce( $_POST['engagements_date_box_nonce'], basename( __FILE__ ) ) ){
	return;}
        
        // Check the user's permissions.
if ( ! current_user_can( 'edit_post', $post_id ) ){
	return;
}
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post->ID;
}
    //save value
    if ( isset( $_REQUEST['engagements_date'] ) ) {
	update_post_meta( $post_id, '_engagements_date', sanitize_text_field( $_POST['engagements_date'] ) );
}
    
}
function engagements_save_event_link( $post_id ){
	if ( !isset( $_POST['engagements_event_link_box_nonce'] ) || !wp_verify_nonce( $_POST['engagements_event_link_box_nonce'], basename( __FILE__ ) ) ){
	return;
    }
        // Check the user's permissions.
if ( ! current_user_can( 'edit_post', $post_id ) ){
	return;
}
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post->ID;
}
    //save value
    if ( isset( $_REQUEST['engagements_event_link'] ) ) {
	update_post_meta( $post_id, '_engagements_event_link', sanitize_text_field( $_POST['engagements_event_link'] ) );
}

}
function engagements_save_ticket_link( $post_id ){
	if ( !isset( $_POST['engagements_ticket_link_box_nonce'] ) || !wp_verify_nonce( $_POST['engagements_ticket_link_box_nonce'], basename( __FILE__ ) ) ){
	return;}
        
        // Check the user's permissions.
if ( ! current_user_can( 'edit_post', $post_id ) ){
	return;
}
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post->ID;
}
    //save value
    if ( isset( $_REQUEST['engagements_ticket_link'] ) ) {
	update_post_meta( $post_id, '_engagements_ticket_link', sanitize_text_field( $_POST['engagements_ticket_link'] ) );
}
}

function engagements_save_type( $post_id ){
	if ( !isset( $_POST['engagements_type_box_nonce'] ) || !wp_verify_nonce( $_POST['engagements_type_box_nonce'], basename( __FILE__ ) ) ){
	return;
    }
        // Check the user's permissions.
if ( ! current_user_can( 'edit_post', $post_id ) ){
	return;
}
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post->ID;
}
    //save value
    if ( isset( $_REQUEST['engagements_type'] ) ) {
	update_post_meta( $post_id, '_engagements_type', sanitize_text_field( $_POST['engagements_type'] ) );
}
}
add_action( 'save_post_engagements', 'engagements_save_date', 10, 2 );
add_action( 'save_post_engagements', 'engagements_save_event_link', 10, 2 );
add_action( 'save_post_engagements', 'engagements_save_ticket_link', 10, 2 );
add_action( 'save_post_engagements', 'engagements_save_type', 10, 2 );


/*** REGISTER VIDEOS CUSTOM POST TYPE ***/


//register Video post type


/*
* Creating a function to create
*/

function videos_post_type() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Videos', 'Post Type General Name'),
		'singular_name'       => _x( 'Video', 'Post Type Singular Name'),
		'menu_name'           => __( 'Videos'),
		'all_items'           => __( 'All Videos'),
		'view_item'           => __( 'View Video'),
		'add_new_item'        => __( 'Add New Video'),
		'add_new'             => __( 'Add New'),
		'edit_item'           => __( 'Edit Video'),
		'update_item'         => __( 'Update Video')

		
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'videos'),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor'),
        
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
        'rewrite' => array("slug" => "videos"),
        'register_meta_box_cb' => 'add_videos_metaboxes' // function hooking up metaboxes
	);
	
	// Registering your Custom Post Type
	register_post_type( 'videos', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/

add_action( 'init', 'videos_post_type', 0 );

//add in metaboxes for engagements

function add_videos_metaboxes() {
	add_meta_box('wpt_yt_link', 'You Tube Link', 'wpt_yt_link', 'videos', 'normal', 'default');
	add_meta_box('wpt_featured_vid', 'Featured Video', 'wpt_featured_vid', 'videos', 'normal', 'default');
    
}


function wpt_yt_link($post){
    wp_nonce_field( basename( __FILE__ ), 'yt_link_box_nonce' );
    $current_video = get_post_meta( $post->ID, '_yt_link', true );
   echo 
'<input type="text" name="yt_link" value="'.$current_video.'" class="widefat" />';

}

function wpt_featured_vid($post){
    wp_nonce_field( basename( __FILE__ ), 'featured_vid_box_nonce' );
    $is_featured = get_post_meta( $post->ID, '_featured_vid', true );
   echo 
'<input type="checkbox" name="featured_vid"', $is_featured ? 'checked="checked"': '',  '/>';

}

/**
 * Save custom field meta box data
 *
 * @param int $post_id The post ID.
 */
function videos_save_link( $post_id ){
	if ( !isset( $_POST['yt_link_box_nonce'] ) || !wp_verify_nonce( $_POST['yt_link_box_nonce'], basename( __FILE__ ) ) ){
	return;}
        
        // Check the user's permissions.
if ( ! current_user_can( 'edit_post', $post_id ) ){
	return;
}
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post->ID;
}
    //save value
    if ( isset( $_REQUEST['yt_link'] ) ) {
	update_post_meta( $post_id, '_yt_link', sanitize_text_field( $_POST['yt_link'] ) );
}
    
}

function videos_save_featured( $post_id ){
	if ( !isset( $_POST['featured_vid_box_nonce'] ) || !wp_verify_nonce( $_POST['featured_vid_box_nonce'], basename( __FILE__ ) ) ){
	return;}
        
        // Check the user's permissions.
if ( ! current_user_can( 'edit_post', $post_id ) ){
	return;
}
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post->ID;
}
    //save value
   $current_post_id = $post_id;
	update_post_meta( $current_post_id, '_featured_vid', $_POST['featured_vid']);
    if ( isset( $_REQUEST['featured_vid'] ) ) {
    $args = array( 'post_type' => 'videos', 'posts_per_page' => -1);
$videos = new WP_Query($args);
    foreach($videos->posts as $vid_post) {
   if($vid_post->ID != $current_post_id) {
       update_post_meta( $vid_post->ID, '_featured_vid', false);
   }
    
}
    }
    
}


add_action( 'save_post_videos', 'videos_save_link', 10, 2 );
add_action( 'save_post_videos', 'videos_save_featured', 10, 2 );



/*** REGISTER AUDIO CUSTOM POST TYPE ***/


//register Video post type


/*
* Creating a function to create
*/

function audio_post_type() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Audio', 'Post Type General Name'),
		'singular_name'       => _x( 'Audio', 'Post Type Singular Name'),
		'menu_name'           => 'Audio',
		'all_items'           => 'All Audio',
		'view_item'           =>'View Audio',
		'add_new_item'        => 'Add New Audio',
		'add_new'             => 'Add New',
		'edit_item'           => 'Edit Audio',
		'update_item'         => 'Update Audio'

		
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'audio'),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'thumbnail'),
        
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
        'rewrite' => array("slug" => "audio"),
        'register_meta_box_cb' => 'add_audio_metaboxes' // function hooking up metaboxes
	);
	
	// Registering your Custom Post Type
	register_post_type( 'audio', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/

add_action( 'init', 'audio_post_type', 0 );

//add in metaboxes for engagements

function add_audio_metaboxes() {
	add_meta_box('wpt_vocal', 'Vocal', 'wpt_vocal', 'audio', 'normal', 'default');
	add_meta_box('wpt_music', 'Music', 'wpt_music', 'audio', 'normal', 'default');
	add_meta_box('wpt_rec_details', 'Recording Details', 'wpt_rec_details', 'audio', 'normal', 'default');
    
}


function wpt_vocal($post){
    wp_nonce_field( basename( __FILE__ ), 'vocal_box_nonce' );
    $current_vocal = get_post_meta( $post->ID, '_vocal', true );
   echo 
'<input type="text" name="vocal" value="'.$current_vocal.'" class="widefat" />';

}

function wpt_music($post){
    wp_nonce_field( basename( __FILE__ ), 'music_box_nonce' );
    $current_music = get_post_meta( $post->ID, '_music', true );
   echo 
'<input type="text" name="music" value="'.$current_music.'" class="widefat" />';

}

function wpt_rec_details($post){
    wp_nonce_field( basename( __FILE__ ), 'rec_details_box_nonce' );
    $current_rec_details = get_post_meta( $post->ID, '_rec_details', true );
   echo 
'<input type="text" name="rec_details" value="'.$current_rec_details.'" class="widefat" />';

}

/**
 * Save custom field meta box data
 *
 * @param int $post_id The post ID.
 */
function audio_save_vocal( $post_id ){
	if ( !isset( $_POST['vocal_box_nonce'] ) || !wp_verify_nonce( $_POST['vocal_box_nonce'], basename( __FILE__ ) ) ){
	return;}
        
        // Check the user's permissions.
if ( ! current_user_can( 'edit_post', $post_id ) ){
	return;
}
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post->ID;
}
    //save value
    if ( isset( $_REQUEST['vocal'] ) ) {
	update_post_meta( $post_id, '_vocal', sanitize_text_field( $_POST['vocal'] ) );
}
    
}

function audio_save_music( $post_id ){
	if ( !isset( $_POST['music_box_nonce'] ) || !wp_verify_nonce( $_POST['music_box_nonce'], basename( __FILE__ ) ) ){
	return;}
        
        // Check the user's permissions.
if ( ! current_user_can( 'edit_post', $post_id ) ){
	return;
}
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post->ID;
}
    //save value
   if ( isset( $_REQUEST['music'] ) ) {
	update_post_meta( $post_id, '_music', sanitize_text_field( $_POST['music'] ) );
    
    
}


}

function audio_save_rec_details( $post_id ){
	if ( !isset( $_POST['rec_details_box_nonce'] ) || !wp_verify_nonce( $_POST['rec_details_box_nonce'], basename( __FILE__ ) ) ){
	return;}
        
        // Check the user's permissions.
if ( ! current_user_can( 'edit_post', $post_id ) ){
	return;
}
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post->ID;
}
    //save value
    if ( isset( $_REQUEST['rec_details'] ) ) {
	update_post_meta( $post_id, '_rec_details', sanitize_text_field( $_POST['rec_details'] ) );
}
    
}

add_action( 'save_post_audio', 'audio_save_vocal', 10, 2 );
add_action( 'save_post_audio', 'audio_save_music', 10, 2 );
add_action( 'save_post_audio', 'audio_save_rec_details', 10, 2 );



/*** REGISTER PRESS CUSTOM POST TYPE ***/


//register Press post type


/*
* Creating a function to create
*/

function press_post_type() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Press', 'Post Type General Name'),
		'singular_name'       => _x( 'Press', 'Post Type Singular Name'),
		'menu_name'           => __( 'Press'),
		'all_items'           => __( 'All Press'),
		'view_item'           => __( 'View Press'),
		'add_new_item'        => __( 'Add New Press'),
		'add_new'             => __( 'Add New'),
		'edit_item'           => __( 'Edit Press'),
		'update_item'         => __( 'Update Press')

		
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'press'),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'thumbnail'),
        
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
        'rewrite' => array("slug" => "press"),
        'register_meta_box_cb' => 'add_press_metaboxes' // function hooking up metaboxes
	);
	
	// Registering your Custom Post Type
	register_post_type( 'press', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/

add_action( 'init', 'press_post_type', 0 );

//add in metaboxes for press

function add_press_metaboxes() {
	add_meta_box('wpt_press_link', 'Relevant link', 'wpt_press_link', 'press', 'normal', 'default');
	add_meta_box('wpt_press_date', 'Publication date', 'wpt_press_date', 'press', 'normal', 'default');
	add_meta_box('wpt_press_type', 'Publication type', 'wpt_press_type', 'press', 'side', 'default');
    
}


function wpt_press_link($post){
    wp_nonce_field( basename( __FILE__ ), 'press_link_box_nonce' );
    $current_link = get_post_meta( $post->ID, '_press_link', true );
   echo 
'<input type="text" name="press_link" value="'.$current_link.'" class="widefat" />';

}

function wpt_press_date($post){
    wp_nonce_field( basename( __FILE__ ), 'press_date_box_nonce' );
    $current_date = get_post_meta( $post->ID, '_press_date', true );
   echo 
'<input type="text" name="press_date" value="'.$current_date.'" class="widefat" />';

}


function wpt_press_type($post){
    wp_nonce_field( basename( __FILE__ ), 'press_type_box_nonce' );
    $current_type = get_post_meta( $post->ID, '_press_type', true );?>

        <select name="press_type">
            <option value="magazine" <?php selected( $current_type, 'magazine' )?>>Magazine</option>
            <option value="review" <?php selected( $current_type, 'review' )?>>Review</option>
        </select>
        <?php   }

/**
 * Save custom field meta box data
 *
 * @param int $post_id The post ID.
 */
function press_save_link( $post_id ){
	if ( !isset( $_POST['press_link_box_nonce'] ) || !wp_verify_nonce( $_POST['press_link_box_nonce'], basename( __FILE__ ) ) ){
	return;}
        
        // Check the user's permissions.
if ( ! current_user_can( 'edit_post', $post_id ) ){
	return;
}
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
}
    //save value
    if ( isset( $_REQUEST['press_link'] ) ) {
	update_post_meta( $post_id, '_press_link', sanitize_text_field( $_POST['press_link'] ) );
}
    
}

function press_save_date( $post_id ){
	if ( !isset( $_POST['press_date_box_nonce'] ) || !wp_verify_nonce( $_POST['press_date_box_nonce'], basename( __FILE__ ) ) ){
	return;}
        
        // Check the user's permissions.
if ( ! current_user_can( 'edit_post', $post_id ) ){
	return;
}
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
}
    //save value
    if ( isset( $_REQUEST['press_date'] ) ) {
	update_post_meta( $post_id, '_press_date', sanitize_text_field( $_POST['press_date'] ) );
}
   
    
}
function press_save_type( $post_id ){ 
if ( !isset( $_POST['press_type_box_nonce'] ) || !wp_verify_nonce( $_POST['press_type_box_nonce'], basename( __FILE__ ) ) ){
	return;}
        
        // Check the user's permissions.
if ( ! current_user_can( 'edit_post', $post_id ) ){
	return;
}
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
}

    //saves value
   if(isset($_POST['press_type'])){
         

        update_post_meta($post_id, '_press_type',$_POST['press_type']);
       
    }
     

}



add_action( 'save_post_press', 'press_save_link', 10, 2 );
add_action( 'save_post_press', 'press_save_date', 10, 2 );
add_action( 'save_post_press', 'press_save_type', 10, 2);


/* CUSTOM COLUMNS */


add_filter( 'manage_edit-engagements_columns', 'engagement_columns' ) ;

function engagement_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Engagement' ),
		'type' => __( 'Type' ),
		'date' => __( 'Date' )
	);

	return $columns;
}

add_action( 'manage_engagements_posts_custom_column', 'manage_engagements_columns', 10, 2 );

function manage_engagements_columns( $column, $post_id ) {
	global $post;

	if ($column == 'type') {
        $type = get_post_meta( $post_id, '_engagements_type', true );

			/* If no duration is found, output a default message. */
			if ( empty( $type ) )
				echo __( 'Not set' );

			/* If there is a duration, append 'minutes' to the text string. */
			else
				echo $type;
    }

	
}




/* 
 * Customize Menu Item Classes
 * @author Bill Erickson
 * @link http://www.billerickson.net/customize-which-menu-item-is-marked-active/
 *
 * @param array $classes, current menu classes
 * @param object $item, current menu item
 * @param object $args, menu arguments
 * @return array $classes
 */
function be_menu_item_classes( $classes, $item, $args ) {
    global $post;
if( in_array('photo-item',$classes) && is_page() && $post->post_parent   )   {
        $classes[] = 'current-menu-item';
    }

    return $classes;

}
add_filter( 'nav_menu_css_class', 'be_menu_item_classes', 10, 3 );
