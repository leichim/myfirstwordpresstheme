<?php /* Content if nothing is found */ ?>		
	<article id="post-0" class="post error404 not-found boxitem">
		<div class="post-content" itemprop="description">
            <header class="entry-header"> 
                <h2 class="entry-title" itemprop="name"><?php _e( 'Nothing Found', 'msign' ); ?></h2>
            </header>
            <div class="entry-content">
                <p class="notice"><?php _e( 'Apologies, but no content was found. Perhaps searching will help find the right content?', 'msign' ); ?></p>
                <?php get_search_form(); ?>
            </div>    
		</div><!-- .post-content -->
	</article><!-- #post-0 -->