<?php
/**
 * Contenido de subpágina Approach & Expertise: hero, overview cards, gallery, related projects.
 * Recibe vía query_var:
 *   spd_service  — array con datos del servicio (de inc/approach-data.php)
 *   spd_projects — todos los proyectos (de inc/projects-data.php)
 *
 * Si la página WP tiene contenido en el editor, ese texto sobreescribe el placeholder de overview.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$service  = get_query_var( 'spd_service', null );
$projects = get_query_var( 'spd_projects', array() );

if ( ! $service || ! is_array( $service ) ) {
	return;
}

$hero_image = isset( $service['hero_image'] ) ? $service['hero_image'] : '';
$title      = get_the_title() ?: ( isset( $service['title'] ) ? $service['title'] : '' );
$overview   = '';

/* Use WP editor content if present, otherwise fallback to approach-data */
$wp_content = get_the_content();
if ( $wp_content ) {
	$overview = apply_filters( 'the_content', $wp_content );
} else {
	$overview = isset( $service['overview'] ) ? $service['overview'] : '';
}

$scope          = isset( $service['scope'] ) ? $service['scope'] : '';
$gallery_images = isset( $service['gallery'] ) && $service['gallery']
	? $service['gallery']
	: array( $hero_image );

/* Related: all projects (up to 6, carousel will paginate) */
$related = array_values( $projects );
?>

<!-- ========== Hero ========== -->
<section class="project-hero"
         id="project-hero"
         aria-label="<?php echo esc_attr( $title ); ?> hero"
         style="background-image: url(<?php echo esc_url( $hero_image ); ?>);">
	<div class="project-hero__overlay" aria-hidden="true"></div>
	<div class="project-hero__content">
		<p class="project-hero__category">Approach &amp; Expertise</p>
		<h1 class="project-hero__title"><?php echo esc_html( $title ); ?></h1>
	</div>
</section>

<div class="container">

	<!-- ========== Overview Cards ========== -->
	<section class="project-overview" id="project-overview" aria-label="Service overview">
		<div class="project-overview__grid">
			<div class="project-overview__card">
				<h3>Overview</h3>
				<?php if ( $wp_content ) : ?>
					<?php echo wp_kses_post( $overview ); ?>
				<?php else : ?>
					<p><?php echo esc_html( $overview ); ?></p>
				<?php endif; ?>
			</div>
			<div class="project-overview__card">
				<h3>Scope</h3>
				<p><?php echo esc_html( $scope ); ?></p>
			</div>
		</div>
	</section>

	<!-- ========== Gallery ========== -->
	<section class="project-gallery content-section" aria-label="Gallery">
		<h2 class="section-title">Gallery</h2>
		<div class="c-carousel"
		     data-carousel
		     data-carousel-loop="true"
		     data-carousel-dots="false"
		     data-carousel-breakpoints='{"0":1,"600":2,"900":3}'
		     aria-label="Service gallery">
			<div class="c-carousel__viewport">
				<div class="c-carousel__track">
					<?php foreach ( $gallery_images as $img ) : ?>
						<div class="c-carousel__slide">
							<div class="gallery-slide-img">
								<img src="<?php echo esc_url( $img ); ?>"
								     alt="<?php echo esc_attr( $title ); ?>">
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<button class="c-carousel__btn c-carousel__btn--prev" type="button" aria-label="Previous"></button>
			<button class="c-carousel__btn c-carousel__btn--next" type="button" aria-label="Next"></button>
			<div class="c-carousel__dots" aria-label="Pagination"></div>
		</div>
	</section>

	<!-- ========== Related Projects ========== -->
	<?php if ( $related ) : ?>
		<section class="project-related content-section" aria-label="Related Projects">
			<h2 class="section-title">Related Projects</h2>
			<div class="c-carousel"
			     data-carousel
			     data-carousel-loop="true"
			     data-carousel-dots="false"
			     data-carousel-breakpoints='{"0":1,"768":2,"900":3}'
			     aria-label="Related projects">
				<div class="c-carousel__viewport">
					<div class="c-carousel__track">
						<?php foreach ( $related as $p ) :
							$p_link = function_exists( 'spd_project_page_url' )
								? spd_project_page_url( isset( $p['slug'] ) ? $p['slug'] : '' )
								: home_url( '/projects/' );
						?>
							<div class="c-carousel__slide">
								<div class="related-card">
									<a href="<?php echo esc_url( $p_link ); ?>" class="thumb">
										<img src="<?php echo esc_url( $p['image'] ); ?>"
										     alt="<?php echo esc_attr( $p['title'] ); ?>">
									</a>
									<div class="body">
										<h3>
											<a href="<?php echo esc_url( $p_link ); ?>">
												<?php echo esc_html( $p['title'] ); ?>
											</a>
										</h3>
										<?php if ( ! empty( $p['excerpt'] ) ) : ?>
											<p><?php echo esc_html( $p['excerpt'] ); ?></p>
										<?php endif; ?>
										<a href="<?php echo esc_url( $p_link ); ?>" class="link">
											View project &rarr;
										</a>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<button class="c-carousel__btn c-carousel__btn--prev" type="button" aria-label="Previous"></button>
				<button class="c-carousel__btn c-carousel__btn--next" type="button" aria-label="Next"></button>
				<div class="c-carousel__dots" aria-label="Pagination"></div>
			</div>
		</section>
	<?php endif; ?>

</div>
