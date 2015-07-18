<?php 
/**
 * This is the file containing all shortcodes 
 */
/* Custom Tags for Download button */
function download_shortcode( $atts, $content = null ) {
    extract(shortcode_atts(array(
        "url" => '',
        "title" => __('Download','msign'),
        "target" => '_blank',
		"class" => 'normal',
), $atts));
   return '<div class="dlbutton-container"><a class="no-transition '.$class.'" href="'.$url.'" title="'.$title.'" target="'.$target.'">' . $content . '</a></div>';
}
add_shortcode( 'dlbutton' , 'download_shortcode');
/* Shortcode for Adsense */
function showads1() { $ads1 = stripslashes(get_option('msign_ad1')); return '<div class="ad-container"><div class="inner adsense1">'.$ads1.'</div></div>';}  
add_shortcode('adsense1', 'showads1'); 
function showads2() {  $ads2 = stripslashes(get_option('msign_ad2'));return '<div class="ad-container"><div class="inner adsense2">'.$ads2.'</div></div>';}  
add_shortcode('adsense2', 'showads2'); 
function showads3() {  $ads3 = stripslashes(get_option('msign_ad3'));return '<div class="ad-container"><div class="inner adsense3">'.$ads3.'</div></div>';}  
add_shortcode('adsense3', 'showads3'); 
/* Pullquote Shortcode, with ability to float the pullquote left or right */
function pullquote($atts, $content = null) {
	  extract(shortcode_atts(array(
	        'class' => 'left' // The default value
	    ), $atts));
	return '<h3 class="pull-'.$class.'">'.$content.'</h3>';
	}
add_shortcode('pull', 'pullquote');
/* Shortcode for Columns in posts */
function column($atts, $content = null) {
	  extract(shortcode_atts(array(
	        'class' => 'two' // The default value
	    ), $atts));
	return 
	'<div class="column-'.$class.'">'
	. do_shortcode($content) .
	'</div>';
	}
add_shortcode('column', 'column');
/* Shortcode for different colored boxes in posts */
function colorbox($atts, $content = null) {
	  extract(shortcode_atts(array(
	        'class' => 'neutral' // The default value
	    ), $atts));
	return 
	'<p class="box-'.$class.'">'
	. do_shortcode($content) .
	'</p>';
	}
add_shortcode('box', 'colorbox');
/* Shortcode for Twitter Follow */
function twitter_short() {
	$twittername= get_option('msign_social_twitter_username');
	return 
	'<a href="http://twitter.com/'.$twittername.'" class="twitter-follow-button" title="Follow '.$twittername.'" onClick="return popup(this)" target="_blank">@'.$twittername.'</a>';
	}
add_shortcode('twitter', 'twitter_short');
/* Shortcodes which allows Tooltips */ /* TO ADD: CSS STYLING */
function tooltip_shortcode($atts, $content) { 
	  extract(shortcode_atts(array(
	        'title' => _e('Tooltip Title','msign') // The default value
	    ), $atts));
	return 
	'<div class="tool-tip-container">'
		.do_shortcode($content). '<span class="tip-simple" title="'.$title.'">'.$title.'</span>
	</div>';
}
add_shortcode('tooltip', 'tooltip_shortcode');
/* Allows shortcode use in Widgets */
add_filter('widget_text', 'do_shortcode');