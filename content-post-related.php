<?php
/**
 * The file for displaying the related post loop beside the single post.
 * It is called via the related posts function in functions.php.
 * You can set the count via the $related_items_count variable.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

if ( is_singular( 'portfolio' ) ) {
	$loop     = 'loop-portfolio';
	$category = 'portfolio_category';

} elseif ( is_singular( 'download' ) ) {
	$loop     = 'loop-download';
	$category = 'download_category';

} else {
	$loop     = 'loop-post';
	$category = 'category';
}

$related_items_count = 14;
$related             = bean_get_related_posts( $post->ID, $category, array( 'posts_per_page' => $related_items_count ) );
$i                   = 1;

if ( $related->post_count !== 0 ) {
	while ( $related->have_posts() ) :
		$related->the_post();
		get_template_part( $loop );
		$i++;
endwhile;
	wp_reset_postdata();
}
