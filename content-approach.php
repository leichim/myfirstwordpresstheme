<?php /* Content for approach */ ?>		
<article id="post-<?php the_ID(); ?>" <?php post_class() ?> itemscope itemtype="http://schema.org/Thing">
  <div class="post-content">
        <?php if(has_post_thumbnail()) { ?>
              <figure class="approach-image">
                 <?php the_post_thumbnail('default-homebox-large'); ?>
              </figure>
        <?php } ?>
        <div class="approach-content">
            <h3 class="entry-title" itemprop="name"><?php echo get_post_meta($post->ID,'approach_order' ,TRUE),':'; the_title(); ?></h3>
            <div class="entry-content" itemprop="text">
                <?php the_content(); ?>
            </div>
        </div>
        <?php edit_post_link( __( 'Edit approach', 'msign' ), '<span>&raquo; ', '</span>'); ?>
    </div> <!-- .post-content -->
</article>