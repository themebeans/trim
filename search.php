<?php
/**
 * The template for displaying Search Results pages
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

get_header();

if ( have_posts() ) { ?>

	<article class="post search-head">

		<div class="inner">
			<?php get_search_form(); ?>
		</div><!-- END .inner -->

	</article>

	<?php
	global $query_string;
	query_posts( $query_string . '&posts_per_page=' . get_option( 'posts_per_page' ) . '' );
?>

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			get_template_part( 'loop-post' ); // PULL LOOP-POST.PHP
	endwhile;
endif;
	?>

<?php } else { ?>

	<article class="post search-head">

		<div class="inner">

			<h2 class="entry-title"><?php printf( __( 'Nothing Found', 'trim' ) ); ?></h2>

			<p><?php printf( __( 'Sorry, but we didn&#39;t find anything for "%s". Please try searching again.', 'trim' ), get_search_query() ); ?></p>

			<?php get_search_form(); ?>

		</div><!-- END .inner -->

	</article>

<?php
} //END else

get_footer();
