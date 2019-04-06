<?php
/**
 * The content for the fullscreen slider portfolio template.
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
?>

<div id="slider-<?php echo esc_js( $post->ID ); ?>" class="home-slider fadein">

	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('#slider-<?php echo esc_js( $post->ID ); ?>').superslides({
				animation: 'slide',
				pagination: true,
				play: 6000,
			});
		});
	</script>

	<ul class="slides-container">

		<?php
		if ( is_tax() ) {
			global $query_string;
			query_posts( "{$query_string}&posts_per_page=-1" );
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					?>
						<?php $slide_img = get_post_meta( $post->ID, '_bean_home_slider_image', true ); ?>

						<?php if ( $slide_img ) { ?>
							<li>
								<a title="<?php printf( __( 'Permanent Link to %s', 'trim' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>">
									<img src="<?php echo esc_url( $slide_img ); ?>" />
								</a>
							</li>
						<?php } ?>

						<?php
				endwhile;
			endif;

			wp_reset_postdata();

		} else {
			$args = array(
				'post_type'           => 'portfolio',
				'order'               => $order,
				'orderby'             => $orderby,
				'paged'               => $paged,
				'meta_key'            => $meta_key,
				'posts_per_page'      => '-1',
				'ignore_sticky_posts' => true,
				'meta_query'          => array(
					array(
						'key'   => '_bean_portfolio_feature',
						'value' => 'on',
					),
				),
			);

			$wp_query = new WP_Query( $args );
			?>

			<?php
			if ( $wp_query->have_posts() ) :
				while ( $wp_query->have_posts() ) :
					$wp_query->the_post();
?>

								<?php $slide_img = get_post_meta( $post->ID, '_bean_home_slider_image', true ); ?>

								<?php if ( $slide_img ) { ?>
					<li>
						<a title="<?php printf( __( 'Permanent Link to %s', 'trim' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>">
							<img src="<?php echo esc_url( $slide_img ); ?>" />
						</a>
					</li>
				<?php } ?>

							<?php
			endwhile;
endif;
?>

		<?php
		} //END else
		?>

	</ul><!-- END .slides-container -->

	<nav class="slides-navigation fadein">
		<a href="#" class="next"><?php _e( 'Next', 'trim' ); ?></a>
		<a href="#" class="prev"><?php _e( 'Previous', 'trim' ); ?></a>
	</nav><!-- END .slides-navigation -->

</div><!-- END #slider-$postid -->

<ul class="home-slider-mobile fadein">

	<?php
	if ( $wp_query->have_posts() ) :
		while ( $wp_query->have_posts() ) :
			$wp_query->the_post();
?>

				<?php $slide_img = get_post_meta( $post->ID, '_bean_home_slider_image', true ); ?>

				<?php if ( $slide_img ) { ?>
			<li>
				<a title="<?php printf( __( 'Permanent Link to %s', 'trim' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>">
					<img src="<?php echo esc_url( $slide_img ); ?>" />
				</a>
			</li>
		<?php } ?>

			<?php
	endwhile;
endif;
?>

</ul><!-- END .home-slider-mobile -->
