<?php
/**
 * The template for displaying attachments.
 **/
get_header(); ?>
		<div id="container" class="single-attachment">
			<main id="content" role="main">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h2 class="entry-title" itemprop="name"><?php the_title(); ?></h2>
						<div class="entry-meta">
							<?php if ( wp_attachment_is_image() ) {
									$metadata = wp_get_attachment_metadata();
									printf( __( 'Full size is %s pixels', 'msign'),
										sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
											wp_get_attachment_url(),
											esc_attr( __('Link to full-size image', 'msign') ),
											$metadata['width'],
											$metadata['height']
										)
									);
								} 
							edit_post_link( __( 'Edit Attachment', 'msign' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
						</div><!-- .entry-meta -->
					</header>
					<div class="post-content" itemprop="image">
						<div class="entry-attachment">
                        	<?php if ( ! empty( $post->post_parent ) ) : ?>
							<p class="page-title"><a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php esc_attr( printf( __( 'Return to %s', 'msign' ), get_the_title( 		$post->post_parent ) ) ); ?>" rel="gallery">Attachment from: <br /> <?php
							printf( __( '<span class="meta-nav">&larr;</span> %s', 'msign' ), get_the_title( $post->post_parent ) );
							?></a></p>
							<?php endif; ?>
							<?php if ( wp_attachment_is_image() ) :
                                $attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
                                foreach ( $attachments as $k => $attachment ) {
                                    if ( $attachment->ID == $post->ID )
                                        break;
                                }
                                $k++;
                                if ( count( $attachments ) > 1 ) {
                                    if ( isset( $attachments[ $k ] ) )
                                        $next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
                                    else
                                        $next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
                                } else {
                                    $next_attachment_url = wp_get_attachment_url();
                                }
                            ?>
						<p class="attachment"><a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
							$attachment_size = apply_filters( 'msign_attachment_size', 876 );
							echo wp_get_attachment_image( $post->ID, array( $attachment_size, 9999 ) ); 
						?></a></p>
						<?php else : ?>
						<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
						<?php endif; ?>
						</div><!-- .entry-attachment -->
						<div class="entry-caption"><?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?></div>
					</div><!-- .post-content -->
                    <footer class="entry-utility">
                        <nav id="nav-below" class="navigation">
                            <div class="nav-previous"><?php previous_image_link( '%link', '<span class="meta-nav">' . _x( 'Previous Image (Left Key):', 'Previous Link', 'msign' ) . '</span>' ); ?></div>
                            <div class="nav-next"><?php next_image_link( '%link', '<span class="meta-nav">' . _x( 'Next Image (Right Key):', 'Next Link', 'msign' ) . '</span>' ); ?></div>
                        </nav><!-- #nav-below -->
                    </footer><!-- .entry-utility -->
				</article><!-- #post-## -->
			<?php endwhile; ?>
			</main><!-- #content -->
		</div><!-- #container -->
<?php get_footer(); ?>