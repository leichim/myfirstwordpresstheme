<?php /* View of services, portfolio and testimonies in tabbed manner */ ?>
    <div class="tabs">
        <div class="center">	
            <nav class="tab-nav">
            <?php if(get_option('msign_servicesintro') && get_option('msign_add_services') == 1) { ?>
                <h3><a href="#services" title="<?php echo get_option ('msign_servicesintro'); ?>"><?php echo get_option ('msign_servicesintro'); ?><span class="pointer"></span></a></h3>
            <?php } if(get_option('msign_portfoliointro') && get_option('msign_add_portfolio') == 1) { ?>
                <h3><a href="#portfolio" title="<?php echo get_option ('msign_portfoliointro'); ?>"><?php echo get_option ('msign_portfoliointro'); ?><span class="pointer"></span></a></h3>
            <?php } if(get_option('msign_testimoniesintro') && get_option('msign_add_testimonies') == 1) { ?>
                <h3><a href="#testimonies" title="<?php echo get_option ('msign_testimoniesintro'); ?>"><?php echo get_option ('msign_testimoniesintro'); ?><span class="pointer"></span></a></h3>
            <?php } ?>
            </nav><!-- .tab-nav -->
        </div><!-- .center -->
		<?php if(get_option('msign_add_services') == 1) { ?>
        <div id="services" itemscope itemtype="http://schema.org/ProfessionalService" class="single-tab active">
          <div class="center">
              <div class="postbox">			
                    <?php $services_amount = get_option('msign_services_num') ;
					$services_args = array( 'post_type' => 'services', 'posts_per_page' => $services_amount );  
                    $wp_query = new WP_Query(); $wp_query->query($services_args); 
                    if ($wp_query->have_posts() ) : 
                        while ($wp_query->have_posts() ) : $wp_query->the_post(); 
                            get_template_part('content', 'services');
                        endwhile; 
                    elseif ( ! have_posts() ) : 
                        get_template_part('content', 'none');
                    endif; wp_reset_query(); ?>	
              </div><!-- .postbox -->	
			  <?php if(get_option('msign_services_path')) { ?>
                  <a href="<?php echo get_option('msign_services_path'); ?>" class="view red"><?php _e('More services &rsaquo;','msign'); ?></a> 
              <?php } ?>
           </div>
         </div>
         <?php } if( get_option('msign_add_portfolio')  ) { ?>
         <div id="portfolio" class="single-tab"> 
           <div class="center">  
                <div class="postbox">			
                    <?php $portfolio_amount = get_option('msign_projects_num') ;
					$portfolio_args = array( 'post_type' => 'portfolio_project', 'posts_per_page' => $portfolio_amount );  
                    $wp_query = new WP_Query(); $wp_query->query($portfolio_args); 
                    if ($wp_query->have_posts() ) : 
                        while ($wp_query->have_posts() ) : $wp_query->the_post(); 
                            get_template_part('content', 'portfolio_project');
                        endwhile; 
                    elseif ( ! have_posts() ) : 
                        get_template_part('content', 'none');
                    endif; wp_reset_query(); ?>	
                </div><!-- .postbox -->
				<?php if(get_option('msign_portfolio_path')) { ?>
                        <a href="<?php echo get_option('msign_portfolio_path'); ?>" class="view red"><?php _e('More work &rsaquo;','msign'); ?></a> 
                <?php } ?>
          </div><!-- .introduction -->
         </div>
         <?php } if(get_option('msign_add_testimonies') == 1) { ?> 
         <div id="testimonies" class="single-tab">
           <div class="center">
            	<div class="postbox">   
                <?php $testimonies_amount = get_option('msign_testimonies_num') ;
					$testimonies_args = array( 'post_type' => 'testimonies', 'posts_per_page' => $testimonies_amount );  
                    $wp_query = new WP_Query(); $wp_query->query($testimonies_args);
                    if ($wp_query->have_posts() ) : 
                        while ($wp_query->have_posts() ) : $wp_query->the_post(); 
                            get_template_part('content', 'testimonies');
                        endwhile; 
                    elseif ( ! have_posts() ) : 
                        get_template_part('content', 'none');
                    endif; wp_reset_query(); ?> 
                </div><!-- .postbox -->      
                <?php if(get_option('msign_testimonies_path')) { ?>
                   <a href="<?php echo get_option('msign_testimonies_path'); ?>" class="view red"><?php _e('More testimonies &rsaquo;','msign'); ?></a> 
                <?php } ?>
          </div><!-- .introduction -->
        </div>    
        <?php }?>
    </div><!-- .tabs -->