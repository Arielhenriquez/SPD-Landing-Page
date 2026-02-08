<?php
/**
 * The image carousel template.
 *
 * @package WP_Carousel_Pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

$is_youtube_feed = ( 'youtube_feed' === $wpcp_external_source_type );

if ( $is_youtube_feed ) {

	// Get YouTube Thumbnail.
	$thumb_src = '';
	$enclosure = $item->get_enclosure();

	// Get youtube video URL.
	$video_url = $item->get_link();

	// YouTube video title.
	$youtube_title = $item->get_title();

	// Get youtube video ID from URL.
	$video_url = str_replace( 'shorts/', 'watch?v=', $video_url ); // Convert shorts URL to standard watch URL.
	preg_match( '/v=([^&]+)/', $video_url, $matches );
	$video_id = $matches[1] ?? '';

	if ( $enclosure && $enclosure->get_thumbnail() ) {
		$thumb_src = $enclosure->get_thumbnail();
	}
}

// Get first image from feed content if the feature image is not found.
if ( ! $thumb_src ) {
	// Use regular expression to extract the first image URL.
	preg_match( '/<img.*?src=["\'](https:\/\/[^"\']+)["\'].*?>/i', $item->get_content(), $matches );

	// Check if a match is found.
	if ( isset( $matches[1] ) ) {
		$thumb_src = $matches[1];
	}
}

?>
<div class="<?php echo esc_attr( $grid_column ); ?>">
	<div class="wpcp-single-item wpcp-rss-feed 
	<?php echo ( $is_youtube_feed ) ? esc_attr( 'wcp-video-item' ) : ''; ?>">

		<?php if ( $is_youtube_feed && ! empty( $thumb_src ) ) { ?>
			<div class="wpcp-slide-image">
				<?php
				if ( 'lightbox' === $video_play_mode ) {
					?>
						<a class="wcp-video" data-fancybox="wpcp_view" data-buttons='["<?php echo esc_attr( $l_box_zoom_button ); ?>","<?php echo esc_attr( $show_full_screen ); ?>","<?php echo esc_attr( $show_slideshow ); ?>","<?php echo esc_attr( $show_social_share ); ?>","<?php echo esc_attr( $show_download_button ); ?>","<?php echo esc_attr( $show_img_thumb ); ?>","<?php echo esc_attr( $l_box_close_button ); ?>"]' data-lightbox-gallery="group-<?php echo esc_attr( $post_id ); ?>" data-item-slug="<?php echo esc_attr( self::get_item_slug( $video_url ) ); ?>" href="<?php echo esc_url( $video_url ); ?>">
							<img src="<?php echo esc_url( $thumb_src ); ?>" alt="<?php echo esc_html( $youtube_title ); ?>"><i class="fa fa-play-circle-o" aria-hidden="true"></i>
						</a>
					<?php
				} else {
					?>
					<div class="wcp-video-iframe-wrapper">
						<div class="wcp-video-section wcp-video-inline-mode">
							<!-- Display Video Thumbnail -->
							<img loading="lazy" class="wcp-lazy" data-src="<?php echo esc_url( $thumb_src ); ?>" src="<?php echo esc_url( $thumb_src ); ?>" alt="<?php echo esc_html( $youtube_title ); ?>"><i class="fa fa-play-circle-o" aria-hidden="true"></i>

							<!-- Play Button Icon -->
							<button><i class="fa fa-play-circle-o" aria-hidden="true"></i></button>
							
							<!-- YouTube Video Embed -->
							<div class="wcp-video-iframe-wrapper wcp-inline-video-youtube" data-embed="<?php echo esc_attr( $video_id ); ?>" data-fancybox data-src="<?php echo esc_url( $video_url ); ?>" data-type="youtube" data-width="600" data-height="400" data-autoplay="<?php echo esc_attr( $video_autoplay ); ?>" data-loop="<?php echo esc_attr( $video_loop ); ?>">
							</div>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		<?php } else { ?>
			<?php if ( ! empty( $thumb_src ) ) { ?>
				<div class="wpcp-slide-image">
					<a href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $link_target ); ?>" <?php echo $image_link_nofollow; ?>>
						<img src="<?php echo esc_url( $thumb_src ); ?>" alt="">
					</a>
				</div>
			<?php } ?>
		<?php } ?>
	
		<div class="wpcp-all-captions">
			<?php if ( $show_feed_title ) { ?>
			<h3 class="wpcp-post-title">
				<a class="feed_title" href="<?php echo esc_url( $item->get_permalink() ); ?>" title="
				<?php
				/* translators: %s: Publication date of the post */
				printf( __( 'Posted %s', 'wp-carousel-pro' ), esc_html( $pub_date ) );
				?>
				" target="<?php echo esc_attr( $link_target ); ?>" <?php echo $image_link_nofollow; ?>><?php echo wp_kses_post( $title ); ?></a>
			</h3>
			<div class="wpcp-post-meta">
				<?php
				/* translators: %s: Publication date of the post */
				printf( __( 'Posted %s', 'wp-carousel-pro' ), esc_html( $pub_date ) );
				?>
			</div>
			<?php } ?>
			<?php
			if ( $wpcp_feed_content_show ) {
				?>

			<div class="wpcp-post-content"><p><?php echo wp_kses_post( $description ); ?></p></div>
			<?php } ?>
			<?php if ( $show_feed_read_more ) { ?>
			<div class="sp-wpcp-read-more">
				<a class="wpcp_readmore" href="<?php echo $link; ?>" target="<?php echo esc_attr( $link_target ); ?>" <?php echo $image_link_nofollow; ?>> <?php echo wp_kses_post( $wpcp_feed_readmore_text ); ?></a>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
