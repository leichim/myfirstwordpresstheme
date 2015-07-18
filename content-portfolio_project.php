<?php /* Content for portfolio items */ ?>		
<article id="post-<?php the_ID(); ?>" <?php post_class('boxitem') ?> itemscope itemtype="http://schema.org/CreativeWork">
        <header class="entry-header mask">
                  <h2 class="entry-title" itemprop="name">
                      <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('View more details for ', 'msign'); the_title_attribute(); ?>" itemprop="url">
                          <?php the_title(); ?>
                      </a>
                  </h2>
                  <h6 itemprop="genre"><?php echo get_the_term_list( $post->ID, 'project_category', '', ' &middot; ','' ); ?></h6>
        </header>
        <?php if(has_post_thumbnail()) { ?>
            <figure class="portfolio-image">
            <?php the_post_thumbnail( 'homebox-small' ); ?>
            </figure>
        <?php } 
        edit_post_link( __( 'Edit project', 'msign' ), '<span>&raquo; ', '</span>'); ?>
</article>