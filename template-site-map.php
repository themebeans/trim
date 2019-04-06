<?php
/**
 * Template Name: Site Map
 * The template for displaying the site map template.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

get_header();

$page_title  = get_post_meta( $post->ID, '_bean_page_title', true );
$page_layout = get_post_meta( $post->ID, '_bean_page_layout', true ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( "single-page $page_layout" ); ?>>

	<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { ?>
			<?php the_post_thumbnail( 'post-feat' ); ?>
	<?php } ?>

	<div class="inner">

		<div class="entry-content">

			<?php if ( $page_title == 'on' ) { ?>
				<h1 class="entry-title"><?php the_title( '' ); ?></h1><?php } ?>

			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
			?>

			<div class="archives-list">

				<h6><?php _e( 'Pages', 'trim' ); ?></h6>
				<ul><?php wp_list_pages( 'title_li=' ); ?></ul>

			</div>

			<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-link"><span>' . __( 'Pages:', 'trim' ) . '</span>',
					'after'  => '</div>',
				)
			);
			wp_reset_query();
			?>

			</div>

	</div>

</article>

<?php
if ( $page_layout === 'page_sidebar' or $page_layout === 'page_fullwidth_sidebar' ) {
	dynamic_sidebar( 'internal-sidebar' );
}

get_footer();
