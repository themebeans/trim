<?php
/**
 * The template for displaying posts in the Quote post format.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

// POST META
$quote        = get_post_meta( $post->ID, '_bean_quote', true );
$quote_source = get_post_meta( $post->ID, '_bean_quote_source', true );
?>

<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'trim' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">

	<div class="vert-align">
		<h2 class="entry-title"><?php echo stripslashes( esc_html( $quote ) ); ?></h2>
		<span class="subtext"><?php echo stripslashes( esc_html( $quote_source ) ); ?></span>
	</div><!-- END .vert-align -->

</a>
