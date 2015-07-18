<?php
/**
 * The Template for displaying all single portfolio posts.
 */
get_header(); ?>
			<main id="content" role="main">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('largebox'); ?> >
					<div class="post-content">
                        <div class="entry-content" itemprop="text">
                            <?php the_content(); ?>                   
                        </div><!-- .entry-content -->	
                        <footer class="entry-utility"> 
                        	<?php if( has_term('', 'project_category', '') || get_post_meta( $post->ID, "project_interest", true ) ) { ?> 
                        	<div class="entry-meta types">
                                <span itemprop="genre">
                                    <?php echo '<span class="category-icon"></span>' . get_the_term_list( $post->ID, 'project_category'); 
                                    if(get_post_meta( $post->ID, "project_interest", true )) { echo '<a href="#">'.get_post_meta( $post->ID, "project_interest", true ).'</a>';  } ?>
                                </span>
                            </div>
                        	<?php } if ( get_option('msign_social_portfolio_show') == 1 && !get_post_meta( $post->ID, "post_social", true ) ) { msign_social_share(); } ?>  
                            <nav id="nav-above" class="navigation">
                                <div class="nav-previous">
                                    <?php previous_post_link( '%link', '<span class="meta-nav">&lsaquo;</span> %title' ); ?>
                                </div>
                                <div class="nav-next">
                                    <?php next_post_link( '%link', '<span class="meta-nav">&rsaquo;</span> %title' ); ?>
                                </div>
                            </nav><!-- #nav-below -->	
                            <?php if ( get_option('msign_portfolio_related') == 1 && !get_post_meta( $post->ID, "post_related", true ) ) { msign_related_posts();  } ?>                          		
                        </footer><!-- .entry-utility --> 
                    </div><!-- .post-content -->     		
                </article><!-- #post-->                                     	
			<?php endwhile;  
            if ( get_post_meta($post->ID, 'post_postloop_enable', true) ) { get_template_part('content', 'custom'); } ?>
			</main><!-- #content -->
            <?php get_template_part('sidebars'); ?>          
<?php get_footer(); ?>
