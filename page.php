<?php
/**
 * The template for displaying all pages, without the ability to make comments.
 * This is the template that displays all pages by default.
 */
get_header(); ?>
			<main id="content" role="main">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('largebox') ?>>
                        <?php if(has_post_thumbnail()) { ?>
                        	<figure class="post-image">
								<?php if( get_option('msign_general_layout') == 'one-column' || get_post_meta($post->ID,'post_layout' ,TRUE) == 'one-column' ) { 
                                    the_post_thumbnail( 'default-fullwidth' );
                                } else { 
                                    the_post_thumbnail( 'default-homebox-large' ); 
                                } ?>
                            </figure>
						<?php } if( get_post_meta($post->ID,'post_video' ,TRUE) ) { ?>
                            <div class="video-wrapper">
                                <div class="video-container">
                                    <?php echo get_post_meta($post->ID,'post_video' ,TRUE); ?>
                                </div>
                            </div>	
                        <?php } ?> 
                        <div class="post-content">  
                            <div class="entry-content" itemprop="text">
                                <?php the_content(); wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'msign' ), 'after' => '</div>' ) ); ?>
                            </div>
                        </div><!-- .post-content -->
				</article>
			<?php endwhile; 
			if ( get_post_meta($post->ID, 'post_postloop_enable', true) ) { get_template_part('content', 'custom'); } ?>
			</main><!-- #content -->
            <?php get_template_part('sidebars'); ?>
<?php get_footer(); ?>