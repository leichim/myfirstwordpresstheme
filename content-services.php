<?php /* Content for service items in loop */ ?>		
    <article id="post-<?php the_ID(); ?>" <?php post_class('boxitem') ?> itemprop="makesOffer" itemscope itemtype="http://schema.org/Offer">
	  <?php if(has_post_thumbnail()) { ?>
          <figure class="service-image">
              <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php _e('More information', 'msign'); the_title_attribute(); ?>">
                <?php the_post_thumbnail( 'homebox-small' ); ?>
              </a>
          </figure>
      <?php } ?>
      <div class="post-content">
          <header class="entry-header"> 
              <h2 itemprop="name" class="entry-title">
              	   <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('More information for ', 'msign'); the_title_attribute(); ?>" itemprop="url"><?php the_title(); ?></a>
              </h2>
          </header>
		  <div class="entry-content" itemprop="description">
		  	<?php global $more; $more = 0; the_content(''); ?>
          </div>
      	  <footer class="entry-utility">
            <div class="continue-reading"> 
                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php _e('More information for ', 'msign'); the_title_attribute(); ?>" class="view">
                    <?php _e('More information &rsaquo;', 'msign'); ?>
                </a>    
            </div>
    		<?php edit_post_link( __( 'Edit service', 'msign' ), '<span>&raquo; ', '</span>'); ?>      
      	</footer>
     </div> <!-- .post-content -->
    </article>