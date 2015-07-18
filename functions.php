<?php
/**
 * This is the functions file for the MyFirst Theme
 *****************************************************/

/* Content Width */
if ( ! isset( $content_width ) ) $content_width = 590;

/* The Themesetup */
add_action( 'after_setup_theme', 'msign_setup' );
if ( ! function_exists( 'msign_setup' ) ):
	function msign_setup() {
		add_theme_support( 'automatic-feed-links' ); // RSS Feed Set-up
		add_theme_support( 'post-thumbnails' ); // This theme uses post thumbnails
		set_post_thumbnail_size( 150, 150, true ); // Default Size of the thumbnails
		add_image_size( 'homebox-small', 300, 272, true ); 	// Size of the thumbnails in the small homeboxes
		add_image_size( 'default-homebox-large', 630, 272, true ); 	// Size of the thumbnails in the large homeboxes and pages & posts.
		add_image_size( 'default-fullwidth', 960, 272, true ); 	// Size of the thumbnails for full-width pages
		add_image_size( 'img-thumbnail', 75, 68, true ); 	// Size of the thumbnails for random and featured widgets
		add_theme_support( 'custom-background', array('default-image' => get_template_directory_uri() . '/img/pattern.png') ); // This team supports custom backgrounds
		if ( function_exists( 'register_nav_menus' ) ) {
			register_nav_menus( array( 'primary' => __( 'Primary Navigation Menu', 'msign' ) ));	// This theme uses wp_nav_menu() in one location.		
		}
		/* General functions */
		include_once( get_template_directory() . '/inc/widgets.php' );
		include_once( get_template_directory() . '/inc/customfunctions.php' );
		include_once( get_template_directory() . '/inc/shortcodes.php' );
		include_once( get_template_directory() . '/inc/customposts.php' );
		/* Admin functions */
		if(is_admin()){ 
			include_once( get_template_directory() . '/admin/themeoptions.php' );
			include_once( get_template_directory() . '/admin/metaboxes.php' );
		}	
		/* Make the theme ready for translation  */
		load_theme_textdomain( 'msign', get_template_directory() . '/languages' );
		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );
	}
endif; 

/* Enqueye backend and front-end scripts */
function msign_backend_scripts() {
	if(is_admin()){ 
        wp_enqueue_media();
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style("themecss", get_template_directory_uri(). "/admin/admin-css.css", false, "1.0");
		wp_enqueue_script("themejs", get_template_directory_uri()."/admin/admin-js.js", array('jquery', 'wp-color-picker'));
	}
}
add_action( 'admin_enqueue_scripts', 'msign_backend_scripts' );

function msign_frontend_scripts() {
   	if( ! is_admin()){
		global $post;
		wp_deregister_script('jquery'); 	// Registers Google CDN Jquery instead of Jquery included by Wordpress
		wp_enqueue_script('jquery',('https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'), '', '1.9.1', true); 
		wp_enqueue_script('jqueryui',('https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js'), array('jquery'), '1.10.3',true); // JQuery UI
		wp_enqueue_script('functions', get_template_directory_uri(). '/js/functions.js', array('jquery', 'jqueryui'), '1.0', true); // Loads main functions
		wp_enqueue_script('slider', get_template_directory_uri(). '/js/slider.js', array('jquery'), '2.1.06', true); // Loads slider functions	
		
        // Dynamic script loading
		if( get_option('msign_portfolio_overview_ajax') && is_page_template('portfolio.php') ) {
			wp_enqueue_script('portfolio-categories', get_template_directory_uri(). '/js/ajax-portfolio-categories.js', array('jquery'), '', true); // Loads ajax for portfolio categories		
        }
	}
}
add_action( 'wp_enqueue_scripts', 'msign_frontend_scripts' );
/* Message to use the posts to posts plugin */
function msign_custom_widgets_warning() {      
	$plugins = get_option('active_plugins');
	$required_plugin = 'posts-to-posts/posts-to-posts.php';
	if ( ! in_array( $required_plugin , $plugins ) ) {
    	echo '<div id="message" class="updated"><p><a href="http://wordpress.org/extend/plugins/posts-to-posts/" target="_blank">'. __('To be able to use custom widgets and connect services to portfolio projects, please download and activate the Posts to Posts plugin', 'msign').'</a></p></div>';
	}
}
add_action('admin_notices', 'msign_custom_widgets_warning');
/* Adds Theme Page to Dashboard */
function msign_custom_dashboard() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget('custom_help_widget', 'M-Sign.nl Wordpress Theme', 'msign_custom_dashboard_help');
}
function msign_custom_dashboard_help() {
	_e('<p>Welcome to the M-Sign Wordpress Theme, a HTML5 Semantic, Responsive Wordpress Theme with Jquery Slider and Extensive Theme Options.</p> 
	<p>Visit <a href="https://www.michieltramper.com" target="_blank">the page</a> of the author.</p>', 'msign');
}
add_action('wp_dashboard_setup', 'msign_custom_dashboard');

/* Post connection for widgets, is used after Posts 2 Posts plugin is installed and activated */
function msign_custom_widgets_register() {
      	p2p_register_connection_type( array(
			'name' => 'widgets_to_posts',
			'from' => 'custom-widget',
			'to' => array('post', 'page' , 'services', 'portfolio_project' )
		) );
}
add_action( 'p2p_init', 'msign_custom_widgets_register' );
/* Post connection to connect services to portfolio. */
function msign_services_connect_register() {
      	p2p_register_connection_type( array(
			'name' => 'services_to_projects',
			'from' => 'services',
			'to' => array('portfolio_project' )
		) );
}
add_action( 'p2p_init', 'msign_services_connect_register' );

/**
 * Removes empty paragraphs and linebreaks around shortcodes
 */
function remove_empty_tags_around_shortcodes($content) {
    $tags = array(
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br>' => ']',
        ']<br />' => ']'
    );
 
    $content = strtr($content, $tags);
    return $content;
} 
add_filter('the_content', 'remove_empty_tags_around_shortcodes');