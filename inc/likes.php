<?php
/**
 * Functions for post/portfolio likes feature.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

function Bean_Like_This( $post_id, $action = 'get' ) {
	if ( ! is_numeric( $post_id ) ) {
		error_log( 'Error: Value submitted for post_id was not numeric' );
		return;
	}

	switch ( $action ) {
		case 'get':
			$data = get_post_meta( $post_id, '_likes' );

			if ( ! is_numeric( $data[0] ) ) {
				$data[0] = 0;
				add_post_meta( $post_id, '_likes', '0', true );
			}

			return $data[0];
		break;
		case 'update':
			if ( isset( $_COOKIE[ 'like_' + $post_id ] ) ) {
				return;
			}

			$currentValue = get_post_meta( $post_id, '_likes' );

			if ( ! is_numeric( $currentValue[0] ) ) {
				$currentValue[0] = 0;
				add_post_meta( $post_id, '_likes', '1', true );
			}

			$currentValue[0]++;
			update_post_meta( $post_id, '_likes', $currentValue[0] );

			setcookie( 'like_' + $post_id, $post_id, time() * 20, '/' );
			break;

	}
}

function Bean_PrintLikes( $post_id ) {
	$likes = Bean_Like_This( $post_id );

	$likeword = ' Likes ';
	$who      = ' people like ';

	if ( $likes == 1 ) {
		$who      = ' person likes ';
		$likeword = ' Like ';
	}

	if ( isset( $_COOKIE[ 'like_' + $post_id ] ) ) {
		print '<a href="#" class="bean-likes active" id="like-' . $post_id . '">' . $likes . '</a>';
			return;
	}
		print '<a href="#" class="bean-likes" id="like-' . $post_id . '">' . $likes . '</a>';
}

function Bean_SetUpPostLikes( $post_id ) {
	if ( ! is_numeric( $post_id ) ) {
		error_log( 'Error: Value submitted for post_id was not numeric' );
		return;
	}
	add_post_meta( $post_id, '_likes', '0', true );
}

function checkHeaders() {
	if ( isset( $_POST['likepost'] ) ) {
		Bean_Like_This( $_POST['likepost'], 'update' );
	}
}

function jsIncludes() {
	wp_enqueue_script( 'jquery' );
}

add_action( 'publish_post', 'Bean_SetUpPostLikes' );
add_action( 'init', 'checkHeaders' );
add_action( 'get_header', 'jsIncludes' );
