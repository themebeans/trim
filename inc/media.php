<?php
/**
 * This file contains the media functions for the theme.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

if ( ! function_exists( 'bean_gallery' ) ) {
	function bean_gallery( $postid, $imagesize = '', $layout = '', $orderby = '', $single = false ) {
		$thumb_ID      = get_post_thumbnail_id( $postid );
		$image_ids_raw = get_post_meta( $postid, '_bean_image_ids', true );

		if ( $image_ids_raw != '' ) {
			$image_ids   = explode( ',', $image_ids_raw );
			$post_parent = null;
		} else {
			$image_ids   = '';
			$post_parent = $postid;
		}

		// PULL THE IMAGE ATTACHMENTS
		$args        = array(
			'exclude'        => $thumb_ID,
			'include'        => $image_ids,
			'numberposts'    => -1,
			'orderby'        => $orderby,
			'order'          => 'ASC',
			'post_type'      => 'attachment',
			'post_parent'    => $post_parent,
			'post_mime_type' => 'image',
			'post_status'    => null,
		);
		$attachments = get_posts( $args );

		// IF THE FUNCTION'S LAYOUT IS CALLING FOR THE SLIDER
		if ( $layout == 'slider' ) {
			// TRANSFER RANDO META FOR TRUE/FALSE SLIDE RANDOMIZE
			if ( $orderby == 'rand' ) {
				$orderby_slides = 'true';
			} else {
				$orderby_slides = 'false';
			}
			?>

			<script type="text/javascript">
				jQuery(document).ready(function($){
					jQuery('#slider-<?php echo esc_js( $postid ); ?>').flexslider({
						namespace: "bean-",
						animation: "fade",
						slideshow: true,
						animationLoop: true,
						randomize: <?php echo esc_js( $orderby_slides ); ?>,
						directionNav: true,
						controlNav: true,
						smoothHeight: false,
						touch: true,
						prevText: "",
						nextText: "",
						start: function (slider) {
							if (typeof slider.container === 'object') {
								slider.container.click(function (e) {
									if (!slider.animating) {
										slider.flexAnimate(slider.getTarget('next'));
									}
								});
							}
						}
					});
				});
			</script>

			<div class="post-slider">
				<div id="slider-<?php echo $postid; ?>" class="flexslider">
					<ul class="slides">
						<?php
						if ( ! empty( $attachments ) ) {
							$i = 0;
							foreach ( $attachments as $attachment ) {
								$src     = wp_get_attachment_image_src( $attachment->ID, $imagesize );
								$caption = $attachment->post_excerpt;
								$caption = ( $caption ) ? "<div class='bean-image-caption subtext'>$caption</div>" : '';
								$alt     = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
								echo "<li>$caption<img height='$src[2]' src='$src[0]' alt='$alt'/></li>";
							}
						} // END if( !empty($attachments) )
					?>
				</ul><!-- END .slides -->
			</div><!-- END #slider-$postid -->
		</div><!-- END .post-slider -->

		<?php
		} // END if( $layout == 'slider' )

		// IF THE FUNCTION'S LAYOUT IS CALLING FOR THE STANDARD PORTFOLIO SINGLE
		if ( $layout == 'stacked' ) {
			if ( ! empty( $attachments ) ) {
				?>

				<ul class="stacked">
					<?php
					foreach ( $attachments as $attachment ) {
						$caption = $attachment->post_excerpt;
						$caption = ( $caption ) ? "<div class='bean-image-caption subtext'>$caption</div>" : '';
						$alt     = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;

						$src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
						?>

						<li>
							<?php echo "<img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />$caption"; ?>
						</li>
				<?php } //END foreach( $attachments as $attachment ) ?>
			</ul>

			<?php
			} // END if( !empty($attachments) )
		} // END if( $layout == 'std-portfolio-single' )

		if ( $layout == 'portfolio-lightbox' ) {
			if ( ! empty( $attachments ) ) {
			?>

			  <ul class="stacked">

					<?php
					 $i = 1;

					foreach ( $attachments as $attachment ) {

						$hidden = ( $i != 1 ) ? ' hidden' : '';

						$src           = wp_get_attachment_image_src( $attachment->ID, $imagesize );
						$src_lrg       = wp_get_attachment_image_src( $attachment->ID, 'port-full' );
						$caption       = $attachment->post_excerpt;
						$caption_front = ( $caption ) ? "<div class='bean-image-caption subtext'>$caption</div>" : '';
						$alt           = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
						$src           = wp_get_attachment_image_src( $attachment->ID, 'port-full' );
						?>

							   <li><?php echo '<a data-fancybox href="' . $src[0] . '" class="lightbox ' . $hidden . '" title="' . htmlspecialchars( $caption ) . '" rel="' . $postid . '" alt="' . $alt . '"><span class="lightbox-image"/></span><img src="' . $src[0] . '"/></a>' . $caption_front . ''; ?></li>

						<?php
					}
					?>

					</ul>

			<?php
			}
		}

		if ( $layout == 'fullscreen' ) {
			?>
			<div id="slider-<?php echo $postid; ?>" class="home-slider fadein
										<?php
										if ( $portfolio_content_display == 'off' ) {
											echo ' no-content'; }
				?>
				">

				<?php
				$animation     = get_post_meta( $postid, '_bean_fullscreen_animation', true );
				$animation     = ( $animation == 'slide' ) ? "'slide'" : "'fade'";
				$autoplay      = get_post_meta( $postid, '_bean_fullscreen_autoplay', true );
				$autoplay_time = get_post_meta( $postid, '_bean_fullscreen_autoplay_time', true );
				$pagination    = get_post_meta( $postid, '_bean_fullscreen_pagination', true );
				$lightbox      = get_post_meta( $postid, '_bean_gallery_layout', true );
				?>

				<script type="text/javascript">
				   jQuery(document).ready(function($){
					   $('#slider-<?php echo esc_js( $postid ); ?>').superslides({
						   animation: <?php echo esc_js( $animation ); ?>,
						   pagination:
							<?php
							if ( 'on' === $pagination ) {
								echo esc_js( 'true' );
							} else {
								echo esc_js( 'false' ); }
	?>
	,
							<?php
							if ( 'on' === $autoplay ) {
								echo esc_js( 'play: ' . $autoplay_time . ' ' ); }
							?>
					   });
				   });
				</script>

				<ul class="slides-container">

					<?php
					if ( ! empty( $attachments ) ) {
						foreach ( $attachments as $attachment ) {
							$caption    = $attachment->post_excerpt;
							$caption    = ( $caption ) ? "<div class='bean-image-caption subtext fadein'>$caption</div>" : '';
							$alt        = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
							$src        = wp_get_attachment_image_src( $attachment->ID, $imagesize );
							$caption_lb = $attachment->post_excerpt;
							?>

							<li>
								<?php if ( $lightbox == 'portfolio-lightbox' ) { ?>
									<?php echo '' . $caption . '<a href="' . $src[0] . '" class="lightbox " title="' . htmlspecialchars( $caption_lb ) . '" rel="' . $postid . '" alt="' . $alt . '"><img height=' . $src[2] . ' width=' . $src[1] . ' src=' . $src[0] . ' alt=' . $alt . ' /></a>'; ?>
								<?php } else { ?>
									<?php echo "$caption<img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />"; ?>
								<?php } ?>
							</li>

							<?php
						} //END foreach( $attachments as $attachment )
					} // END if( !empty($attachments) )
					?>

				</ul><!-- END .slides -->

				<nav class="slides-navigation">
					<a href="#" class="next"><?php _e( 'Next', 'trim' ); ?></a>
					<a href="#" class="prev"><?php _e( 'Previous', 'trim' ); ?></a>
				</nav>

			</div><!-- END #slider-$postid -->

			<ul class="home-slider-mobile
			<?php
			if ( $lightbox == ' portfolio-lightbox' ) {
				echo ' lb-layout'; }
				?>
				">

				<?php
				if ( ! empty( $attachments ) ) {
					foreach ( $attachments as $attachment ) {
						$caption = $attachment->post_excerpt;
						$caption = ( $caption ) ? "<div class='bean-image-caption subtext fadein'>$caption</div>" : '';
						$alt     = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
						$src     = wp_get_attachment_image_src( $attachment->ID, 'port-full' );
						?>

						<li>
							<?php if ( $lightbox == 'portfolio-lightbox' ) { ?>
									<?php echo '<a href="' . esc_url( $src[0] ) . '" class="lightbox " title="' . htmlspecialchars( $caption ) . '" rel="' . esc_attr( $postid ) . '" alt="' . esc_attr( $alt ) . '"><img height=' . esc_attr( $src[2] ) . ' width=' . esc_attr( $src[1] ) . ' src=' . esc_url( $src[0] ) . ' alt=' . esc_attr( $alt ) . ' /></a>' . esc_html( $caption ) . ''; ?>
							<?php } else { ?>
									<?php echo "<img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />$caption"; ?>
							<?php } ?>
						</li>

						<?php
					}
				}
				?>

			</ul><!-- END .home-slider-mobile -->
		<?php
		} // END if( $layout == 'fullscreen' )

		if ( $layout == 'post-lightbox' ) {

			$fullwidth_media = get_post_meta( $postid, '_bean_fullwidth_media', true );

			if ( ! empty( $attachments ) ) {
				$i = 1;

				foreach ( $attachments as $attachment ) {

					$hidden = ( $i != 1 ) ? ' hidden' : '';

					$feat_image_url  = wp_get_attachment_url( get_post_thumbnail_id( $postid ) );
					$fullwidth_image = get_post_meta( $postid, '_bean_fullwidth_image', true );
					$src             = wp_get_attachment_image_src( $attachment->ID, $imagesize );
					$caption         = $attachment->post_excerpt;

					echo "<a data-fancybox class='lightbox $hidden' rel='$postid' href='$src[0]' title=" . htmlspecialchars( $caption ) . '>';
						echo "<span class='lightbox-image'/> </span>";
						echo "<img src='$feat_image_url' />";
					echo '</a>';

						$i++;
				}
			}
		}

	} // END function bean_gallery
} // END if ( !function_exists( 'bean_gallery' ) )




/*
===================================================================*/
/*
  AUDIO POST FORMAT FUNCTION
/*===================================================================*/
if ( ! function_exists( 'bean_audio' ) ) {
	function bean_audio( $postid ) {
		// MP3 FROM POST/PORTFOLIO
		$mp3 = get_post_meta( $postid, '_bean_audio_mp3', true );
		?>

		<div id="jp_container_<?php echo esc_attr( $postid ); ?>" class="jp-audio fullwidth" data-file="<?php echo esc_url( $mp3 ); ?>">
			<div id="jquery_jplayer_<?php echo esc_attr( $postid ); ?>" class="jp-jplayer">
			</div>
			<div class="jp-interface" style="display: none;">
				<ul class="jp-controls">
					<li><a href="javascript:;" class="jp-play" tabindex="1" title="Play"><span><?php _e( 'Play', 'trim' ); ?></span></a></li>
					<li><a href="javascript:;" class="jp-pause" tabindex="1" title="Pause"><span><?php _e( 'Pause', 'trim' ); ?></span></a></li>
				</ul><!-- END .jp-controls -->
				<div class="jp-progress">
					<div class="jp-seek-bar">
						<div class="jp-play-bar"></div>
					</div><!-- END .jp-seek-bar -->
				</div><!-- END .jp-progress -->
			</div><!-- END .jp-interface -->
		</div>

		<?php
	} // END function bean_audio($postid)
} // END if ( !function_exists( 'bean_audio' ) )
