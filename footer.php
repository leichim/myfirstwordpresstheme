<?php
/**
 * The template for displaying the footer.
 */
?>
	<?php if( !is_home() || is_page_template('homepage.php')  ) { ?></div><!-- #container --><?php } ?>  
</div><!-- #wrapper -->
<footer id="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
    <div id="footer-widgets">
		<?php if ( is_active_sidebar( 'footer-widget-area1' ) ) : ?>
        	<aside class="footer-widget-area" role="complementary"><?php dynamic_sidebar( 'footer-widget-area1' ); ?></aside>
        <?php endif; if ( is_active_sidebar( 'footer-widget-area2' ) ) : ?>
        	<aside class="footer-widget-area" role="complementary"><?php dynamic_sidebar( 'footer-widget-area2' ); ?></aside>
        <?php endif; if ( is_active_sidebar( 'footer-widget-area3' ) ) : ?>
        	<aside class="footer-widget-area" role="complementary"><?php dynamic_sidebar( 'footer-widget-area3' ); ?></aside>
        <?php endif;  ?>
    </div>  <!-- #footer-widgets --> 
    <div id="colophon">
        <div id="site-info">
              <nav id="footer-pages">
                <?php if(get_option('msign_about_path')) { ?><a href="<?php echo stripslashes(get_option('msign_about_path')); ?>"><?php _e('About','msign'); ?></a><?php } 
                if(get_option('msign_contact_path')) { ?><a href="<?php echo stripslashes(get_option('msign_contact_path')); ?>"><?php _e('Contact','msign'); ?></a><?php } 
                if(get_option('msign_policies_path')) { ?><a href="<?php echo stripslashes(get_option('msign_policies_path')); ?>"><?php _e('Policies','msign'); ?></a><?php } ?>
              </nav><!-- #footer-pages -->
              <div id="copyright">
              	<span>
					<?php _e('MyFirstTheme by ','msign');?> <a href="https://www.michieltramper.com" target="_blank" title="Michiel Tramper">Michiel Tramper</a> |
              	</span> 
                <?php echo '&copy; <span itemprop="copyrightYear">'. date('Y'). '</span>'; ?>
                <span itemprop="copyrightHolder" itemscope itemtype="http://schema.org/Organization">
                    <a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url">
                         <span itemprop="name"><?php bloginfo( 'name' ); ?></span>
                    </a>
                </span> 
              </div><!-- #copyright -->
        </div><!-- #site-info -->   
    </div><!-- #colophon --> 
</footer><!-- #footer --> 
<?php if(get_option('msign_back_top') == 1) { ?><div id="back-top"><a href="#top" title="<?php _e('Back to the top', 'msign') ?>">&circ;</a></div><?php } ?> 
<?php wp_footer(); 
$analytics = stripslashes(get_option('msign_analytics')); if ($analytics) { echo $analytics; }
if ( is_single() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
</body>
</html>