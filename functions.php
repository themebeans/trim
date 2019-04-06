<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

if ( ! defined( 'TRIM_DEBUG' ) ) :
	/**
	 * Check to see if development mode is active.
	 * If set to false, the theme will load un-minified assets.
	 */
	define( 'TRIM_DEBUG', true );
endif;

if ( ! defined( 'TRIM_ASSET_SUFFIX' ) ) :
	/**
	 * If not set to true, let's serve minified .css and .js assets.
	 * Don't modify this, unless you know what you're doing!
	 */
	if ( ! defined( 'TRIM_DEBUG' ) || true === TRIM_DEBUG ) {
		define( 'TRIM_ASSET_SUFFIX', null );
	} else {
		define( 'TRIM_ASSET_SUFFIX', '.min' );
	}
endif;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function trim_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Tabor, use a find and replace
	 * to change 'trim' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'trim', get_parent_theme_file_path( '/languages' ) );

	/*
	 * Add default posts and comments RSS feed links to head.
	 */
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Filter Tabor's custom-background support argument.
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 * }
	 */
	$args = array(
		'default-color' => 'f2f2f2',
	);
	add_theme_support( 'custom-background', $args );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	set_post_thumbnail_size( 140, 140 );

	add_image_size( 'post-feat', 750, 9999, false );
	add_image_size( 'port-full', 1540, 9999, false );
	add_image_size( 'grid-feat', 500, 500, array( 'center', 'top' ) );

	// Set the content width in pixels, based on the theme's design and stylesheet.
	$GLOBALS['content_width'] = apply_filters( 'trim_content_width', 700 );

	/*
	 * This theme uses wp_nav_menu() in the following locations.
	 */
	register_nav_menus(
		array(
			'primary-menu' => esc_html__( 'Primary Menu', 'trim' ),
			'mobile-menu'  => esc_html__( 'Mobile Menu', 'trim' ),
		)
	);

	/*
	 * Switch default core search for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support(
		'post-formats', array(
			'aside',
			'audio',
			'image',
			'gallery',
			'link',
			'quote',
			'video',
		)
	);

	/*
	 * This theme styles the visual editor to resemble the theme style.
	 */
	add_editor_style( array( 'assets/css/editor' . TRIM_ASSET_SUFFIX . '.css' ) );

	/*
	 * Enable support for Customizer Selective Refresh.
	 * See: https://make.wordpress.org/core/2016/02/16/selective-refresh-in-the-customizer/
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Enable support for the WordPress default Theme Logo
	 * See: https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo', array(
			'flex-width' => true,
		)
	);
}
add_action( 'after_setup_theme', 'trim_setup' );

/**
 * Register widget areas.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function trim_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Internal Sidebar', 'trim' ),
			'description'   => __( 'Widget area for the primary sidebar.', 'trim' ),
			'id'            => 'internal-sidebar',
			'before_widget' => '<article class="widget post %2$s"><div class="inner clearfix">',
			'after_widget'  => '</div></article>',
			'before_title'  => '<h6 class="widget-title">',
			'after_title'   => '</h6>',
		)
	);

	if ( true === get_theme_mod( 'show_single_post_sidebar', trim_defaults( 'show_single_post_sidebar' ) ) ) {

		if ( true === get_theme_mod( 'show_post_loop_single', trim_defaults( 'show_post_loop_single' ) ) ) {
				register_sidebar(
					array(
						'name'          => __( 'Single Post Sidebar', 'trim' ),
						'description'   => __( 'Widget area for the primary sidebar.', 'trim' ),
						'id'            => 'single-sidebar',
						'before_widget' => '<div class="widget %2$s clearfix">',
						'after_widget'  => '</div>',
						'before_title'  => '<h6 class="widget-title">',
						'after_title'   => '</h6>',
					)
				);
		} else {
			register_sidebar(
				array(
					'name'          => __( 'Single Post Sidebar', 'trim' ),
					'description'   => __( 'Widget area for the primary sidebar.', 'trim' ),
					'id'            => 'single-sidebar',
					'before_widget' => '<article class="widget %2$s"><div class="inner clearfix">',
					'after_widget'  => '</div></article>',
					'before_title'  => '<h6 class="widget-title">',
					'after_title'   => '</h6>',
				)
			);
		}
	}

	if ( true === get_theme_mod( 'show_single_edd_sidebar', trim_defaults( 'show_single_edd_sidebar' ) ) ) {

		if ( true === get_theme_mod( 'show_edd_loop_single', trim_defaults( 'show_edd_loop_single' ) ) ) {
				register_sidebar(
					array(
						'name'          => __( 'Edd Shop Sidebar', 'trim' ),
						'description'   => __( 'Widget area for the primary sidebar.', 'trim' ),
						'id'            => 'shop-template',
						'before_widget' => '<div class="widget %2$s clearfix">',
						'after_widget'  => '</div>',
						'before_title'  => '<h6 class="widget-title">',
						'after_title'   => '</h6>',
					)
				);
		} else {
			register_sidebar(
				array(
					'name'          => __( 'Edd Shop Sidebar', 'trim' ),
					'description'   => __( 'Widget area for the primary sidebar.', 'trim' ),
					'id'            => 'shop-template',
					'before_widget' => '<article class="widget %2$s"><div class="inner clearfix">',
					'after_widget'  => '</div></article>',
					'before_title'  => '<h6 class="widget-title">',
					'after_title'   => '</h6>',
				)
			);
		}
	}

	if ( true === get_theme_mod( 'hidden_sidebar', trim_defaults( 'hidden_sidebar' ) ) ) {
		register_sidebar(
			array(
				'name'          => __( 'Hidden Sidebar', 'trim' ),
				'description'   => __( 'Widget area for the hidden sidebar.', 'trim' ),
				'id'            => 'hidden-sidebar',
				'before_widget' => '<div class="widget %2$s clearfix">',
				'after_widget'  => '</div>',
				'before_title'  => '<h6 class="widget-title">',
				'after_title'   => '</h6>',
			)
		);
	}

}
add_action( 'widgets_init', 'trim_widgets_init' );




/**
 * Enqueue scripts and styles.
 */
function trim_scripts() {

	// Load theme styles.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'trim-style', get_parent_theme_file_uri( '/style' . TRIM_ASSET_SUFFIX . '.css' ) );
		wp_enqueue_style( 'trim-child-style', get_theme_file_uri( '/style.css' ), false, '@@pkg.version', 'all' );
	} else {
		wp_enqueue_style( 'trim-style', get_theme_file_uri( '/style' . TRIM_ASSET_SUFFIX . '.css' ) );
	}

	// Load the standard WordPress comments reply javascript.
	if ( is_singular( 'post' ) && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Load custom theme styles.
	$theme_style = get_theme_mod( 'theme_style', trim_defaults( 'theme_style' ) );

	if ( 'theme_style_2' === $theme_style ) {
		wp_enqueue_style( 'trim-style-2', get_theme_file_uri( '/assets/styles/style-2/style-2.css' ) );
	}

	if ( 'theme_style_3' === $theme_style ) {
		wp_enqueue_style( 'trim-style-2', get_theme_file_uri( '/assets/styles/style-3/style-3.css' ) );
	}

	/**
	 * Now let's check the same for the scripts.
	 */
	if ( TRIM_DEBUG ) {

		// Vendor scripts.
		wp_enqueue_script( 'infinitescroll', get_theme_file_uri( '/assets/js/vendors/infinitescroll.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'trim-libraries', get_theme_file_uri( '/assets/js/vendors/custom-libraries.js' ), array( 'jquery' ), '@@pkg.version', true );

		// Custom scripts.
		wp_enqueue_script( 'trim-global', get_theme_file_uri( '/assets/js/custom/global.js' ), array( 'jquery' ), '@@pkg.version', true );

		$translation_handle = 'trim-global'; // Variable for wp_localize_script.

	} else {
		wp_enqueue_script( 'trim-vendors-min', get_theme_file_uri( '/assets/js/vendors.min.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'trim-custom-min', get_theme_file_uri( '/assets/js/custom.min.js' ), array( 'jquery' ), '@@pkg.version', true );

		$translation_handle = 'trim-custom-min'; // Variable for wp_localize_script for minified javascript.
	}

	if ( ! is_page_template( 'template-portfolio-fullscreen-slider.php' ) && ! is_page_template( 'template-underconstruction.php' ) ) {
		wp_enqueue_script( 'masonry' );
		wp_enqueue_script( 'infinitescroll' );
	}

	// Enqueue validation script.
	if ( is_page_template( 'template-contact.php' ) || is_singular( 'post' ) || is_singular( 'portfolio' ) ) {
		wp_enqueue_script( 'validation', 'https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', 'jquery', '1.9', true );
	}

	// Localize.
	wp_localize_script( $translation_handle, 'WP_TEMPLATE_DIRECTORY_URI', array( 0 => get_template_directory_uri() ) );

	wp_localize_script(
		$translation_handle,
		'trim_L10n',
		array(
			'name'           => __( 'Name', 'trim' ),
			'email'          => __( 'Email Address', 'trim' ),
			'message'        => __( 'Message', 'trim' ),
			'comments_name'  => __( 'Name', 'trim' ),
			'comments_email' => __( 'Email Address', 'trim' ),
			'comments_url'   => __( 'URL', 'trim' ),
			'comments_text'  => __( 'Comment', 'trim' ),
		)
	);

}
add_action( 'wp_enqueue_scripts', 'trim_scripts' );

function bean_getPostViews( $postID ) {
	$count_key = 'post_views_count';
	$count     = get_post_meta( $postID, $count_key, true );

	if ( $count == '' ) {
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
		return '0';
	}

	return $count;
}

function bean_setPostViews( $postID ) {
	$count_key = 'post_views_count';
	$count     = get_post_meta( $postID, $count_key, true );

	if ( $count == '' ) {
		$count = 0;
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
	} else {
		$count++;
		update_post_meta( $postID, $count_key, $count );
	}

}

function bean_get_related_posts( $post_id, $taxonomy, $args = array() ) {
	$terms = wp_get_object_terms( $post_id, $taxonomy );

	if ( count( $terms ) ) {
		$post      = get_post( $post_id );
		$our_terms = array();
		foreach ( $terms as $term ) {
			$our_terms[] = $term->slug;
		}

		$args  = wp_parse_args(
			$args, array(
				'post_type'    => $post->post_type,
				'post__not_in' => array( $post_id ),
				'tax_query'    => array(
					array(
						'taxonomy' => $taxonomy,
						'terms'    => $our_terms,
						'field'    => 'slug',
						'operator' => 'IN',
					),
				),
				'orderby'      => 'rand',
			)
		);
		$query = new WP_Query( $args );
		return $query;
	} else {
		return false;
	}
} //END if ( function( 'bean_get_related_posts' ) )


function bean_comment( $comment, $args, $depth ) {
	$isByAuthor = false;

	if ( $comment->comment_author_email == get_the_author_meta( 'email' ) ) {
		$isByAuthor = true;
	}

	$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>">

				<div class="comment-author vcard">
						<?php echo get_avatar( $comment, $size = '45' ); ?>
					<?php printf( __( '<cite class="fn">%s</cite> ', 'trim' ), get_comment_author_link() ); ?> <?php
					if ( $isByAuthor ) {
?>
<span class="author-tag"><?php _e( '(Author)', 'trim' ); ?></span><?php } ?>
			</div><!-- END .comment-author.vcard -->

			<div class="comment-meta commentmetadata subtext">
				<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( __( '%1$s at %2$s', 'trim' ), get_comment_date(), get_comment_time() ); ?></a><?php edit_comment_link( __( 'Edit', 'trim' ), ' &middot; ', '' ); ?>   &middot;
									<?php
									comment_reply_link(
										array_merge(
											$args, array(
												'depth' => $depth,
												'max_depth' => $args['max_depth'],
											)
										)
									);
?>
			</div><!-- END .comment-meta.commentmetadata.subtext -->

			<div class="comment-body">
				<?php if ( $comment->comment_approved == '0' ) : ?>
						<span class="moderation"><?php _e( 'Awaiting Moderation', 'trim' ); ?></span>
					<?php endif; ?>
			<?php comment_text(); ?>
			</div><!-- END .comment-body -->

		</div><!-- END #comment-<?php comment_ID(); ?> -->
	</li>
<?php
}

if ( ! function_exists( 'bean_ping' ) ) {
	function bean_ping( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		?>

		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>

		<?php
	}
}


function bean_custom_form_filters( $args = array(), $post_id = null ) {
	global $id;

	if ( null === $post_id ) {
		$post_id = $id;
	} else {
		$id = $post_id;
	}

	$commenter     = wp_get_current_commenter();
	$user          = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$fields = array(
		'author' => '
			<div class="comment-form-author clearfix">
				<label for="author">' . __( 'Name', 'trim' ) . ( '<span class="required">*</span>' ) . '</label>
				<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required/>
			</div>',

		'email'  => '
			<div class="comment-form-email clearfix">
			<label for="email">' . __( 'Email', 'trim' ) . ( '<span class="required">*</span>' ) . '</label>
				<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" required/>
			</div>',

		'url'    => '
			<div class="comment-form-url">
				<label for="url">' . __( 'Website', 'trim' ) . '</label>
				<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30"/>
			</div>',
	);

	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<div class="comment-form-message clearfix"><label for="comment">' . __( 'Comment', 'trim' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8"  required></textarea></div>',
		'',
		'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'trim' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as subtext">' . sprintf( __( 'Currently logged in as <a href="%1$s">%2$s</a> / <a href="%3$s" title="Log out of this account">Logout</a>', 'trim' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => null,
		'comment_notes_after'  => null,
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'class_submit'         => 'submit',
		'name_submit'          => 'submit',
		'submit_field'         => '<p class="form-submit">%1$s %2$s</a>',
		'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
		'title_reply'          => sprintf( __( '<span>Leave a Comment</span>', 'trim' ) ),
		'title_reply_to'       => __( 'Leave a Reply to %s', 'trim' ),
		'cancel_reply_link'    => __( 'Cancel', 'trim' ),
		'label_submit'         => __( 'Submit Comment', 'trim' ),
	);

	return $defaults;
}
add_filter( 'comment_form_defaults', 'bean_custom_form_filters' );

if ( ! function_exists( 'trim_pingback_header' ) ) :
	/**
	 * Add a pingback url auto-discovery header for singularly identifiable articles.
	 */
	function trim_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
		}
	}
	add_action( 'wp_head', 'trim_pingback_header' );
endif;

/**
 * Filter shortcodes in the post excerpt.
 */
add_filter( 'the_excerpt', 'do_shortcode' );

/**
 * Template tags.
 */
require get_theme_file_path( '/inc/template-tags.php' );

/**
 * Template functions.
 */
require get_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_theme_file_path( '/inc/customizer/customizer.php' );
require get_theme_file_path( '/inc/customizer/customizer-css.php' );
require get_theme_file_path( '/inc/customizer/defaults.php' );

/**
 * Metaboxes.
 */
require get_theme_file_path( '/inc/metaboxes/metaboxes.php' );
require get_theme_file_path( '/inc/metaboxes/meta-page.php' );
require get_theme_file_path( '/inc/metaboxes/meta-post.php' );
require get_theme_file_path( '/inc/metaboxes/meta-portfolio.php' );
require get_theme_file_path( '/inc/metaboxes/meta-download.php' );

/**
 * Media.
 */
require get_theme_file_path( '/inc/media.php' );

/**
 * Likes.
 */
require get_theme_file_path( '/inc/likes.php' );

/**
 * Widgets.
 */
require get_theme_file_path( '/inc/widgets/widget-cta.php' );
require get_theme_file_path( '/inc/widgets/widget-flickr.php' );
require get_theme_file_path( '/inc/widgets/widget-portfolio-menu.php' );
require get_theme_file_path( '/inc/widgets/widget-portfolio-taxonomy.php' );
require get_theme_file_path( '/inc/widgets/widget-portfolio.php' );

/**
 * Admin specific functions.
 */
require get_parent_theme_file_path( '/inc/admin/init.php' );

/**
 * Disable Merlin WP.
 */
function themebeans_merlin() {}

/**
 * Disable Dashboard Doc.
 */
function themebeans_guide() {}
