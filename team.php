<?php
/**
 * Template Name: Team Members
 * This template shows teammembers.
 */
get_header(); 
?>
		   <main id="content" role="main" itemscope itemtype="http://schema.org/ProfessionalService">
				<div class="postbox">
					<?php 
					$post_amount = get_post_meta($post->ID, 'posts_amount', true);
					get_post_meta( $post->ID, "posts_order", true ) ? $post_order = get_post_meta( $post->ID, "posts_order", true ) : $post_order = get_option('msign_posts_order') ;
					if( $post_order == 'title' || $post_order == 'author'  ) {
						$args = array('orderby' => $post_order, 'order' => 'ASC', 'paged' => $paged, 'posts_per_page' => $post_amount, 'post_type' => 'members'); 
					} else {
						$args = array( 'orderby' => $post_order, 'paged' => $paged, 'posts_per_page' => $post_amount, 'post_type' => 'members'); 
					} 
                    $wp_query = new WP_Query(); $wp_query->query($args);
                    if ( $wp_query->have_posts() ) : 
                        while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
                            get_template_part('content', 'members');
                        endwhile; 
                    elseif ( ! have_posts() ) : 
                        get_template_part('content', 'none');
                    endif;?>
                </div><!-- .postbox-->
                <?php msign_pagination(); wp_reset_query();
				if ( get_post_meta($post->ID, 'post_postloop_enable', true) ) { get_template_part('content', 'custom'); } ?>
           </main><!-- #content -->
           <?php get_template_part('sidebars'); ?>
<?php get_footer(); ?>