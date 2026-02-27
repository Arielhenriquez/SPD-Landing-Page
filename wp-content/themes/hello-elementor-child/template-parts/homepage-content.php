<?php
/**
 * Contenido homepage: hero, approach, featured projects (scroll), services, cta. Sin header/footer (van en la plantilla).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$home = home_url( '/' );
$projects_url = home_url( '/projects/' );
$contact_url = home_url( '/contact-us-2/' );
?>
  <main id="main-content">
    <section class="hero">
      <div class="hero-overlay"></div>
      <div class="hero-content">
        <h1 class="hero-title">SPD Contracting</h1>
        <p class="hero-subtitle">Committed to your project</p>
        <div class="hero-buttons">
          <a href="<?php echo esc_url( $home ); ?>#approach" class="btn btn-primary">ABOUT US &gt;</a>
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
        <div class="projects-carousel">
          <button type="button" class="carousel-arrow carousel-prev" aria-label="Previous">‹</button>
          <div class="projects-cards">
            <article class="project-card">
              <div class="project-image"></div>
              <div class="project-caption">
                <span class="project-category">Government Housing</span>
                <h4>Forest Ridge and The Vistas Apartments Renovations</h4>
              </div>
            </article>
            <article class="project-card">
              <div class="project-image"></div>
              <div class="project-caption">
                <span class="project-category">Recreational Facilities</span>
                <h4>Sherwood Recreation Center Exterior Improvements</h4>
              </div>
            </article>
            <article class="project-card">
              <div class="project-image"></div>
              <div class="project-caption">
                <span class="project-category">Recreational Facilities</span>
                <h4>Randall Recreation Center Project</h4>
              </div>
            </article>
          </div>
          <button type="button" class="carousel-arrow carousel-next" aria-label="Next">›</button>
        </div>
      </div>
    </section>

    <section class="services">
      <div class="container">
        <div class="services-grid">
          <div class="services-intro">
            <h2 class="section-label">Approach & Expertise</h2>
            <p>At SPD Contracting, Inc., our comprehensive and integrated approach focuses on project delivery from conception through completion. Leveraging decades of industry experience, we offer specialized expertise and tailored solutions to meet diverse client needs across the D.C. region.</p>
            <a href="<?php echo esc_url( $home ); ?>#approach" class="btn btn-primary">VIEW ALL SERVICES &gt;</a>
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
