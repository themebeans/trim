<?php
/**
 * The template for displaying the post sharing.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

$feat_image      = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
$twitter_profile = get_theme_mod( 'twitter_profile', trim_defaults( 'twitter_profile' ) );
$via             = ( $twitter_profile ) ? '&via=' . $twitter_profile : null;

// Generate the Twitter URL.
$tweet_url = '
	http://twitter.com/share?
	text=' . get_the_title() . '
	&url=' . get_the_permalink() . $via;

if ( ! post_password_required() ) {

	if ( false === get_theme_mod( 'show_post_loop_single', trim_defaults( 'show_post_loop_single' ) ) && true === get_theme_mod( 'show_single_post_sidebar', trim_defaults( 'show_single_post_sidebar' ) ) ) {
		echo '<article class="widget">';
	}
	?>

	<ul class="social-sharing">
		<li><a href="<?php echo esc_url( $tweet_url ); ?>" target="_blank" class="twitter"><?php echo esc_html__( 'Tweet', 'trim' ); ?></a></li>
		<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="facebook even"><?php echo esc_html__( 'Share', 'trim' ); ?></a></li>
		<li><a href="http://pinterest.com/pin/create/bookmarklet/?media=<?php echo esc_url( $feat_image ); ?>&url=<?php the_permalink(); ?>&is_video=false&description=<?php the_title_attribute(); ?>" class="pinterest"><?php echo esc_html__( 'Pin', 'trim' ); ?></a></li>
		<li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" class="google even"><?php echo esc_html__( 'Send', 'trim' ); ?></a></li>

	</ul>

	<div class="social-sharing-divide"></div>

	<?php
	if ( false === get_theme_mod( 'show_post_loop_single', trim_defaults( 'show_post_loop_single' ) ) && true === get_theme_mod( 'show_single_post_sidebar', trim_defaults( 'show_single_post_sidebar' ) ) ) {
		echo '</article>'; }
}
