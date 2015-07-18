<?php 
/*******************************/
/* Metaboxes
/*******************************/

/* Post Custom Fields settings */
global $meta_box; // Declare global variable so later foreach loops will not be broken
$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
$template_file = get_post_meta($post_id,'_wp_page_template',TRUE); // check for a template type
/* ----------- For single post types ----------------/
/* Metaboxes for single post */
$meta_box['post'] = array(
    'id' => 'post-format-meta',  
    'title' => 'Post Settings',    
    'context' => 'normal',    
    'priority' => 'high',
    'fields' => array(
		array(
			"id" => "post_video",
			"std" => "",
			"name" => __("Featured video:","msign"),
			"desc" => __("If you want a featured video in the post, use this box to paste the embed code.","msign"),
			"type" => "textarea",
		),
		array(
			"id" => "post_layout",
			"std" => "",
			"name" => __("Post lay-out:","msign"),
			"desc" => __("Choose the desired lay-out for this post (if none is selected, the theme default settings are used).", "msign"),
			"type" => "layout",
			"options" => array('sidebar-left', 'sidebar-right', 'one-column')
		),
		array(
			"id" => "post_sidebar",
			"std" => "",
			"name" => __("Use custom widgets:","msign"),
			"desc" => __("If you want to disable the standard post sidebar for this post, check this field. Instead, custom widgets can be used.","msign"),
			"type" => "checkbox",
		),	
		array(
			"id" => "post_metaheader",
			"std" => "",
			"name" => __("Disable all meta header (category, date, author, comments) information:","msign"),
			"desc" => __("To disable all meta header information for this post, enable this box.","msign"),
			"type" => "checkbox",
		),				
		array(
			"id" => "post_breadcrumbs",
			"std" => "",
			"name" => __("Disable breadcrumbs for this post:","msign"),
			"desc" => __("To disable the breadcrumbs navigation for this post, check this field.","msign"),
			"type" => "checkbox",
		),
		array(
			"id" => "post_seo_title",
			"std" => "",
			"name" => __("SEO Title:","msign"),
			"desc" => __("Change this to alter the title of the post in the head section of the site and displayed in search engines.","msign"),
			"type" => "text",
		),
		array(
			"id" => "post_seo_description",
			"std" => "",
			"name" => __("Post Seo Description:","msign"),
			"desc" => __("Change this to change the post description for search engines.","msign"),
			"type" => "textarea",
		),				
		array(
			"id" => "post_featured_image",
			"std" => "",
			"name" => __("Disable featured image:","msign"),
			"desc" => __("Checking this box will disable the featured image when viewing this single post.","msign"),
			"type" => "checkbox",
		),						
		array(
			"id" => "post_related_title",
			"std" => "",
			"name" => __("Title above related posts:","msign"),
			"desc" => __("Use this if you want to override the global theme settings for related posts title for this post only.","msign"),
			"type" => "text",
		),
		array(
			"id" => "post_related_number",
			"std" => "",
			"name" => __("Number of related posts to show:","msign"),
			"desc" => __("Use this if you want to override the global theme settings for related posts number for this post only.","msign"),
			"type" => "text",
		),					
		array(
			"id" => "post_related",
			"std" => "",
			"name" => __("Disable related posts for this post:","msign"),
			"desc" => __("Use this if you want to override the global theme settings for the related posts for this post only .","msign"),
			"type" => "checkbox",
		),				
		array(
			"id" => "post_social",
			"std" => "",
			"name" => __("Disable social sharing icons for this post only:","msign"),
			"desc" => __("Check this if you want to override the global theme settings for social sharing for this post only.","msign"),
			"type" => "checkbox",
		),	
		array(
			"id" => "post_author_disable",
			"std" => "",
			"name" => __("Disable author description for this post only:","msign"),
			"desc" => __("Check this if you want to override the global theme settings for author descriptions for this post only.","msign"),
			"type" => "checkbox",
		),	
		array(
			"id" => "post_comments_disable",
			"std" => "",
			"name" => __("Disable comments for this post only:","msign"),
			"desc" => __("Check this box to disable comments for this post.","msign"),
			"type" => "checkbox",
		),			
		array(
			"id" => "post_postloop_enable",
			"std" => "",
			"name" => __("Enable a custom post loop at the bottom of this post:","msign"),
			"desc" => __("Enabling this field allows for a number of posts from a certain type to be displayed at the bottom of this post.","msign"),
			"type" => "checkbox",
		),	
		array(
			"id" => "post_postloop_text",
			"std" => "",
			"name" => __("Title above custom post loop:","msign"),
			"desc" => __("Add the title above the custom post loop.","msign"),
			"type" => "text",
		),		
		array(
			"id" => "post_postloop",
			"std" => "",
			"name" => __("Post type:","msign"),
			"desc" => __("Choose the post type to be shown.","msign"),
			"type" => "postloop",
		),	
		array(
			"id" => "post_postloop_amount",
			"std" => "",
			"name" => __("Number of posts to be shown:","msign"),
			"desc" => __("Choose the number of posts which you want to show under the post.","msign"),
			"type" => "text",
		),
		array(
			"id" => "post_postloop_order",
			"options" => array("date", "title", "rand", "comment_count", "author"),
			"std" => "date",
			"name" => __("Order posts by:","msign"),
			"desc" => __("Choose how the posts should be ordered.","msign"),
			"type" => "select",
		),														
	),
);
/* ----------- For pages & page templates ----------------/
/* Metaboxes for single page */
$meta_box['page'] = array(
    'id' => 'post-format-meta',  
    'title' => 'Page additional fields',    
    'context' => 'normal',    
    'priority' => 'high',
    'fields' => array(
		array(
			"id" => "post_video",
			"std" => "",
			"name" => __("Featured video:","msign"),
			"desc" => __("If you want a featured video in this page, use this box to paste the embed code.","msign"),
			"type" => "textarea",
		),	
		array(
			"id" => "st_quote",
			"std" => "",
			"name" => __("Statement:","msign"),
			"desc" => __("Add a statement to your page, which will appear above the main title.","msign"),
			"type" => "text",
		),
		array(
			"id" => "posts_amount",
			"std" => "",
			"name" => __("Posts per page:","msign"),
			"desc" => __("When using a pagetemplate with a (custom) post index, specify the amount of posts to be shown per page here. If no value is entered, the default values from the themesettings are used.","msign"),
			"type" => "text",
		),	
		array(
			"id" => "posts_order",
			"options" => array("date", "title", "rand", "comment_count", "author"),
			"std" => "date",
			"name" => __("Order posts by:","msign"),
			"desc" => __("When using a pagetemplate with a (custom) post index, choose how the posts should be ordered.","msign"),
			"type" => "select",
		),					
		array(
			"id" => "post_layout",
			"std" => "",
			"name" => __("Post lay-out:","msign"),
			"desc" => __("Choose the desired lay-out for this post (if none is selected, the theme default settings are used).", "msign"),
			"type" => "layout",
			"options" => array('sidebar-left', 'sidebar-right', 'one-column')
		),					
		array(
			"id" => "post_sidebar",
			"std" => "",
			"name" => __("Use custom widgets:","msign"),
			"desc" => __("To disable the standard post sidebar for this post, check this field. Instead, custom widgets can be used.","msign"),
			"type" => "checkbox",
		),	
		array(
			"id" => "post_breadcrumbs",
			"std" => "",
			"name" => __("Disable breadcrumbs for this post:","msign"),
			"desc" => __("To disable the breadcrumbs navigation for this post, check this field.","msign"),
			"type" => "checkbox",
		),	
		array(
			"id" => "post_seo_title",
			"std" => "",
			"name" => __("SEO Title:","msign"),
			"desc" => __("Change this to alter the title of the post in the head section of the site and displayed in search engines.","msign"),
			"type" => "text",
		),
		array(
			"id" => "post_seo_description",
			"std" => "",
			"name" => __("Post SEO Description:","msign"),
			"desc" => __("Change this to change the post description for search engines.","msign"),
			"type" => "text",
		),					
		array(
			"id" => "post_postloop_enable",
			"std" => "",
			"name" => __("Enable a custom post loop at the bottom of this page:","msign"),
			"desc" => __("Enabling this field allows for a number of posts from a certain type to be displayed at the bottom of this post.","msign"),
			"type" => "checkbox",
		),	
		array(
			"id" => "post_postloop_text",
			"std" => "",
			"name" => __("Title above custom post loop:","msign"),
			"desc" => __("Add the title above the custom post loop.","msign"),
			"type" => "text",
		),		
		array(
			"id" => "post_postloop",
			"std" => "",
			"name" => __("Post type:","msign"),
			"desc" => __("Choose the post type to be shown (querying the same post type as a template will not work).","msign"),
			"type" => "postloop",
		),	
		array(
			"id" => "post_postloop_amount",
			"std" => "",
			"name" => __("Number of posts to be shown:","msign"),
			"desc" => __("Choose the number of posts which you want to show under the post.","msign"),
			"type" => "text",
		),	
		array(
			"id" => "post_postloop_order",
			"options" => array("date", "title", "rand", "comment_count", "author"),
			"std" => "date",
			"name" => __("Order posts by:","msign"),
			"desc" => __("Choose how the posts from the custom loop should be ordered.","msign"),
			"type" => "select",
		),					
	),
);
/* Metaboxes for slider items */
$meta_box['feature'] = array(
    'id' => 'post-format-meta',  
    'title' => 'Slider Settings',    
    'context' => 'normal',    
    'priority' => 'high',
    'fields' => array(
		array(
			"id" => "fpfeature_caption",
			"std" => "",
			"name" => __("Caption in the slider field:", "msign"),
			"desc" => __("Fill in the caption that describes the content of your slider.", "msign"),
			"type" => "textarea",
		),
		array(
			"id" => "fpfeature_link",
			"std" => "",
			"name" => __("Post or page to link:", "msign"),
			"desc" => __("Fill in the webpage or post where you want to link the slider to.", "msign"),
			"type" => "text",
		),	
		array(
			"id" => "fpfeature_link_text",
			"std" => "",
			"name" => __("Link text", "msign"),
			"desc" => __("Text describing the link.", "msign"),
			"type" => "text",
		),	
		array(
			"id" => "fpfeature_image",
			"std" => "",
			"name" => __("Link of featured image:", "msign"),
			"desc" => __("Filling in this field will allow you to add an image to the post in the slider on the homepage.", "msign"),
			"type" => "upload",
		),
		array(
			"id" => "fpfeature_video",
			"std" => "",
			"name" => __("Embed code to featured video:", "msign"),
			"desc" => __("Filling in this field will allow you to add an video to the post in the slider on the homepage.", "msign"),
			"type" => "textarea",
		),
	),
);
/* Metaboxes for portfolio items */
$meta_box['portfolio_project'] = array(
	'id' => 'post-format-meta-portfolio-slider',  
    'title' => 'Project Additional Settings',    
    'context' => 'normal',    
    'priority' => 'high',
    'fields' => array(
		array(
			"id" => "st_quote",
			"std" => "",
			"name" => __("Statement:","msign"),
			"desc" => __("Add a statement to your project, which will appear above the main title.","msign"),
			"type" => "text",
		),		
		array(
			"id" => "project_slider1",
			"std" => "",
			"name" => __("Slider Image 1:", "msign"),
			"desc" => __("Add the url of another slider image or the embed code of a video in this field. If this field is empty, the featured image is used instead", "msign"),
			"type" => "textarea",
		), 		
		array(
			"id" => "project_slider2",
			"std" => "",
			"name" => __("Slider Image 2:", "msign"),
			"desc" => __("Add the url of another slider image or the embed code of a video in this field.", "msign"),
			"type" => "textarea",
		),
		array(
			"id" => "project_slider3",
			"std" => "",
			"name" => __("Slider Image 3:", "msign"),
			"desc" => __("Add the url of another slider image or the embed code of a video in this field.", "msign"),
			"type" => "textarea",
		),
		array(
			"id" => "project_slider4",
			"std" => "",
			"name" => __("Slider Image 4:", "msign"),
			"desc" => __("Add the url of another slider image or the embed code of a video in this field.", "msign"),
			"type" => "textarea",
		),
		array(
			"id" => "project_slider5",
			"std" => "",
			"name" => __("Slider Image 5:", "msign"),
			"desc" => __("Add the url of another slider image or the embed code of a video in this field.", "msign"),
			"type" => "textarea",
		),
		array(
			"id" => "post_layout",
			"std" => "",
			"name" => __("Post lay-out:","msign"),
			"desc" => __("Choose the desired lay-out for this post (if none is selected, the theme default settings are used).", "msign"),
			"type" => "layout",
			"options" => array('sidebar-left', 'sidebar-right', 'one-column')
		),
		array(
			"id" => "post_sidebar",
			"std" => "",
			"name" => __("Use custom widgets:","msign"),
			"desc" => __("To disable the standard post sidebar for this item, check this field. Instead, custom widgets can be used.","msign"),
			"type" => "checkbox",
		),
		array(
			"id" => "post_breadcrumbs",
			"std" => "",
			"name" => __("Disable breadcrumbs:","msign"),
			"desc" => __("To disable the breadcrumbs navigation for this post, check this field.","msign"),
			"type" => "checkbox",
		),	
		array(
			"id" => "post_social",
			"std" => "",
			"name" => __("Disable social sharing icons for this project only:","msign"),
			"desc" => __("Check this if you want to override the global theme settings for social sharing for this project only.","msign"),
			"type" => "checkbox",
		),
		array(
			"id" => "post_related_title",
			"std" => "",
			"name" => __("Title above related posts:","msign"),
			"desc" => __("Use this if you want to override the global theme settings for related posts title for this post only.","msign"),
			"type" => "text",
		),
		array(
			"id" => "post_related_number",
			"std" => "",
			"name" => __("Number of related posts to show:","msign"),
			"desc" => __("Use this if you want to override the global theme settings for related posts number for this post only.","msign"),
			"type" => "text",
		),					
		array(
			"id" => "post_related",
			"std" => "",
			"name" => __("Disable related posts for this post:","msign"),
			"desc" => __("Use this if you want to override the global theme settings for the related posts for this post only .","msign"),
			"type" => "checkbox",
		),					
		array(
			"id" => "post_seo_title",
			"std" => "",
			"name" => __("SEO Title:","msign"),
			"desc" => __("Change this to alter the title of the post in the head section of the site and displayed in search engines.","msign"),
			"type" => "text",
		),
		array(
			"id" => "post_seo_description",
			"std" => "",
			"name" => __("Post SEO Description:","msign"),
			"desc" => __("Change this to change the post description for search engines.","msign"),
			"type" => "text",
		),								
		array(
			"id" => "project_interest",
			"std" => "",
			"name" => __("Project fields of interest:", "msign"),
			"desc" => __("Describe additional fields of interest, for example: 'Application Development'.", "msign"),
			"type" => "text",
		),
		array(
			"id" => "project_client",
			"std" => "",
			"name" => __("Project client:", "msign"),
			"desc" => __("Add the client for whom this project was done.", "msign"),
			"type" => "text",
		),
		array(
			"id" => "website_client",
			"std" => "",
			"name" => __("Website client:", "msign"),
			"desc" => __("Add the website of the client for whom this project was done.", "msign"),
			"type" => "text",
		),
		array(
			"id" => "project_website",
			"std" => "",
			"name" => __("Project Website:", "msign"),
			"desc" => __("Add the webpage or url linked to this project", "msign"),
			"type" => "text",
		),	
		array(
			"id" => "project_details",
			"std" => "",
			"name" => __("Project Details:", "msign"),
			"desc" => __("Add any additional details of the project here.", "msign"),
			"type" => "textarea",
		),	
		array(
			"id" => "post_postloop_enable",
			"std" => "",
			"name" => __("Enable a custom post loop at the bottom of this post:","msign"),
			"desc" => __("Enabling this field allows for a number of posts from a certain type to be displayed at the bottom of this post.","msign"),
			"type" => "checkbox",
		),	
		array(
			"id" => "post_postloop_text",
			"std" => "",
			"name" => __("Title above custom post loop:","msign"),
			"desc" => __("Add the title above the custom post loop.","msign"),
			"type" => "text",
		),		
		array(
			"id" => "post_postloop",
			"std" => "",
			"name" => __("Post type:","msign"),
			"desc" => __("Choose the post type to be shown.","msign"),
			"type" => "postloop",
		),	
		array(
			"id" => "post_postloop_amount",
			"std" => "",
			"name" => __("Number of posts to be shown:","msign"),
			"desc" => __("Choose the number of posts which you want to show under the post.","msign"),
			"type" => "text",
		),	
		array(
			"id" => "post_postloop_order",
			"options" => array("date", "title", "rand", "comment_count", "author"),
			"std" => "date",
			"name" => __("Order posts by:","msign"),
			"desc" => __("Choose how the posts should be ordered.","msign"),
			"type" => "select",
		),						
	),
);
/* Metaboxes for service items and service overview page */
$meta_box['services'] = array(
    'id' => 'post-format-meta',  
    'title' => 'Services Additional Settings',    
    'context' => 'normal',    
    'priority' => 'high',
    'fields' => array(
		array(
			"id" => "post_video",
			"std" => "",
			"name" => __("Featured video:","msign"),
			"desc" => __("If you want a featured video for this service, use this box to paste the embed code.","msign"),
			"type" => "textarea",
		),	
		array(
			"id" => "st_quote",
			"std" => "",
			"name" => __("Statement:","msign"),
			"desc" => __("Add a statement to your service, which will appear above the main title.","msign"),
			"type" => "text",
		),		
		array(
			"id" => "post_layout",
			"std" => "",
			"name" => __("Post lay-out:","msign"),
			"desc" => __("Choose the desired lay-out for this post (if none is selected, the theme default settings are used).", "msign"),
			"type" => "layout",
			"options" => array('sidebar-left', 'sidebar-right', 'one-column')
		),
		array(
			"id" => "post_sidebar",
			"std" => "",
			"name" => __("Use custom widgets:","msign"),
			"desc" => __("To disable the standard sidebar for this item, check this field. Instead, custom widgets can be used.","msign"),
			"type" => "checkbox",
		),	
		array(
			"id" => "post_breadcrumbs",
			"std" => "",
			"name" => __("Disable breadcrumbs:","msign"),
			"desc" => __("To disable the breadcrumbs navigation for this post, check this field.","msign"),
			"type" => "checkbox",
		),	
		array(
			"id" => "post_seo_title",
			"std" => "",
			"name" => __("SEO Title:","msign"),
			"desc" => __("Change this to alter the title of the post in the head section of the site and displayed in search engines.","msign"),
			"type" => "text",
		),
		array(
			"id" => "post_seo_description",
			"std" => "",
			"name" => __("Post SEO Description:","msign"),
			"desc" => __("Change this to change the post description for search engines.","msign"),
			"type" => "text",
		),			
		array(
			"id" => "post_featured_image",
			"std" => "",
			"name" => __("Disable featured image to show on this service:","msign"),
			"desc" => __("Checking this box will disable the featured image when viewing this single service.","msign"),
			"type" => "checkbox",
		),						
		array(
			"id" => "services_header-1",
			"std" => "",
			"name" => __("Title additional details field 1:","msign"),
			"desc" => __("Fill in the title for any additional details for the service in this field.","msign"),
			"type" => "text",
		),
		array(
			"id" => "services_details-1",
			"std" => "",
			"name" => __("Text additional details field 1","msign"),
			"desc" => __("Fill in the paragraph for any additional details for the service in this field.","msign"),
			"type" => "textarea",
		),	
		array(
			"id" => "services_header-2",
			"std" => "",
			"name" => __("Title additional details field 2:","msign"),
			"desc" => __("Fill in the title for any additional details for the service in this field.","msign"),
			"type" => "text",
		),
		array(
			"id" => "services_details-2",
			"std" => "",
			"name" => __("Text additional details field 2","msign"),
			"desc" => __("Fill in the paragraph for any additional details for the service in this field.","msign"),
			"type" => "textarea",
		),
		array(
			"id" => "services_header-3",
			"std" => "",
			"name" => __("Title additional details field 3:","msign"),
			"desc" => __("Fill in the title for any additional details for the service in this field.","msign"),
			"type" => "text",
		),
		array(
			"id" => "services_details-3",
			"std" => "",
			"name" => __("Text additional details field 3","msign"),
			"desc" => __("Fill in the paragraph for any additional details for the service in this field.","msign"),
			"type" => "textarea",
		),	
		array(
			"id" => "post_postloop_enable",
			"std" => "",
			"name" => __("Enable a custom post loop at the bottom of this post:","msign"),
			"desc" => __("Enabling this field allows for a number of posts from a certain type to be displayed at the bottom of this post.","msign"),
			"type" => "checkbox",
		),	
		array(
			"id" => "post_postloop_text",
			"std" => "",
			"name" => __("Title above custom post loop:","msign"),
			"desc" => __("Add the title above the custom post loop.","msign"),
			"type" => "text",
		),		
		array(
			"id" => "post_postloop",
			"std" => "",
			"name" => __("Post type:","msign"),
			"desc" => __("Choose the post type to be shown.","msign"),
			"type" => "postloop",
		),	
		array(
			"id" => "post_postloop_amount",
			"std" => "",
			"name" => __("Number of posts to be shown:","msign"),
			"desc" => __("Choose the number of posts which you want to show under the post.","msign"),
			"type" => "text",
		),				
	),
);
/* Metaboxes for member items and member overview page */
$meta_box['members'] = array(
    'id' => 'post-format-meta',  
    'title' => 'Member Settings',    
    'context' => 'normal',    
    'priority' => 'high',
    'fields' => array(
		array(
			"id" => "member_function",
			"options" => array("founder","employee","partner"),
			"std" => "employee",
			"name" => __("Position of added member:","msign"),
			"desc" => __("Describe the position of the member.","msign"),
			"type" => "select",
		),
		array(
			"id" => "member_linkedin",
			"std" => "",
			"name" => __("Linkedin Profile:","msign"),
			"desc" => __("Add the Linkedin profile of this team member.","msign"),
			"type" => "text",
		),	
		array(
			"id" => "member_facebook",
			"std" => "",
			"name" => __("Facebook Profile:","msign"),
			"desc" => __("Add the Facebook profile of this team member.","msign"),
			"type" => "text",
		),
		array(
			"id" => "member_twitter",
			"std" => "",
			"name" => __("Twitter Profile:","msign"),
			"desc" => __("Add the Twitter profile of this team member.","msign"),
			"type" => "text",
		),
		array(
			"id" => "member_gplus",
			"std" => "",
			"name" => __("Google Plus Profile:","msign"),
			"desc" => __("Add the Google Plus profile of this team member.","msign"),
			"type" => "text",
		),
		array(
			"id" => "member_behance",
			"std" => "",
			"name" => __("Behance Profile:","msign"),
			"desc" => __("Add the Behance profile of this team member.","msign"),
			"type" => "text",
		),						
	),
);
/* Metabox for approach post type */
$meta_box['approach'] = array(
    'id' => 'post-format-meta',  
    'title' => 'Work Approaches Additional Settings',    
    'context' => 'normal',    
    'priority' => 'high',
    'fields' => array(
		array(
            'name' => __('Order of approaches',"msign"),
            'desc' => __('Please indicate what the order of the approach step is. A lower number is rendered first.',"msign"),
            'id' => 'approach_order',
            'type' => 'select',
			'options' => array(01,02,03,04,05,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25),
            'std' => ''
        ),
	), 
);
if ($template_file == 'contact.php' ) {
	$meta_box['page'] = array(
		'id' => 'post-format-meta',  
		'title' => 'Contact (semantic) additional fields',    
		'context' => 'normal',    
		'priority' => 'high',
		'fields' => array(
			array(
				"id" => "st_quote",
				"std" => "",
				"name" => __("Statement:","msign"),
				"desc" => __("Add a statement to your service, which will appear above the main title.","msign"),
				"type" => "text",
			),		
			array(
				"id" => "post_layout",
				"std" => "",
				"name" => __("Post lay-out:","msign"),
				"desc" => __("Choose the desired lay-out for this post (if none is selected, the theme default settings are used).", "msign"),
				"type" => "layout",
				"options" => array('sidebar-left', 'sidebar-right', 'one-column')
			),
			array(
				"id" => "post_sidebar",
				"std" => "",
				"name" => __("Use custom widgets:","msign"),
				"desc" => __("To disable the standard sidebar for this item, check this field. Instead, custom widgets can be used.","msign"),
				"type" => "checkbox",
			),	
			array(
				"id" => "post_breadcrumbs",
				"std" => "",
				"name" => __("Disable breadcrumbs:","msign"),
				"desc" => __("To disable the breadcrumbs navigation for this post, check this field.","msign"),
				"type" => "checkbox",
			),
			array(
				"id" => "post_seo_title",
				"std" => "",
				"name" => __("SEO Title:","msign"),
				"desc" => __("Change this to alter the title of the post in the head section of the site and displayed in search engines.","msign"),
				"type" => "text",
			),
			array(
				"id" => "post_seo_description",
				"std" => "",
				"name" => __("Post SEO Description:","msign"),
				"desc" => __("Change this to change the post description for search engines.","msign"),
				"type" => "text",
			),				
			array(
				"id" => "contact_enable",
				"std" => "",
				"name" => __("Enable semantic contactaddress:","msign"),
				"desc" => __("Enable to show the semantic contactdata below on this page.","msign"),
				"type" => "checkbox",
			),									
			array(
				"id" => "contact_address",
				"std" => "",
				"name" => __("Address:","msign"),
				"desc" => __("Add a contact address.","msign"),
				"type" => "text",
			),
			array(
				"id" => "contact_post",
				"std" => "",
				"name" => __("Postal/zip code:","msign"),
				"desc" => __("Add a post/zip code.","msign"),
				"type" => "text",
			),
			array(
				"id" => "contact_city",
				"std" => "",
				"name" => __("City:","msign"),
				"desc" => __("Add the city of your contact address.","msign"),
				"type" => "text",
			),
			array(
				"id" => "contact_country",
				"std" => "",
				"name" => __("Country:","msign"),
				"desc" => __("Add the country of your contact address.","msign"),
				"type" => "text",
			),
			array(
				"id" => "contact_email",
				"std" => "",
				"name" => __("E-mail address:","msign"),
				"desc" => __("Enter e-mail adress.","msign"),
				"type" => "text",
			),
			array(
				"id" => "contact_phone",
				"std" => "",
				"name" => __("Phone number:","msign"),
				"desc" => __("Enter phone number.","msign"),
				"type" => "text",
			),
			array(
				"id" => "contact_social_media",
				"name" => __("Show social media links?","msign"),
				"desc" => __("Show social media links (showed if they filled in at the themesettings panel)","msign"),
				'type' => 'checkbox',
				'std' => ''
			),	
		),
	);
}
function msign_add_box() {
    global $meta_box, $post_type;  
    foreach($meta_box as $post_type => $value) {
        add_meta_box($value['id'], $value['title'], 'msign_format_box', $post_type, $value['context'], $value['priority']);
    }
}
function msign_format_box() {
  global $meta_box, $post;
  echo '<input type="hidden" name="msign_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
  echo '<table class="form-table">'; 
  foreach ($meta_box[$post->post_type]['fields'] as $field) {
      $meta = get_post_meta($post->ID, $field['id'], true);
      echo '<tr>'.
              '<th style="width:20%"><label for="'. $field['id'] .'"><h4 style="margin-top:0;">'. $field['name']. '</h4></label></th>'.
              '<td>';
      switch ($field['type']) {
          case 'text':
              echo '<input type="text" name="'. $field['id']. '" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['std']) . '" size="30" style="width:97%" />'. '<br /><span class="description">'. $field['desc'] . '</span>';
              break;
          case 'textarea':
              echo '<textarea name="'. $field['id']. '" id="'. $field['id']. '" cols="60" rows="4" style="width:97%">'. ($meta ? $meta : $field['std']) . '</textarea>'. '<br /><span class="description">'. $field['desc'] . '</span>';
              break;
          case 'select':
              echo '<div class="boxed-fields"><select name="'. $field['id'] . '" id="'. $field['id'] . '">';
              foreach ($field['options'] as $option) {
                  echo '<option '. ( $meta == $option ? ' selected="selected"' : '' ) . '>'. $option . '</option>';
              }
              echo '</select><br /><span class="description">'. $field['desc'] . '</span></div>';
              break;
          case 'radio':
		  	  echo '<div class="boxed-fields">';
              foreach ($field['options'] as $option) {
                  echo '<input type="radio" name="' . $field['id'] . '" value="' . $option['value'] . '"' . ( $meta == $option['value'] ? ' checked="checked"' : '' ) . ' />' . $option['name'];
              }
			  echo '<br /><span class="description">'. $field['desc'] . '</span></div>';
              break;
          case 'checkbox':
              echo '<div class="boxed-fields"><input type="checkbox" name="' . $field['id'] . '" id="' . $field['id'] . '"' . ( $meta ? ' checked="checked"' : '' ) . ' /><span class="description">'. $field['desc'] . '</span></div>';
              break;
		  case 'upload':
		  		echo '<div class="image-upload">';
                    if ( $meta ) { 
                    		echo '<img src="'. $meta .'" style="max-width:150px;  height:auto;" />';
                       } 					
					echo '<div class="input">
							<input id="'. $field['id'] .'" class="upload-url' . $field_class . '" type="text" name="'. $field['id'] .'" value="'. ($meta ? $meta : $field['std']) .  '" size="50" />
							<input id="upload_button" class="upload_button button" type="button" name="upload_button" value="'.__('Upload image', 'msign').'" />'. '<br /><span class="description">'. $field['desc'] . '</span>
					</div>
				</div>';
				break;	
		  case 'layout':
		  	 echo '<div class="boxed-fields">';
			 foreach ($field['options'] as $option) {
              	echo '<input type="radio" class="lay-out" id="'. $option .'" name="' . $field['id'] . '" value="' . $option . '"' . ( $meta == $option  ? ' checked="checked"' : '' ) . ' /><label for="'. $option .'">'. $option .'</label>'; 
			 }
			 echo '<br /><span class="description">'. $field['desc'] . '</span></div>';
             break;	
		  case 'postloop':
 			$post_types = array('post','services','portfolio_project', 'testimonies', 'members', 'approach'); 
			echo '<div class="boxed-fields"><select name="'. $field['id'] . '" id="'. $field['id'] . '">';
			foreach ($post_types as $post_type ) {
  					echo '<option '. ( $meta == $post_type ? ' selected="selected"' : ''). '>' . $post_type . '</option>';
				}
			echo '</select><br /><span class="description">'. $field['desc'] . '</span></div>';	  
		  break;	  
      }
      echo     '<td>'.'</tr>';
  }
  echo '</table>';
}
function msign_save_data($post_id) {
    global $meta_box,  $post;
    if (!wp_verify_nonce($_POST['msign_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    } 
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }   
    foreach ($meta_box[$post->post_type]['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];     
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}
add_action('save_post', 'msign_save_data');
add_action('admin_menu', 'msign_add_box');