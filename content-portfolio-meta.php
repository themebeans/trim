<?php
/**
 * The file for displaying the related portfolio loop below the portfolio single.
 * It is called via the related posts function in functions.php.
 * You can set the count via the $related_items_count variable.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

wp_reset_query();

// SETTING UP META
$portfolio_date        = get_post_meta( $post->ID, '_bean_portfolio_date', true );
$portfolio_url         = get_post_meta( $post->ID, '_bean_portfolio_url', true );
$portfolio_client      = get_post_meta( $post->ID, '_bean_portfolio_client', true );
$portfolio_cats        = get_post_meta( $post->ID, '_bean_portfolio_cats', true );
$portfolio_tags        = get_post_meta( $post->ID, '_bean_portfolio_tags', true );
$portfolio_custom_meta = get_post_meta( $post->ID, '_bean_portfolio_custom_meta', true );
?>

<ul class="entry-meta clearfix subtext">

	<?php if ( $portfolio_client ) { ?>
		<li><?php _e( 'Client: ', 'trim' ); ?>
		<?php if ( $portfolio_url ) { // DISPLAY PORTFOLIO URL ?>
			<a href="<?php echo esc_url( $portfolio_url ); ?>" target="blank"><?php echo esc_html( $portfolio_client ); ?></a>
		<?php
} else {
	echo esc_html( $portfolio_client ); }
?>
		</li>
	<?php } ?>

	<?php if ( $portfolio_cats == 'on' ) { // DISPLAY TAGS ?>
		<?php $terms = get_the_terms( $post->ID, 'portfolio_category' ); ?>
		<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
			<li class="tax"><?php _e( 'In: ', 'trim' ); ?><?php the_terms( $post->ID, 'portfolio_category', '', ', ', '' ); ?></li>
		<?php endif; ?>
	<?php } ?>

	<?php if ( $portfolio_tags == 'on' ) { // DISPLAY CATEGORY ?>
		<li class="tax"><?php _e( 'Tagged: ', 'trim' ); ?><?php the_terms( $post->ID, 'portfolio_tag', '#', ' #', '' ); ?></li>
	<?php } ?>

	<?php if ( $portfolio_custom_meta == 'on' ) { // DISPLAY CATEGORY ?>
		<?php the_meta(); ?>
	<?php } ?>

	<?php if ( get_theme_mod( 'portfolio_likes', trim_defaults( 'portfolio_likes' ) ) == true ) { ?>
		<li class="likes"><?php Bean_PrintLikes( $post->ID ); ?></li>
	<?php } ?>

</ul><!-- END .entry-meta-->
