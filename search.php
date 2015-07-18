<?php
/**
 * The template for displaying Search Results pages.
 */
get_header(); ?>
    <main id="content" role="main" itemscope itemtype="http://schema.org/Blog">
        <div class="postbox"> 
            <?php if ( have_posts() ) : 
                while ( have_posts() ) : the_post();  
                    get_template_part('content');
                endwhile;  
            elseif ( ! have_posts() ) : 
                get_template_part('content', 'none');
            endif; ?>	
        </div><!-- .postbox -->
    </main><!-- #content -->
    <?php get_template_part('sidebars'); ?>
<?php get_footer(); ?>