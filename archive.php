<?php
/**
 * The template for displaying Archive pages.
 */
get_header(); ?>
    <main id="content" role="main" itemscope itemtype="http://schema.org/Blog">
    	<?php if ( get_the_author_meta( 'description', $post->post_author ) && is_author() ) { msign_author(); } ?> 
        <div class="postbox"> 
            <?php /* The loop */
                if ( have_posts() ) : 
                    while ( have_posts() ) : the_post();  
                        get_template_part('content');
                    endwhile;  
                elseif ( ! have_posts() ) : 
                    get_template_part('content', 'none');
                endif; ?>
        </div><!-- .postbox -->
        <?php msign_pagination(); wp_reset_query(); ?>
    </main><!-- #content -->
    <?php get_template_part('sidebars'); ?>
<?php get_footer();?>