<?php
/**
 * The template for displaying the post template/grid loop.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

// GENERATE TERMS FOR FILTER
$terms     = get_the_terms( $post->ID, 'category' );
$term_list = null;
if ( is_array( $terms ) ) {
	foreach ( $terms as $term ) {
		$term_list .= $term->slug;
		$term_list .= ' '; }
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( "$term_list" ); ?>>

	<div class="post-thumb">

		<?php
		$format = get_post_format();
		if ( false === $format ) {
			$format = 'standard'; }

		if ( ! post_password_required() ) {
			get_template_part( 'inc/post-formats/content', $format );
		}
		?>

	</div><!-- END .post-thumb -->

	<?php if ( $format != 'aside' && $format != 'quote' && $format != 'image' && $format != 'link' ) { // DONT SHOW THIS ON ASIDE POST FORMAT ?>

		<div class="inner">

			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'trim' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2><!-- END .entry-title -->

			<span class="published subtext">
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'trim' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_time( get_option( 'date_format' ) ); ?></a>
			</span>

			<?php if ( ! post_password_required() ) { ?>
				<p class="entry-excerpt">
					<?php if ( ! is_search() ) { ?>
						<?php echo do_shortcode( wp_trim_words( get_the_content(), 13 ) ); ?>
					<?php } else { ?>
						<?php echo do_shortcode( wp_trim_words( get_the_content(), 30 ) ); ?>
					<?php } ?>
				</p><!-- END .entry-excerpt -->
			<?php } else { ?>
				<?php echo do_shortcode( get_the_content() ); ?>
			<?php } ?>

			<ul class="entry-meta subtext">

				<?php if ( ! is_search() ) { ?>
					<?php if ( ! post_password_required() ) { ?>
						<?php if ( comments_open() ) { ?>
							<li><span class="icon-comments"></span><?php comments_popup_link( __( '0', 'trim' ), __( '1', 'trim' ), __( '%', 'trim' ) ); ?></li>
						<?php } ?>
					<?php } else { ?>
						<li><span class="icon-comments"></span><?php comments_number( '0', '1', '%' ); ?></li>
					<?php } ?>

					<?php if ( get_theme_mod( 'post_likes', trim_defaults( 'post_likes' ) ) == true ) { ?>
						<li><?php Bean_PrintLikes( $post->ID ); ?></li>
					<?php } ?>
				<?php } //END !is_search() ?>

				<?php if ( is_user_logged_in() ) { ?>
					<li class="edit-link"><?php edit_post_link( __( '[Edit]', 'trim' ), '', '' ); ?></li>
				<?php } ?>

			</ul><!-- END .entry-meta -->

		</div><!-- END .inner -->

	<?php } ?>

</article>
