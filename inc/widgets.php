<?php
/**
 * This is the file for all custom widgets and sidebars
 * Register widgetized areas, including one sidebars, one midbar and three widget-ready columns in the footer.
 * @since msign 1.0
 */
function msign_widgets_init() {
	// Widgets Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Blog Sidebar', 'msign' ),
		'id' => 'primary-widget-area',
		'description' => __( 'Sidebar used in archives and blog posts.', 'msign' ),
		'before_widget' => '<section id="%1$s" class="boxitem %2$s"><div class="item-content">',
		'after_widget' => '</div></section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Page Sidebar', 'msign' ),
		'id' => 'page-widget-area',
		'description' => __( 'Sidebar used in pages,', 'msign' ),
		'before_widget' => '<section id="%1$s" class="boxitem %2$s"><div class="item-content">',
		'after_widget' => '</div></section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Portfolio Page Sidebar', 'msign' ),
		'id' => 'portfolio-widget-area',
		'description' => __( 'Sidebar used in the portfolio overview page and single portfolio items.', 'msign' ),
		'before_widget' => '<section id="%1$s" class="boxitem %2$s"><div class="item-content">',
		'after_widget' => '</div></section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Services Page Sidebar', 'msign' ),
		'id' => 'services-widget-area',
		'description' => __( 'Sidebar used at services overview pages and single services. ', 'msign' ),
		'before_widget' => '<section id="%1$s" class="boxitem %2$s"><div class="item-content">',
		'after_widget' => '</div></section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
			) );	
	register_sidebar( array(
		'name' => __( 'Testimonies Page Sidebar', 'msign' ),
		'id' => 'testimonies-widget-area',
		'description' => __( 'Sidebar which shows up at testimonies page.', 'msign' ),
		'before_widget' => '<section id="%1$s" class="boxitem %2$s"><div class="item-content">',
		'after_widget' => '</div></section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
			) );	
	register_sidebar( array(
		'name' => __( 'Team Members Page Sidebar', 'msign' ),
		'id' => 'members-widget-area',
		'description' => __( 'Sidebar which shows up at the team members page template.', 'msign' ),
		'before_widget' => '<section id="%1$s" class="boxitem %2$s"><div class="item-content">',
		'after_widget' => '</div></section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
			) );	
	register_sidebar( array(
		'name' => __( 'Approaches Page Sidebar', 'msign' ),
		'id' => 'approach-widget-area',
		'description' => __( 'Sidebar which shows up at the approaches page template.', 'msign' ),
		'before_widget' => '<section id="%1$s" class="boxitem %2$s"><div class="item-content">',
		'after_widget' => '</div></section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
			) );			
	register_sidebar( array(
		'name' => __( 'Contact Page Sidebar', 'msign' ),
		'id' => 'contact-widget-area',
		'description' => __( 'Sidebar which shows up at the contact template page.', 'msign' ),
		'before_widget' => '<section id="%1$s" class="boxitem %2$s"><div class="item-content">',
		'after_widget' => '</div></section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
			) );								
	// Widgets Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Widget Area 1', 'msign' ),
		'id' => 'footer-widget-area1',
		'description' => __( 'The footer widget area', 'msign' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h6 class="widget-title-footer">',
		'after_title' => '</h6>',
	) );	
		register_sidebar( array(
		'name' => __( 'Footer Widget Area 2', 'msign' ),
		'id' => 'footer-widget-area2',
		'description' => __( 'The footer widget area', 'msign' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h6 class="widget-title-footer">',
		'after_title' => '</h6>',
	) );	
		register_sidebar( array(
		'name' => __( 'Footer Widget Area 3', 'msign' ),
		'id' => 'footer-widget-area3',
		'description' => __( 'The footer widget area', 'msign' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h6 class="widget-title-footer">',
		'after_title' => '</h6>',
	) );
}
add_action( 'widgets_init', 'msign_widgets_init' );
/**** Featured Posts Widget ****/
class Featured_Posts extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'classname' => 'widget_featured_posts', 'description' => __('This widget displays featured posts from a certain category.', 'msign' ) );
        parent::__construct( 'featured_posts', __('Featured Posts', 'msign'), $widget_ops);
	}
	function form($instance) {
		$defaults = array( 'title' => __('Featured', 'msign'));  
		$instance = wp_parse_args( (array) $instance, $defaults );  
		?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'msign')?></label><br />
                <input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
            </p><p>
            	<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Number of Featured Posts:', 'msign')?></label><br />
                <input type="text" name="<?php echo $this->get_field_name( 'number' ); ?>" id="<?php echo $this->get_field_id( 'number' ); ?>" value="<?php echo $instance['number']; ?>"  />
            </p><p>
            	<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e('Category to Feature:', 'msign')?></label><br />
				<select id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">
				<?php
                    $category = $instance[ 'category' ];
                    $categories= get_categories();
                    foreach ($categories as $cat) {
                        $option = '<option value="'.$cat->slug.'" ' . ( $category == $cat->category_nicename ? " selected=\"selected\"" : "") . '>';
                            $option .= $cat->cat_name;
                        $option .= '</option>';
                        echo $option;
                    } ?>
            	</select>
            </p>
		<?php
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']); 
		$instance['category'] = strip_tags($new_instance['category']);
		$instance['number'] =strip_tags($new_instance['number']);
		return $instance;
	}
	function widget($args, $instance) {
		extract( $args);
		$title = apply_filters('widget_title', $instance['title'] ); 
		$number = $instance['number'];
		$category = $instance['category'];
		
		echo $before_widget;
			if ($title)
				echo $before_title . $title . $after_title;
				?>
                <ul class="random-posts">
                    <?php
                        $recent = new WP_Query( 'posts_per_page=' . $number . '&category_name=' . $category );
                        while( $recent->have_posts() ) : $recent->the_post(); 
                        global $post; global $wp_query;
                    ?>
                    <li>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                            <?php the_post_thumbnail( 'img-thumbnail' );?></a>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
                            <span>
                            	<a href="<?php the_permalink(); ?>/#comments" title="<?php _e('Read Comments', 'msign') ?>"><?php comments_number('0 Comments', '1 Comment', '% Comments' );?></a>
                            </span>
                    </li>
                    <?php endwhile; wp_reset_query(); ?>
                </ul>	
        <?php echo $after_widget;
	}
}
register_widget('Featured_Posts');
/**** Recent Posts Widget ****/
class Recent_Posts extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'classname' => 'widget_recent_posts', 'description' => __('This widget displays most recent posts with their thumbnail.', 'msign' ) );
        parent::__construct( 'recent_posts', __('Recent Posts with Thumbnail', 'msign'), $widget_ops);
	}
	function form($instance) {
		$defaults = array( 'title' => __('Recent Posts', 'msign'), 'number' => __('5', 'msign'));  
		$instance = wp_parse_args( (array) $instance, $defaults );  
		?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'msign')?></label><br />
                <input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
            </p><p>
            	<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Number of Posts:', 'msign')?></label><br />
                <input type="text" name="<?php echo $this->get_field_name( 'number' ); ?>" id="<?php echo $this->get_field_id( 'number' ); ?>" value="<?php echo $instance['number']; ?>"/>
            </p>
		<?php
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']); 
		$instance['number'] =strip_tags($new_instance['number']);
		return $instance;
	}
	function widget($args, $instance) {
		extract( $args);
		$title = apply_filters('widget_title', $instance['title'] ); 
		$number = $instance['number'];
		echo $before_widget;
			if ($title)
				echo $before_title . $title . $after_title;
				?>
            <ul class="random-posts">
                <?php
                    $recent = new WP_Query( 'posts_per_page=' . $number );
                    while( $recent->have_posts() ) : $recent->the_post(); 
                        global $post; global $wp_query; ?>
                        <li>
                             <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                <?php the_post_thumbnail( 'img-thumbnail' );?></a>
                             <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
                             <span>
                                <a href="<?php the_permalink(); ?>/#comments" title="<?php _e('Read Comments', 'msign') ?>"><?php comments_number('0 Comments', '1 Comment', '% Comments' );?></a>
                             </span>
                        </li>
                <?php endwhile; wp_reset_query(); ?>
            </ul>
        <?php  echo $after_widget;
	}
}
register_widget('Recent_Posts');
/* Twitter Widget */
class Twitter_msign extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'classname' => 'twitter_msign', 'description' => __( 'This widget displays a standard twitterfeed.', 'msign' ) );
        parent::__construct( 'twitter_msign', __('M-Sign Twitter Widget', 'msign'), $widget_ops);
	}
	function form($instance) {
		/* Defaults for certain fields */
		$defaults = array( 
						'title' => __('Twitter Widget', 'msign'),
						'username' => '',
						'number' => '3',
						'twitter_theme' => 'light'
						); 
		$instance = wp_parse_args( (array) $instance, $defaults );
		/* Converts html for certain fields */
		$title = htmlspecialchars($instance['title']);
		$username = htmlspecialchars($instance['username']);
		$number = htmlspecialchars($instance['number']);
		 
		?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'msign')?></label><br />
                <input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
            </p><p>
            	<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Twitter Username:', 'msign')?></label><br />
                <input type="text" name="<?php echo $this->get_field_name( 'username' ); ?>" id="<?php echo $this->get_field_id( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
            </p>
            <p>
            	<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Number of Tweets:', 'msign')?></label><br />
                <input type="text" name="<?php echo $this->get_field_name( 'number' ); ?>" id="<?php echo $this->get_field_id( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
            </p>
            <p>
            	<label for="<?php echo $this->get_field_id( 'twitter_id' ); ?>"><?php _e('Widget ID from Twitter.com:', 'msign')?></label><br />
                <input type="text" name="<?php echo $this->get_field_name( 'twitter_id' ); ?>" id="<?php echo $this->get_field_id( 'twitter_id' ); ?>" value="<?php echo $instance['twitter_id']; ?>"/>
            </p>
            <p>
            	<label for="<?php echo $this->get_field_id( 'twitter_theme' ); ?>"><?php _e('Twitter Theme:', 'msign')?></label><br />
				<select id="<?php echo $this->get_field_id( 'twitter_theme' ); ?>" name="<?php echo $this->get_field_name( 'twitter_theme' ); ?>">
				<?php $twitter_theme = $instance[ 'twitter_theme' ]; 
                    $option = '<option value="dark"' . ( $twitter_theme == 'dark' ? 'selected="selected"' : '' ) . '>' . __('dark', 'msign') . '</option>';
                    $option .= '<option value="light"' . ( $twitter_theme == 'light' ? 'selected="selected"' : '' ) . '>' . __('light', 'msign') . '</option>';
                    echo $option; ?>
            	</select>
            </p>
            <p>
            	<label for="<?php echo $this->get_field_id( 'color' ); ?>"><?php _e('Color of links:', 'msign')?></label><br />
                <input type="text" class="msign-color-field" name="<?php echo $this->get_field_name( 'color' ); ?>" id="<?php echo $this->get_field_id( 'color' ); ?>" value="<?php echo $instance['color']; ?>" data-default-color="#f23183"/>
            </p>
		<?php
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']); 
		$instance['username'] = strip_tags($new_instance['username']); 
		$instance['number'] = strip_tags($new_instance['number']); 
		$instance['twitter_id'] = strip_tags($new_instance['twitter_id']); 
		$instance['color'] = strip_tags($new_instance['color']); 
		$instance['twitter_theme'] = strip_tags($new_instance['twitter_theme']); 
		return $instance;
	}
	function widget($args, $instance) {
		extract( $args);
		$title = apply_filters('widget_title', $instance['title'] );
		$username = strip_tags($instance['username']); 
		$number = strip_tags($instance['number']); 
		$twitter_id = strip_tags($instance['twitter_id']);
		$color = strip_tags($instance['color']);
		$twitter_theme = strip_tags($instance['twitter_theme']);
		echo $before_widget;
		if ($title)
			echo $before_title . $title . $after_title; 
			$tweets =  '<a class="twitter-timeline" href="https://twitter.com/%1$s" data-widget-id="%2$s" data-chrome="nofooter noborders transparent noheader" data-tweet-limit="%3$s" width="260" height="300" data-theme="%4$s" data-link-color="%5$s">' .__('Tweets by ', 'msign').'%1$s</a>';
			printf($tweets, $username, $twitter_id, $number, $twitter_theme, $color);
		echo $after_widget;
	}
}
register_widget('Twitter_msign');

/**** Tabbed Widget ****/
class Tabbed_Posts extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'classname' => 'widget_tabbed_posts', 'description' => __('This widget displays the most recent, popular and featured posts in a tabbed style.', 'msign' ) );
        parent::__construct( 'tabbed_posts', __('Tabbed Widget', 'msign'), $widget_ops);
	}
	function form($instance) {
		$defaults = array( 'title' => __('Tabbed Widget', 'msign'), 'number' => __('5', 'msign'));  
		$instance = wp_parse_args( (array) $instance, $defaults );  
		?><p>
            	<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Number of posts to show for each tab:', 'msign')?></label><br />
                <input type="text" name="<?php echo $this->get_field_name( 'number' ); ?>" id="<?php echo $this->get_field_id( 'number' ); ?>" value="<?php echo $instance['number']; ?>"/>
            </p><p>
            	<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e('Category to Feature:', 'msign')?></label><br />
				<select id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">
				<?php
                    $category = $instance[ 'category' ];
                    $categories= get_categories();
                    foreach ($categories as $cat) {
                        $option = '<option value="'.$cat->slug.'" ' . ( $category == $cat->category_nicename ? " selected=\"selected\"" : "") . '>';
                            $option .= $cat->cat_name;
                        $option .= '</option>';
                        echo $option;
                    } ?>
            	</select>
            </p>
		<?php
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['number'] =strip_tags($new_instance['number']);
		$instance['category'] =strip_tags($new_instance['category']);
		return $instance;
	}
	function widget($args, $instance) {
		extract( $args);
		$number = $instance['number'];
		$category = $instance['category'];
		echo $before_widget; ?>
        <div class="ui-tabs">
        	<ul class="ui-tabs-nav">
				<li><a href="#recent"><?php _e('Latest:', 'msign'); ?><span class="pointer"></span></a></li>
                <li><a href="#popular"><?php _e('Popular:', 'msign'); ?><span class="pointer"></span></a></li>
                <li><a href="#featured"><?php _e('Featured:', 'msign'); ?><span class="pointer"></span></a></li>
			</ul>
            <div class="ui-tabs-panel" id="recent">
            	<ul class="random-posts">
                    <?php $recent = new WP_Query( 'posts_per_page=' . $number );
                    while( $recent->have_posts() ) : $recent->the_post(); 
                        global $post; global $wp_query; ?>
                        <li>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Link to ', 'msign'); the_title_attribute(); ?>">
                                <?php the_post_thumbnail( 'img-thumbnail' );?>
                            </a>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
                            <span>
                                <a href="<?php the_permalink(); ?>/#comments" title="<?php _e('Read Comments', 'msign') ?>">
                                    <?php comments_number('0 Comments', '1 Comment', '% Comments' );?>
                                </a>
                            </span>
                        </li>
                    <?php endwhile; wp_reset_query(); ?>
                    </ul>
                </div>
                <div class="ui-tabs-panel" id="popular">
                	<ul class="random-posts">
                    <?php $popular = new WP_Query( 'posts_per_page=' . $number . '&orderby=comment_count' );
                    while( $popular->have_posts() ) : $popular->the_post(); 
                        global $post; global $wp_query; ?>
                        <li>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Link to  ', 'msign'); the_title_attribute(); ?>">
                                <?php the_post_thumbnail( 'img-thumbnail' );?>
                            </a>
                            <a href="<?php the_permalink(); ?>" title="<?php _e('Link to  ', 'msign'); the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
                            <span>
                                <a href="<?php the_permalink(); ?>/#comments" title="<?php _e('Read Comments', 'msign') ?>">
                                    <?php comments_number('0 Comments', '1 Comment', '% Comments' );?>
                                </a>
                            </span>
                        </li>
                    <?php endwhile; wp_reset_query(); ?>
                    </ul>
                </div>
                <div class="ui-tabs-panel" id="featured">
                	<ul class="random-posts">
                    <?php $featured = new WP_Query( 'posts_per_page=' . $number . '&category_name=' . $category );
                    while( $featured->have_posts() ) : $featured->the_post(); 
                        global $post; global $wp_query; ?>
                        <li>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Link to ', 'msign'); the_title_attribute(); ?>">
                                <?php the_post_thumbnail( 'img-thumbnail' );?>
                            </a>
                            <a href="<?php the_permalink(); ?>" title="<?php _e('Link to ', 'msign'); the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
                            <span>
                                <a href="<?php the_permalink(); ?>/#comments" title="<?php _e('Read Comments', 'msign') ?>">
                                    <?php comments_number('0 Comments', '1 Comment', '% Comments' );?>
                                </a>
                            </span>
                        </li>
                    <?php endwhile; wp_reset_query(); ?>
                    </ul>
                </div>
        </div><!-- .ui-tabs -->
        <?php  echo $after_widget;
	}
}
register_widget('Tabbed_Posts');