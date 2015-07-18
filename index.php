<?php
/**
 * The main template file, being able to display a midbar with widgets and a given number of posts.
 */
get_header();   
if(get_option('msign_add_featureslider') == 1) { get_template_part('slider'); } ?>
<section id="description" itemscope itemtype="http://schema.org/ProfessionalService">
    <div class="introduction">  
            <h1 class="intro-title" itemprop="description">
                <?php if(get_option('msign_home_introduction')) {
                        	echo get_option('msign_home_introduction');
                      } else { 
                        	_e('Welcome, please insert an introduction text in the themesettings panel', 'msign');
                      } ?>
            </h1> 
            <meta itemprop="name" content="<?php bloginfo( 'name' ); ?>" />
            <?php if(get_option('msign_home_introduction_text')) { ?>
                <p><?php echo stripslashes(get_option('msign_home_introduction_text')); ?></p>
            <?php } ?>
    </div> 
</section>
<?php if(get_option('msign_add_services') == 1 || get_option('msign_add_portfolio') == 1 || get_option('msign_add_testimonies') == 1) { 
    get_template_part('tabs');	
} if(get_option('msign_add_blog') == 1) { ?>
<section id="container" <?php the_column_class(); ?>> 
    <h3 class="blogintro"><?php if(get_option('msign_blogintro')) { echo get_option ('msign_blogintro'); } else { _e('Latest Blogs' , 'msign'); } ?></h3>
    <main id="content" role="main" itemscope itemtype="http://schema.org/Blog">
    	<div class="postbox">
			<?php $post_amount = get_option( 'msign_smallbox' );
			$post_order = get_option('msign_posts_order') ;
			if( $post_order == 'title' || $post_order == 'author'  ) {
				$args = array('orderby' => $post_order, 'order' => 'ASC', 'paged' => $paged, 'posts_per_page' => $post_amount); 
			} else {
				$args = array( 'orderby' => $post_order, 'paged' => $paged, 'posts_per_page' => $post_amount); 
			} 
			query_posts($args);			
            if ( have_posts() ) : 
                 while ( have_posts() ) : the_post();  
                     get_template_part('content');
                 endwhile;  
            elseif ( ! have_posts() ) : 
                get_template_part('content', 'none');
            endif; wp_reset_query(); ?>  
        </div>  
    </main><!-- #content --> 
    <?php get_template_part('sidebars') ?>
</section><!-- #container -->
<?php } get_footer(); ?>