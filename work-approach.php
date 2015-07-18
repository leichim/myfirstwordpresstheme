<?php
/**
 * Template Name: Work Approach
 * This template shows work approaches
 */
get_header(); ?>
    <main id="content" role="main">
        <div id="approach-summary">
            <?php $order = get_post_meta($post->ID,'approach_order' ,TRUE);
            $wp_query = new WP_Query('meta_key=approach_order&meta_value'.$order.'&orderby=meta_value_num&order=ASC&post_type=approach&posts_per_page=999');
            if ( $wp_query->have_posts() ) : 
                while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                    <div class="buttons">
                        <a class="button" id="postlink-<?php the_ID(); ?>" href="#post-<?php the_ID(); ?>">
                            <?php echo get_post_meta($post->ID,'approach_order' ,TRUE); ?>
                        </a>
                        <h6><a class="approach-scroll-link" id="postlink-<?php the_ID(); ?>" href="#post-<?php the_ID(); ?>"><?php the_title();?></a></h6>
                    </div>
            <?php endwhile; 
            endif; ?>
        </div>
        <?php $order = get_post_meta($post->ID,'approach_order' ,TRUE);
        $wp_query = new WP_Query('meta_key=approach_order&meta_value'.$order.'&orderby=meta_value_num&order=ASC&post_type=approach&posts_per_page=999'); 
        if ( $wp_query->have_posts() ) : 
            while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
                get_template_part('content' , 'approach');
            endwhile; 
        elseif ( ! have_posts() ) :
            get_template_part('content' , 'none');
        endif; wp_reset_query(); ?>
        <?php if ( get_post_meta($post->ID, 'post_postloop_enable', true) ) { get_template_part('content', 'custom'); } ?>
   </main><!-- #content -->
   <?php get_template_part('sidebars'); ?>
<?php get_footer();?>