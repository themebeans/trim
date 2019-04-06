<?php
/**
 * The template for displaying posts in the standard post format.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

$grid_feat_img = get_post_meta( $post->ID, '_bean_grid_feat_img', true );

if ( $grid_feat_img ) {
	if ( is_sticky() ) {
		echo '<span></span>'; } ?>

	<a title="<?php printf( __( 'Permanent Link to %s', 'trim' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>">
		<img src="<?php echo esc_url( $grid_feat_img ); ?>"/>
	</a>

<?php
} else {
	if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) {

		if ( is_sticky() ) {
			echo '<span></span>'; }
		?>

		<a title="<?php printf( __( 'Permanent Link to %s', 'trim' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'post-feat' ); ?>
		</a>

		<?php
	}
}
