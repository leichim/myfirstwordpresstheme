<?php
/**
 * Template Name: Contact page
 */
get_header(); ?>
    <main id="content" role="main">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('largebox') ?>>
            <div class="post-content">
                <?php if(has_post_thumbnail()) { ?>
                    <figure class="post-image">
                        <?php the_post_thumbnail( 'default-homebox-large' ); ?> <!-- Thumbnail for single post or page, if existing -->
                    </figure>
                <?php } ?>
                <div class="entry-content" itemprop="text">
                    <?php the_content(); ?>
                </div>
            </div><!-- .post-content -->
        </article><!-- #post-## -->
    <?php endwhile; endif; ?>
    </main><!-- #content -->
    <!-- TBD: improve sidebar functions -->
    <aside class="secondary" role="complementary"> 	
        <div class="postbox" itemscope itemtype="http://schema.org/ProfessionalService">
            <?php if (get_post_meta( $post->ID, "contact_enable", true )) { ?>
            <section class="boxitem">
            	<div class="item-content">
                    <h3><?php _e('Contact Address:', 'msign') ?></h3>
                        <address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                            <?php if (get_post_meta( $post->ID, "contact_address", true )) { ?>
                            <span itemprop="streetAddress"><?php echo get_post_meta( $post->ID, "contact_address", true ); ?></span><br />
                            <?php } if (get_post_meta( $post->ID, "contact_post", true )) { ?>
                            <span itemprop="postalCode"><?php echo get_post_meta( $post->ID, "contact_post", true ); ?></span>
                            <?php } if (get_post_meta( $post->ID, "contact_city", true )) { ?>
                            <span itemprop="addressLocality"><?php echo get_post_meta( $post->ID, "contact_city", true ); ?></span><br />
                            <?php } if (get_post_meta( $post->ID, "contact_country", true )) { ?>
                            <span itemprop="addressCountry"><?php echo get_post_meta( $post->ID, "contact_country", true ); ?></span><br />
                            <?php } ?>
                        </address>
                   </div>
             </section><!-- .boxitem -->
             <section class="boxitem">
            	<div class="item-content">
                	<h3><?php _e('Contact us by:', 'msign') ?></h3>
                        <?php if (get_post_meta( $post->ID, "contact_phone", true )) { 
                        	_e('Telephone: ','msign')?><span itemprop="telephone"><?php echo get_post_meta( $post->ID, "contact_phone", true ); ?></span><br />
                        <?php } if (get_post_meta( $post->ID, "contact_email", true )) { 
							_e('E-mail: ','msign')?><span itemprop="email"><a href="mailto:<?php echo get_post_meta( $post->ID, "contact_email", true ); ?>">
							<?php echo get_post_meta( $post->ID, "contact_email", true ); ?></a></span>
                        <?php } ?>
                 </div>
             </section><!-- .boxitem -->  
             <?php } if (get_post_meta( $post->ID, "contact_social_media", true )) { ?>
             <section class="boxitem"> 
             	<div class="item-content">
                    <h3><?php _e('Social Networks:', 'msign') ?></h3>
                    <div class="social-media">
                        <?php if(get_option('msign_social_facebook')) { ?>
                        <a class="facebook-share" href="<?php echo get_option('msign_social_facebook'); ?>" target="_blank" title="<?php bloginfo( 'name' ); _e(' on Facebook', 'msign'); ?>" rel="external"><?php _e('Facebook', 'msign'); ?></a>
                        <?php } if(get_option('msign_social_twitter_username')) { ?>
                        <a class="twitter-share" href="http://www.twitter.com/<?php echo get_option('msign_social_twitter_username'); ?>" target="_blank" title="<?php bloginfo( 'name' ); _e(' on Twitter', 'msign'); ?>" rel="external"><?php _e('Facebook', 'msign'); ?></a>
                        <?php } if(get_option('msign_social_linkedin')) { ?>
                        <a class="linkedin-share" href="<?php echo get_option('msign_social_linkedin'); ?>" target="_blank" title="<?php bloginfo( 'name' ); _e(' on Linkedin', 'msign'); ?>" rel="external"><?php _e('LinkedIn', 'msign'); ?></a>
                        <?php } if(get_option('msign_social_gplus')) { ?>
                        <a class="gplus-share" href="<?php echo get_option('msign_social_gplus'); ?>" target="_blank" title="<?php bloginfo( 'name' ); _e(' on Google Plus', 'msign'); ?>" rel="external"><?php _e('Google Plus', 'msign'); ?></a>
                        <?php } if(get_option('msign_social_behance')) { ?>
                        <a class="behance-share" href="<?php echo get_option('msign_social_behance'); ?>" target="_blank" title="<?php bloginfo( 'name' ); _e(' on Behance', 'msign'); ?>" rel="external"><?php _e('Behance', 'msign'); ?></a>
                        <?php } ?>
                      </div><!-- .social-media -->
                  </div><!-- .item-content -->
            </section><!-- .boxitem --> 
            <?php } ?>     
         </div><!-- .contact-details -->
    </aside><!-- #secondary -->
    <?php get_template_part('sidebars'); ?>
<?php get_footer(); ?>