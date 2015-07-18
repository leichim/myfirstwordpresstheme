<?php
/**
 * The Header for the M-Sign theme.
 * Displays all of the <head> section and everything up till <div id="main">
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/Webpage" <?php $useragent = $_SERVER['HTTP_USER_AGENT']; if(preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) { echo 'class="ie"'; } ?>>
    <head>
        <title><?php msign_title();?></title>   
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php if(get_option('msign_seo') == 0 ) { ?>
			<?php msign_tags(); // Grabs the post tags and uses them for meta keywords ?>
            <meta name="description" content="<?php msign_description(); ?>" />
            <?php if(is_home() || is_singular()) { 
                    echo '<meta name="robots" content="index,follow" />'; 
                  } else { 
                    echo '<meta name="robots" content="noindex,follow" />'; // Archive pages are currently not indexed
                  } 
			// Sets thumbnail image for social-sharing	 
            	if(is_singular() && has_post_thumbnail()) {
                    $imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ));
                    echo '<meta itemprop="image" content="' . $imgsrc[0] . '" />';
                   } 
			if(get_option('msign_opengraph')) {
				msign_display_opengraph(); // Displays opengraph functions
			} ?>
            <link rel="canonical" href="<?php echo msign_current_page_url(); ?>" />
            <?php /* Author settings for google search */
				if(get_the_author_meta( 'gplus', $post->post_author ) && is_singular()) { 
					echo '<link rel="author" href="'. get_the_author_meta( 'gplus', $post->post_author ) .'" />';  
				} elseif(get_option('msign_gplus_boss')) { 
					echo '<link rel="author" href="'. get_option('msign_gplus_boss') .'" />';
				} 
				if(get_option('msign_social_gplus')) {
					echo '<link rel="publisher" href="'. get_option('msign_social_gplus') .'" />';
				}
        	} if(get_option('msign_add_customcss') == 1 ) { ?><link rel="stylesheet" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/custom.css" type="text/css" /><?php } ?>
        <link rel="stylesheet" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css" type="text/css" />
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_option('msign_favicon');?>" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->
        <?php wp_head(); ?>
    </head>
	<body <?php body_class('hfeed'); ?>>
        <!--[if lte IE 8 ]>
        <noscript><h1>JavaScript is required for this website to be displayed correctly. Please enable JavaScript before continuing.</h1></noscript>
        <![endif]-->
        <header id="header" itemscope itemtype="http://schema.org/WPHeader">
          <div class="header-top-container" role="banner">
            <div class="header-top">
              <?php if(get_option('msign_logo_image') == "") { ?>
              <hgroup id="site-title">
                <h2> <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> </h2>
                <h5 id="site-description"><?php bloginfo( 'description' ); ?></h5>
              </hgroup>
              <?php } else { $logo_image = get_option('msign_logo_image'); ?>
              <div id="logoplacer"> 
                  <a class="logo" href="<?php echo home_url() ?>" title="<?php bloginfo('name'); ?>" rel="home">
                      <img src="<?php echo $logo_image; ?>" alt="<?php bloginfo('name') . ' ' . _e('Logo', 'msign'); ?>" />
                  </a> 
              </div><!-- #logoplacer -->   
              <?php } if(get_option('msign_social_icons') == 1) { msign_social_contact(); } ?>          
            </div><!-- .header-top -->         
          </div><!-- .header-top-container -->      
          <nav id="main-nav" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
                <?php wp_nav_menu(array( 'container_class' => 'menu-header', 'container_id' => 'nav', 'theme_location' => 'primary', 
                'items_wrap' => '<a id="jump" href="#header">'.__('Menu', 'msign').'</a><ul id="main-menu" class="%2$s">%3$s<li id="back"><a href="#top">Close Menu</a></li></ul>'));?>  
                <div class="search-container"><?php get_search_form(); // Search form ?></div> 
          </nav><!-- #main_nav -->      
        </header>    <!-- #header -->  
        <div id="wrapper" <?php msign_microscheme(); ?>>
        	<!-- The title display for all pages -->
        	<?php if( ! is_home() ) { ?>
                <div id="description">
                    <header class="introduction">
                    	<?php if(get_post_meta( $post->ID, "st_quote", true )) { ?><h6 class="quote"><?php echo get_post_meta( $post->ID, "st_quote", true ) ?></h6><?php } ?>
                        <h1 itemprop="<?php if (is_single('post')) { echo "headline"; } else { echo "name"; } ?>" class="entry-title">
							<?php msign_post_title(); ?>
                        </h1>
                        <?php msign_breadcrumbs(); ?>
                    </header><!-- .introduction -->
                </div><!-- #description -->  
                <?php if ( is_singular('portfolio_project') ) {
					get_template_part('slider', 'portfolio');
				} ?>
                <div id="container" <?php the_column_class();?>>
            <?php } ?>