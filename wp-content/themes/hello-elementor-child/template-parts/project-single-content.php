<?php
/**
 * Contenido de página individual de proyecto: hero, overview, gallery, related.
 * Recibe: $args['project'] (proyecto actual), $args['projects'] (todos).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$project  = get_query_var( 'spd_project', null );
$projects = get_query_var( 'spd_projects', array() );
if ( ! $project || ! is_array( $project ) ) {
	return;
}

$hero_image = isset( $project['image'] ) ? $project['image'] : '';
$category_label = isset( $project['category_label'] ) ? $project['category_label'] : ( isset( $project['category'] ) ? $project['category'] : '' );
$title = isset( $project['title'] ) ? $project['title'] : '';
$excerpt = isset( $project['excerpt'] ) ? $project['excerpt'] : '';
$overview = isset( $project['overview'] ) ? $project['overview'] : $excerpt;
$gallery_images = isset( $project['gallery_images'] ) && is_array( $project['gallery_images'] ) ? $project['gallery_images'] : array( $hero_image );
$current_slug = isset( $project['slug'] ) ? $project['slug'] : '';

?>
<section class="project-hero" id="project-hero" aria-label="Project hero" style="background-image: url(<?php echo esc_url( $hero_image ); ?>);">
	<div class="project-hero__overlay" aria-hidden="true"></div>
	<div class="project-hero__content">
		<?php if ( $category_label ) : ?>
			<p class="project-hero__category"><?php echo esc_html( $category_label ); ?></p>
		<?php endif; ?>
		<h1 class="project-hero__title"><?php echo esc_html( $title ); ?></h1>
	</div>
</section>

<div class="container">
	<section class="project-overview" id="project-overview" aria-label="Project overview">
		<div class="project-overview__grid">
			<div class="project-overview__card">
				<h3>Overview</h3>
				<p><?php echo esc_html( $overview ); ?></p>
			</div>
			<div class="project-overview__card">
				<h3>Scope</h3>
				<p><?php
					if ( ! empty( $project['scope'] ) ) {
						echo esc_html( $project['scope'] );
					} else {
						echo 'This project falls under ';
						echo esc_html( isset( $project['category'] ) ? $project['category'] : $category_label );
						echo '.';
					}
				?></p>
			</div>
		</div>
	</section>

	<section class="project-gallery content-section" aria-label="Gallery">
		<h2 class="section-title">Gallery</h2>
		<div class="c-carousel" data-carousel data-carousel-loop="true" data-carousel-dots="false" data-carousel-breakpoints='{"0":1,"600":2,"900":3}' aria-label="Project gallery">
			<div class="c-carousel__viewport">
				<div class="c-carousel__track">
					<?php foreach ( $gallery_images as $img ) : ?>
						<div class="c-carousel__slide">
							<div class="gallery-slide-img">
								<img src="<?php echo esc_url( $img ); ?>" alt="">
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

	<section class="project-related content-section" aria-label="Related Projects">
		<h2 class="section-title">Related Projects</h2>
		<div id="related-projects-mount" data-current-slug="<?php echo esc_attr( $current_slug ); ?>">
			<div class="c-carousel" data-carousel data-carousel-loop="true" data-carousel-dots="false" data-carousel-breakpoints='{"0":1,"768":2,"900":3}' aria-label="Related projects">
				<div class="c-carousel__viewport">
					<div class="c-carousel__track">
						<!-- Populated by project-single.js from projectsMenu -->
					</div>
				</div>
				<button class="c-carousel__btn c-carousel__btn--prev" type="button" aria-label="Previous"></button>
				<button class="c-carousel__btn c-carousel__btn--next" type="button" aria-label="Next"></button>
				<div class="c-carousel__dots" aria-label="Pagination"></div>
			</div>
		</div>
	</section>
</div>
