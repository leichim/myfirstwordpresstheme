<?php /* Content for members in loops */ ?>		
<article id="post-<?php the_ID(); ?>" <?php post_class('boxitem') ?>>
	  <div class="post-content <?php if( get_post_meta( $post->ID, "member_function", true ) == "partner") echo 'partner'; ?>" 
		  <?php if( get_post_meta( $post->ID, "member_function", true ) == "founder") { 
					  echo 'itemprop="founder"';
				} elseif( get_post_meta( $post->ID, "member_function", true ) == "partner") {
					  echo 'itemprop="member"';
				} else {
					  echo 'itemprop="employee"';
				} ?> itemscope itemtype="http://schema.org/Person">
		  <header class="entry-header"> 
			<?php if(has_post_thumbnail()) { ?>
				<figure class="round-image">
					<?php the_post_thumbnail(); ?>
				</figure>
			<?php } ?>
			<h4 class="entry-title" itemprop="name"><?php the_title(); ?></h4>
		  </header>
		  <div class="entry-content" itemprop="description">
				<?php the_content();?>
		  </div>
		  <footer class="entry-utility">
				<?php msign_social_members(); ?>
				<?php edit_post_link( __( 'Edit member', 'msign' ), '<span>&raquo; ', '</span>'); ?>
		  </footer>
	 </div> <!-- .post-content -->
</article>