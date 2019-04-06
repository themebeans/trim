<?php
/**
 * The file for displaying the more portfolio loop below the portfolio single.
 * It is called via the single-portfolio.php.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

if ( is_singular( 'portfolio' ) ) {
	$loop      = 'loop-portfolio';
	$post_type = 'portfolio';

} elseif ( is_singular( 'download' ) ) {
	$loop      = 'loop-download';
	$post_type = 'download';
} else {
	$loop      = 'loop-post';
	$post_type = 'post';
}

$args = array(
	'post_type'      => $post_type,
	'order'          => 'DSC',
	'orderby'        => 'rand',
	'posts_per_page' => '14',
	'post__not_in'   => array( $post->ID ),
);

query_posts( $args );

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		get_template_part( $loop );
	endwhile;
endif;

wp_reset_query();
