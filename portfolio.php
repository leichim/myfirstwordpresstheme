<?php
/**
 * Template Name: Portfolio
 * The template for displaying Portfolio Archive pages.
 */
get_header(); ?>
      <main id="content" role="main">
          <div id="post-<?php the_ID(); ?>" class="largebox">                  
              <div class="post-content">
                  <h6><?php _e('Project Categories:', 'msign') ?></h6>
                  <ul class="types" itemprop="genre">
                      <li><a href="<?php the_permalink(); ?>" class="types-all"><?php _e('All', 'msign'); ?></a></li>
                      <?php wp_list_categories('taxonomy=project_category&depth=-1&title_li='); ?>
                  </ul>
              </div>
          </div><!-- #post -->
          <div id="ajax-preview"></div>
          <div id="ajax-load">
              <div class="postbox">			
                  <?php /* Variables, if template specific amount is not filled in the page, the general option from themesettings is used */
                  get_post_meta($post->ID, 'posts_amount', true) ? $post_amount = get_post_meta($post->ID, 'posts_amount', true) : $post_amount = get_option('msign_portfolio_layout_number');
                  get_post_meta( $post->ID, "posts_order", true ) ? $post_order = get_post_meta( $post->ID, "posts_order", true ) : $post_order = get_option('msign_posts_order') ;
                  if( $post_order == 'title' || $post_order == 'author'  ) {
                      $args = array('orderby' => $post_order, 'order' => 'ASC', 'paged' => $paged, 'posts_per_page' => $post_amount, 'post_type' => 'portfolio_project'); 
                  } else {
                      $args = array( 'orderby' => $post_order, 'paged' => $paged, 'posts_per_page' => $post_amount, 'post_type' => 'portfolio_project'); 
                  } 
                  $wp_query = new WP_Query(); $wp_query->query($args); 
                  if ($wp_query->have_posts() ) : 
                      while ($wp_query->have_posts() ) : $wp_query->the_post(); 
                          get_template_part('content', 'portfolio_project');
                      endwhile; 
                  elseif ( ! have_posts() ) : 
                      get_template_part('content', 'none');
                  endif; 	?>	
              </div><!-- .postbox -->
          </div>
          <?php if( get_option('msign_portfolio_overview_ajax') ) { ?>
              <span class="loader"></span> 
          <?php }
          msign_pagination(); wp_reset_query(); 			
          if ( get_post_meta($post->ID, 'post_postloop_enable', true) ) { get_template_part('content', 'custom'); } ?>
     </main><!-- #content -->
     <?php get_template_part('sidebars'); ?>
<?php get_footer(); ?>