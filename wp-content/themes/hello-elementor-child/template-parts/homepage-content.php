<?php
/**
 * Contenido homepage: hero, approach, featured projects (scroll), services, cta. Sin header/footer (van en la plantilla).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$home             = home_url( '/' );
$projects_url     = home_url( '/projects/' );
$contact_url      = home_url( '/contact-us-2/' );
$company_info_url = function_exists( 'spd_page_url_by_slug' ) ? spd_page_url_by_slug( 'company-info' ) : home_url( '/company-info/' );
$approach_url     = function_exists( 'spd_page_url_by_slug' ) ? spd_page_url_by_slug( 'approach-expertise' ) : home_url( '/approach-expertise/' );
?>
  <main id="main-content">
    <section class="hero">
      <div class="hero-overlay"></div>
      <div class="hero-content">
        <h1 class="hero-title">SPD Contracting</h1>
        <p class="hero-subtitle">Committed to your project</p>
        <div class="hero-buttons">
          <a href="<?php echo esc_url( $company_info_url ); ?>" class="btn btn-primary">ABOUT US &gt;</a>
          <a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn-primary">CONTACT US &gt;</a>
        </div>
      </div>
    </section>

    <section class="approach" id="approach">
      <div class="container">
        <h2 class="section-label">Approach & Expertise</h2>
        <div class="approach-grid">
          <div class="approach-headline">
            <h3>At SPD Contracting, integrity and innovation drive our approach.</h3>
          </div>
          <div class="approach-text">
            <p>At SPD Contracting, Inc., our comprehensive and integrated approach focuses on project delivery from conception through completion. Leveraging decades of industry experience, we offer specialized expertise and tailored solutions to meet diverse client needs across the D.C. region.</p>
          </div>
        </div>
        <div class="metrics">
          <div class="metric">
            <span class="metric-number">10</span>
            <span class="metric-label">Areas of SPECIALITY</span>
          </div>
          <div class="metric">
            <span class="metric-number">5</span>
            <span class="metric-label">Personnel MANAGEMENT</span>
          </div>
          <div class="metric">
            <span class="metric-number">100</span>
            <span class="metric-label">Completed PROJECTS</span>
          </div>
        </div>
        <div class="partner-logos">
          <div class="partner-logo">DGS</div>
          <div class="partner-logo">Turner</div>
          <div class="partner-logo">Keystone</div>
          <div class="partner-logo">TPM Group</div>
          <div class="partner-logo">Chiaramonte</div>
        </div>
      </div>
    </section>

    <section class="featured-projects" id="projects">
      <div class="container">
        <div class="projects-intro">
          <div class="projects-text-box">
            <h2 class="section-label">Featured Projects</h2>
            <h3 class="projects-title">A vast portfolio of diverse projects</h3>
            <p>SPD Contracting, Inc. specializes in diverse sectors such as Education, Private Ventures, Municipal Projects, & Emergency Response-Oriented Endeavors.</p>
            <p>SPD is committed to delivering innovative solutions to meet the unique needs of each project.</p>
          </div>
          <a href="<?php echo esc_url( $projects_url ); ?>" class="btn btn-dark">VIEW ALL PROJECTS &gt;</a>
        </div>
        <div class="featured-carousel content-section" aria-label="Featured projects">
          <div class="c-carousel" data-carousel data-carousel-loop="true" data-carousel-dots="false" data-carousel-breakpoints='{"0":1,"600":2,"900":3}' aria-label="Featured projects">
            <div class="c-carousel__viewport">
              <div class="c-carousel__track">
                <?php
                $projects_data = include get_stylesheet_directory() . '/inc/projects-data.php';
                foreach ( $projects_data as $p ) :
                  $p_link = function_exists( 'spd_project_page_url' ) ? spd_project_page_url( isset( $p['slug'] ) ? $p['slug'] : '' ) : home_url( '/projects/' );
                ?>
                  <div class="c-carousel__slide">
                    <article class="c-carousel__card">
                      <div class="c-carousel__card-image">
                        <a href="<?php echo esc_url( $p_link ); ?>">
                          <img src="<?php echo esc_url( $p['image'] ); ?>" alt="<?php echo esc_attr( $p['title'] ); ?>">
                        </a>
                      </div>
                      <div class="c-carousel__card-body">
                        <p class="c-carousel__card-category"><?php echo esc_html( isset( $p['category_label'] ) ? $p['category_label'] : $p['category'] ); ?></p>
                        <h3 class="c-carousel__card-title"><a href="<?php echo esc_url( $p_link ); ?>"><?php echo esc_html( $p['title'] ); ?></a></h3>
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
        </div>
      </div>
    </section>

    <section class="services">
      <div class="container">
        <div class="services-grid">
          <div class="services-intro">
            <h2 class="section-label">Approach & Expertise</h2>
            <p>At SPD Contracting, Inc., our comprehensive and integrated approach focuses on project delivery from conception through completion. Leveraging decades of industry experience, we offer specialized expertise and tailored solutions to meet diverse client needs across the D.C. region.</p>
            <a href="<?php echo esc_url( $approach_url ); ?>" class="btn btn-primary">VIEW ALL SERVICES &gt;</a>
          </div>
          <div class="service-feature">
            <div class="service-image"></div>
            <h3>Construction Manager At Risk</h3>
            <p>We proactively identify, evaluate, and mitigate project risks to deliver on time and on budget.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="cta-section" id="contact">
      <div class="cta-overlay"></div>
      <div class="cta-content">
        <p class="cta-text">Reach out to us, and our team will respond promptly to assist you.</p>
        <a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn-primary">CONTACT US &gt;</a>
      </div>
    </section>
  </main>
