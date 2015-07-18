<?php 
/* SEO Functions. These are ommited if they are disabled in the theme options panel, so that a good SEO plugin can be used */
/* SEO: Tags function to automatically insert tags into meta keywords.*/
if ( ! function_exists( 'msign_tags' ) ) {
	function msign_tags() {
		$posttags = get_the_tags();
		$standard_keywords = get_option('msign_standard_metakeywords');
		if($posttags) {
			foreach((array)$posttags as $tag) {
			  $tags_name = $tag->name . ',';
			}
			$tags_name = trim($csv_tags, ',');
			echo '<meta name="keywords" content=" '. $standard_keywords .',' . $tags_name . '" />';
		} else {
			echo '<meta name="keywords" content=" '. $standard_keywords .' " />';
		}
	} 
}
/* SEO: Title*/
 if ( ! function_exists( 'msign_title' ) ) {
	function msign_title() {
		global $page, $paged;
		$site_description = get_bloginfo( 'description', 'display' );
		if( is_singular() ) {
			global $post;
			if(get_post_meta($post->ID, 'post_seo_title', true)) {
				echo get_post_meta($post->ID, 'post_seo_title', true) . ' &middot; ';
			} else {
				wp_title(' &middot; ', true , 'right');
			}
		}
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo "$site_description &middot; ";
		if ( $paged >= 2 || $page >= 2 ) {
			echo sprintf( __( 'Page %s', 'msign' ), max( $paged, $page ) ) .  ' &middot; ';
		}
		if ( is_category() ) {
			echo single_cat_title('',false) . ' &middot; ';
		}
		if ( is_tag() ) {
			echo single_tag_title('',false) . ' &middot; ';
		}
		if ( is_search() ) {
			echo __('Search results for: ', 'msign') . get_search_query() . ' &middot; ';
		}
		if ( is_date() ) {
			_e('Archive &middot; ', 'msign'); 
		}
		if ( is_tax() ) {
			echo __('Portfolio for: ', 'msign') . single_cat_title( '', false ) . ' &middot; ';
		}
		if ( is_author() ) {
			$current_author = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
			echo __('Posts written by ', 'msign') . $current_author->display_name . ' &middot; '; 
		}
		bloginfo( 'name' );
 	}
}
/* SEO: Description */
if ( ! function_exists( 'msign_description' ) ) {
 	function msign_description() {		
			$home_description = get_option('msign_home_description');
			$category_description = get_option('msign_category_description');	
			$custom_description = get_option('msign_standard_description');
 			$site_description = get_bloginfo( 'description', 'display' );
            if ( is_home() || is_front_page() ) {
              	if( $home_description ) {
					echo $home_description; 
				} elseif( $custom_description ) {
					echo $custom_description; 
				} elseif( $site_description) { 
					echo $site_description; 
				} else {
					_e('Your site does not have a valid meta description yet', 'msign'); 
				}
			} elseif ( is_archive()) {
				if( category_description() ) {
                	echo trim(strip_tags(category_description()));	
				} elseif( $category_description ) {
					echo $category_description;
				} elseif( $custom_description ) {
					echo $custom_description;
				} elseif( $site_description ) { 
					echo $site_description; 
				} else {
					_e('Your site does not have a valid meta description yet', 'msign'); 
				}
			} elseif ( is_singular() ) { 
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					global $post;
					$post_description = get_post_meta($post->ID, 'post_seo_description', true);
					if($post_description) {
						echo $post_description;
					} else {
						the_excerpt();
					}
           		endwhile; endif; 
			};
	}
 }
/* SEO: Canonical links */
if ( ! function_exists( 'msign_current_page_url' ) ) :
	function msign_current_page_url() {
		$pageURL = 'http';
		if( isset($_SERVER["HTTPS"]) ) {
			if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
endif;
/* SEO: Microschemes */
if ( ! function_exists( 'msign_microscheme' ) ) :
function msign_microscheme() {
	if(is_page_template('contact.php')) { 
		echo 'itemscope itemtype="http://schema.org/ContactPage"';
	} elseif(is_singular('portfolio_project')) { 
		echo 'itemscope itemtype="http://schema.org/CreativeWork"';
	} elseif(is_singular('post')) { 
		echo 'itemscope itemtype="http://schema.org/BlogPosting"';
    } elseif( is_singular('services') ) { 
		echo 'itemscope itemtype="http://schema.org/ProfessionalService" itemprop="makesOffer"';
    } elseif(is_search()) {
		echo 'itemscope itemtype="http://schema.org/SearchResultsPage"';
	}
}
endif;
if ( ! function_exists( 'msign_postloop_microscheme' ) ) :
function msign_postloop_microscheme() {
	global $post_postloop;
	if ($post_postloop == 'services' || $post_postloop == 'members' || $post_postloop == 'testimonies') { echo 'itemscope itemtype="http://schema.org/ProfessionalService"'; } 
}
endif;
/* SEO: Opengraph */
if ( ! function_exists( 'msign_display_opengraph' ) ) :
	function msign_display_opengraph() {
		$twitter_username = get_option('msign_social_twitter_username'); ?>
				<meta property="og:type" content="website" />
				<meta property="og:title" content="<?php msign_title(); ?>" />
				<meta property="og:description" content="<?php msign_description(); ?>'" />
				<meta property="og:url" content="<?php msign_current_page_url(); ?>" />
				<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>" />
		<?php if(is_singular() && has_post_thumbnail()) {
            $imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ));
            echo '<meta property="og:image" content="' . $imgsrc[0] . '" />';
        } 
		if($twitter_username) {
			echo   '<meta name="twitter:site" content="@' . $twitter_username . '" />
					<meta name="twitter:card" content="summary" />
					<meta name="twitter:creator" content="@'. $twitter_username . '" />';
		}
	}
endif;

/* SEO: Semantic Breadcrumbs (using rich snippets/microdata). If yoast breadcrumbs plugin is used, this breadcrumb function is discarded. Works best with pretty permalinks  */
if ( ! function_exists( 'msign_breadcrumbs' ) ) :
	function msign_breadcrumbs() {
	  global $post;
	  if ( function_exists('yoast_breadcrumb') ) { 
		yoast_breadcrumb('<nav id="breadcrumbs">','</nav>'); 
	  } elseif( get_option('msign_breadcrumbs') && ! get_post_meta($post->ID, 'post_breadcrumbs', true)) { 
		  $delimiter = '<span class="delimiter">&raquo;</span>';
		  $scheme = '<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
		  $home_text = __('Home', 'msign'); // Text used in the home (highest ancestor) breadcrumb
		  $before = $scheme. '<a href="' . msign_current_page_url() . '" itemprop="url"><span itemprop="title">'; // Tag before the current breadcrumb
		  $after = '</span></a></div>'; // Tag after the current breadcrumb
		  // No breadcrumbs on home or frontpage
		  if ( !is_home() && !is_front_page() ) {
			// The main container
			echo '<nav id="breadcrumbs">';
			$home = home_url();
			echo $scheme . '<a href="' . $home . '" itemprop="url"><span itemprop="title">' . $home_text . '</span></a></div> ' . $delimiter . ' ';
			// In single posts
			if ( is_single() && !is_attachment() ) {
			  // custom post types
			  if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					$services_link = get_option('msign_services_path');
					$services_name = get_option('msign_services_name');
					$portfolio_link = get_option('msign_portfolio_path');
					$portfolio_name = get_option('msign_portfolio_name');
					$members_link = get_option('msign_members_path');
					$members_name = get_option('msign_members_name');
					$testimonies_link = get_option('msign_testimonies_path');
					$testimonies_name = get_option('msign_testimonies_name');
					if ( get_post_type() == 'services' && $services_link && $services_name) {
						$post_overview_link = $services_link; 
						$post_overview_name = $services_name; 
					} elseif ( get_post_type() == 'portfolio_project' && $portfolio_link && $portfolio_name) {
						$post_overview_link = $portfolio_link; 
						$post_overview_name = $portfolio_name; 
					} elseif ( get_post_type() == 'testimonies' && $testimonies_link && $testimonies_name) {
						$post_overview_link = $testimonies_link; 
						$post_overview_name = $testimonies_name; 
					} elseif ( get_post_type() == 'members' && $members_link && $members_name) {
						$post_overview_link = $members_link; 
						$post_overview_name = $members_name; 
					} else {
						$post_overview_link = $home . '/' . $slug['slug'] . '/'; // Sets parent archive page to slug if no link is added in the admin page.
						$post_overview_name = $post_type->labels->singular_name; 
					}
					echo $scheme . '<a href="' . $post_overview_link . '" itemprop="url"><span itemprop="title">' . $post_overview_name . '</span></a></div>' . $delimiter;
					echo $before . get_the_title() . $after;
			  // normal types
			  } else {
					$categories = get_the_category($post->ID); 
					$output = '';
					if($categories){
						foreach($categories as $category) {
							$output .= $scheme.'<a href="'.get_category_link( $category->term_id ).'" itemprop="url"><span itemprop="title">'.$category->cat_name.'</span></a></div>'.$delimiter;
						}
					echo $output;
					}
					echo $before . get_the_title() . $after; 
			  }
			// All other cases for custom post types
			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() && get_post_type() != 'portfolio_project' ) {
			  	$post_type = get_post_type_object(get_post_type());
			 	echo $before . $post_type->labels->singular_name . $after; 
			// In attachments
			} elseif ( is_attachment() ) {
			  	$parent = get_post($post->post_parent);
			 	 echo $scheme . '<a href="' . get_permalink($parent) . '" itemprop="url"><span itemprop="title">' . $parent->post_title . '</span></a></div>' . $delimiter . ' ';
			  	echo $before . get_the_title() . $after;
			// In pages without parent
			} elseif ( is_page() && !$post->post_parent ) {
			  	echo $before . get_the_title() . $after;
			// In pages with parent
			} elseif ( is_page() && $post->post_parent ) {
			  	$parent_id  = $post->post_parent;
			 	$breadcrumbs = array();
			  	while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = $scheme . '<a href="' . get_permalink($page->ID) . '" itemprop="url"><span itemprop="title">' . get_the_title($page->ID) . '</span></a></div>';
					$parent_id  = $page->post_parent;
			  	}
			  $breadcrumbs = array_reverse($breadcrumbs);
			  foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
			  echo $before . get_the_title() . $after;
			} 
			// In category archive
			elseif ( is_category() ) { 
				$cat = single_cat_title('', false);
				$catID = get_cat_ID($cat);
				echo $scheme . get_category_parents($catID, true, '</div>'. $delimiter . $scheme); 
				echo '<span itemprop="title">' . __('Archive', 'msign') . $after;
			}
			// In tag archive
			elseif ( is_tag() ) { 
				$tag = single_tag_title('', false);
				echo $before. $tag . $after;
			}
			// In search archive
			elseif ( is_search() ) { 
				echo $before.  __('Search Results', 'msign') . $after;
			}
			// In date archive	
			elseif ( is_date() ) { 
				echo $before. __('Date Archive', 'msign') . $after;
			} 
			// In custom taxonomy archive, for portfolio
			elseif ( is_tax() ) { 
				$portfolio_link = get_option('msign_portfolio_path');
				$portfolio_name = get_option('msign_portfolio_name');
				//$custom_term = get_query_var( 'term' );
				$custom_term = get_term_by('slug', get_query_var( 'term' ), 'project_category');
				if($portfolio_link && $portfolio_name) {
					echo $scheme . '<a href="'.$portfolio_link.'" itemprop="url"><span itemprop="title">'.$portfolio_name.'</span></a></div>'.$delimiter;
				} else {
					echo $scheme . '<a href="#" itemprop="url"><span itemprop="title">'. __('Project Type', 'msign') .'</span></a></div>'.$delimiter;
				}
				echo $before. $custom_term->name  . $after;	
			}					
			echo '</nav>';	
		  }
	  }
	} 
endif;
/* Post Title */
if ( ! function_exists( 'msign_post_title' ) ) {
	function msign_post_title() {
		if ( is_singular() ) {
			single_post_title();
		} elseif( is_archive() && !is_tax() ) {
			if ( is_day() ) :  printf( __( 'Daily Archives: <span>%s</span>', 'msign' ), get_the_date() ); 
            elseif ( is_month() ) :  printf( __( 'Monthly Archives: <span>%s</span>', 'msign' ), get_the_date('F Y') );  
            elseif ( is_year() ) :  printf( __( 'Yearly Archives: <span>%s</span>', 'msign' ), get_the_date('Y') ); 
            elseif ( is_author() ) :  $current_author = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
                printf( __( 'Posts written by: %s', 'msign' ),  $current_author->display_name );
            elseif ( is_category() ) :  echo '<span>' . single_cat_title( '', false ) . '</span>';
            elseif ( is_tag() ) :	printf( __( 'Posts tagged: %s', 'msign' ) , '<span>' . single_tag_title( '', false ) . '</span>' );
            else :  _e( 'Blog Archives', 'msign' ); endif;
		} elseif( is_tax('project_category') ) {
			printf( __( 'Portfolio for: %s', 'msign' ), '<span>' . single_cat_title( '', false ) . '</span>' );
		} elseif( is_search()) {
			printf( __( 'Search Results for: %s', 'msign' ), '<span>' . get_search_query() . '</span>' );
		} elseif( is_404() ) {
			echo "Oops, we got a 404";
		}		
	}
}
/* Custom Excerpt Lenght */
function msign_excerpt_length( $length ) {
		return 40;
}
add_filter( 'excerpt_length', 'msign_excerpt_length' );
/* Removes paragraps from excerpts */ 
remove_filter('the_excerpt', 'wpautop'); 
/* Prints HTML with meta information for the current post (tags). */
if ( ! function_exists( 'msign_posted_in' ) ) {
	function msign_posted_in() {
		$tag_list = get_the_tag_list('<span itemprop="keywords">',' ','</span>');
		if ( $tag_list ) {
			echo '<span class="tag-icon"></span>'. $tag_list;
		}
	}
}
/* Prints HTML with meta information for the current post—date/time and author. */
if ( ! function_exists( 'msign_posted_on' ) ) {
	function msign_posted_on() {
			global $post;
			printf( __( '<span itemprop="genre">%1$s</span> <strong>&middot;</strong>   %3$s  <strong>&middot;</strong>   %3$s  <strong>&middot;</strong>    %4$s      ', 'msign' ),
				get_the_term_list( $post->ID, 'category', '', ', ', '' ),
				get_the_tag_list('<span itemprop="keywords">',' ','</span>'),
                sprintf( '<a href="%1$s"><time datetime="%2$s" itemprop="datePublished" class="updated">%3$s</time></a>',
					get_permalink(),
					get_the_date('c'),
					get_the_date()),
				sprintf( 
                    '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
					get_author_posts_url( get_the_author_meta( 'ID' ) ),
					sprintf( 
                        esc_attr__( 'View all posts by %s', 'msign' ), 
                        get_the_author() 
                    ),
					get_the_author()
                )
			);
		}
}
/* Customize all images from the mediagallery with HTML 5 Caption */
if ( ! function_exists( 'msign_caption_shortcode_filter' ) ) {
	add_filter('img_caption_shortcode', 'msign_caption_shortcode_filter',10,3);
	function msign_caption_shortcode_filter($val, $attr, $content = null) {
		extract(shortcode_atts(array(
			'id'	=> '',
			'align'	=> '',
			'width'	=> '',
			'caption' => ''
		), $attr));
		if ( 1 > (int) $width || empty($caption) )
			return $val;
		$capid = '';
		if ( $id ) {
			$id = esc_attr($id);
			$capid = 'id="figcaption_'. $id . '" ';
			$id = 'id="' . $id . '"';
		}	
		return '<figure ' . $id . ' class="wp-caption ' . esc_attr($align) . '" style="width: '
		. (4 + (int) $width) . 'px">' . do_shortcode( $content ) . '<figcaption ' . $capid
		. 'class="wp-caption-text">' . $caption . '</figcaption></figure>';
	}
}
/* General Template for Comments */	
if ( ! function_exists( 'msign_comment' ) ) :
	function msign_comment( $comment, $args, $depth ) {
		//$comments = get_comments(array($post->ID)); Work in progress
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' :
		?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>" itemscope itemtype="http://schema.org/Comment">
	  <div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard"> <?php echo get_avatar( $comment, 58 ); ?>
		  <div class="comment-meta commentmetadata">
              <a href="<?php echo esc_url(get_comment_link( $comment->comment_ID ) ); ?>">
                <?php  printf( __( '<span>%1$s at %2$s</span>', 'msign' ), get_comment_date(),  get_comment_time() ); ?>
              </a>
              <?php edit_comment_link( __( '(Edit)', 'msign' ), ' ' );?>
		  </div>
		  <!-- .comment-meta .commentmetadata --> 
		  <?php printf( __( '%s <span class="says">said:</span>', 'msign' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?> </div>
		<!-- .comment-author .vcard -->
		<div class="comment-body" itemprop="text">
		  <?php if ( $comment->comment_approved == '0' ) : ?>
		  <em class="comment-awaiting-moderation">
		  <?php _e( 'Your comment is awaiting moderation.', 'msign' ); ?>
		  </em> <br />
		  <?php endif; ?>
		  <?php comment_text(); ?>
		</div>
		<div class="reply">
		  <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div>
		<!-- .reply -->   
	  </div>
	  <!-- #comment-##  --> 
      </li>
	  <?php		break;
			case 'pingback'  :
			case 'trackback' :
		?>
	<li class="post pingback">
	  <p>
		<?php _e( 'Pingback:', 'msign' ); ?>
		<?php comment_author_link(); ?>
		<?php edit_comment_link( __( '(Edit)', 'msign' ), ' ' ); ?>
	  </p>
      </li>
	  <?php	break;
		endswitch;
	}
endif;
/* Improved Pagination */
if ( ! function_exists( 'msign_pagination' ) ) :
function msign_pagination() {
	global $wp_query; 
	if ( $wp_query->max_num_pages > 1 ){ ?>
		<nav id="pagination-pages">
			<?php $int = 999999999; 
			echo paginate_links( array(
				'base' => str_replace( $int, '%#%', get_pagenum_link( $int ) ),
				'format' => '/page/%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages,
				'prev_text'    => '&laquo;',
   				'next_text'    => '&raquo;',
			) ); ?>
		</nav>
<?php 
	}
}
endif;
/* Social Media Share */
if ( ! function_exists( 'social_share' ) ) :
function msign_social_share() { ?>
    <div class="social-media">	
    	<?php if( is_singular('post') ) { ?>	
        	<a href="#reply-title" title="<?php _e('Leave a Reply', 'msign')?>" itemprop="discussionUrl" class="reply-link"><?php _e('Reply', 'msign')?></a>
        <?php } ?>
        <span><?php _e('Share:', 'msign') ?></span>
        <?php if(get_option('msign_twitterbutton')) { ?>
            <a class="twitter-share" title="<?php _e('Share on twitter', 'msign')?>" target="_blank" rel="nofollow"
            href="http://twitter.com/share?url=<?php urlencode(the_permalink());?>&text=<?php urlencode(the_title()); ?>&via=<?php echo get_option('msign_social_twitter_username'); ?>"><?php _e('Share on twitter', 'msign')?></a>
        <?php } if(get_option('msign_facebooklike')) { ?>
            <a class="facebook-share" title="<?php _e('Share on Facebook', 'msign')?>" target="_blank" rel="nofollow"
                href="http://www.facebook.com/sharer.php?u=<?php urlencode(the_permalink()); ?>&t=<?php urlencode(the_title()) ?>">
                <?php _e('Share on Facebook', 'msign')?></a>               
            <?php } if(get_option('msign_stumbleupon')) { ?>
                <a class="stumble-share" title="<?php _e('Stumble', 'msign')?>" target="_blank" rel="nofollow"
                href="http://stumbleupon.com/submit?url=<?php urlencode(the_permalink()); ?>&title=<?php urlencode(the_title()); ?>">
                <?php _e('Stumble', 'msign')?></a>
            <?php } if(get_option('msign_delicious')) { ?>
                <a class="delicious-share" title="<?php _e('Bookmark on Delicious', 'msign')?>" target="_blank" rel="nofollow"
                href="http://del.icio.us/post?url=<?php echo urlencode(the_permalink()); ?>&title=<?php urlencode(the_title()); ?>">
                <?php _e('Bookmark on Delicious', 'msign')?></a>
            <?php } if(get_option('msign_digg')) { ?>
                <a class="digg-share" title="<?php _e('Digg it', 'msign')?>" target="_blank" rel="nofollow"
                href="http://digg.com/submit?url=<?php urlencode(the_permalink()); ?>"><?php _e('Digg it', 'msign')?></a>
            <?php } if(get_option('msign_pinterest')) { ?>
                <a class="pin-share" title="<?php _e('Pin it', 'msign')?>" target="_blank" rel="nofollow" 
                class="pinterest-share" href="http://pinterest.com/pin/create/button/?url=<?php urlencode(the_permalink());; ?>&description=<?php urlencode(the_title()) ?>"><?php _e('Pin it', 'msign')?></a>
            <?php }  if(get_option('msign_sharelinkedin')) { ?>
                <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php urlencode(the_permalink()); ?>&title=<?php urlencode(the_title()) ?>&summary=<?php the_excerpt(); ?>&source=<?php bloginfo('name'); ?>" title="<?php _e('Share on LinkedIn', 'msign')?>" target="_blank" class="linkedin-share" rel="nofollow"><?php _e('Share on LinkedIn', 'msign')?></a>
            <?php } if(get_option('msign_gplus')) { ?>
                <a href="https://plus.google.com/share?url=<?php urlencode(the_permalink()); ?>" target="_blank" class="gplus-share" title="<?php _e('Share on Google Plus', 'msign'); ?>" rel="nofollow"><?php _e('Share on Google Plus', 'msign'); ?></a>
            <?php } ?>                            
      </div>
<?php }
endif;
/* Social Media Icons */
if ( ! function_exists( 'msign_social_contact' ) ) :
function msign_social_contact() {  ?>
          <div id="iconplacer">
            <?php if(get_option('msign_social_facebook')) { ?>
            <a class="facebook" href="<?php echo get_option('msign_social_facebook'); ?>" target="_blank" title="<?php bloginfo( 'name' ); _e(' on Facebook', 'msign'); ?>" rel="external"><?php _e('Facebook', 'msign')?></a>
            <?php }  if(get_option('msign_social_twitter_username')) { ?>
            <a class="twitterfollow" href="http://www.twitter.com/<?php echo get_option('msign_social_twitter_username'); ?>" target="_blank" title="<?php bloginfo( 'name' );  _e(' on Twitter', 'msign'); ?>" rel="external"><?php _e('Twitter', 'msign')?> </a>
            <?php }  if(get_option('msign_social_linkedin')) { ?>
            <a class="linkedin" href="<?php echo get_option('msign_social_linkedin'); ?>" target="_blank" title="<?php bloginfo( 'name' ); _e(' on LinkedIn', 'msign'); ?>" rel="external"><?php _e('LinkedIn', 'msign')?></a>
            <?php } if(get_option('msign_social_gplus')) { ?>
            <a class="gplus" href="<?php echo get_option('msign_social_gplus'); ?>" target="_blank" title="<?php bloginfo( 'name' ); _e(' on Google Plus', 'msign'); ?>" rel="external"><?php _e('Google Plus', 'msign')?></a>
            <?php } if(get_option('msign_social_behance')) { ?>
            <a class="behance" href="<?php echo get_option('msign_social_behance'); ?>" target="_blank" title="<?php bloginfo( 'name' ); _e(' on Behance', 'msign'); ?>" rel="external"><?php _e('Behance', 'msign')?></a>
            <?php }  if(get_option('msign_social_youtube')) { ?>
            <a class="youtube" href="<?php echo get_option('msign_social_youtube'); ?>" target="_blank" title="<?php bloginfo( 'name' ); _e(' on Youtube', 'msign'); ?>" rel="external"><?php _e('Youtube', 'msign')?></a>
            <?php } if(get_option('msign_social_vimeo')) { ?>
            <a class="vimeo" href="<?php echo get_option('msign_social_vimeo'); ?>" target="_blank" title="<?php bloginfo( 'name' ); _e(' on Vimeo', 'msign'); ?>" rel="external"><?php _e('Vimeo', 'msign')?></a>
            <?php } if(get_option('msign_social_email')) { ?>
            <a class="newsletter" href="<?php echo get_option('msign_social_email'); ?>" target="_blank" title="<?php _e('Subscribe by e-mail', 'msign'); ?>" rel="external nofollow"><?php _e('E-mail Subscription', 'msign')?></a>
            <?php } if(get_option('msign_social_feed')) { ?>
            <a class="rssfollow" href="<?php echo get_option('msign_social_feed'); ?>" target="_blank" title="<?php _e('RSS Feed', 'msign'); ?>" rel="external nofollow"><?php _e('RSS Feed', 'msign')?></a>
            <?php } ?>
          </div><!-- #iconplacer --> 
<?php 	} 
endif;
/* Restricting Feedburners feed to text before more tag */
if ( ! function_exists( 'msign_content_feed' ) ) :
	function msign_content_feed($feed_type = null) {
		if ( !$feed_type )
			$feed_type = get_default_feed();
		global $more;
		$more_restore = $more;
		$more = 0;
		$content = apply_filters('the_content', get_the_content());
		$more = $more_restore;
		$content = str_replace(']]>', ']]>', $content);
		return $content;
	}
	add_filter('the_content_feed', 'msign_content_feed');
endif;
/* Related posts */
if ( ! function_exists( 'msign_related_posts' ) ) :
	function msign_related_posts() {
		global $post;
		$tag = wp_get_post_tags($post->ID);
 		$type = wp_get_post_terms( $post->ID, 'project_category');
		if( is_singular('post') ) {
			$related_number = ( get_post_meta( $post->ID, "post_related_number", true ) ? get_post_meta( $post->ID, "post_related_number", true )  : get_option('msign_related_number'));
			$rargs = array(
				'post_type' => 'post', 
				'tag' => $tag[0]->slug,
				'post__not_in' => array($post->ID),
				'posts_per_page'=> $related_number,
				'orderby' => 'rand' );
		} elseif( is_singular('portfolio_project') ) {
			$related_number = ( get_post_meta( $post->ID, "post_related_number", true ) ? get_post_meta( $post->ID, "post_related_number", true )  : get_option('msign_portfolio_related_number'));
			$rargs = array(
				'post_type' => 'portfolio_project', 
				'project_category' => $type[0]->slug,
				'post__not_in' => array($post->ID),
				'posts_per_page'=> $related_number,
				'orderby' => 'rand' );
		}
		$rp_query = new WP_Query($rargs); 		
		if( $rp_query->have_posts() ) { ?>
        	<aside class="related">
				<?php if(get_post_meta( $post->ID, "post_related_title", true )) { 
					echo '<h3>'. get_post_meta( $post->ID, "post_related_title", true) . '</h3>';  
				} elseif( is_singular('post') && get_option('msign_related_title') ) {
               		echo '<h3>'. get_option('msign_related_title') . '</h3>'; 
				} elseif( is_singular('portfolio_project') && get_option('msign_portfolio_related_title') ) {
					echo '<h3>'. get_option('msign_portfolio_related_title') . '</h3>'; 
				} ?>
                <ul class="random-posts">
                    <?php  while ($rp_query->have_posts()) : $rp_query->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail();?></a>
                        <?php if( is_singular('post')) { ?>
                        	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                            <span>
                                <a href="<?php the_permalink(); ?>/#comments" title="<?php _e('View Comments', 'msign'); ?>">
                                    <?php comments_number(__('0 Comments &raquo;','msign'), __('1 Comment &raquo;','msign'), __('% Comments &raquo;','msign') );?>
                                </a>
                            </span>
                        <?php } ?>
                    </li>
                    <?php endwhile; wp_reset_query(); ?>
                </ul><!-- .random-posts -->
            </aside>
        <?php } 
		}
endif;
/* Author */
if ( ! function_exists( 'msign_author' ) ) :
	function msign_author() { 
		global $post;
		$display_name = get_the_author_meta( 'display_name', $post->post_author );
		$author_facebook = get_the_author_meta( 'facebook', $post->post_author );
		$author_twitter = get_the_author_meta( 'twitter', $post->post_author );
		$author_linkedin = get_the_author_meta( 'linkedin', $post->post_author );
		$author_gplus = get_the_author_meta( 'gplus', $post->post_author );
		$author_behance = get_the_author_meta( 'behance', $post->post_author );
		$author_pinterest = get_the_author_meta( 'pinterest', $post->post_author );  ?>
		<aside id="entry-author-info" itemprop="author" itemscope itemtype="http://schema.org/Person">
			<div id="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email', $post->post_author ), apply_filters( 'msign_author_bio_avatar_size', 60 ) ); ?>
			</div><!-- #author-avatar -->
			<div id="author-description">
                <h2>
                    <span itemprop="name" class="vcard">
                        <a href="<?php if(get_the_author_meta( 'url', $post->post_author )) { the_author_meta( 'url', $post->post_author ); } else { echo home_url(); } ?>" target="_blank" class="url fn" rel="author"><?php printf( esc_attr__( 'About %s', 'msign' ), get_the_author_meta( 'nickname', $post->post_author ) ); ?></a>
                    </span>
                </h2>
                <p itemprop="description">
                    <?php the_author_meta( 'description', $post->post_author); 
                    if(is_single()) { ?>
                        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                            <?php printf( __( 'View all posts by <span class="author vcard">%s</span> &rarr;', 'msign' ), get_the_author() ); ?>
                        </a>
                    <?php } ?>
                </p>
                <div id="author-link">
                    <?php if($author_facebook) { ?>
                        <a class="facebook-share" title="<?php echo $display_name; _e(' on Facebook', 'msign') ?>" target="_blank" rel="author" href="<?php echo $author_facebook; ?>">
                            <?php echo $display_name; _e(' on Facebook', 'msign'); ?>
                        </a> 
                    <?php } if($author_twitter) { ?>
                        <a class="twitter-share" title="<?php echo $display_name; _e(' on Twitter', 'msign') ?>" target="_blank" rel="author" href="<?php echo $author_twitter; ?>">
                            <?php _e(' on Twitter', 'msign'); ?>
                        </a> 
                    <?php } if($author_linkedin) { ?>
                        <a class="linkedin-share" title="<?php echo $display_name; _e(' on LinkedIn', 'msign') ?>" target="_blank" rel="author" href="<?php echo $author_linkedin; ?>">
                            <?php echo $display_name; _e(' on LinkedIn', 'msign'); ?>
                        </a> 
                    <?php } if($author_gplus) { ?>
                        <a class="gplus-share" title="<?php echo $display_name; _e(' on Google Plus', 'msign') ?>" target="_blank" rel="author" href="<?php echo $author_gplus; ?>">
                            <?php echo $display_name; _e(' on Google Plus', 'msign'); ?>
                        </a> 
                    <?php } if($author_behance) { ?>
                        <a class="behance-share" title="<?php echo $display_name; _e(' on Behance', 'msign') ?>" target="_blank" rel="author" href="<?php echo $author_behance; ?>">
                            <?php echo $display_name; _e(' on Behance', 'msign'); ?>
                        </a> 
                    <?php } if($author_pinterest) { ?>
                        <a class="pinterest-share" title="<?php echo $display_name; _e(' on Pinterest', 'msign') ?>" target="_blank" rel="author" href="<?php echo $author_pinterest; ?>">
                            <?php echo $display_name; _e(' on Pinterest', 'msign'); ?>
                        </a> 
                    <?php } ?>                                                                                                                               
				</div><!-- #author-link	-->
			</div><!-- #author-description -->
		</aside><!-- #entry-author-info -->
   <?php }
endif;
/* Function which displays social-network for team-members */
if ( ! function_exists( 'msign_social_members' ) ) :
	function msign_social_members() {
		global $post; 
		$member_facebook = get_post_meta($post->ID, 'member_facebook', true );
		$member_twitter = get_post_meta($post->ID, 'member_twitter', true );
		$member_linkedin = get_post_meta($post->ID, 'member_linkedin', true );
		$member_gplus = get_post_meta($post->ID, 'member_gplus', true );
		$member_behance = get_post_meta($post->ID, 'member_behance', true ); 
		?>
        	<div id="author-link">
			<?php if($member_facebook) { ?>
                <a class="facebook-share" title="<?php the_title(); _e(' on Facebook', 'msign') ?>" target="_blank" rel="external" href="<?php echo $member_facebook; ?>">
                    <?php the_title(); _e(' on Facebook', 'msign'); ?>
                </a> 
            <?php } if($member_twitter) { ?>
                <a class="twitter-share" title="<?php the_title(); _e(' on Twitter', 'msign') ?>" target="_blank" rel="external" href="http://www.twitter.com/<?php echo $member_twitter; ?>">
                    <?php the_title(); _e(' on Twitter', 'msign'); ?>
                </a> 
            <?php } if($member_linkedin) { ?>
                <a class="linkedin-share" title="<?php the_title(); _e(' on LinkedIn', 'msign') ?>" target="_blank" rel="external" href="<?php echo $member_linkedin; ?>">
                    <?php the_title(); _e(' on LinkedIn', 'msign'); ?>
                </a> 
            <?php } if($member_gplus) { ?>
                <a class="gplus-share" title="<?php the_title(); _e(' on Google Plus', 'msign') ?>" target="_blank" rel="external" href="<?php echo $member_gplus; ?>">
                    <?php the_title(); _e(' on Google Plus', 'msign'); ?>
                </a> 
            <?php } if($member_behance) { ?>
                <a class="behance-share" title="<?php the_title(); _e(' on Behance', 'msign') ?>" target="_blank" rel="external" href="<?php echo $member_behance; ?>">
                    <?php the_title(); _e(' on Behance', 'msign'); ?>
                </a> 
            <?php } ?>
            </div>
        <?php 
	}
endif;
/* Functions which regulate social pages of a single author */
function add_additional_contactmethod( $contactmethods ) {
  // Add contemporary contact methods
  if ( !isset( $contactmethods['twitter'] ) ) 
  	$contactmethods['twitter'] = __('Twitter Username', 'msign'); 
  if ( !isset( $contactmethods['facebook'] ) ) 
  	$contactmethods['facebook'] = __('Facebook Url', 'msign'); 
  if ( !isset( $contactmethods['linkedin'] ) ) 
  	$contactmethods['linkedin'] = __('LinkedIn Url', 'msign'); 
  if ( !isset( $contactmethods['gplus'] ) )  
  	$contactmethods['gplus'] = __('Google Plus Url', 'msign'); 
  if ( !isset( $contactmethods['behance'] ) ) 
  	$contactmethods['behance'] = __('Behance Url', 'msign'); 
  if ( !isset( $contactmethods['pinterest'] ) )  
  	$contactmethods['pinterest'] = __('Pinterest Url', 'msign'); 
  if ( !isset( $contactmethods['behance'] ) )  
  	$contactmethods['behance'] = __('Behance Url', 'msign'); 
  // Remove contactmethods which seem unneccessary
  if ( isset( $contactmethods['yim'] ) )
    unset( $contactmethods['yim'] );
  if ( isset( $contactmethods['aim'] ) )
    unset( $contactmethods['aim'] );
  if ( isset( $contactmethods['jabber'] ) )
    unset( $contactmethods['jabber'] );
  return $contactmethods;
}
add_filter( 'user_contactmethods', 'add_additional_contactmethod', 10, 1 );
/* Function which regulates the display of a page and the position of a sidebar */
if ( ! function_exists( 'the_column_class' ) ) :
	function the_column_class() {
		 global $post; 
		 $post_layout = get_post_meta($post->ID,'post_layout' ,TRUE);
		 	if($post_layout == 'sidebar-left' && is_singular() ) {
			 	echo 'class="' .$post_layout. '"'; 	
			} elseif($post_layout == 'one-column' && is_singular() ) {
			 	echo 'class="' .$post_layout. '"'; 	
			} elseif($post_layout == 'sidebar-right' && is_singular() ) {
				echo 'class="' .$post_layout. '"'; 
			} elseif( get_option('msign_portfolio_layout') && get_query_var( 'taxonomy' ) == 'project_category' ) {
				echo 'class="' . get_option('msign_portfolio_layout') . '"';
			} elseif( get_option('msign_index_layout') && is_home() ) {
				echo 'class="' . get_option('msign_index_layout') . '"';
			} elseif( get_option('msign_blog_single_layout') && is_singular('post') ) {
				echo 'class="' . get_option('msign_blog_single_layout') . '"';
			} elseif( get_option('msign_blog_archive_layout') && is_archive() ) {
				echo 'class="' . get_option('msign_index_layout') . '"';
			} else {
				echo 'class="' . get_option('msign_general_layout') . '"';
			}				
	}
endif;
/* This function determines what sidebar needs to be rendered based on the post type */
if ( ! function_exists( 'the_sidebar_type' ) ) :
	function the_sidebar_type() { 
		global $post; ?>
        <aside class="secondary" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">	
            <div class="postbox">
			<?php 
			if(get_post_meta($post->ID,'post_sidebar' ,TRUE) && is_singular()) {		
				$plugins = get_option('active_plugins');
				$required_plugin = 'posts-to-posts/posts-to-posts.php';
				if ( in_array( $required_plugin , $plugins ) ) {
					// Display connected widgets
					$connected = new WP_Query( array('connected_type' => 'widgets_to_posts', 'connected_items' => get_queried_object(), 'nopaging' => true, 'post_type' => 'custom-widget', 'post_per_page' => '999' ) );
					if ( $connected->have_posts() ) : 
						while ( $connected->have_posts() ) : $connected->the_post();?>
							<section class="boxitem">
                            	<div class="item-content">
                                    <h3 class="widget-title"><?php the_title(); ?></h3>
                                    <div class="custom-widget"><?php the_content(); ?></div>
                                </div>
							</section><!-- .boxitem --> 
					<?php endwhile; 
					endif; wp_reset_query();
				} else { ?>
                	<section class="boxitem">
                        <div class="item-content">
                            <p class="notice">
                            	<a href="http://wordpress.org/extend/plugins/posts-to-posts/" target="_blank">
									<?php _e('To use custom widgets, please download and activate the Posts to Posts plugin', 'msign'); ?>
                                </a>
                            </p>
                        </div>
                    </section><!-- .boxitem --> 
				<?php }
            } else {
                if( is_singular('post') || ( is_archive() && get_query_var( 'taxonomy' ) != 'project_category' ) || is_home() || is_front_page() || is_search() || is_page_template('homepage.php') || is_page_template('blog.php')  ) {
                    dynamic_sidebar( 'primary-widget-area' );				
				} elseif( is_singular('page') && ! is_page_template() ) {
                    dynamic_sidebar( 'page-widget-area' ); 
                } elseif(  is_page_template('portfolio.php') || ( is_archive() && get_query_var( 'taxonomy' ) == 'project_category' ) ) {
					dynamic_sidebar( 'portfolio-widget-area' ); 
				} elseif( is_singular('portfolio_project') ) { 
					   if (get_post_meta( $post->ID, "project_website", true )) { ?>
                            <section class="boxitem">
                                <div class="item-content">
                                    <a class="view red" target="_blank" href="<?php echo stripslashes(get_post_meta( $post->ID, "project_website", true )); ?>">
                                        <?php _e('View Website &rsaquo;', 'msign') ?>
                                    </a>
                                </div>
                            </section><!-- .boxitem -->    
                        <?php }  if (get_post_meta( $post->ID, "project_client", true )) { ?>
                            <section class="boxitem">
                                <div class="item-content">
                                    <h3><?php _e('Client:', 'msign') ?></h3>
                                    <p><a class="view" href="<?php if (get_post_meta( $post->ID, "client_website", true )) { echo stripslashes(get_post_meta( $post->ID, "client_website", true )); } else { echo '#'; } ?>"><?php echo get_post_meta( $post->ID, "project_client", true ) ?></a></p>
                                </div>
                            </section><!-- .boxitem -->     
                        <?php } 
						// Display connected services
                        $connected = new WP_Query( array('connected_type' => 'services_to_projects', 'connected_items' => get_queried_object(), 'nopaging' => true, 'post_type' => 'custom-widget', 'post_per_page' => '999' ) );
                        if ( $connected->have_posts() ) : ?>
                        	<section class="boxitem">                          
                            	<div class="item-content">
                                	<h3 class="widget-title"><?php _e('Services Provided:', 'msign'); ?></h3>
                                    <ul class="thick">
										<?php while ( $connected->have_posts() ) : $connected->the_post();?>
                                        	<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                        <?php endwhile; ?> 
                                    </ul>
                                    
                                </div>
                            </section><!-- .boxitem --> 
                       <?php endif; wp_reset_query();                          
                        if (get_post_meta( $post->ID, "project_details", true )) { ?>
                        <section class="boxitem">
                            <div class="item-content">
                                <h3><?php _e('Additional details:', 'msign') ?></h3>
                                <p><?php echo get_post_meta( $post->ID, "project_details", true ) ?></p>
                            </div>
                        </section><!-- .boxitem --> 
                        <?php } ?>
					<?php dynamic_sidebar( 'portfolio-widget-area' ); 
                } elseif( is_page_template('services.php') ) {
                    dynamic_sidebar( 'services-widget-area' );
				} elseif( is_singular('services') ) {
					for ($i = 1; $i <= 3; $i++) {           	
						if (get_post_meta( $post->ID, "services_header-".$i, true )) { ?>
                            <section class="boxitem">
                                <div class="item-content">
                                    <h3><?php echo get_post_meta( $post->ID, "services_header-".$i, true ); ?></h3>
                                    <?php if (get_post_meta( $post->ID, "services_details-".$i, true )) { ?>
                                        <p><?php echo stripslashes(get_post_meta( $post->ID, "services_details-".$i, true )); ?></p>
                                    <?php } ?>
                                </div>
                            </section>
                        <?php }  
					} 
					dynamic_sidebar( 'services-widget-area' );
                } elseif( is_page_template('testimonies.php') ) {
                    dynamic_sidebar( 'testimonies-widget-area' ); 
                } elseif( is_page_template('members.php') ) {
                    dynamic_sidebar( 'members-widget-area' ); 
                } elseif( is_page_template('work-approach.php') ) {
                    dynamic_sidebar( 'approach-widget-area' ); 
                } elseif( is_page_template('contact.php') ) {
                    dynamic_sidebar( 'contact-widget-area' );  
                }
            } ?>
            </div>
        </aside>
    <?php    
	}
endif;
/* This function establishes a script for smooth scrolling if at about page template or if approaches are rendered in a singular file */
if ( ! function_exists( 'msign_approach_scroll' ) ) :
	function msign_approach_scroll() {
		global $post; 
		if(is_page_template('work-approach.php')) {		
			$posts = get_posts('numberposts=99999&post_type=approach');
			foreach($posts as $post) : ?>
				<script type="text/javascript">
					jQuery(document).ready(function ($){ 
						$("#postlink-<?php the_ID(); ?>").click(function(){
							$('html, body').animate({scrollTop: $("#post-<?php the_ID(); ?>").offset().top}, 1e3);
							return false
						});
					});
				</script>
		<?php endforeach; 
		}
	}
endif;
add_action('wp_footer', 'msign_approach_scroll', 100); ?>