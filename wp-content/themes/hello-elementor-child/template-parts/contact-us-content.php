<?php
/**
 * Contenido página Contact Us: hero, Featured carousel, formulario, Related Projects.
 * Estructura y clases según pages.css + contact-us.css (hero-overlay, contact-form-shell, related-projects, etc.).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$projects_data = include get_stylesheet_directory() . '/inc/projects-data.php';
$projects_url  = home_url( '/projects/' );
$hero_bg       = 'https://lh3.googleusercontent.com/aida-public/AB6AXuBOTH_XXiqo2Xmlvew0BGoutUjD_5zUP3JJIePy7kRKcWy_AIOwGaExeC1JdBU4ue6xw0R0TdIxV43s_fpgYikUGTBIY9QoJzaQUUL4jCPT5faFmnUPcxf_ddYcVZJp3RaTmIKF105ih4PMHQYq-H_zrdiZM4gmK91b_hBPJG688OPzmYKnFbQTZPWDseM1x8vFcNgBa00kqDrVWmorEPeZgBCP7ZvZmZosxI8XJe2sZt0G5vpqPq-e4zFe1xC56klPAajYkCDkkcVr';
?>
<main id="main-content">
	<section class="contact-hero" style="background-image: url('<?php echo esc_url( $hero_bg ); ?>'); background-size: cover; background-position: center;">
		<div class="hero-overlay"></div>
		<div class="contact-hero-content">
			<div class="contact-hero-title-wrap">
				<h1 class="contact-hero-title">Contact</h1>
				<span class="contact-hero-subtitle">Us</span>
			</div>
		</div>
	</section>

	<div class="container contact-page-content">

		<section class="featured-carousel content-section" aria-label="Featured projects">
			<h2 class="section-title">Featured Projects</h2>
			<div class="c-carousel" data-carousel data-carousel-loop="true" data-carousel-dots="false" data-carousel-breakpoints='{"0":1,"600":2,"900":3}' aria-label="Featured projects">
				<div class="c-carousel__viewport">
					<div class="c-carousel__track">
						<?php foreach ( $projects_data as $p ) : ?>
							<div class="c-carousel__slide">
								<article class="c-carousel__card">
									<div class="c-carousel__card-image">
										<img src="<?php echo esc_url( $p['image'] ); ?>" alt="">
									</div>
									<div class="c-carousel__card-body">
										<p class="c-carousel__card-category"><?php echo esc_html( isset( $p['category_label'] ) ? $p['category_label'] : $p['category'] ); ?></p>
										<h3 class="c-carousel__card-title"><?php echo esc_html( $p['title'] ); ?></h3>
									</div>
								</article>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<button class="c-carousel__btn c-carousel__btn--prev" type="button" aria-label="Previous"></button>
				<button class="c-carousel__btn c-carousel__btn--next" type="button" aria-label="Next"></button>
				<div class="c-carousel__dots" aria-label="Pagination"></div>
			</div>
		</section>

		<section class="contact-form-section">
			<div class="contact-form-shell">
				<div class="contact-form-inner">
					<div class="contact-form-header">
						<h2 class="contact-form-title">Contact Us</h2>
						<p class="contact-form-description">Get in touch with our team of experts for your next construction project.</p>
					</div>
					<form class="contact-form" action="#" method="post">
						<div class="contact-grid contact-grid-two-col">
							<div class="form-field form-field-floating">
								<input class="input-line" id="first_name" name="first_name" placeholder="First Name" type="text" required/>
								<label for="first_name">First Name</label>
							</div>
							<div class="form-field form-field-floating">
								<input class="input-line" id="last_name" name="last_name" placeholder="Last Name" type="text" required/>
								<label for="last_name">Last Name</label>
							</div>
						</div>
						<div class="contact-grid contact-grid-two-col">
							<div class="form-field form-field-floating">
								<input class="input-line" id="email" name="email" placeholder="E-mail Address" type="email" required/>
								<label for="email">E-mail Address</label>
							</div>
							<div class="form-field form-field-floating">
								<input class="input-line" id="phone" name="phone" placeholder="Phone" type="tel"/>
								<label for="phone">Phone</label>
							</div>
						</div>
						<div class="form-field">
							<textarea class="input-box" id="message" name="message" placeholder="Your message..." rows="4"></textarea>
						</div>
						<button class="contact-submit-btn" type="submit">
							SEND <span class="material-symbols-outlined">arrow_forward</span>
						</button>
					</form>
					<div class="contact-info-grid">
						<div class="contact-info-item">
							<div class="contact-info-icon contact-info-icon-location">
								<span class="material-symbols-outlined">location_on</span>
							</div>
							<p>1018 Bladensburg Rd NE<br/>Washington, DC 20002</p>
						</div>
						<div class="contact-info-item">
							<div class="contact-info-icon contact-info-icon-phone">
								<span class="material-symbols-outlined">phone</span>
							</div>
							<p>202-934-5222</p>
						</div>
						<div class="contact-info-item">
							<div class="contact-info-icon contact-info-icon-email">
								<span class="material-symbols-outlined">email</span>
							</div>
							<p>admin@spdcon-inc.com</p>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="related-projects">
			<div class="related-projects-header">
				<h2 class="related-projects-title">Related Projects</h2>
				<div class="related-projects-nav">
					<button class="related-nav-btn" type="button" aria-label="Previous related project">
						<span class="material-symbols-outlined">west</span>
					</button>
					<button class="related-nav-btn" type="button" aria-label="Next related project">
						<span class="material-symbols-outlined">east</span>
					</button>
				</div>
			</div>
			<div class="related-projects-grid">
				<?php
				$related = array(
					array(
						'title'   => 'The Wall at O Street SE',
						'excerpt' => 'The Design-Build Services for the O Street SE Retaining Wall Restoration project involve the structural rehabilitation and stabilization of the existing retaining wall to ensure long-term integrity and compliance...',
						'url'     => $projects_url . '#the-wall-at-o-street-se',
						'img'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDhVOtn7H0edkswx54-FuoLO3jgri6O-hSRjb3nFS6W2qZcco_AOeuuAskf-K8OVLoB_U3-W4UC2sSrLU9ajo-eOl2eqxLem1HLazcZNgpNWvRDQlljN73qnLkPDfSGWnBOZWM5s6nkVa48Pemyj9XVMma9ymkcMO04-Rh7Kl0X2mLlo_OEAQvT2IOcUQGGasJ1316Z1lfDAeQVuJZovl1vxLmr_TmpTFfLIGRs7ScXK9xtvFmGc20mYAX3X7kqdfIt8u_fIt0RLr5K',
					),
					array(
						'title'   => 'MPD 4th District HQ',
						'excerpt' => 'SPD Contracting, Inc., as the Design-Builder, is overseeing the design and construction of the MPD 4th District Headquarters Generator Replacement Project...',
						'url'     => $projects_url . '#mpd-4th-district-headquarters',
						'img'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC2Sv_x5WCsnx03lhntAt8mjI6cO4_6Tna9_Lx56q34e95st2GpjzBBLCLXSAQIdnIa-V5QO0q5XvFkfBAkCf4Wj6gvxfpUS1ihWKjbZj4cKBCR5E_NhT-GlzL8dH6cNmb6grEi8QKzqxJ4kThWoYlvFToxrOUde1-P-RMixidpce703e7T7MrLKJUPQPw1EDygRL7LFoHBxIN1mfoEFivgA6E-4NHsMvQpvrucjvSKg89YXrWgkXDgeQAjuNTM99wXfpfug9F8tFY3',
					),
				);
				foreach ( $related as $item ) :
					?>
				<article class="related-project-card">
					<div class="related-project-media">
						<img alt="<?php echo esc_attr( $item['title'] ); ?>" src="<?php echo esc_url( $item['img'] ); ?>"/>
						<div class="related-project-overlay"></div>
					</div>
					<h3 class="related-project-name"><?php echo esc_html( $item['title'] ); ?></h3>
					<p class="related-project-summary"><?php echo esc_html( $item['excerpt'] ); ?></p>
					<a class="related-project-link" href="<?php echo esc_url( $item['url'] ); ?>">
						Read more <span class="material-symbols-outlined">arrow_forward</span>
					</a>
				</article>
				<?php endforeach; ?>
			</div>
		</section>

	</div>
</main>
