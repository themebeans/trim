<?php
/**
 * The template for displaying the singular attachment page.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post single-page' ); ?>>

	<div class="entry-content-media">
		<?php $image_info = getimagesize( $post->guid ); ?>
		<img src="<?php echo esc_url( $post->guid ); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" <?php echo esc_html( $image_info[3] ); ?> />
	</div><!-- END .entry-content-media-->

	<div class="inner">
		<h2 class="entry-title"><?php the_title(); ?></h2>
		<span class="published subtext"><?php _e( 'Uploaded ', 'trim' ); ?><?php esc_html( the_time( get_option( 'date_format' ) ) ); ?></span>
	</div><!-- END .inner -->

</article>

<?php
get_footer();
