<?php
/**
 * The template for displaying search forms, including cross-browser placeholder
 */
?>
<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<input type="search" class="s" name="s" placeholder="<?php _e('Search for&hellip;?', 'msign') ?>" value="<?php _e('Search for&hellip;?', 'msign') ?>" 
    onblur="if (this.value == '') {this.value = '<?php _e('Search for&hellip;?', 'msign') ?>';}"  onfocus="if (this.value == '<?php _e('Search for&hellip;?', 'msign') ?>') {this.value = '';}" />
	<input type="submit" class="searchsubmit" value="<?php _e('Search', 'msign') ?>" title="<?php _e('Search', 'msign') ?>" /> 
</form>
   