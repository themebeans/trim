<?php
/**
 * Template Name: Under Construction
 * The template for displaying the under construction page template.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

get_header();
?>

<div class="construction-banner"></div>

<div class="construction-content">

	<div class="construction-logo">
		<?php if ( get_theme_mod( 'construction-img-upload', trim_defaults( 'construction-img-upload' ) ) ) { ?>
			<img src="<?php echo esc_url( get_theme_mod( 'construction-img-upload', trim_defaults( 'construction-img-upload' ) ) ); ?>"/>
		<?php } else { ?>
			<img src="<?php echo esc_url( get_template_directory_uri( '/assets/images/construction.png' ) ); ?>">
		<?php } ?>
	</div>

	<h1 class="entry-title"><?php the_title(); ?></h1>

	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>

	<div class="construction-banner btm"></div>

</div>

<?php
get_footer();
