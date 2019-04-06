<?php
/**
 * The default template for displaying content for the standard post.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

?>

<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'trim' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">

	<div class="vert-align">
		<?php the_content(); ?>
	</div><!-- END .vert-align -->

</a>
