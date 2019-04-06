<?php
/**
 * The template for displaying posts in the Video post format.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

// META
$embed           = get_post_meta( $post->ID, '_bean_video_embed', true );
$video_embed_url = get_post_meta( $post->ID, '_bean_video_embed_url', true );
$grid_feat_img   = get_post_meta( $post->ID, '_bean_grid_feat_img', true );

// USE GRID IMAGE IF ADDED
if ( $grid_feat_img ) {
	$feat_image = get_post_meta( $post->ID, '_bean_grid_feat_img', true );

} else {
	$feat_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
}

if ( $video_embed_url ) {
	echo '<a data-fancybox class="lightbox fancybox.iframe" href="' . esc_url( $video_embed_url ) . '">';
		echo '<span class="lightbox-play"></span>';
		echo '<img src=' . esc_url( $feat_image ) . '>';
	echo '</a>';
} else {
	if ( $embed ) {
		echo stripslashes( htmlspecialchars_decode( $embed ) );
	}
}
