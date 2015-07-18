<?php 
/** 
 * Template for showing the slider
 **/ ?>
    <div id="slider" class="loading">
      <div class="flexslider" >
      	<ul class="slides">
			<?php $sliderargs = array( 'post_type' => 'feature','posts_per_page' => get_option('msign_numbers_featureslider'));
            $wp_query = new WP_Query(); $wp_query->query($sliderargs);
            if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
            <li class="slide" style="background:url(<?php echo get_post_meta( $post->ID, "fpfeature_image", true ); ?>) 50% 50% no-repeat;">  
				<div class="slidercontent">
 					<div class="caption"> 
                        <h2>
                            <a href="<?php echo get_post_meta( $post->ID, "fpfeature_link", true )?>" rel="bookmark" title="<?php the_title(); ?>" itemprop="url"><?php the_title(); ?></a>
                        </h2>
                        <?php if( get_post_meta( $post->ID, "fpfeature_caption", true ) ) { ?>
                            <div><span><?php echo get_post_meta( $post->ID, "fpfeature_caption", true ) ?></span></div>
                        <?php } if( get_post_meta( $post->ID, "fpfeature_link", true ) ) { ?>
                            <a href="<?php echo get_post_meta( $post->ID, "fpfeature_link", true ) ?>" title="<?php echo get_post_meta( $post->ID, "fpfeature_link_text", true ) ?>" class="view" rel="bookmark"><?php echo get_post_meta( $post->ID, "fpfeature_link_text", true  ) . ' &rsaquo;'; ?></a>
                        <?php } edit_post_link( __( 'Edit Slider', 'msign' ), '<span>&raquo; ', '</span>'); ?>
                      </div><!-- .caption -->
                      <?php if(get_post_meta( $post->ID, "fpfeature_video", true ) ) { ?>
                    	<div class="video-wrapper-slider">
                        	<div class="video-container">
								<?php echo get_post_meta( $post->ID, "fpfeature_video", true ); ?>
                        	</div><!-- .video-container -->
                    	</div><!-- .video-wrapper -->
           			  <?php } ?>               	 
                </div>
            </li><!-- .slide -->
            <?php endwhile; endif; wp_reset_query(); ?>
        </ul><!-- .slides -->
      </div> <!-- .flexslider -->
    </div> <!-- #slider -->