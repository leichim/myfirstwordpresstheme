<?php
/**
 * The Template for displaying all single posts.
 */
get_header(); ?>
    <main id="content" role="main">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('largebox') ?>>
			<?php if( has_post_thumbnail() && !get_post_meta($post->ID, 'post_featured_image', true)  ) { ?>
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
            	<?php if( ! get_post_meta($post->ID, 'post_metaheader', true) ) { ?>
                    <div class="entry-meta">
                        <?php msign_posted_on(); ?>	
                        <span class="comments-link">&middot;
                            <?php comments_popup_link(__('0 Comments &raquo;','msign'), __('1 Comments &raquo;','msign'), __('% Comments &raquo;','msign') );?>
                        </span>
                    </div><!-- .entry-meta -->
                <?php } ?>
                <div class="entry-content" itemprop="articleBody">
                    <?php the_content(); ?>
                </div>
                <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'msign' ), 'after' => '</div>' ) );?>  
                <footer class="entry-utility">
                    <div class="entry-meta types">
                        <?php msign_posted_in(); ?>
                    </div>                        
                    <?php if ( get_option('msign_social_show') == 1 && !get_post_meta( $post->ID, "post_social", true ) ) { msign_social_share(); } ?>
                    <nav id="nav-below" class="navigation">
                        <div class="nav-previous">
							<?php previous_post_link( '%link', '<span class="meta-nav">&lsaquo;</span> %title' ); ?>
                        </div>
                        <div class="nav-next">
							<?php next_post_link( '%link', '<span class="meta-nav">&rsaquo;</span> %title' ); ?>
                        </div>
                    </nav><!-- #nav-below -->	
                    <?php if ( get_option('msign_related') == 1 && !get_post_meta( $post->ID, "post_related", true ) ) { msign_related_posts();  } 
                     if ( get_the_author_meta( 'description' ) && get_option('msign_blog_author') && !get_post_meta( $post->ID, "post_author_disable", true ) ) { msign_author(); } ?>  
                </footer><!-- .entry-utility -->                  
            </div><!-- .post-content -->	
        </article><!-- #post-->  
        <?php if ( get_post_meta($post->ID, 'post_postloop_enable', true) ) { get_template_part('content', 'custom'); } ?>                                
        <?php if( !get_post_meta($post->ID, 'post_comments_disable', true)) { comments_template(); } ?>		
    <?php endwhile; wp_reset_query(); ?>
    </main><!-- #content -->
    <?php get_template_part('sidebars'); ?>
<?php get_footer(); ?>