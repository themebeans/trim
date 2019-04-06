<?php
/**
 * The header for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<?php
$hidden_sidebar       = get_theme_mod( 'hidden_sidebar', trim_defaults( 'hidden_sidebar' ) );
$hidden_sidebar_class = ( true === $hidden_sidebar ) ? 'sidebar-active' : null;
?>

<body <?php body_class(); ?>>
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}
	?>
	<?php
	if ( ! is_404() && ! is_page_template( 'template-underconstruction.php' ) ) {

		if ( true === get_theme_mod( 'portfolio_filter', trim_defaults( 'portfolio_filter' ) ) ) {
			if ( is_page_template( 'template-portfolio.php' ) || is_page_template( 'template-portfolio-grid.php' ) || is_page_template( 'template-portfolio-fullwidth.php' ) ) {
				get_template_part( 'content', 'portfolio-filter' );
			}
		}

		if ( true === get_theme_mod( 'edd_filter', trim_defaults( 'edd_filter' ) ) ) {
			if ( is_page_template( 'template-edd-downloads.php' ) || is_post_type_archive( 'download' ) ) {
				get_template_part( 'content', 'download-filter' );
			}
		}
		?>

		<?php if ( has_nav_menu( 'mobile-menu' ) ) : ?>

			<nav id="mobile-nav" aria-label="<?php esc_attr_e( 'Mobile Menu', 'trim' ); ?>">

					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'mobile-menu',
						)
					);
					?>

			</nav>

		<?php endif; ?>

		<div class="row">

			<header id="masthead" class="header <?php echo esc_attr( get_theme_mod( 'header_style', trim_defaults( 'header_style' ) ) ); ?>">

				<div class="left-side">

					<?php trim_site_logo(); ?>

					<p class="site-description">
						<?php echo esc_html( get_bloginfo( 'description' ) ); ?>

						</p>

					<?php if ( has_nav_menu( 'primary-menu' ) ) : ?>

						<nav class="nav primary hide-for-small">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'primary-menu',
									'container'      => '',
									'menu_id'        => 'primary-menu',
									'menu_class'     => 'sf-menu main-menu',
								)
							);
							?>
						</nav>

					<?php endif; ?>

				</div>

				<?php if ( true === get_theme_mod( 'hidden_sidebar', trim_defaults( 'hidden_sidebar' ) ) ) { ?>
					<a id="nav-toggle" class="sidebar-btn" href="javascript:void(0);"><span></span></a>
				<?php } ?>

				<?php
				if ( true === get_theme_mod( 'portfolio_filter', trim_defaults( 'portfolio_filter' ) ) ) {
					if ( is_page_template( 'template-portfolio.php' ) || is_page_template( 'template-portfolio-grid.php' ) || is_page_template( 'template-portfolio-fullwidth.php' ) ) {
					?>
						<a id="filter-toggle" class="<?php echo esc_attr( $hidden_sidebar_class ); ?>" title="<?php echo esc_html__( 'Open Sidebar', 'trim' ); ?>" href="javascript:void(0);"><span></span><span class="filter-circle"></span><span class="filter-circle2"></span></a>
					<?php
					}
				}

				if ( true === get_theme_mod( 'edd_filter', trim_defaults( 'edd_filter' ) ) ) {
					if ( is_page_template( 'template-edd-downloads.php' ) || is_post_type_archive( 'download' ) ) {
					?>
						<a id="filter-toggle" class="<?php echo esc_attr( $hidden_sidebar_class ); ?>" title="<?php echo esc_html__( 'Open Sidebar', 'trim' ); ?>" href="javascript:void(0);"><span></span><span class="filter-circle"></span><span class="filter-circle2"></span></a>
					<?php
					}
				}
				?>

			</header>

			<?php
			if ( true === get_theme_mod( 'hidden_sidebar', trim_defaults( 'hidden_sidebar' ) ) ) {
				get_template_part( 'content', 'hidden-sidebar' );
			}
			?>

		</div>

		<div class="content-wrapper <?php echo esc_attr( get_theme_mod( 'theme_version', trim_defaults( 'theme_version' ) ) ); ?> <?php echo esc_attr( get_theme_mod( 'header_style', trim_defaults( 'header_style' ) ) ); ?>">

			<?php
			if ( true === get_theme_mod( 'portfolio_filter', trim_defaults( 'portfolio_filter' ) ) ) {
				if ( is_page_template( 'template-portfolio.php' ) || is_page_template( 'template-portfolio-grid.php' ) || is_page_template( 'template-portfolio-fullwidth.php' ) ) {
					get_template_part( 'content', 'portfolio-filter-mobile' );
				}
			}

			// Get the portfolio layout.
			$portfolio_layout = get_post_meta( $post->ID, '_bean_portfolio_layout', true );
			if ( 'default' === $portfolio_layout ) {
				if ( 'theme_version_grid' === get_theme_mod( 'theme_version', trim_defaults( 'theme_version' ) ) ) {
					$portfolio_layout = 'std';
				} elseif ( 'theme_version_fullwidth' === get_theme_mod( 'theme_version', trim_defaults( 'theme_version' ) ) ) {
					$portfolio_layout = 'fullwidth';
				} elseif ( 'theme_version_fullscreen' === get_theme_mod( 'theme_version', trim_defaults( 'theme_version' ) ) ) {
					$portfolio_layout = 'fullscreen';
				} else {
					$portfolio_layout = 'std';
				}
			}

			if ( ! is_page_template( 'template-portfolio-fullscreen-slider.php' ) ) {
				if ( 'fullscreen' === $portfolio_layout || 'theme_version_fullscreen' === get_theme_mod( 'theme_version', trim_defaults( 'theme_version' ) ) && is_page_template( 'template-portfolio.php' ) ) {
				} else {
				?>
					<div id="masonry-container">
						<div class="grid-width"></div><div class="gutter-width"></div>
				<?php
				}
			}
	}
