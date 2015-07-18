<?php
/**
 * The Template for displaying single servicess
 */
get_header(); ?>
    <main id="content" role="main">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('largebox'); ?> >
            <?php if( has_post_thumbnail() && !get_post_meta($post->ID, 'post_featured_image', true) ) { ?>
                <figure class="service-image">    
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
                    <?php the_content(); ?>
                </div>                     
                <footer class="entry-utility">  
                	 <?php if( has_term('', 'services_category', '') ) { ?> 
                        <div class="entry-meta types">
                            <span itemprop="genre">
                                <?php echo '<span class="category-icon"></span>' . get_the_term_list( $post->ID, 'project_category'); ?>
                            </span>
                        </div> 
                     <?php } ?>
                     <nav id="nav-above" class="navigation">
                        <div class="nav-previous">
                            <?php previous_post_link( '%link', '<span class="meta-nav">&lsaquo;</span> %title' ); ?>
                        </div>
                        <div class="nav-next">
                            <?php next_post_link( '%link', '<span class="meta-nav">&rsaquo;</span> %title' ); ?>
                        </div>
                      </nav><!-- #nav-below -->	                        		
                </footer><!-- .entry-utility -->  
            </div><!-- .post-content --> 			
        </article><!-- #post-->                                     	
    <?php endwhile; // end of the loop. 
    if ( get_post_meta($post->ID, 'post_postloop_enable', true) ) { get_template_part('content', 'custom'); } ?>
    </main><!-- #content -->
    <?php get_template_part('sidebars'); ?>
<?php get_footer(); ?>