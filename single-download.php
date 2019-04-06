<?php
/**
 * The template for displaying all single download.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

get_header();

// POST META
$orderby         = get_post_meta( $post->ID, '_bean_post_randomize', true );
$orderby         = ( $orderby == 'off' ) ? 'post__in' : 'rand';
$link            = get_post_meta( $post->ID, '_bean_link_url', true );
$link_title      = get_post_meta( $post->ID, '_bean_link_title', true );
$quote           = get_post_meta( $post->ID, '_bean_quote', true );
$quote_source    = get_post_meta( $post->ID, '_bean_quote_source', true );
$embed           = get_post_meta( $post->ID, '_bean_video_embed', true );
$video_embed_url = get_post_meta( $post->ID, '_bean_video_embed_url', true );

// VIEW COUNTER
bean_setPostViews( get_the_ID() ); ?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-page' ); ?>>

			<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { ?>
			<div class="entry-content-media
			<?php
			if ( ! has_post_thumbnail() ) {
				echo 'no-img'; }
?>
">
				<?php the_post_thumbnail( 'post-feat' ); ?>
			</div><!-- END .entry-content-media -->
		<?php } //END  if(has_post_thumbnail) ?>

			<div class="inner">

				<div class="entry-content">

					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-meta-header">
					<span class="published subtext"><?php the_time( get_option( 'date_format' ) ); ?></span>
					</div><!-- END .entry-meta-header -->

					<?php the_content(); ?>

					<?php
					// PAGE LINK
					wp_link_pages(
						array(
							'before'         => '<p><strong>' . __( 'Pages:', 'trim' ) . '</strong> ',
							'after'          => '</p>',
							'next_or_number' => 'number',
						)
					);
					?>

				</div><!-- END .entry-content -->

				<div class="single-page-footer">
					<?php get_template_part( 'content', 'post-meta' ); ?>
				</div><!-- END .single-page-footer -->

			</div><!-- END .inner -->

		</article>

	<?php
endwhile;
endif;

// OPTIONAL SIDEBAR
if ( get_theme_mod( 'show_single_edd_sidebar', trim_defaults( 'show_single_edd_sidebar' ) ) == true ) {
	if ( get_theme_mod( 'show_edd_loop_single', trim_defaults( 'show_edd_loop_single' ) ) == true && is_active_sidebar( 'edd-shop-template' ) ) {
	?>
		<article class="sidebar post">
			<div class="inner">

				<div class="edd-purchase-btn">
					<?php echo do_shortcode( '[purchase_link]' ); ?>
				</div>

				<div class="edd social-sharing-divide"></div>

				<?php if ( get_theme_mod( 'show_edd_sharing', trim_defaults( 'show_edd_sharing' ) ) == true ) { ?>
					<?php get_template_part( 'content', 'post-social' ); ?>
				<?php } ?>

				<?php dynamic_sidebar( 'shop-template' ); ?>

			</div><!-- END .inner -->
		</article>
	<?php
	} else {
		dynamic_sidebar( 'shop-template' );
	}
}

if ( get_theme_mod( 'show_edd_loop_single', trim_defaults( 'show_edd_loop_single' ) ) == true ) {

	$more_loop = get_theme_mod( 'edd_more_loop', trim_defaults( 'edd_more_loop' ) );
	if ( $more_loop != '' ) {
		switch ( $more_loop ) {
			case 'related':
				$terms = get_the_terms( $post->ID, 'download_category' );
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
