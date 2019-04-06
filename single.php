<?php
/**
 * The template for displaying all single posts.
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

			<?php
			$format = get_post_format();

			if ( false === $format ) {
				$format = 'standard'; }

			if ( $format != 'aside' ) {
			?>

			<?php if ( $format != 'video' && $format != 'gallery' && $format != 'image' && $format != 'link' && $format != 'aside' && $format != 'quote' ) { ?>

				<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { ?>
					<div class="entry-content-media
					<?php
					if ( ! has_post_thumbnail() ) {
						echo 'no-img'; }
?>
">
						<?php the_post_thumbnail( 'post-feat' ); ?>

						<?php if ( $format == 'audio' ) { ?>

							<?php
							if ( ! has_post_thumbnail() ) {
								echo '<div class="no-feat">'; }
									bean_audio( $post->ID );
							if ( ! has_post_thumbnail() ) {
								echo '</div>'; }
								?>

						<?php } //END  if( $format == 'audio' ) ?>
					</div><!-- END .entry-content-media -->
				<?php } //END  if(has_post_thumbnail) ?>

				<?php if ( $format == 'audio' && ! has_post_thumbnail() ) { ?>

					<div class="entry-content-media no-img">

						<?php
						echo '<div class="no-feat">';
							bean_audio( $post->ID );
						echo '</div>';
						?>

					</div><!-- END .entry-content-media -->

				<?php } //END  if( $format == 'audio' ) ?>

			<?php } //END ($format != 'video'...) ?>

				<?php if ( $format == 'image' ) { ?>

				<div class="entry-content-media
				<?php
				if ( ! has_post_thumbnail() ) {
					echo 'no-img'; }
?>
">

					<?php bean_gallery( $post->ID, '', 'post-lightbox', $orderby, true ); ?>

				</div><!-- END .entry-content-media -->

			<?php } //END  if( $format == 'image' ) ?>

				<?php if ( $format == 'gallery' ) { ?>

				<div class="entry-content-media
				<?php
				if ( ! has_post_thumbnail() ) {
					echo 'no-img'; }
?>
">

					<?php bean_gallery( $post->ID, '', 'slider', $orderby, true ); ?>

				</div><!-- END .entry-content-media -->

			<?php } //END  if( $format == 'gallery' ) ?>

				<?php if ( $format == 'video' ) { ?>

				<div class="entry-content-media
				<?php
				if ( ! has_post_thumbnail() ) {
					echo 'no-img'; }
?>
">

					<?php
					if ( $video_embed_url ) {
						echo '<a data-fancybox class="lightbox" href="' . esc_url( $video_embed_url ) . '">';
							echo '<span class="lightbox-play"></span>';
							the_post_thumbnail( 'post-feat' );
						echo '</a>';
					} else {
						if ( $embed ) {
							echo stripslashes( htmlspecialchars_decode( $embed ) );
						}
					}
					?>

				</div><!-- END .entry-content-media -->

			<?php } //END  if( $format == 'video' ) ?>

				<?php if ( $format == 'link' ) { ?>

				<div class="entry-content-media
				<?php
				if ( ! has_post_thumbnail() ) {
					echo 'no-img'; }
?>
">

					<a target="blank" href="<?php echo esc_url( $link ); ?>">
						<div class="vert-align">
							<h2 class="entry-title"><?php echo stripslashes( esc_html( $link_title ) ); ?></h2>
							<span class="subtext"><?php echo stripslashes( esc_html( $link ) ); ?></span>
						</div><!-- END .vert-align -->
					</a>

				</div><!-- END .entry-content-media -->

			<?php } //END  if( $format == 'link' ) ?>

				<?php if ( $format == 'quote' ) { ?>

				<div class="entry-content-media
				<?php
				if ( ! has_post_thumbnail() ) {
					echo 'no-img'; }
?>
">

					<div class="vert-align">
						<h2 class="entry-title"><?php echo stripslashes( esc_html( $quote ) ); ?></h2>
						<span class="subtext"><?php echo stripslashes( esc_html( $quote_source ) ); ?></span>
					</div><!-- END .vert-align -->

				</div><!-- END .entry-content-media -->

			<?php } //END  if( $format == 'quote' ) ?>

			<?php } //END  if( $format == 'aside' ) ?>

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

				<?php comments_template( '', true ); ?>

			</div><!-- END .inner -->

		</article>

	<?php
endwhile;
endif;

// OPTIONAL SIDEBAR
if ( get_theme_mod( 'show_single_post_sidebar', trim_defaults( 'show_single_post_sidebar' ) ) == true ) {
	if ( get_theme_mod( 'show_post_loop_single', trim_defaults( 'show_post_loop_single' ) ) == true && is_active_sidebar( 'single-sidebar' ) ) {
	?>
		<article class="sidebar post">
			<div class="inner">

				<?php if ( get_theme_mod( 'post_sharing', trim_defaults( 'post_sharing' ) ) == true ) { ?>
					<?php get_template_part( 'content', 'post-social' ); ?>
				<?php } ?>

				<?php dynamic_sidebar( 'single-sidebar' ); ?>

			</div><!-- END .inner -->
		</article>
	<?php
	} else {

		dynamic_sidebar( 'single-sidebar' );

		if ( get_theme_mod( 'post_sharing', trim_defaults( 'post_sharing' ) ) == true ) {
			get_template_part( 'content', 'post-social' );
		}
	}
}

if ( get_theme_mod( 'show_single_post_sidebar', trim_defaults( 'show_single_post_sidebar' ) ) == false && get_theme_mod( 'post_sharing', trim_defaults( 'post_sharing' ) ) == true ) {
?>
		<article class="sidebar post no-sidebar-social-only">
			<div class="inner">
				<?php get_template_part( 'content', 'post-social' ); ?>
			</div><!-- END .inner -->
		</article>
	<?php
}

// MORE LOOP PULL
if ( get_theme_mod( 'show_post_loop_single', trim_defaults( 'show_post_loop_single' ) ) == true ) {

	// SWITCHER FOR MORE OR RELATED LOOP
	$more_loop = get_theme_mod( 'post_more_loop', trim_defaults( 'post_more_loop' ) );
	if ( $more_loop != '' ) {
		switch ( $more_loop ) {
			case 'related':
				$terms = get_the_terms( $post->ID, 'category' );
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
