<?php
/**
 * The file is for displaying the blog post meta.
 * This has it's own content file because we call it among various post formats.
 * If you edit this file, its output will be edited on all post formats.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */
?>

<ul class="entry-meta subtext">

		<li><?php _e( 'Posted by:', 'trim' ); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></li>

	<?php if ( is_singular( 'post' ) ) { ?>
		<li><?php _e( 'Categories: ', 'trim' ); ?><?php the_category( ', ' ); ?></li>
	<?php } ?>

	<?php
	if ( is_singular( 'download' ) ) {
		$terms = get_the_terms( $post->ID, 'download_category' );
		if ( $terms && ! is_wp_error( $terms ) ) {
		?>
			<li><?php _e( 'Categories: ', 'trim' ); ?><?php the_terms( $post->ID, 'download_category', '', ', ', '' ); ?></li>
		<?php
		}
	}
	?>

	<?php if ( get_theme_mod( 'show_tags', trim_defaults( 'show_tags' ) ) == true && has_tag() ) { ?>
		<li class="tags"><?php _e( 'Tags: ', 'trim' ); ?><?php echo the_tags( '', ',&nbsp;', '' ); ?> </li>
	<?php } ?>

	<?php if ( comments_open() ) { ?>
		<li>
		<?php
		_e( 'Comments: ', 'trim' );
		comments_popup_link( '0', '1', '%' );
?>
</li>
	<?php } ?>

		<li><?php _e( 'Views: ', 'trim' ); ?><?php echo bean_getPostViews( get_the_ID() ); ?></li>

	<?php
	if ( is_singular( 'post' ) ) {
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__( '[Edit<span class="screen-reader-text"> "%s"</span>]', 'trim' ),
				get_the_title()
			),
			'<li class="edit-link">',
			'</li>'
		);
	}
	?>

	<?php if ( get_theme_mod( 'post_likes', trim_defaults( 'post_likes' ) ) == true or get_theme_mod( 'edd_likes', trim_defaults( 'edd_likes' ) ) == true ) { ?>
		<li><?php Bean_PrintLikes( $post->ID ); ?></li>
	<?php } ?>




</ul><!-- END .entry-meta -->
