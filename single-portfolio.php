<?php
/**
 * The template for displaying the portfolio singular page.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

get_header();

// VIEW COUNTER
bean_setPostViews( get_the_ID() );

// META
$gallery_layout       = get_post_meta( $post->ID, '_bean_gallery_layout', true );
$portfolio_review     = get_post_meta( $post->ID, '_bean_portfolio_review', true );
$portfolio_type_audio = get_post_meta( $post->ID, '_bean_portfolio_type_audio', true );
$portfolio_type_video = get_post_meta( $post->ID, '_bean_portfolio_type_video', true );

// RANDOMIZE
$orderby = get_post_meta( $post->ID, '_bean_portfolio_randomize', true );
$orderby = ( $orderby == 'off' ) ? 'post__in' : 'rand';

// WE ARE USING THE GLOBAL THEME CUSTOMIZER VALUE AS PRIORITY, PORTFOLIO POST META SECONDARY
$portfolio_layout = get_post_meta( $post->ID, '_bean_portfolio_layout', true );
if ( $portfolio_layout == 'default' ) {
	if ( get_theme_mod( 'theme_version', trim_defaults( 'theme_version' ) ) == 'theme_version_grid' ) {
		$portfolio_layout = 'std'; } elseif ( get_theme_mod( 'theme_version', trim_defaults( 'theme_version' ) ) == 'theme_version_fullwidth' ) {
		$portfolio_layout = 'fullwidth'; } elseif ( get_theme_mod( 'theme_version', trim_defaults( 'theme_version' ) ) == 'theme_version_fullscreen' ) {
			$portfolio_layout = 'fullscreen'; } else {
			$portfolio_layout = 'std'; }
} ?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
?>

		<?php if ( ! post_password_required() ) { ?>

		<?php if ( $portfolio_layout == 'std' or $portfolio_layout == 'fullwidth' or $portfolio_layout == 'fullscreen' ) { ?>

			<?php
			if ( $portfolio_layout == 'fullscreen' ) {
				bean_gallery( $post->ID, 'port-full', 'fullscreen', $orderby, true );
			}
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( "$portfolio_layout single-page" ); ?>>

				<div class="inner">

					<?php
					if ( $portfolio_layout == 'fullscreen' ) {

						if ( $portfolio_type_video != 'on' ) {
							get_template_part( 'content', 'portfolio-media' );
						}
					}
					?>


					<?php
					if ( $portfolio_layout == 'fullwidth' ) {
						get_template_part( 'content', 'portfolio-media' );
						bean_gallery( $post->ID, 'port-full', $gallery_layout, $orderby, true );
					}
					?>

					<div class="entry-content">

						<div>
							<h1 class="entry-title"><?php the_title(); ?></h1>

							<?php the_content(); ?>
						</div>

						<?php get_template_part( 'content', 'portfolio-meta' ); ?>

					</div><!-- END .entry-content-->

					<?php
					if ( $portfolio_layout == 'std' ) {
						get_template_part( 'content', 'portfolio-media' );
						bean_gallery( $post->ID, 'port-full', $gallery_layout, $orderby, true );
					}
					?>

				</div><!-- END .inner -->

			</article>

		<?php } ?>

	<?php } ?>

	<?php
endwhile;
endif;

if ( $portfolio_review ) {
	if ( $portfolio_layout != 'fullscreen' ) {
	?>
		<article class="portfolio-review post">
			<div class="inner">
				<span class="quote-icon"></span>
				<h2><?php echo esc_html( $portfolio_review ); ?></h2>
			</div><!-- END .inner -->
		</article>
<?php
	}
}

if ( get_theme_mod( 'show_portfolio_sharing', trim_defaults( 'show_portfolio_sharing' ) ) == true ) {
	if ( $portfolio_layout != 'fullscreen' ) {
	?>
		<article class="sidebar post">
			<div class="inner">
				<?php get_template_part( 'content', 'post-social' ); ?>
			</div><!-- END .inner -->
		</article>
<?php
	}
}


// MORE LOOP PULL
$portfolio_more = get_post_meta( $post->ID, '_bean_portfolio_more', true );
if ( $portfolio_more == 'on' and get_theme_mod( 'show_portfolio_loop_single', trim_defaults( 'show_portfolio_loop_single' ) ) == true ) {

	if ( $portfolio_layout == 'fullscreen' ) {
	?>

		<div id="masonry-container">
			<div class="grid-width"></div><div class="gutter-width"></div>

			<?php if ( get_theme_mod( 'show_portfolio_sharing', trim_defaults( 'show_portfolio_sharing' ) ) == true ) { ?>
				<article class="sidebar post">
					<div class="inner">
						<?php get_template_part( 'content', 'post-social' ); ?>
					</div><!-- END .inner -->
				</article>
			<?php } ?>

			<?php if ( $portfolio_review ) { ?>
				<article class="portfolio-review post">
					<div class="inner">
						<span class="quote-icon"></span>
						<h2><?php echo esc_html( $portfolio_review ); ?></h2>
					</div><!-- END .inner -->
				</article>
			<?php } ?>

	<?php } ?>

	<?php
	$more_loop = get_theme_mod( 'portfolio_more_loop', trim_defaults( 'portfolio_more_loop' ) );
	if ( $more_loop != '' ) {
		switch ( $more_loop ) {
			case 'related':
				$terms = get_the_terms( $post->ID, 'portfolio_category' );
				if ( $terms && ! is_wp_error( $terms ) ) :
					get_template_part( 'content', 'post-related' );
				endif;

				break;
			case 'more':
				get_template_part( 'content', 'post-more' );

				break;
		}
	}
}

get_footer();
