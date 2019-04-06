<?php
/**
 * The file is for displaying the single portfolio media
 * It is called via single-portfolio.php
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

/*
===================================================================*/
/*
  GET PORTFOLIO META
/*
===================================================================*/
// PORTFOLIO TYPES
$portfolio_type_audio = get_post_meta( $post->ID, '_bean_portfolio_type_audio', true );
$portfolio_type_video = get_post_meta( $post->ID, '_bean_portfolio_type_video', true );

// AUDIO META
$audio_mp3 = get_post_meta( $post->ID, '_bean_audio_mp3', true );

// VIDEO META
$embed  = get_post_meta( $post->ID, '_bean_portfolio_embed_code', true );
$embed2 = get_post_meta( $post->ID, '_bean_portfolio_embed_code_2', true );
$embed3 = get_post_meta( $post->ID, '_bean_portfolio_embed_code_3', true );
$embed4 = get_post_meta( $post->ID, '_bean_portfolio_embed_code_4', true );


if ( ! post_password_required() ) { // START PASSWORD PROTECTED


	/*
	===================================================================*/
	/*
	  AUDIO PORTFOLIO
	/*===================================================================*/
	if ( $portfolio_type_audio == 'on' ) {
		if ( $audio_mp3 ) { ?>

			<div class="audio-no-feat">
				<?php bean_audio( $post->ID ); ?>
			</div><!-- END .audio-no-feat -->

		<?php
		}//END if ( $audio_mp3 )
	} // END if ( $portfolio_type_audio == 'on')




	/*
	===================================================================*/
	/*
	  VIDEO PORTFOLIO
	/*===================================================================*/
	if ( $portfolio_type_video == 'on' ) {
		if ( $embed ) {
			echo '<div class="video-frame">';
				echo stripslashes( htmlspecialchars_decode( $embed ) );
			echo '</div>';

		} //END if($embed)

		if ( $embed2 ) {
			echo '<div class="video-frame">';
				echo stripslashes( htmlspecialchars_decode( $embed2 ) );
			echo '</div>';

		} //END if($embed2)

		if ( $embed3 ) {
			echo '<div class="video-frame">';
				echo stripslashes( htmlspecialchars_decode( $embed3 ) );
			echo '</div>';

		} //END if($embed3)

		if ( $embed4 ) {
			echo '<div class="video-frame">';
				echo stripslashes( htmlspecialchars_decode( $embed4 ) );
			echo '</div>';

		} //END if($embed4)
	} // END if ( $portfolio_type_video == 'on')
} //END if ( !post_password_required() )
