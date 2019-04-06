<?php
/**
 * The template for displaying the default searchform whenever it is called in the theme.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */
?>

<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>/">
	<input type="text" name="s" id="s" value="<?php _e( 'Click to search...', 'trim' ); ?>" onfocus="if(this.value=='<?php _e( 'Click to search...', 'trim' ); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e( 'Click to search...', 'trim' ); ?>';" />
</form><!-- END #searchform -->
