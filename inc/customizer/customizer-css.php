<?php
/**
 * Enqueues front-end CSS for Customizer options.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

/**
 * Set the Custom CSS via Customizer options.
 */
function trim_customizer_css() {

	$background_color    = get_theme_mod( 'background_color', '#f2f2f2' );
	$theme_style         = get_theme_mod( 'theme_style', trim_defaults( 'theme_style_1' ) );
	$theme_accent_color  = get_theme_mod( 'theme_accent_color', trim_defaults( 'theme_accent_color' ) );
	$custom_bg           = '';
	$logo_maxwidth       = get_theme_mod( 'custom_logo_max_width', trim_defaults( 'custom_logo_max_width' ) );
	$logo_mobilemaxwidth = get_theme_mod( 'custom_logo_mobile_max_width', trim_defaults( 'custom_logo_mobile_max_width' ) );
	$css_filter_style    = get_theme_mod( 'portfolio_css_filter', trim_defaults( 'portfolio_css_filter' ) );

	$css =
	'
	#masthead {
		background-color: #' . $background_color . ';
	}

	.social-sharing-divide,
	.page-template-template-portfolio-fullscreen-slider-php .footer-row,
	.page-template-template-portfolio-php .theme_version_fullscreen.footer {
		background-color: #' . $background_color . ';
	}

	@media screen and (max-width: 768px) {
	    body .custom-logo-link img.custom-logo {
	        width: ' . esc_attr( $logo_mobilemaxwidth ) . 'px;
	    }
	}

	@media screen and (min-width: 769px) {
	    body .custom-logo-link img.custom-logo {
	        width: ' . esc_attr( $logo_maxwidth ) . 'px;
	    }
	}

	a { color:' . $theme_accent_color . '; }

	.cats,
	.widget a,
	.entry-content a,
	h1 a:hover,
	blockquote,
	.author-tag,
	.a-link:hover,
	.site-title:hover,
	.published a:hover,
	.entry-meta a:hover,
	.pagination a:hover,
	header ul li a:hover,
	footer ul li a:hover,
	.single-price .price,
	.entry-title a:hover,
	.comment-meta a:hover,
	h2.entry-title a:hover,
	.comment-author a:hover,
	.products li h2 a:hover,
	.entry-link a.link:hover,
	.team-content h3 a:hover,
	.site-description a:hover,
	.bean-tabs > li.active > a,
	.bean-panel-title > a:hover,
	.grid-item .entry-meta a:hover,
	.bean-tabs > li.active > a:hover,
	.bean-tabs > li.active > a:focus,
	#cancel-comment-reply-link:hover,
	.shipping-calculator-button:hover,
	.single-product ul.tabs li a:hover,
	.grid-item.post .entry-meta a:hover,
	.single-product ul.tabs li.active a,
	.single-portfolio .sidebar-right a.url,
	.grid-item.portfolio .entry-meta a:hover,
	.portfolio.grid-item span.subtext a:hover,
	.entry-content .portfolio-social li a:hover,
	header ul > .sfHover > a.sf-with-ul,
	.entry-content a:hover,
	.widget_bean_tweets .button,
	header .sub-menu li a:hover,
	#mobile-filter li a:hover,
	.widget_bean_tweets .button:hover,
	.hidden-sidebar .widget a:hover,
	header .sub-menu li.current-menu-item a:hover,
	.single-portfolio .portfolio-social .bean-likes:hover,
	.entry-content .wp-playlist-dark .wp-playlist-playing .wp-playlist-caption,
	.entry-content .wp-playlist-light .wp-playlist-playing .wp-playlist-caption,
	.entry-content .wp-playlist-dark .wp-playlist-playing .wp-playlist-item-title,
	.entry-content .wp-playlist-light .wp-playlist-playing .wp-playlist-item-title { color:' . $theme_accent_color . '!important; }

	.onsale,
	.new-tag,
	.bean-btn,
	.bean-shot,
	.type-team,
	.btn:hover,
	#place_order,
	.button:hover,
	nav a h1:hover,
	.tagcloud a,
	div.jp-play-bar,
	.tagcloud a:hover,
	.vert-align:hover,
	.pagination a:hover,
	.flickr_badge_image,
	.edd_checkout a:hover,
	div.jp-volume-bar-value,
	.avatar-list li a.active,
	.dark_style .pagination a,
	.btn[type="submit"]:hover,
	input[type="reset"]:hover,
	input[type="button"]:hover,
	#edd-purchase-button:hover,
	input[type="submit"]:hover,
	.button[type="submit"]:hover,
	#load-more:hover .overlay h5,
	.sidebar-btn .menu-icon:hover,
	.pagination .page-portfolio a,
	.widget_bean_cta .bean-cta,
	#mobile-filter li a.active,
	.widget .buttons .checkout.button,
	.side-menu .sidebar-btn .menu-icon,
	.dark_style .sidebar-btn .menu-icon,
	input[type=submit].edd-submit.button,
	.comment-form-rating p.stars a.active,
	.hidden-sidebar.sidebar.dark .tagcloud a,
	.comment-form-rating p.stars a.active:hover,
	table.cart td.actions .checkout-button.button,
	article.sidebar .widget_bean_cta .bean-cta:hover,
	#masonry-container article.widget_bean_cta .inner:hover,
	.entry-content .mejs-controls .mejs-time-rail span.mejs-time-current { background-color:' . $theme_accent_color . '; }

	.entry-content .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current { background:' . $theme_accent_color . '; }

	.pagination a:hover,
	.single-product .price ins,
	.entry-content a:hover,
	.widget a:hover,
	abbr:hover, acronym:hover, ins:hover,
	.single-product ul.tabs li.active a,
	#filter-toggle:hover span.filter-circle,
	#filter-toggle:hover span.filter-circle2,
	textarea:focus,
	.theme_style_2 textarea:focus,
	#mobile-filter li a:hover,
	#mobile-filter li a.active,
	.theme_style_2 input[type="tel"]:focus,
	.theme_style_2 input[type="url"]:focus,
	.theme_style_2 input[type="text"]:focus,
	.theme_style_2 input[type="date"]:focus,
	.theme_style_2 input[type="time"]:focus,
	.theme_style_2 input[type="email"]:focus,
	.theme_style_2 input[type="number"]:focus,
	.theme_style_2 input[type="search"]:focus,
	.theme_style_2 input[type="password"]:focus,
	.theme_style_2 input[type="datetime"]:focus { border-color:' . $theme_accent_color . '!important; }

	.bean-btn { border: 1px solid ' . $theme_accent_color . '!important; }

	.bean-quote,
	.instagram_badge_image,
	.bean500px_badge_image,
	.products li a.added_to_cart,
	.single_add_to_cart_button.button,
	#nav-toggle:hover span:before,
	#nav-toggle:hover span:after,
	#filter-toggle:hover span:not(.filter-circle):not(.filter-circle2)::before,
	#filter-toggle:hover span:not(.filter-circle):not(.filter-circle2)::after,
	.single-page .edd-submit,mailbag
	.sidebar .edd-submit.button,
	.dark_style.side-menu .sidebar-btn .menu-icon:hover { background-color:' . $theme_accent_color . '!important; }
	';

	// CSS Filter Customizer option.
	$css_filter_css = '';
	if ( $css_filter_style ) {
		switch ( $css_filter_style ) {
			case 'none':
				break;
			case 'grayscale':
				$css_filter_css = '#masonry-container article.portfolio img { filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); filter:gray; -webkit-filter:grayscale(100%);-moz-filter: grayscale(100%);-o-filter: grayscale(100%);}';
				break;
			case 'sepia':
				$css_filter_css = '#masonry-container article.portfolio img { -webkit-filter: sepia(50%); }';
				break;
			case 'saturation':
				$css_filter_css = '#masonry-container article.portfolio img { -webkit-filter: saturate(150%); }';
				break;
		}
	}

	// Support for Bean Pricing Tables.
	$pricing_tables_css = '';
	include_once ABSPATH . 'wp-admin/includes/plugin.php'; if ( is_plugin_active( 'bean-pricingtables/bean-pricingtables.php' ) ) {
		$pricing_tables_css = '.bean-pricing-table .pricing-column li span {color:' . esc_attr( $theme_accent_color ) . '!important;}#powerTip,.bean-pricing-table .pricing-highlighted{background-color:' . esc_attr( $theme_accent_color ) . '!important;}#powerTip:after {border-color:' . esc_attr( $theme_accent_color ) . ' transparent!important; }';
	}

	return wp_strip_all_tags( $css . $css_filter_css . $pricing_tables_css );
}

/**
 * Enqueue the Customizer styles on the front-end.
 */
function trim_customizer_styles() {
	wp_add_inline_style( 'trim-style', trim_customizer_css() );
}
add_action( 'wp_enqueue_scripts', 'trim_customizer_styles' );
