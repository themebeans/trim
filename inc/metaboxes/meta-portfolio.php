<?php
/**
 * The file is for creating the portfolio post type meta.
 * Meta output is defined on the portfolio single editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

/**
 * Portfolio metaboxes.
 */
function bean_metabox_portfolio() {

	$prefix = '_bean_';

	$meta_box = array(
		'id'       => 'portfolio-type',
		'title'    => __( 'Portfolio Format', 'trim' ),
		'page'     => 'portfolio',
		'context'  => 'side',
		'priority' => 'core',
		'fields'   => array(
			array(
				'name' => __( 'Gallery', 'trim' ),
				'id'   => $prefix . 'portfolio_type_gallery',
				'desc' => __( '', 'trim' ),
				'type' => 'checkbox',
				'std'  => true,
			),
			array(
				'name' => __( 'Audio', 'trim' ),
				'id'   => $prefix . 'portfolio_type_audio',
				'desc' => __( '', 'trim' ),
				'type' => 'checkbox',
				'std'  => false,
			),
			array(
				'name' => __( 'Video', 'trim' ),
				'id'   => $prefix . 'portfolio_type_video',
				'desc' => __( '', 'trim' ),
				'type' => 'checkbox',
				'std'  => false,
			),
		),
	);
	bean_add_meta_box( $meta_box );

	$meta_box = array(
		'id'       => 'portfolio-meta',
		'title'    => __( 'Portfolio Settings', 'trim' ),
		'page'     => 'portfolio',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name'    => __( 'Portfolio Layout:', 'trim' ),
				'desc'    => __( 'Choose the layout for this portfolio post.', 'trim' ),
				'id'      => $prefix . 'portfolio_layout',
				'type'    => 'select',
				'std'     => 'std',
				'options' => array(
					'default'    => __( 'Default', 'trim' ),
					'fullwidth'  => __( 'Fullwidth Stacked', 'trim' ),
					'fullscreen' => __( 'Fullscreen Slider', 'trim' ),
					'std'        => __( 'Standard', 'trim' ),
				),
			),
			array(
				'name' => __( 'Portfolio Client:', 'trim' ),
				'desc' => __( 'Display the client meta.', 'trim' ),
				'id'   => $prefix . 'portfolio_client',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => __( 'Portfolio URL:', 'trim' ),
				'desc' => __( 'Insert a URL to link your post to.', 'trim' ),
				'id'   => $prefix . 'portfolio_url',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => __( 'Display Custom Meta:', 'trim' ),
				'id'   => $prefix . 'portfolio_custom_meta',
				'type' => 'checkbox',
				'desc' => __( 'Display any custom meta fields.', 'trim' ),
				'std'  => false,
			),
			array(
				'name' => __( 'Display Date:', 'trim' ),
				'id'   => $prefix . 'portfolio_date',
				'type' => 'checkbox',
				'desc' => __( 'Can be modified in your Dashboard General Settings.', 'trim' ),
				'std'  => true,
			),
			array(
				'name' => __( 'Display Categories:', 'trim' ),
				'id'   => $prefix . 'portfolio_cats',
				'type' => 'checkbox',
				'desc' => __( 'Select to display the portfolio categories.', 'trim' ),
				'std'  => true,
			),
			array(
				'name' => __( 'Display Tags:', 'trim' ),
				'id'   => $prefix . 'portfolio_tags',
				'type' => 'checkbox',
				'desc' => __( 'Select to display the portfolio tags.', 'trim' ),
				'std'  => false,
			),
			array(
				'name' => __( 'Display More Posts:', 'trim' ),
				'id'   => $prefix . 'portfolio_more',
				'type' => 'checkbox',
				'desc' => __( 'Display a portfolio grid below your post.', 'trim' ),
				'std'  => true,
			),
			array(
				'name' => __( 'Portfolio Review:', 'trim' ),
				'desc' => __( 'Add a review section to your standard or fullwidth layout post.', 'trim' ),
				'id'   => $prefix . 'portfolio_review',
				'type' => 'textarea',
				'std'  => '',
			),
		),
	);
	bean_add_meta_box( $meta_box );

	$meta_box = array(
		'id'       => 'bean-meta-box-portfolio-images',
		'title'    => __( 'Gallery Settings', 'trim' ),
		'page'     => 'portfolio',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name'    => __( 'Gallery Layout:', 'trim' ),
				'desc'    => __( 'Choose which layout to display for this portfolio post.', 'trim' ),
				'id'      => $prefix . 'gallery_layout',
				'type'    => 'select',
				'std'     => 'stacked',
				'options' => array(
					'stacked'            => __( 'Standard', 'trim' ),
					'portfolio-lightbox' => __( 'Lightbox Viewer', 'trim' ),
				),
			),
			array(
				'name' => __( 'Gallery Images:', 'trim' ),
				'desc' => __( 'Upload images here for your gallery post. Once uploaded, drag & drop to reorder.', 'trim' ),
				'id'   => $prefix . 'portfolio_upload_images',
				'type' => 'images',
				'std'  => __( 'Browse & Upload', 'trim' ),
			),
			array(
				'name' => __( 'Randomize Gallery:', 'trim' ),
				'id'   => $prefix . 'portfolio_randomize',
				'type' => 'checkbox',
				'desc' => __( 'Randomize the gallery on page load.', 'trim' ),
				'std'  => false,
			),
			array(
				'name' => __( 'Fullscreen Image:', 'trim' ),
				'desc' => __( 'Upload an image to deploy on the Fullscreen & Fullwidth Portfolio Templates.', 'trim' ),
				'id'   => $prefix . 'home_slider_image',
				'type' => 'file',
				'std'  => '',
			),
			array(
				'name' => __( 'Feature in Home Slider:', 'trim' ),
				'id'   => $prefix . 'portfolio_feature',
				'type' => 'checkbox',
				'desc' => __( 'Featured this post on the Fullscreen Portfolio Template.', 'trim' ),
				'std'  => true,
			),
		),
	);
	bean_add_meta_box( $meta_box );

	$meta_box = array(
		'id'       => 'bean-meta-box-portfolio-slideshow',
		'title'    => __( 'Fullscreen Slideshow Settings', 'trim' ),
		'page'     => 'portfolio',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name'    => __( 'Slideshow Animation', 'trim' ),
				'desc'    => __( 'Select the animation style for this post.', 'trim' ),
				'id'      => $prefix . 'fullscreen_animation',
				'type'    => 'select',
				'std'     => 'slide',
				'options' => array(
					'slide' => __( 'Slide', 'trim' ),
					'fade'  => __( 'Fade', 'trim' ),
				),
			),
			array(
				'name' => __( 'Display Pagination:', 'trim' ),
				'id'   => $prefix . 'fullscreen_pagination',
				'desc' => __( 'Select to display the slide pagination.', 'trim' ),
				'type' => 'checkbox',
				'std'  => false,
			),
			array(
				'name' => __( 'Autoplay Slideshow', 'trim' ),
				'id'   => $prefix . 'fullscreen_autoplay',
				'type' => 'checkbox',
				'desc' => __( 'Select to autoplay the fullscreen slideshow.', 'trim' ),
				'std'  => false,
			),
			array(
				'name' => __( 'Autoplay Time:', 'trim' ),
				'id'   => $prefix . 'fullscreen_autoplay_time',
				'desc' => __( 'The time in milliseconds for the slideshow to animate.', 'trim' ),
				'type' => 'text',
				'std'  => '5000',
			),
		),
	);
	bean_add_meta_box( $meta_box );

	$meta_box = array(
		'id'       => 'bean-meta-box-portfolio-audio',
		'title'    => __( 'Audio Post Format Settings', 'trim' ),
		'page'     => 'portfolio',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __( 'MP3 File URL:', 'trim' ),
				'id'   => $prefix . 'audio_mp3',
				'type' => 'file',
				'std'  => '',
			),
		),
	);
	bean_add_meta_box( $meta_box );

	$meta_box = array(
		'id'       => 'bean-meta-box-portfolio-video',
		'title'    => __( 'Video Post Format Settings', 'trim' ),
		'page'     => 'portfolio',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __( 'Embed 1:', 'trim' ),
				'desc' => __( 'Insert your embeded code here.', 'trim' ),
				'id'   => $prefix . 'portfolio_embed_code',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => __( 'Embed 2:', 'trim' ),
				'desc' => __( 'Insert your embeded code here.', 'trim' ),
				'id'   => $prefix . 'portfolio_embed_code_2',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => __( 'Embed 2:', 'trim' ),
				'desc' => __( 'Insert your embeded code here.', 'trim' ),
				'id'   => $prefix . 'portfolio_embed_code_3',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => __( 'Embed 3:', 'trim' ),
				'desc' => __( 'Insert your embeded code here.', 'trim' ),
				'id'   => $prefix . 'portfolio_embed_code_4',
				'type' => 'textarea',
				'std'  => '',
			),
		),

	);
	bean_add_meta_box( $meta_box );
}
add_action( 'add_meta_boxes', 'bean_metabox_portfolio' );
