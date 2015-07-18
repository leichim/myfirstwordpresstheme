<?php
/**
 * The template part which renders sidebars based on the page which is viewed.
 */
 // Declare variables
 global $post;
 $post_layout = get_post_meta($post->ID,'post_layout' ,TRUE);
 $portfolio_layout = get_option('msign_portfolio_layout');
 $general_layout = get_option('msign_general_layout');
 $homepage_layout = get_option('msign_index_layout');
 // Conditions
			if( $post_layout && is_singular() ) { // In single posts
				if( $post_layout != 'one-column') {  	
					the_sidebar_type(); // Function can be found in inc/themefunctions.php
				} 
		   } elseif( $portfolio_layout && get_query_var( 'taxonomy' ) == 'project_category') { // In portfolio archive 
		   		if( $portfolio_layout != 'one-column') {  		
					the_sidebar_type();
				}        
		   } elseif( $general_layout && ! is_home() ) { // In general archives
				if( $general_layout != 'one-column' ) { 
					the_sidebar_type();
				}
		   } elseif( $homepage_layout && is_home() ) { // In index page
				if( $homepage_layout != 'one-column' ) { 
					the_sidebar_type();
				}
		   } else { ?>
			   <aside class="secondary" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">
               	   <div class="boxitem">
                   		<div class="item-content">
                   			<p class="notice"><?php _e('No lay-out has been selected in the theme or post settings', 'msign'); ?></p>
                        </div>
                   </div>
               </aside>
	 <?php }
                                  