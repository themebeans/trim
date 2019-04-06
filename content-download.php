<?php
/**
 * Portfolio filtering code.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

// PULL PAGINATION FROM CUSTOMIZATION
$portfolio_posts_count = get_theme_mod( 'portfolio_posts_count', trim_defaults( 'portfolio_posts_count' ) );

if ( is_tax() ) {

	global $query_string;
	query_posts( "{$query_string}&posts_per_page=-1" );

	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			get_template_part( 'loop-download' );
	endwhile;
endif;
	wp_reset_postdata();

} else {

	// LOAD PORTFOLIO QUERY
	$args = array(
		'post_type'      => 'download',
		'order'          => 'DSC',
		'orderby'        => 'menu_order',
		'posts_per_page' => $portfolio_posts_count,
	);

	$wp_query = new WP_Query( $args );

	if ( $wp_query->have_posts() ) :
		while ( $wp_query->have_posts() ) :
			$wp_query->the_post();
			get_template_part( 'loop-download' );
	endwhile;
endif;

	wp_reset_postdata();

} //END else is_tax()
