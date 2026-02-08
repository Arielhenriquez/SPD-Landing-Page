<?php
/**
 * Video thumb
 *
 * This template can be overridden by copying it to yourtheme/wp-carousel-pro/templates/loop/video-type/image.php
 *
 * @package WP_Carousel_Pro
 */

?>
<div class="wpcp-slide-image">
<?php
if ( filter_var( $image_src, FILTER_VALIDATE_URL ) ) {
	if ( ! $image_width_attr && $image_src ) {
		// The Dailymotion thumbnail image is excluded as this URL redirects to the actual image.
		if ( strpos( $image_src, 'https://dailymotion.com/thumbnail/' ) !== false ) {
			$image_attr = array( '', '' );
		} else {
			$image_attr = @getimagesize( $image_src );
		}
		$image_width_attr  = isset( $image_attr[0] ) ? $image_attr[0] : $image_width_attr;
		$image_height_attr = isset( $image_attr[1] ) ? $image_attr[1] : $image_height_attr;
	}
	$image_attr = array(
		'src'    => $image_src,
		'width'  => $image_width_attr,
		'height' => $image_height_attr,
	);
	$video_slug = 'lightbox' === $video_play_mode ? self::get_item_slug( $video_url ) : '';
	$image_tag  = self::image_tag( $lazy_load_image, $carousel_mode, $image_attr, $video_thumb_alt_text, '', $lazy_load_img, $wpcp_layout, $video_slug );

	if ( $thumbnail_slider ) {
		?>
		<img src="<?php echo esc_url( $image_src ); ?>"  width="<?php echo esc_attr( $image_width_attr ); ?>" height="<?php echo esc_attr( $image_height_attr ); ?>" alt="<?php echo esc_attr( $video_thumb_alt_text ); ?>">
		<?php
	} elseif ( 'lightbox' === $video_play_mode && ( 'wistia' === $sp_url['video_type'] || 'tiktok' === $sp_url['video_type'] || 'twitch' === $sp_url['video_type'] ) ) {
		?>
		<a class="wcp-video" data-fancybox="wpcp_view" data-type="iframe" data-buttons='["zoom","slideShow","fullScreen","share","download","thumbs","close"]' href="<?php echo esc_url( $video_url ); ?>">
		<?php echo $image_tag; // phpcs:ignore ?>
			<i class="fa fa-play-circle-o" aria-hidden="true"></i>
		</a>
			<?php
	} else {

		if ( 'lightbox' === $video_play_mode ) {
			?>
			<a class="wcp-video" data-fancybox="wpcp_view" data-buttons='["zoom","slideShow","fullScreen","share","download","thumbs","close"]' href="<?php echo esc_url( $video_url ); ?>" data-item-slug="<?php echo esc_attr( self::get_item_slug( $video_url ) ); ?>">
			<?php
			echo $image_tag; // phpcs:ignore 
			if ( isset( $sp_url['video_url'] ) && ! empty( $sp_url['video_url'] ) ) {
				?>
				<i class="fa fa-play-circle-o" aria-hidden="true"></i>
			<?php } ?>
			</a>
			<?php
		} else { // Inline mode.
			?>
			<div class="wcp-video-iframe-wrapper">
				<div class="wcp-video-section wcp-video-inline-mode <?php echo esc_attr( $sp_url['video_type'] ); ?>">
					<!-- Display Video Thumbnail -->
					<?php echo $image_tag; // phpcs:ignore ?>
					<!-- Play Button Icon -->
					<button><i class="fa fa-play-circle-o" aria-hidden="true"></i></button>
					<?php if ( 'youtube' === $sp_url['video_type'] ) : ?>
					<!-- YouTube Video Embed -->
					<div class="wcp-video-iframe-wrapper wcp-inline-video-youtube" data-embed="<?php echo esc_attr( $sp_url['video_id'] ); ?>" data-fancybox data-src="<?php echo esc_url( $video_url ); ?>" data-type="<?php echo esc_attr( $sp_url['video_type'] ); ?>" data-width="600" data-height="400" data-autoplay="<?php echo esc_attr( $video_autoplay ); ?>" data-loop="<?php echo esc_attr( $video_loop ); ?>">
						</div>

						<?php
					elseif ( 'vimeo' === $sp_url['video_type'] ) :
						// Extract the video ID.
						$query_position = strpos( $video_url, '?' );
						$base_url       = $query_position ? substr( $video_url, 0, $query_position ) : $video_url;
						$video_id       = substr( $base_url, strrpos( $base_url, '/' ) + 1 );

						// Retain query parameters if present (e.g., autoplay=1&muted=1).
						$query_string = $query_position ? substr( $video_url, $query_position ) : '';
						$query_string = str_replace( 'muted=1', 'muted=0', $query_string );
						// Update the URL to embed format.
						$sp_url['video_url'] = 'https://player.vimeo.com/video/' . $video_id . $query_string;
						?>
						<!-- Vimeo Video Embed -->
					<div class="skip-lazy wcp-iframe wcp-lazy-load-video" data-embed="<?php echo esc_attr( $sp_url['video_url'] ); ?>" allowfullscreen data-autoplay="<?php echo esc_attr( $video_autoplay ); ?>" data-loop="<?php echo esc_attr( $video_loop ); ?>">
					</div>

						<?php
					elseif ( 'sproutvideo' === $sp_url['video_type'] ) :

						// Get video autoplay and loop settings.
						$video_autoplay = ( '1' == $shortcode_data['video_autoplay_mode'] ) ? 'true' : 'false';
						$video_loop     = ( '1' == $shortcode_data['video_loop'] ) ? 'true' : 'false';
						?>

						<div class="skip-lazy wcp-iframe wcp-lazy-load-video" 
							data-embed="<?php echo esc_attr( $sp_url['video_url'] ); ?>?muted=true&autoPlay=<?php echo esc_attr( $video_autoplay ); ?>&loop=<?php echo esc_attr( $video_loop ); ?>" 
							allowfullscreen 
							data-autoplay="<?php echo esc_attr( $video_autoplay ); ?>" data-loop="<?php echo esc_attr( $video_loop ); ?>" style="min-height: 150px;">

							<img src="<?php echo esc_url( $sp_url['video_thumb_url'] ); ?>" alt="Video thumbnail" class="lazyload-preview" />
							<div class="wcp-play-button-overlay"></div>
						</div>

						<?php
					elseif ( isset( $sp_url['video_url'] ) && ! empty( $sp_url['video_url'] ) ) :
						$video_url = isset( $sp_url['video_url'] ) ? $sp_url['video_url'] : '';

						// Check if the URL is a DailyMotion video URL.
						if ( strpos( $video_url, 'dailymotion.com/video/' ) !== false ) {
							// Extract the video ID.
							$video_id = substr( $video_url, strrpos( $video_url, '/' ) + 1 );
							// Update the URL to embed format.
							$sp_url['video_url'] = 'https://www.dailymotion.com/embed/video/' . $video_id;
						}
						?>
						<!-- Custom Video Embed -->
					<div class="skip-lazy wcp-iframe wcp-lazy-load-video" data-embed="<?php echo esc_attr( $sp_url['video_url'] ); ?>" data-autoplay="<?php echo esc_attr( $video_autoplay ); ?>" data-loop="<?php echo esc_attr( $video_loop ); ?>"></div>
					<?php endif; ?>
				</div>
			</div>
			<?php
		}
	}
}
?>
</div>
