<?php
/**
 * The template for displaying Archive pages.
 */
get_header(); ?>
    <main id="content" role="main">
        <div class="postbox"> 
            <?php 
				/* Variables */
				$post_amount = get_option('msign_portfolio_layout_number');
				$terms = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
				/* Query for Portfolio Type Taxonomy */
				$portfolio_args = array( 'post_type' => 'portfolio_project', 'posts_per_page' => $post_amount , 'paged' => $paged, 
				'tax_query' => array( array('taxonomy' => 'project_category', 'field' => 'slug', 'terms' => $terms )) ); 
				$wp_query = new WP_Query(); $wp_query->query($portfolio_args); 
				if ($wp_query->have_posts() ) : 
					while ($wp_query->have_posts() ) : $wp_query->the_post(); 
						get_template_part('content', 'portfolio_project');
					endwhile; 
				elseif ( ! have_posts() ) : 
					get_template_part('content', 'none');
				endif; ?>
        </div><!-- .postbox -->
        <?php msign_pagination(); wp_reset_query(); ?>
    </main><!-- #content -->
    <?php get_template_part('sidebars'); ?>
<?php get_footer();?>