<?php /* Content for testimonies in loops */ ?>		
<article id="post-<?php the_ID(); ?>" <?php post_class('boxitem') ?> itemprop="review" itemscope itemtype="http://schema.org/Review">
    <div class="post-content">
        <header class="entry-header">
            <?php if(has_post_thumbnail()) { ?>
                <figure class="round-image"><?php the_post_thumbnail(); ?></figure>
            <?php } ?>
            <h4 itemprop="name" class="entry-title">
                <?php the_title(); ?>
            </h4>
        </header>
        <div class="entry-content" itemprop="reviewBody">
            <?php the_content(); ?>
        </div>
        <?php edit_post_link( __( 'Edit testimony', 'msign' ), '<span>&raquo; ', '</span>'); ?>
    </div> <!-- .post-content -->
</article>