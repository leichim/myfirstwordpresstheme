<?php
/**
 * Template Name: Homepage
 */
get_header();   
if(get_option('msign_add_featureslider') == 1) { get_template_part('slider'); }  ?>
<section>
    <div id="description" itemscope itemtype="http://schema.org/ProfessionalService">
        <header class="introduction">
            <?php if(get_post_meta( $post->ID, "st_quote", true )) { ?><h6 class="quote"><?php echo get_post_meta( $post->ID, "st_quote", true ) ?></h6><?php } ?>
            <h1 itemprop="description" class="entry-title"><?php single_post_title(); ?></h1>
            <meta itemprop="name" content="<?php bloginfo( 'name' ); ?>" />
            <?php msign_breadcrumbs(); ?>
        </header><!-- .introduction -->
    </div>
    <div id="container" class="one-column">
          <div id="content" role="main">
            <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('largebox') ?>>
					<div class="post-content">
                        <?php if(has_post_thumbnail()) { ?>
                        	<figure class="post-image">
								<?php if( get_option('msign_general_layout') == 'one-column' || get_post_meta($post->ID,'post_layout' ,TRUE) == 'one-column' ) { 
                                    the_post_thumbnail( 'default-fullwidth' );
                                } else { 
                                    the_post_thumbnail( 'default-homebox-large' ); 
                                } ?>
                            </figure>
						<?php } ?>
                        <div class="entry-content" itemprop="text">
                        	<?php the_content(); wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'msign' ), 'after' => '</div>' ) ); ?>
                        </div>
					</div><!-- .post-content -->
				</article>
            <?php endwhile; wp_reset_query(); ?>
      </div><!-- #content --> 
    </div><!-- #container -->
</section>
<?php if( get_option('msign_add_services') || get_option('msign_add_portfolio') || get_option('msign_add_testimonies') ) { 
    get_template_part('tabs');	
} if(get_option('msign_add_blog') == 1) { ?>
<section id="container" <?php the_column_class(); ?>>
    <?php if(get_option('msign_blogintro')) { echo '<h3 class="blogintro">'. get_option ('msign_blogintro') . '</h3>'; } ?>
    <main id="content" role="main" itemscope itemtype="http://schema.org/Blog">
    	<div class="postbox">
			<?php get_post_meta( $post->ID, "posts_amount", true ) ? $post_amount = get_post_meta( $post->ID, "posts_amount", true ) : $post_amount = get_option('msign_smallbox');
			get_post_meta( $post->ID, "posts_order", true ) ? $post_order = get_post_meta( $post->ID, "posts_order", true ) : $post_order = get_option('msign_posts_order') ;
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
        <?php if ( get_post_meta($post->ID, 'post_postloop_enable', true) ) { get_template_part('content', 'custom'); } ?> 
    </main><!-- #content --> 
    <?php get_template_part('sidebars'); ?>
</section><!-- #container -->
<?php } get_footer(); ?>