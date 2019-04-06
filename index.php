<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

get_header();

if ( is_archive() ) { ?>

	<article class="post archive-head format-quote">

		<div class="vert-align">

			<?php
			if ( is_category() ) {
				$page_title = sprintf( __( 'All Posts in %s', 'trim' ), single_cat_title( '', false ) );
			} elseif ( is_tag() ) {
				$page_title = sprintf( __( 'All Posts in %s', 'trim' ), single_tag_title( '', false ) );
			} elseif ( is_date() ) {
				if ( is_month() ) {
					$page_title = sprintf( __( 'Archive for: %s', 'trim' ), get_the_time( 'F, Y' ) );
				} elseif ( is_year() ) {
					$page_title = sprintf( __( 'Archive for: %s', 'trim' ), get_the_time( 'Y' ) );
				} elseif ( is_day() ) {
					$page_title = sprintf( __( 'Archive for: %s', 'trim' ), get_the_time( get_option( 'date_format' ) ) );
				} else {
					$page_title = __( 'Archives', 'trim' );
				}
			} elseif ( is_author() ) {
				if ( get_query_var( 'author_name' ) ) {
					$curauth = get_user_by( 'login', get_query_var( 'author_name' ) );
				} else {
					$curauth = get_userdata( get_query_var( 'author' ) );
				}
				$author_name = $curauth->display_name;
				$title       = sprintf( __( 'Articles by %s', 'trim' ), $author_name );
				$page_title  = $author_avatar . $title;
			} else {
				$page_title = single_term_title( '', false );
			}
				?>

			<h2 class="entry-title"><?php echo esc_html( $page_title ); ?></h2>

		</div><!-- END.archive-head -->

	</article><!-- END.archive-head -->

<?php
}

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		get_template_part( 'loop-post' ); // PULL LOOP-POST.PHP
	endwhile;
endif;
?>

<div id="page_nav" class="hide">
	<?php next_posts_link(); ?>
</div><!-- END #page_nav -->

<?php
get_footer();
