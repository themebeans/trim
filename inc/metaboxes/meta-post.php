<?php
/**
 * The file is for creating the blog post type meta.
 * Meta output is defined on the page editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

add_action( 'add_meta_boxes', 'bean_metabox_post' );
function bean_metabox_post() {

	// Start with an underscore to hide fields from custom fields list.
	$prefix = '_bean_';

	// Set the context, based on whether or not Gutenberg is enabled.
	$context = ( function_exists( 'register_block_type' ) ) ? 'side' : 'normal';

	/**
	 * Post Settings.
	 */
	$meta_box = array(
		'id'       => 'page-meta',
		'title'    => __( 'Post Settings', 'trim' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __( 'Grid Image URL:', 'trim' ),
				'desc' => __( 'Upload an image for the grid. ', 'trim' ),
				'id'   => $prefix . 'grid_feat_img',
				'type' => 'file',
				'std'  => '',
			),
		),
	);
	bean_add_meta_box( $meta_box );

	/*
	===================================================================*/
	/*
	  AUDIO POST FORMAT SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'bean-meta-box-audio',
		'title'    => __( 'Audio Post Format', 'trim' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __( 'MP3 File URL:', 'trim' ),
				'desc' => __( 'Upload or link to an MP3 file.', 'trim' ),
				'id'   => $prefix . 'audio_mp3',
				'type' => 'file',
				'std'  => '',
			),
		),
	);
	bean_add_meta_box( $meta_box );

	/*
	===================================================================*/
	/*
	  GALLERY POST FORMAT SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'bean-meta-box-gallery',
		'title'    => __( 'Image Post Format', 'trim' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => 'Gallery Images:',
				'desc' => 'Upload images here for your gallery post. Once uploaded, drag & drop to reorder.',
				'id'   => $prefix . 'post_upload_images',
				'type' => 'images',
				'std'  => __( 'Browse & Upload', 'trim' ),
			),
			array(
				'name' => __( 'Randomize Gallery:', 'trim' ),
				'id'   => $prefix . 'post_randomize',
				'type' => 'checkbox',
				'desc' => __( 'Randomize the gallery on page load.', 'trim' ),
				'std'  => false,
			),
		),
	);
	bean_add_meta_box( $meta_box );

	/*
	===================================================================*/
	/*
	  LINK POST FORMAT SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'bean-meta-box-link',
		'title'    => __( 'Link Post Format', 'trim' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __( 'Link Title:', 'trim' ),
				'desc' => __( 'The title for your link.', 'trim' ),
				'id'   => $prefix . 'link_title',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => __( 'Link URL:', 'trim' ),
				'desc' => __( 'ex: http://themebeans.com', 'trim' ),
				'id'   => $prefix . 'link_url',
				'type' => 'text',
				'std'  => 'http://',
			),
		),

	);
	bean_add_meta_box( $meta_box );

	/*
	===================================================================*/
	/*
	  QUOTE POST FORMAT SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'bean-meta-box-quote',
		'title'    => __( 'Quote Post Format', 'trim' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __( 'Quote Text:', 'trim' ),
				'desc' => __( 'Insert your quote into this textarea.', 'trim' ),
				'id'   => $prefix . 'quote',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => __( 'Quote Source:', 'trim' ),
				'desc' => __( 'Who said the quote above?', 'trim' ),
				'id'   => $prefix . 'quote_source',
				'type' => 'text',
				'std'  => '',
			),
		),

	);
	bean_add_meta_box( $meta_box );

	/*
	===================================================================*/
	/*
	  VIDEO POST FORMAT SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'bean-meta-box-video',
		'title'    => __( 'Video Post Format', 'trim' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __( 'Embeded Code:', 'trim' ),
				'desc' => __( 'Include your video embed code here.', 'trim' ),
				'id'   => $prefix . 'video_embed',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => __( 'Embeded Video URL:', 'trim' ),
				'desc' => __( 'The direct URL to your embedded video.', 'trim' ),
				'id'   => $prefix . 'video_embed_url',
				'type' => 'text',
				'std'  => '',
			),
		),
	);
	bean_add_meta_box( $meta_box );
} // END function bean_metabox_post()
