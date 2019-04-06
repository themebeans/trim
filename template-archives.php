<?php
/**
 * Template Name: Post Archives
 * The template for displaying the post archives template.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

get_header();

// PAGE META
$page_title  = get_post_meta( $post->ID, '_bean_page_title', true );
$page_layout = get_post_meta( $post->ID, '_bean_page_layout', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( "single-page $page_layout" ); ?>>

	<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { ?>
		<?php the_post_thumbnail( 'post-feat' ); ?>
	<?php } //END if ( (function_exists('has_post_thumbnail')) ?>

	<div class="inner">

		<div class="entry-content">

			<?php
			if ( $page_title == 'on' ) {
?>
<h1 class="entry-title"><?php the_title( '' ); ?></h1><?php } ?>

			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
endwhile; // THE LOOP
?>

			<div class="archives-list">

				<h6><?php _e( 'Last 30 Posts', 'trim' ); ?></h4>

				<ul>
					<?php
					$archive_30 = get_posts( 'numberposts=30' );
					foreach ( $archive_30 as $post ) :
					?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endforeach; ?>
				</ul>

				<h6><?php _e( 'Archives by Month', 'trim' ); ?></h6>

				<ul><?php wp_get_archives( 'type=monthly' ); ?></ul>

				<h6><?php _e( 'Archives by Category ', 'trim' ); ?></h6>

				<ul><?php wp_list_categories( 'title_li=' ); ?></ul>

			</div><!-- END .archives-list -->

			<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-link"><span>' . __( 'Pages:', 'trim' ) . '</span>',
					'after'  => '</div>',
				)
			);
			wp_reset_query();
?>

			</div><!-- END .entry-content -->

	</div><!-- END .inner -->

</article>

<?php
if ( $page_layout === 'page_sidebar' or $page_layout === 'page_fullwidth_sidebar' ) {
	dynamic_sidebar( 'internal-sidebar' );
} // END $page_layout === 'page_sidebar'

get_footer();
