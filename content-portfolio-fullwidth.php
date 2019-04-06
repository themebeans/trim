<?php
/**
 * The content for the fullwidth portfolio template.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */


// PULL PAGINATION FROM CUSTOMIZATION
$portfolio_posts_count = get_theme_mod( 'portfolio_posts_count', trim_defaults( 'portfolio_posts_count' ) );

// PULL PAGINATION FROM READING SETTINGS
$paged = 1;
if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
}
if ( get_query_var( 'page' ) ) {
	$paged = get_query_var( 'page' );
}

// GET THE LOOP ORDERBY & META_KAY VARIABLES VIA THEME CUSTOMIZER
$orderby = get_theme_mod( 'portfolio_loop_orderby', trim_defaults( 'portfolio_loop_orderby' ) );

// LOOP ORDERBY VARIABLE
if ( $orderby != '' ) {
	switch ( $orderby ) {
		case 'date':
			$order    = 'DSC';
			$orderby  = 'date';
			$meta_key = '';
			break;
		case 'rand':
			$order    = 'DSC';
			$orderby  = 'rand';
			$meta_key = '';
			break;
		case 'menu_order':
			$order    = 'ASC';
			$orderby  = 'menu_order';
			$meta_key = '';
			break;
		case 'view_count':
			$order    = 'DSC';
			$orderby  = 'meta_value_num';
			$meta_key = 'post_views_count';
			break;
	}
}

$args = array(
	'post_type'      => 'portfolio',
	'order'          => $order,
	'orderby'        => $orderby,
	'paged'          => $paged,
	'meta_key'       => $meta_key,
	'posts_per_page' => $portfolio_posts_count,
);

query_posts( $args );
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		$slide_img = get_post_meta( $post->ID, '_bean_home_slider_image', true );

		// GENERATE TERMS FOR FILTER PORTFOLIO TEMPLATE
		$terms     = get_the_terms( $post->ID, 'portfolio_category' );
		$term_list = null;
		if ( is_array( $terms ) ) {
			foreach ( $terms as $term ) {
				$term_list .= $term->term_id;
				$term_list .= ' '; }
		}

		if ( ( $slide_img or function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( "post fullwidth $term_list filtered" ); ?>>

				<div class="post-thumb">

					<a title="<?php printf( __( 'Permanent Link to %s', 'trim' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>">
						<?php if ( $slide_img ) { ?>
						<img src="<?php echo $slide_img; ?>" />
					<?php } else { ?>
						<?php the_post_thumbnail( 'post-feat' ); ?>
					<?php } ?>
					</a>

				</div><!-- END .post-thumb -->

				<?php if ( get_theme_mod( 'portfolio_meta', trim_defaults( 'portfolio_meta' ) ) == true ) { ?>

				<div class="inner">
					<h2 class="entry-title">
						<a title="<?php printf( __( 'Permanent Link to %s', 'trim' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>

					<?php if ( ! post_password_required() ) { ?>
						<p class="entry-excerpt">
							<?php if ( ! is_search() ) { ?>
								<?php echo wp_trim_words( get_the_content(), 20 ); ?>
							<?php } else { ?>
								<?php echo wp_trim_words( get_the_content(), 20 ); ?>
							<?php } ?>
						</p><!-- END .entry-excerpt -->
					<?php } else { ?>
						<?php echo get_the_content(); ?>
					<?php } ?>

					<ul class="entry-meta subtext">

						<?php $terms = get_the_terms( $post->ID, 'portfolio_category' ); ?>
						<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
							<li><?php _e( 'In: ', 'trim' ); ?><?php the_terms( $post->ID, 'portfolio_category', '', ', ', '' ); ?></li>
						<?php endif; ?>

						<?php if ( get_theme_mod( 'post_likes', trim_defaults( 'post_likes' ) ) == true ) { ?>
							<li class="likes"><?php Bean_PrintLikes( $post->ID ); ?></li>
						<?php } ?>

					</ul><!-- END .entry-meta -->

				</div><!-- END .inner -->

			<?php } ?>

			</article>

		<?php } ?>

	<?php
endwhile;
endif;
