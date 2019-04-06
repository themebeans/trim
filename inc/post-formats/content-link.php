<?php
/**
 * The template for displaying posts in the Quote post format.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

// POST META
$link       = get_post_meta( $post->ID, '_bean_link_url', true );
$link_title = get_post_meta( $post->ID, '_bean_link_title', true );
?>

<a target="blank" href="<?php echo esc_url( $link ); ?>">
	<div class="vert-align">
		<h2 class="entry-title"><?php echo stripslashes( esc_html( $link_title ) ); ?></h2>
		<span class="subtext"><?php echo stripslashes( esc_html( $link ) ); ?></span>
	</div><!-- END .vert-align -->
</a>
