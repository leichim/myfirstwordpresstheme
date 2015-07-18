<?php 
/*******************************/
/* THEMESETTINGS */
/*******************************/
class msign_ThemeOptions {
	
	/* Keep them for private use */
	private $tabs;
	private $options;
	private $themename;
	private $version;
	
	/* Start-up of class */
	public function __construct($tabs, $options, $themename, $version) {
		$this->options = $options;
		$this->tabs = $tabs;
		$this->themename = $themename;
		$this->version = $version;
		add_action('admin_init', array($this, 'msign_save_options') ); 
		add_action('admin_menu', array($this, 'msign_create_admin') );		
	}
	
    /* Register the menu and menu page*/ 
	public function msign_create_admin() {
		global $themename;
		add_theme_page($themename. __('Theme Settings', 'msign'), __('Theme Settings', 'msign'), 'manage_options', basename(__FILE__), array($this, 'msign_create_options_page'));
	}
	
    /* Save and update options */
	public function msign_save_options() {
		
        if ( isset($_GET['page']) && $_GET['page'] == basename(__FILE__) ) { 
			
            // Variables should exist  
			if ( isset($_POST['save_settings_security']) ) { $nonce = $_POST['save_settings_security']; }
			
            // Checks if nonce is valid and subsequently updates options, if they have a value
			if ( isset($nonce) && wp_verify_nonce( $nonce, 'save' ) ) {
				foreach ($this->options as $value) {
					if( isset( $_POST[ $value['id'] ] ) ) { 
						if( $value['type'] == 'checkbox' ) {
							if( $value['status'] == 'checked' ) {
								update_option( $value['id'], 1 );
							} else { 
								update_option( $value['id'], 0 ); 
							}	
						} elseif( $value['type'] != 'checkbox' ) {
							update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); 
						} else { 
							update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
						}
					} else { 
						delete_option( $value['id'] ); 
					} 
				}
			} 
		}
	}
    
	/* Display of the actual options page  */
	public function msign_create_options_page() { ?>
	  <div class="wrap settings">
		<div class="header">
			<h2 class="title"><?php echo  '<span class="version">' . $this->version . '</span>' . $this->themename; _e(' Theme Settings', 'msign'); ?></h2>
			<div class="tab-nav">
				<?php // The tabs in the navigation
				foreach ($this->tabs as $value) { 
					switch ($value['type']) {    
						case "tabnav":  ?>
							<a href="#<?php echo $value['href']; ?>" title="<?php echo $value['name']; ?>"><?php echo $value['name']; ?><span class="pointer">&nbsp;</span></a>
						<?php break; 
					}
				} ?>
			</div><!-- .tab-nav -->
		</div><!-- .header -->
		<div class="tabs">
			<form id="settings-form" method="post">
				<?php submit_button();
				echo '<input type="hidden" name="save_settings_security" value="'.wp_create_nonce('save').'" />'; 
				echo '<input type="hidden" name="action" value="save_settings" />'; 
				foreach ($this->options as $value) { 
				switch ($value['type']) {  
					case "tab": ?>
						<div class="single-tab" id="<?php echo $value['id']; ?>"> 
					<?php break; 
					case "tabclose": 
						submit_button(); ?>
						</div><!--.single-tab -->
					<?php break;  
					case "text":  ?>
						  <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?>:</label>
						  <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes (get_option( $value['id'] )); } else { echo $value['std']; } ?>" size="100" />
					<?php break; 
					case "textarea": ?>
						  <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?>:</label>
						  <textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" rows="7" cols="80"><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo $value['std']; } ?>
				</textarea>
					<?php break;
					case "checkbox": ?>                  
						<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?>:</label>
						<div class="boxed-fields">
							<?php
								if ( get_option( $value['id'] ) != "" ) { 
									$status= get_option( $value['id'] );
								} else { 
									$status= $value['std']; 
								}
							   ?>
							   <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" <?php if( $status == 1 ) { echo 'checked="checked"'; } ?>/>
						</div>
					<?php break; 
					case "select": ?>                    
						<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?>:</label>
						<div class="boxed-fields">
							<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
							   <?php foreach ($value['options'] as $option) { ?>
								  <option <?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
							  <?php } ?>
							</select>
						</div>
					<?php break;
					case "upload": 
                        $multiple = isset($value['multiple']) ? $value['multiple'] : 'false'; 
                        $media_type = isset($value['media_type']) ? $value['media_type'] : 'image'; 
                        $media_title = isset($value['media_title']) ? $value['media_title'] : __('Add Image', 'msign'); 
                        $button = isset($value['button']) ? $value['button'] : __('Insert', 'msign'); ?>
						<div class="image-upload" data-multiple="<?php echo $multiple ?>" data-type="<?php echo $media_type ?>" data-title="<?php echo $media_title ?>" data-button="<?php echo $button ?>">
							<?php if ( get_option( $value['id'] )) { ?>
								<img src="<?php echo stripslashes ( get_option( $value['id'] ) ); ?>" style="max-width:150px;  height:auto;" />
							<?php } ?>
							<div class="input">
								<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?>:</label>
								<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" class="upload-url" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes (get_option( $value['id'] )); } else { echo $value['std']; } ?>" size="50" />
								<input id="<?php echo $value['id']; ?>" class="upload_button button" type="button" name="<?php echo $value['id']; ?>" value="<?php esc_attr_e('Upload Image', 'msign'); ?>" />				
						   </div>
						   
					   </div>
					   <hr />
					<?php break; 
					case "heading" : ?>
						<h2 style="font-size:1.8em; margin-top:22px;"><?php echo $value['name']; ?></h2>
					<?php 
					break;
					case 'layout':
						echo '<label for="'.$value['id'].'">'. $value['name'] . ':</label><div class="boxed-fields">';
						foreach ($value['options'] as $option) {
							$checked = get_option($value['id']);
							echo '<input type="radio" class="lay-out ' . $option . '" id="'.$option.'_'.$value['id']. '" name="'.$value['id'].'" value="' .$option. '"' . ( $checked == $option ? ' checked="checked"' : '' ) . '/>';
                            echo '<label for="'. $option .'_' . $value['id'] . '">'. $option .'</label>'; 
						}
						echo '</div>';
						break;	
				} // Switch type
			} // Foreach
			?>
			</form>
		 </div><!-- .tabs -->
         <div id="message" style="display:none;">
            <p><?php _e('Options Saved', 'msign'); ?></p>
         </div>         
	  </div><!-- .wrap -->
	  <?php
	}	
}
/* The actual settings content */
$shortname = "msign";
/* Tabs */
$tabs = array (
		array( "name"	=> __("General", "msign"),
           	   "id" 	=> $shortname."_tabnav1",
			   "href" 	=> $shortname."_general",
               "type" 	=> "tabnav",),
		array( "name"	=> __("Homepage", "msign"),
           	   "id" 	=> $shortname."_tabnav2",
			   "href" 	=> $shortname."homepage",
               "type" 	=> "tabnav",),
		array( "name"	=> __("Blog", "msign"),
           	   "id" 	=> $shortname."_tabnav3",
			   "href" 	=> $shortname."blog",
               "type" 	=> "tabnav",),
		array( "name"	=> __("Portfolio", "msign"),
           	   "id" 	=> $shortname."_tabnav6",
			   "href" 	=> $shortname."portfolio",
               "type" 	=> "tabnav",),			   
		array( "name"	=> __("Social Media", "msign"),
           	   "id" 	=> $shortname."_tabnav4",
			   "href" 	=> $shortname."socialmedia",
               "type" 	=> "tabnav",),
		array( "name"	=> __("Analytics and Custom Ads", "msign"),
           	   "id" 	=> $shortname."_tabnav5",
			   "href" 	=> $shortname."analytics",
               "type" 	=> "tabnav",),
		array( "name"	=> __("SEO Options", "msign"),
           	   "id" 	=> $shortname."_tabnav7",
			   "href" 	=> $shortname."seo",
               "type" 	=> "tabnav",),			   
);	
/* Options in each tab */    			
$options = array (		
	/* General Settings */
		array( "name" 	=> "Tab1",
               "id" 	=> $shortname."_general",
               "std" 	=> "",
               "type"	=> "tab",),
		array( "name"	=> __("General Settings", "msign"),
               "id" 	=> $shortname."_gen_settings",
               "std"	=> "",
               "type" 	=> "heading",),
	    array( "name"	=> __("General lay-out", "msign"),
			   "id"	    =>	$shortname . "_general_layout",
			   "std"	=>	"sidebar-right",
			   "type"	=>	"layout",
			   "options" => array('sidebar-left', 'sidebar-right', 'one-column') ),				   
		array( "name" 	=> __("Logo", "msign"),
	           "id" 	=> $shortname."_logo_image",
	           "std" 	=> "",
	           "type" 	=> "upload"),			  
		array( "name" 	=> __("Favicon", "msign"),
	           "id" 	=> $shortname."_favicon",
	           "std" 	=> "",
	           "type" 	=> "upload"),			  	
		array( "name"	=> __("Use custom css sheet (custom.css in editor)", "msign"),
			   "id"		=>	$shortname . "_add_customcss",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),
		array( "name" => __("Order portfolio and service archives by default by","msign"),
			   "id" => $shortname ."_posts_order",
			   "options" => array("date", "title", "rand", "comment_count", "author"),
			   "std" => "date",
			   "type" => "select",),			   
		array( "name"	=> __("Enable back to top scroll button", "msign"),
			   "id"	    =>	$shortname . "_back_top",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),			    			   		    	   				
		array( "name" 	=> __("Page Locations", "msign"),
		       "id" 	=> $shortname."_paths",
		       "std" 	=> "",
		       "type" 	=> "heading"),					
		array( "name" 	=> __("About Page Path", "msign"),
		       "id" 	=> $shortname."_about_path",
		       "std" 	=> "",
		       "type"	=> "text"),			
		array( "name" 	=> __("Contact Page Path", "msign"),
		       "id" 	=> $shortname."_contact_path",
		       "std" 	=> "",
		       "type" 	=> "text"),
		array( "name" 	=> __("Policies Page Path", "msign"),
		       "id" 	=> $shortname."_policies_path",
		       "std" 	=> "",
		       "type"	=> "text"),	
		array( "name" 	=> __("Portfolio Page Path", "msign"),
		       "id" 	=> $shortname."_portfolio_path",
		       "std" 	=> "",
		       "type" 	=> "text"),	
		array( "name" 	=> __("Portfolio Overview Page Title (used in breadcrumbs)", "msign"),
		       "id" 	=> $shortname."_portfolio_name",
		       "std" 	=> "",
		       "type" 	=> "text"),				   
		array( "name" 	=> __("Services Page Path", "msign"),
		       "id" 	=> $shortname."_services_path",
		       "std" 	=> "",
		       "type" 	=> "text"),	
		array( "name" 	=> __("Services Overview Page Title (used in breadcrumbs)", "msign"),
		       "id" 	=> $shortname."_services_name",
		       "std" 	=> "",
		       "type" 	=> "text"),				   
		array( "name" 	=> __("Testimonies Page Path", "msign"),
		       "id" 	=> $shortname."_testimonies_path",
		       "std"	=> "",
		       "type" 	=> "text"),	
		array( "name" 	=> __("Testimonies Overview Page Title (used in breadcrumbs)", "msign"),
		       "id" 	=> $shortname."_testimonies_name",
		       "std"	=> "",
		       "type" 	=> "text"),	
		array( "name" 	=> __("Members Page Path", "msign"),
		       "id" 	=> $shortname."_members_path",
		       "std"	=> "",
		       "type" 	=> "text"),	
		array( "name" 	=> __("Members Overview Page Title (used in breadcrumbs)", "msign"),
		       "id" 	=> $shortname."_members_name",
		       "std"	=> "",
		       "type" 	=> "text"),					   			   
		array( "name" 	=> "general_close",
               "id" 	=> $shortname."_general_close",
               "std"	=> "",
               "type" 	=> "tabclose",),			   			
		/* Homepage Settings */	
		array( "name" 	=> "Tab2",
               "id" 	=> $shortname."homepage",
               "std" 	=> "",
               "type" 	=> "tab",),							
		array( "name" 	=> __("Homepage Settings", "msign"),
               "id" 	=> $shortname."_page_prefs",
               "std" 	=> "",
               "type" 	=> "heading"),			   
		array( "name"	=> __("Show Feature Slider on Homepage", "msign"),
			   "id"	    =>	$shortname . "_add_featureslider",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),
		array( "name"	=> __("Maximum number of slider items", "msign"),
			   "id"	    =>	$shortname . "_numbers_featureslider",
			   "std"	=>	"3",
			   "type"	=>	"text"),
		array( "name"	=> __("Organization Introduction quote or statement to show on home page", "msign"),
			   "id"	    =>	$shortname . "_home_introduction",
			   "std"	=>	"",
			   "type"	=>	"text"),
		array( "name"	=> __("Bottomline or additional text that belongs to this quote or statement", "msign"),
			   "id"	    =>	$shortname . "_home_introduction_text",
			   "std"	=>	"",
			   "type"	=>	"textarea"),
		array( "name" 	=> __("Portfolio projects on homepage", "msign"),
               "id" 	=> $shortname."_homeproject_prefs",
               "std" 	=> "",
               "type" 	=> "heading"),				   
		array( "name"	=> __("View recent portfolio work on home page", "msign"),
			   "id"	    =>	$shortname . "_add_portfolio",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),
		array( "name" 	=> __("Portfolio introduction tabtext to show on home page", "msign"),
		       "id" 	=> $shortname."_portfoliointro",
		       "std" 	=> "",
		       "type" 	=> "text"),	
		array( "name" 	=> __("Number of portfolio projects to show on home page", "msign"),
			   "id"	 	=> $shortname."_projects_num",
			   "type" 	=> "text",
			   "std" 	=> "3"),
		array( "name" 	=> __("Services on homepage", "msign"),
               "id" 	=> $shortname."_homeservices_prefs",
               "std" 	=> "",
               "type" 	=> "heading"),				   			
		array( "name"	=> __("View services on home page", "msign"),
			   "id"	    =>	$shortname . "_add_services",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),
		array( "name" 	=> __("Service introduction tabtext to show on home page", "msign"),
		       "id" 	=> $shortname."_servicesintro",
		       "std" 	=> "",
		       "type" 	=> "text"),	
		array( "name" 	=> __("Number of services to show on home page", "msign"),
			   "id" 	=> $shortname."_services_num",
			   "type" 	=> "text",
			   "std" 	=> "3"),
		array( "name" 	=> __("Testimonies on homepage", "msign"),
               "id" 	=> $shortname."_hometestimonies_prefs",
               "std" 	=> "",
               "type" 	=> "heading"),				   	
		array( "name"	=> __("View testimonies/clients on home page", "msign"),
			   "id"		=>	$shortname . "_add_testimonies",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),
		array( "name" 	=> __("Testimony/client introduction tabtext to show on home page", "msign"),
		       "id" 	=> $shortname."_testimoniesintro",
		       "std" 	=> "",
		       "type" 	=> "text"),	
		array( "name" 	=> __("Number of testimonies to show on home page", "msign"),
			   "id" 	=> $shortname."_testimonies_num",
			   "type" 	=> "text",
			   "std" 	=> "3"),	
		array( "name" 	=> __("Posts on homepage", "msign"),
               "id" 	=> $shortname."_hometestimonies_prefs",
               "std" 	=> "",
               "type" 	=> "heading"),			   
		array( "name"	=> __("View blog on home page", "msign"),
			   "id"		=>	$shortname . "_add_blog",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),
	    array( "name"	=> __("Lay-out of blog on home page", "msign"),
			   "id"	    =>	$shortname . "_index_layout",
			   "std"	=>	"sidebar-right",
			   "type"	=>	"layout",
			   "options" => array('sidebar-left', 'sidebar-right', 'one-column') ),				   
		array( "name" 	=> __("Blog introduction text to show on home page", "msign"),
		       "id" 	=> $shortname."_blogintro",
		       "std" 	=> __("Recently from the blog:", "msign"),
		       "type" 	=> "text"),										
		array( "name" 	=> __("Number of blogposts to appear on the home page", "msign"),
		       "id" 	=> $shortname."_smallbox",
		       "std" 	=> "4",
		       "type" 	=> "text"),
		array( "name" 	=> "Tab2_close",
               "id" 	=> $shortname."homepage_close",
               "std" 	=> "",
               "type" 	=> "tabclose",),					
		/* Blog Settings */	
		array( "name" 	=> "Tab3",
               "id" 	=> $shortname."blog",
               "std" 	=> "",
               "type" 	=> "tab",),						   	
		array( "name" 	=> __("Blog Settings", "msign"),
               "id" 	=> $shortname."_sblog",
               "std" 	=> "",
               "type" 	=> "heading"),	
	    array( "name"	=> __("Default lay-out for single blogs", "msign"),
			   "id"	    =>	$shortname . "_blog_single_layout",
			   "std"	=>	"sidebar-right",
			   "type"	=>	"layout",
			   "options" => array('sidebar-left', 'sidebar-right', 'one-column') ),
	    array( "name"	=> __("Default lay-out for blog archives", "msign"),
			   "id"	    =>	$shortname . "_blog_archive_layout",
			   "std"	=>	"sidebar-right",
			   "type"	=>	"layout",
			   "options" => array('sidebar-left', 'sidebar-right', 'one-column') ),	    
	    array( "name"	=> __("Disable meta header information for posts in archives", "msign"),
			   "id"	    =>	$shortname . "_blog_metaheader",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),			   		   		   		   
	    array( "name"	=> __("Show social media sharing and reply buttons", "msign"),
			   "id"	    =>	$shortname . "_social_show",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),			   			
	    array( "name"	=> __("Show Author on Blog Posts", "msign"),
			   "id"	    =>	$shortname . "_blog_author",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),				   			   			   		   			   
		array( "name"	=> __("Show related posts at end of post (relates based on tags)", "msign"),
			   "id"		=>	$shortname . "_related",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),			   
		array( "name"	=> __("Title above related post area", "msign"),
			   "id"		=>	$shortname . "_related_title",
			   "std"	=>	"",
			   "type"	=>	"text"),			   
		array( "name"	=> __("Maximum number of related posts to show", "msign"),
			   "id"		=>	$shortname . "_related_number",
			   "std"	=>	"4",
			   "type"	=>	"text"),
		array( "name" 	=> "Tab3_close",
               "id" 	=> $shortname."blog_close",
               "std" 	=> "",
               "type" 	=> "tabclose",),			   
		/* Portfolio Settings */	
		array( "name" 	=> "Tab6",
               "id" 	=> $shortname."portfolio",
               "std" 	=> "",
               "type"	=> "tab",),			   
		array( "name" 	=> __("Portfolio Settings", "msign"),
               "id" 	=> $shortname."_parchive",
               "std" 	=> "",
               "type" 	=> "heading"),	
	    array( "name"	=> __("Lay out for portfolio project type archives", "msign"),
			   "id"	    =>	$shortname . "_portfolio_layout",
			   "std"	=>	"one-column",
			   "type"	=>	"layout",
			   "options" => array('sidebar-left', 'sidebar-right', 'one-column') ),
		array( "name"	=> __("Load portfolio categories using ajax", "msign"),
			   "id"		=>	$shortname . "_portfolio_overview_ajax",
			   "std"	=>	"",
			   "status" => "checked",
			   "type"	=>	"checkbox"),					   			   		   				   
		array( "name"	=> __("Number of projects to show per page in portfolio project type archives", "msign"),
			   "id"		=>	$shortname . "_portfolio_layout_number",
			   "std"	=>	"",
			   "type"	=>	"text"),	
	    array( "name"	=> __("Show social media sharing in single projects", "msign"),
			   "id"	    =>	$shortname . "_social_portfolio_show",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),	
		array( "name"	=> __("Show Related projects at end of portfolio projects", "msign"),
			   "id"		=>	$shortname . "_portfolio_related",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),			   
		array( "name"	=> __("Title above related projects", "msign"),
			   "id"		=>	$shortname . "_portfolio_related_title",
			   "std"	=>	"",
			   "type"	=>	"text"),			   
		array( "name"	=> __("Maximum number of related projects to show", "msign"),
			   "id"		=>	$shortname . "_portfolio_related_number",
			   "std"	=>	"4",
			   "type"	=>	"text"),			   		   		   		   		   
		array( "name" 	=> "Tab6_close",
               "id" 	=> $shortname."portfolio_close",
               "std" 	=> "",
               "type" 	=> "tabclose",),				   		
		/* Social Media Settings */	
		array( "name" 	=> "Tab4",
               "id" 	=> $shortname."socialmedia",
               "std" 	=> "",
               "type" 	=> "tab",),			
		array( "name"	=> __("Social Media Settings", "msign"),
               "id"	 	=> $shortname."_social_prefs",
               "std" 	=> "",
               "type" 	=> "heading"),	
		array( "name" 	=> __("Global Google Plus author URI (this profile will be used as author on all pages)", "msign"),
		       "id"		=> $shortname."_gplus_boss",
		       "std" 	=> "",
		       "type" 	=> "text"),			
		array( "name"	=> __("Show Social Media Icons in Header", "msign"),
			   "id"		=>	$shortname . "_social_icons",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),				   		  
		array( "name" 	=> __("Twitter Username", "msign"),
	           "id" 	=> $shortname."_social_twitter_username",
	           "std" 	=> "",
	           "type" 	=> "text"),			  		   			   	
		array( "name" 	=> __("RSS Feed URL", "msign"),
	           "id" 	=> $shortname."_social_feed",
	           "std" 	=> "",
	           "type" 	=> "text"),	
		array( "name" 	=> __("Email Subscription URL", "msign"),
	           "id" 	=> $shortname."_social_email",
	           "std" 	=> "",
	           "type" 	=> "text"),			   	  
		array( "name" 	=> __("Facebook Page URL", "msign"),
	           "id" 	=> $shortname."_social_facebook",
	           "std" 	=> "",
	           "type" 	=> "text"),			  		   
		array( "name" 	=> __("Youtube Channel URL", "msign"),
	           "id" 	=> $shortname."_social_youtube",
	           "std" 	=> "",
	           "type" 	=> "text"),				  
		array( "name" 	=> __("Vimeo Channel URL", "msign"),
	           "id" 	=> $shortname."_social_vimeo",
	           "std" 	=> "",
	           "type" 	=> "text"),			  
		array( "name" 	=> __("LinkedIn Profile URL", "msign"),
	           "id" 	=> $shortname."_social_linkedin",
	           "std" 	=> "",
	           "type" 	=> "text"), 
		array( "name" 	=> __("Google Plus (Company) Page URL", "msign"),
	           "id" 	=> $shortname."_social_gplus",
	           "std"	 => "",
	           "type" 	=> "text"), 
		array( "name" 	=> __("Behance Profile URL", "msign"),
	           "id" 	=> $shortname."_social_behance",
	           "std"	=> "",
	           "type" 	=> "text"), 
		array( "name" 	=> __("Sharing Settings", "msign"),
			   "id" 	=> $shortname."_social_sharing",
			   "std"	 => "",
			   "type" 	=> "heading"),
		array( "name" 	=> __("Add a Twitter Button at bottom of Posts", "msign"),
			   "id"		=>	$shortname . "_twitterbutton",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),  		 
		array( "name" 	=> __("Add a Facebook Share Button at bottom of Posts", "msign"),
	           "id" 	=> $shortname."_facebooklike",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),				  			   	
		array( "name" 	=> __("Add a StumbleUpon Button at bottom of Posts", "msign"),
	           "id"		 => $shortname."_stumbleupon",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),			   
		array( "name" 	=> __("Add a Delicious Button at bottom of Posts", "msign"),
	           "id" 	=> $shortname."_delicious",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),
		array( "name"	 => __("Add a Digg Button at bottom of Posts", "msign"),
	           "id" 	=> $shortname."_digg",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),
		array( "name" 	=> __("Add a Pinterest Button at bottom of Posts", "msign"),
	           "id" 	=> $shortname."_pinterest",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),
		array( "name" 	=> __("Add a LinkedIn Share button at bottom of Posts", "msign"),
			   "id"		=>	$shortname . "_sharelinkedin",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),			   
		array( "name" 	=> __("Add a Google Plus Button at bottom of Posts", "msign"),
	           "id" 	=> $shortname."_gplus",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),
		array( "name" 	=> "Tab4_close",
               "id" 	=> $shortname."socialmedia_close",
               "std" 	=> "",
               "type" 	=> "tabclose",),				   
	    /* Analytics and Ad Management Settings */	
		array( "name" 	=> "Tab5",
               "id" 	=> $shortname."analytics",
               "std" 	=> "",
               "type" 	=> "tab",),			
		array( "name" 	=> __("Analytics and Ad Management", "msign"),
               "id" 	=> $shortname."_analytics_ads",
               "std" 	=> "",
               "type" 	=> "heading"),
		array( "name" 	=> __("Paste your analytics or tracking code or custom javascript here", "msign"),
	           "id" 	=> $shortname."_analytics",
	           "std" 	=> "",
	           "type" 	=> "textarea"),			  
		array( "name" 	=> __("Paste your ad code here, apply this ad by using the [adsense1] shortcode. Most usable for 336x280 sized ads", "msign"),
	           "id" 	=> $shortname."_ad1",
	           "std" 	=> __("You can apply this add using the [adsense1] shortcode", "msign"),
	           "type" 	=> "textarea"),	
		array( "name" 	=> __("Paste your ad code here, apply this ad by using the [adsense2] shortcode. Most usable for 250x250 sized ads", "msign"),
	           "id" 	=> $shortname."_ad2",
	           "std" 	=> __("You can apply this add using the [adsense2] shortcode", "msign"),
	           "type" 	=> "textarea"),
		array( "name"	=> __("Paste your ad code here, apply this ad by using the [adsense3] shortcode. Most usable for 468x60 sized ads", "msign"),
	           "id"	=> $shortname."_ad3",
	           "std" 	=> __("You can apply this add using the [adsense3] shortcode", "msign"),
	           "type" 	=> "textarea"), 
		array( "name" 	=> "Tab5_close",
               "id" 	=> $shortname."analytics_close",
               "std" 	=> "",
               "type" 	=> "tabclose",),
		array( "name" 	=> "Tab7",
               "id" 	=> $shortname."seo",
               "std" 	=> "",
               "type" 	=> "tab",),	
		array( "name"	=> __("Disable theme default SEO set-up", "msign"),
			   "id"	    =>	$shortname . "_seo",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),
		array( "name"	=> __("Enable breadcrumbs", "msign"),
			   "id"	    =>	$shortname . "_breadcrumbs",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),	
		array( "name"	=> __("Enable opengraph", "msign"),
			   "id"		=>	$shortname . "_opengraph",
			   "std"	=>	"",
			   "status" => 'checked',
			   "type"	=>	"checkbox"),			   	   			   			   	
		array( "name" 	=> __("Standard Meta Keywords (seperate with comma)", "msign"),
		       "id"		=> $shortname."_standard_metakeywords",
		       "std" 	=> "",
		       "type" 	=> "text"),	 
		array( "name" 	=> __("Standard SEO Description", "msign"),
		       "id"		=> $shortname."_standard_description",
		       "std" 	=> "",
		       "type" 	=> "text"),	 
		array( "name" 	=> __("Standard Archive SEO Description, shown in archives", "msign"),
		       "id"		=> $shortname."_category_description",
		       "std" 	=> "",
		       "type" 	=> "text"),		
		array( "name" 	=> __("Standard Homepage SEO Description", "msign"),
		       "id"		=> $shortname."_home_description",
		       "std" 	=> "",
		       "type" 	=> "text"),				   		   			   				
		array( "name" 	=> "Tab7_close",
               "id" 	=> $shortname."seo_close",
               "std" 	=> "",
               "type" 	=> "tabclose",),											 		  																					
);
/* Create the class */
$settings_page = new msign_ThemeOptions($tabs, $options, 'My First', '1.0');