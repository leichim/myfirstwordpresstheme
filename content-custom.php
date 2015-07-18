<?php  /* This file is a custom loop, it reloops the loop only with custom arguments */ 
		  $post_related_title = get_post_meta($post->ID, 'post_postloop_text', true); 
		  $post_postloop = get_post_meta($post->ID, 'post_postloop', true); 
		  $postloop_amount = get_post_meta($post->ID, 'post_postloop_amount', true); 
		  $postloop_order = get_post_meta($post->ID, 'post_postloop_order', true); 
		  ?>
		  <aside class="custom-content" role="complementary" <?php msign_postloop_microscheme(); ?>>
			 <?php if( $post_related_title ) { echo '<h3 class="blogintro">'. $post_related_title . '</h3>'; } ?>
			 <div class="postbox" >
				 <?php 
				 if( $postloop_order == 'title' || $postloop_order == 'author'  ) {
                    $custom_args = array( 'posts_per_page' => $postloop_amount, 'post_type' => $post_postloop, 'orderby' => $postloop_order, 'order' => 'ASC' ); 
                 } elseif($post_postloop == "approach") {
                    $order = get_post_meta($post->ID,'approach_order' ,TRUE);
                    $custom_args = array( 'meta_key=approach_order&meta_value'.$order.'&orderby=meta_value_num&order=ASC&post_type=approach&posts_per_page='.$postloop_amount); 
                 } else {
                    $custom_args = array( 'posts_per_page' => $postloop_amount, 'post_type' => $post_postloop, 'orderby' => $postloop_order ); 
                 } 
                 $custom_query = new WP_Query(); $custom_query->query($custom_args); 
                 if ($custom_query->have_posts() ) : 
                    while ($custom_query->have_posts() ) : $custom_query->the_post(); 
                        get_template_part('content', $post_postloop);
                    endwhile; 
                 elseif ( ! have_posts() ) :
                    get_template_part('content', 'none');
                 endif; 
                 wp_reset_query(); ?>  
              </div>            
		  </aside>