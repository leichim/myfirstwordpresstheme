<div id="slider" class="loading">
    <div class="flexslider portfolio">
        <ul class="slides">
            <?php $field1 = get_post_meta( $post->ID, "project_slider1", true );
            $ext1 = pathinfo($field1, PATHINFO_EXTENSION);
            if($field1) { ?> 
                <li class="slide">
                    <?php if($ext1 == 'png' || $ext1 == 'gif' || $ext1 == 'jpg' || $ext1 == 'bmp' || $ext1 == 'tiff' ) { ?>
                    <figure id="1">    
                        <img src="<?php echo $field1; ?>" alt="<?php _e('Project image for: ', 'msign'); the_title(); ?>" />
                    </figure>
                    <?php } else { ?>
                    <div class="video-container">
                        <?php echo $field1; ?>
                    </div>
                    <?php } ?>
                </li>
            <?php } else {
                if(has_post_thumbnail()) { 
                $image_id = get_post_thumbnail_id();  $image_url = wp_get_attachment_image_src($image_id,'large');  $image_url = $image_url[0];?> 
                <li class="slide">
                    <figure id="1">    
                        <a href="<?php echo $image_url ?>" title="<?php the_title_attribute(); ?>" itemprop="image" rel="lightbox">
                            <?php the_post_thumbnail( 'large'); ?>
                        </a>
                    </figure>
                </li>
            <?php	}
            } for ($i = 2; $i <= 5; $i++) {
                $field = get_post_meta( $post->ID, "project_slider".$i, true );
                $ext = pathinfo($field, PATHINFO_EXTENSION);
                if($field) {  ?> 
                <li class="slide">
                    <?php if($ext == 'png' || $ext == 'gif' || $ext == 'jpg' || $ext == 'bmp' || $ext == 'tiff' ) { ?>
                    <figure id="<?php echo $i; ?>">    
                        <img src="<?php echo $field; ?>" alt="<?php _e('Project image for: ', 'msign'); the_title(); ?>" />
                    </figure>
                    <?php } else { ?>
                    <div class="video-container">
                        <?php echo $field; ?>
                    </div>
                    <?php } ?>
                </li>
                <?php } 
            } ?>
        </ul>
    </div><!-- .flexslider -->
</div><!-- #slider -->