<?php
/**
 * This is the file containing all functions for custom posts
 */
 
 /* Custom Post Type: Portfolio Item (but can be used for any image based item with a description) */
add_action( 'init', 'create_post_type_portfolio' );
function create_post_type_portfolio() {
	register_post_type( 'portfolio_project',
		array(
			'labels' => array(
				'name' => __( 'Portfolio', 'msign' ),
				'menu_name' => __( 'Portfolio', 'msign' ),
				'singular_name' => __( 'Portfolio Project', 'msign' ),
				'add_new_item' => __( 'Add a Project', 'msign'),
				'edit_item' => __('Edit Project', 'msign'),
				'new_item' => __('New Project', 'msign'),
				'search_items' => __('Search Projects', 'msign'),
				'not_found' => __('No Projects Found', 'msign'),
				'not_found_in_trash' => __('No Projects Found in Trash', 'msign')
			),
        'menu_icon' => '',    
		'public' => true,
		'rewrite' => array('with_front' => false, 'slug'=>'portfolio'),
		'supports' => array('editor', 'thumbnail', 'title'),
		'has_archive' => true
		)
	);
}
/* Custom Post Type: Feature Slider */
function create_post_type_feature() {
	register_post_type( 'feature',
		array(
			'labels' => array(
				'name' => __( 'Slider Items', 'msign'),
				'menu_name' => __( 'Slider Items', 'msign'),		
				'singular_name' => __('Slider Item', 'msign'),
				'add_new' => __('Add New', 'msign_feature', 'msign'),
				'add_new_item' => __('Add New Slider Item', 'msign'),
				'edit_item' => __('Edit Slider Item', 'msign'),
				'new_item' => __('New Slider Item', 'msign'),
				'all_items' => __('All Slider Items', 'msign'),
				'view_item' => __('View Slider Item', 'msign'),
				'search_items' => __('Search Slider Items', 'msign'),
				'not_found' =>  __('No Slider Items found', 'msign'),
				'not_found_in_trash' => __('No Slider Items found in Trash', 'msign'), 
			),
        'menu_icon' => '', 
		'description' => __('These custom posts will appear in your slider on the frontpage. Use the title and editor to add a title and description that is showed in the sliders caption.', 'msign'),
		'public' => false,
		'has_archive' => false,
		'show_in_nav_menus' => false,
		'exclude_from_search' => true,
		'supports' => array('title'),
		'rewrite' => array('with_front' => false,'slug'=>'feature'),
		)
	);
}
add_action( 'init', 'create_post_type_feature' );
/* Custom Post Type: Services */
function create_post_type_msign_services() {
	register_post_type( 'services',
		array(
			'labels' => array(
				'name' => __( 'Services', 'msign'),
				'menu_name' => __( 'Services', 'msign'),		
				'singular_name' => __('Service', 'msign'),
				'add_new' => __('Add New Service', 'msign'),
				'add_new_item' => __('Add New Service', 'msign'),
				'edit_item' => __('Edit Service', 'msign'),
				'new_item' => __('New Service', 'msign'),
				'all_items' => __('All Services', 'msign'),
				'view_item' => __('View Service', 'msign'),
				'search_items' => __('Search Services', 'msign'),
				'not_found' =>  __('No Services found', 'msign'),
				'not_found_in_trash' => __('No Services found in Trash', 'msign'), 
			),
        'menu_icon' => '',    
		'description' => __('These custom posts will appear on the services page template and on the homepage.','msign' ),
		'public' => true,
		'has_archive' => false,
		'supports' => array('editor', 'excerpt', 'thumbnail','title'),
		'rewrite' => array('with_front' => false, 'slug'=>'service')
		)
	);
}
add_action( 'init', 'create_post_type_msign_services' );
/* Custom Post Type: Clients */
function create_post_type_testimonies() {
	register_post_type( 'testimonies',
		array(
			'labels' => array(
				'name' => __( 'Clients', 'msign' ),
				'menu_name' => 'Clients',		
				'singular_name' => __('Client', 'msign'),
				'add_new' => __('Add New Client', 'msign'),
				'add_new_item' => __('Add New Client', 'msign'),
				'edit_item' => __('Edit Client', 'msign'),
				'new_item' => __('New Client', 'msign'),
				'all_items' => __('All Clients', 'msign'),
				'view_item' => __('View Client', 'msign'),
				'search_items' => __('Search Clients', 'msign'),
				'not_found' =>  __('No Clients found', 'msign'),
				'not_found_in_trash' => __('No Clients found in Trash', 'msign'), 
			),
        'menu_icon' => '',    
		'description' => __('These custom posts will appear on the Clients page template and on the homepage. These posts allow you to add clients and testimonies', 'msign'),
		'public' => false,
		'has_archive' => false,
		'show_in_nav_menus' => false,
		'exclude_from_search' => true,
		'supports' => array('editor', 'excerpt', 'thumbnail','title'),
		'rewrite' => array('with_front' => false, 'slug'=>'client')
		)
	);
}
add_action( 'init', 'create_post_type_testimonies' );
/* Custom Post Type: Members */
function create_post_type_members() {
	register_post_type( 'members',
		array(
			'labels' => array(
				'name' => __( 'Members', 'msign' ),
				'menu_name' => 'Members',		
				'singular_name' => __('Member', 'msign'),
				'add_new' => __('Add New Member', 'msign'),
				'add_new_item' => __('Add New Member', 'msign'),
				'edit_item' => __('Edit Member', 'msign'),
				'new_item' => __('New Member', 'msign'),
				'all_items' => __('All Members', 'msign'),
				'view_item' => __('View Member', 'msign'),
				'search_items' => __('Search Members', 'msign'),
				'not_found' =>  __('No Members found', 'msign'),
				'not_found_in_trash' => __('No Members found in Trash', 'msign'), 
			),
        'menu_icon' => '',     
		'description' => __('These custom posts will appear on the members page template and about us page template.', 'msign'),
		'public' => false,
		'has_archive' => false,
		'show_in_nav_menus' => false,
		'exclude_from_search' => true,
		'supports' => array('editor', 'thumbnail','title'),
		'rewrite' => array('with_front' => false, 'slug'=>'member')
		)
	);
}
add_action( 'init', 'create_post_type_members' );
/* Custom Post Type: Members */
function create_post_type_approach() {
	register_post_type( 'approach',
		array(
			'labels' => array(
				'name' => __( 'Work Process', 'msign' ),
				'menu_name' => 'Work Process',		
				'singular_name' => __('Process Step', 'msign'),
				'add_new' => __('Add New Process Step', 'msign'),
				'add_new_item' => __('Add Process Step', 'msign'),
				'edit_item' => __('Edit Process Step', 'msign'),
				'new_item' => __('New Process Step', 'msign'),
				'all_items' => __('All Process Steps', 'msign'),
				'view_item' => __('View Process Step', 'msign'),
				'search_items' => __('Search Process Steps', 'msign'),
				'not_found' =>  __('No Process Steps found', 'msign'),
				'not_found_in_trash' => __('No Process Steps found in Trash', 'msign'), 
			),
        'menu_icon' => '',     
		'description' => __('These custom posts can be used to describe a certain work approach of your activities.', 'msign'),
		'public' => false,
		'has_archive' => false,
		'supports' => array('editor', 'thumbnail','title'),
		'rewrite' => array('with_front' => false, 'slug'=>'workapproach')
		)
	);
}
add_action( 'init', 'create_post_type_approach' );
function create_post_type_widget() {
	register_post_type( 'custom-widget',
		array(
			'labels' => array(
				'name' => __( 'Custom Widgets', 'msign' ),
				'menu_name' => 'Custom Widgets',		
				'singular_name' => __('Custom Widget', 'msign'),
				'add_new' => __('Add New Custom Widget', 'msign'),
				'add_new_item' => __('Add New Custom Widget', 'msign'),
				'edit_item' => __('Edit Custom Widget', 'msign'),
				'new_item' => __('New Custom Widget', 'msign'),
				'all_items' => __('All Custom Widgets', 'msign'),
				'view_item' => __('View Custom Widget', 'msign'),
				'search_items' => __('Search Custom Widgets', 'msign'),
				'not_found' =>  __('No Custom Widgets found', 'msign'),
				'not_found_in_trash' => __('No Custom Widgets found in Trash', 'msign'), 
			),
        'menu_icon' => '',     
		'description' => __('These custom post type can be used to store custom widgets', 'msign'),
		'public' => false,
		'has_archive' => false,
		'supports' => array('editor', 'thumbnail','title'),
		'rewrite' => array('with_front' => false, 'slug'=>'custom-widget')
		)
	);
}
add_action( 'init', 'create_post_type_widget' );
/* Flushes permalinks after theme is activated */
function msign_rewrite_flush() {
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'msign_rewrite_flush' );
/* Custom Post Messages */
function portfolio_project_updated_messages( $messages ) {
        global $post, $post_ID;
        $messages['portfolio_project'] = array(
                0 => '', // Unused. Messages start at index 1.
                1 => sprintf( __('Portfolio project edited. <a href="%s">View project</a>', 'msign'), esc_url( get_permalink($post_ID) ) ),
                2 => __('Custom field edited.', 'msign'),
                3 => __('Custom field deleted.', 'msign'),
                4 => __('Portfolio project edited.', 'msign'),
                5 => isset($_GET['revision']) ? sprintf( __('Portfolio project revised to %s.', 'msign'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
                6 => sprintf( __('Portfolio project published. <a href="%s">View portfolio project.</a>', 'msign'), esc_url( get_permalink($post_ID) ) ),
                7 => __('Portfolio project saved.', 'msign'),
                8 => sprintf( __('Portfolio project submitted. <a target="_blank" href="%s">Preview project</a>', 'msign'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
                9 => sprintf( __('Portfolio project planned for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview</a>', 'msign'),
                date_i18n( __( 'M j, Y @ G:i', 'msign' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
                10 => sprintf( __('Draft for project edited. <a target="_blank" href="%s">Preview project</a>', 'msign'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        );
        return $messages;
}
add_filter('post_updated_messages', 'portfolio_project_updated_messages');
function feature_updated_messages( $messages ) {
        global $post, $post_ID;
        $messages['feature'] = array(
                0 => '', // Unused. Messages start at index 1.
                1 => __('Slider item edited.', 'msign'),
                2 => __('Custom field edited.', 'msign'),
                3 => __('Custom field deleted.', 'msign'),
                4 => __('Slider item edited.', 'msign'), 
                5 => isset($_GET['revision']) ? sprintf( __('Slider item restored to revision of %s', 'msign'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
                6 => __('Slider item published.', 'msign'),
                7 => __('Slider item saved.', 'msign'),
                8 => __('Slider item submitted.', 'msign'),
                9 => sprintf( __('Slider item planned for: <strong>%1$s</strong>.', 'msign'),
                date_i18n( __( 'M j, Y @ G:i', 'msign' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
                10 => __('Draft for slider item edited.', 'msign')
        );
        return $messages;
}
add_filter('post_updated_messages', 'feature_updated_messages');
function msign_services_updated_messages( $messages ) {
        global $post, $post_ID;
        $messages['services'] = array(
                0 => '', // Unused. Messages start at index 1.
                1 => __('Service edited.', 'msign'),
                2 => __('Custom field edited.', 'msign'),
                3 => __('Custom field deleted.', 'msign'),
                4 => __('Service edited.', 'msign'),
                5 => isset($_GET['revision']) ? sprintf( __('Service restored to revision of %s', 'msign'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
                6 => __('Service published.', 'msign'),
                7 => __('Service saved.', 'msign'),
                8 => __('Service submitted.', 'msign'),
                9 => sprintf( __('Service planned for: <strong>%1$s</strong>.', 'msign'),
                date_i18n( __( 'M j, Y @ G:i', 'msign' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
                10 => __('Draft for Service edited.', 'msign')
        );
        return $messages;
}
add_filter('post_updated_messages', 'msign_services_updated_messages');
function msign_testimonies_updated_messages( $messages ) {
        global $post, $post_ID;
        $messages['testimonies'] = array(
                0 => '', // Unused. Messages start at index 1.
                1 => __('Client edited.', 'msign'),
                2 => __('Custom field edited.', 'msign'),
                3 => __('Custom field deleted.', 'msign'),
                4 => __('Client edited.', 'msign'),
                5 => isset($_GET['revision']) ? sprintf( __('Client restored to revision of %s', 'msign'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
                6 => __('Client published.', 'msign'),
                7 => __('Client saved.', 'msign'),
                8 => __('Client submitted.', 'msign'),
                9 => sprintf( __('Client planned for: <strong>%1$s</strong>.', 'msign'),
                date_i18n( __( 'M j, Y @ G:i', 'msign' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
                10 => __('Draft for Client edited.', 'msign')
        );
        return $messages;
}
add_filter('post_updated_messages', 'msign_testimonies_updated_messages');
function msign_members_updated_messages( $messages ) {
        global $post, $post_ID;
        $messages['members'] = array(
                0 => '', // Unused. Messages start at index 1.
                1 => __('Member edited.', 'msign'),
                2 => __('Custom field edited.', 'msign'),
                3 => __('Custom field deleted.', 'msign'),
                4 => __('Member edited.', 'msign'),
                5 => isset($_GET['revision']) ? sprintf( __('Member restored to revision of %s', 'msign'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
                6 => __('Member published.', 'msign'),
                7 => __('Member saved.', 'msign'),
                8 => __('Member submitted.', 'msign'),
                9 => sprintf( __('Member planned for: <strong>%1$s</strong>.', 'msign'),
                date_i18n( __( 'M j, Y @ G:i', 'msign' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
                10 => __('Draft for Member edited.', 'msign')
        );
        return $messages;
}
add_filter('post_updated_messages', 'msign_members_updated_messages');
function msign_approach_updated_messages( $messages ) {
        global $post, $post_ID;
        $messages['approach'] = array(
                0 => '', // Unused. Messages start at index 1.
                1 => __('Work Approach edited.', 'msign'),
                2 => __('Custom field edited.', 'msign'),
                3 => __('Custom field deleted.', 'msign'),
                4 => __('Work Approach edited.', 'msign'),
                5 => isset($_GET['revision']) ? sprintf( __('Work Approach restored to revision of %s', 'msign'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
                6 => __('Work Approach published.', 'msign'),
                7 => __('Work Approach saved.', 'msign'),
                8 => __('Work Approach submitted.', 'msign'),
                9 => sprintf( __('Work Approach planned for: <strong>%1$s</strong>.', 'msign'),
                date_i18n( __( 'M j, Y @ G:i', 'msign' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
                10 => __('Draft for Work Approach edited.', 'msign')
        );
        return $messages;
}
add_filter('post_updated_messages', 'msign_approach_updated_messages');
function msign_custom_widget_updated_messages( $messages ) {
        global $post, $post_ID;
        $messages['custom-widget'] = array(
                0 => '', // Unused. Messages start at index 1.
                1 => __('Custom Widget edited.', 'msign'),
                2 => __('Custom field edited.', 'msign'),
                3 => __('Custom field deleted.', 'msign'),
                4 => __('Custom Widget edited.', 'msign'),
                5 => isset($_GET['revision']) ? sprintf( __('Custom Widget restored to revision of %s', 'msign'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
                6 => __('Custom Widget published.', 'msign'),
                7 => __('Custom Widget saved.', 'msign'),
                8 => __('Custom Widget submitted.', 'msign'),
                9 => sprintf( __('Custom Widget planned for: <strong>%1$s</strong>.', 'msign'),
                date_i18n( __( 'M j, Y @ G:i', 'msign' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
                10 => __('Draft for Custom Widget edited.', 'msign')
        );
        return $messages;
}
add_filter('post_updated_messages', 'msign_custom_widget_updated_messages');
/* Creates custom category for portfolio items and services */
function msign_taxonomies() {
	register_taxonomy(
		'project_category',		
		'portfolio_project',		
		array(
			'hierarchical' => true,
			'label' => __('Project Type','msign'),	
			'query_var' => true,	
			'rewrite' => array( 'slug' => 'project-type' ),	
		)
	);
}
add_action('init', 'msign_taxonomies', 0);
/* Custom columns for services and portfolio items */
add_filter("manage_edit-services_columns", "services_edit_columns");
function services_edit_columns($columns){
        $columns = array(
            "cb" => "<input type=\"checkbox\" />",
            "title" => __("Service", 'msign'),
            "thumbnail" => __("Thumbnail", 'msign'),
			"description" => __("Description", 'msign')
        );  
        return $columns;
}  
add_action("manage_services_posts_custom_column",  "services_custom_columns"); 
function services_custom_columns($column){
        global $post;
        switch ($column)
        {
            case "thumbnail":
                the_post_thumbnail( 'img-thumbnail' );
                break;
			case "description":
				the_excerpt();
				break;
        }
}  
add_filter("manage_edit-portfolio_project_columns", "project_edit_columns");
function project_edit_columns($columns){
        $columns = array(
            "cb" => "<input type=\"checkbox\" />",
            "title" => __('Project','msign'),
            "thumbnail" => __('Thumbnail','msign'),
            "type" => __('Project Type','msign'),
        );  
        return $columns;
}  
add_action("manage_portfolio_project_posts_custom_column",  "project_custom_columns"); 
function project_custom_columns($column){
        global $post;
        switch ($column)
        {
            case "thumbnail":
                the_post_thumbnail( 'img-thumbnail' );
                break;
            case "type":
                echo get_the_term_list($post->ID, 'project_category', '', ', ','');
                break;
        }
} 