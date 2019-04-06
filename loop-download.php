<?php
/**
 * The template for displaying the downloads loop.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

// GENERATE TERMS FOR FILTER PORTFOLIO TEMPLATE
$terms     = get_the_terms( $post->ID, 'download_category' );
$term_list = null;
if ( is_array( $terms ) ) {
	foreach ( $terms as $term ) {
		$term_list .= $term->term_id;
		$term_list .= ' '; }
}

// GRID IMAGE
$download_grid_image = get_post_meta( $post->ID, '_bean_download_grid_image', true );

// IS THE PORTFOLIO META ENABLED?
if ( get_theme_mod( 'edd_meta', trim_defaults( 'edd_meta' ) ) == true ) {
	$meta = '';
} else {
	$meta = 'no-meta';
} ?>

<?php if ( has_post_thumbnail() || $download_grid_image ) { ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( "post $term_list $meta portfolio filtered" ); ?>>

		<div class="post-thumb">

			<a title="<?php echo the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
					<?php if ( $download_grid_image ) { ?>
						<img src="<?php echo esc_url( $download_grid_image ); ?>" />
					<?php } else { ?>
						<?php the_post_thumbnail( 'post-feat' ); ?>
					<?php } ?>
			</a>

			<div class="product-btn">
				<?php echo do_shortcode( '[purchase_link]' ); ?>
			</div>

		</div>

		<?php if ( get_theme_mod( 'edd_meta', trim_defaults( 'edd_meta' ) ) == true ) { ?>

			<div class="inner">
				<h3 class="entry-title">
					<a title="<?php printf( __( 'Permanent Link to %s', 'trim' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>

				<?php if ( ! post_password_required() ) { ?>
				<p class="entry-excerpt">
					<?php if ( ! is_search() ) { ?>
						<?php echo wp_trim_words( get_the_content(), 13 ); ?>
					<?php } else { ?>
						<?php echo wp_trim_words( get_the_content(), 30 ); ?>
					<?php } ?>
				</p><!-- END .entry-excerpt -->
				<?php } else { ?>
					<?php echo get_the_content(); ?>
				<?php } ?>

				<ul class="entry-meta subtext">

					<?php $terms = get_the_terms( $post->ID, 'download_category' ); ?>
					<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
						<li><?php the_terms( $post->ID, 'download_category', '', ', ', '' ); ?></li>
					<?php endif; ?>

					<?php if ( get_theme_mod( 'edd_likes', trim_defaults( 'edd_likes' ) ) == true ) { ?>
						<li class="likes"><?php Bean_PrintLikes( $post->ID ); ?></li>
					<?php } ?>

				</ul><!-- END .entry-meta -->

			</div><!-- END .inner -->

		<?php } ?>

	</article>

<?php
}
