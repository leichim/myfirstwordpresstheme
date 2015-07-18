<?php /* Content for blog-posts */ ?>		
<article id="post-<?php the_ID(); ?>" <?php post_class('boxitem');  ?> itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">    
	<?php if(has_post_thumbnail()) { ?>
        <figure class="post-image">
            <a href="<?php the_permalink() ?>#more-<?php the_ID(); ?>" rel="bookmark" title="<?php _e('Continue reading ', 'msign'); the_title_attribute(); ?>">
                <?php the_post_thumbnail( 'homebox-small' ); ?>
            </a>
        </figure>
    <?php } if (get_post_meta($post->ID,'post_video' ,TRUE)) { ?>
        <div class="video-wrapper">
            <div class="video-container">
                <?php echo get_post_meta($post->ID,'post_video' ,TRUE); ?>
            </div>
        </div>	
    <?php } ?>     
    <div class="post-content">
        <header class="entry-header"> 
            <h2 itemprop="headline" class="entry-title">
            	<a href="<?php the_permalink() ?>" rel="bookmark" title="Link to <?php the_title_attribute(); ?>" itemprop="url"><?php the_title(); ?></a>
            </h2>
            <?php if(get_option('msign_blog_metaheader') == 0 && !is_search()) { ?>
                <div class="entry-meta">
                    <?php msign_posted_on(); ?>	
                </div><!-- .entry-meta -->
            <?php } ?>
        </header>
        <div class="entry-content" itemprop="description">
			<?php global $more; $more = 0; the_content(''); ?>
        </div>
        <footer class="entry-utility">
            <div class="continue-reading"> 
                <a href="<?php the_permalink() ?>#more-<?php the_ID(); ?>" rel="bookmark" title="<?php _e('Continue Reading ', 'msign'); the_title_attribute(); ?>">
                	<?php  _e('Read more&hellip;', 'msign'); ?>
                </a> 	
            </div>
            <?php edit_post_link( __( 'Edit post', 'msign' ), '<span>&raquo; ', '</span>'); ?> 
        </footer>
    </div><!-- .post-content -->
</article>