<?php
/**
 * Contenido HTML de la homepage. Edita este archivo en el proyecto.
 * No incluyas <html>, <head> ni <body>; la plantilla ya los genera.
 */
$home = home_url( '/' );
?>
  <!-- Header -->
  <header class="site-header">
    <div class="header-inner">
      <a href="<?php echo esc_url( $home ); ?>" class="logo">
        <span class="logo-icon"></span>
        <span class="logo-text">SPD Contracting, Inc.</span>
      </a>
      <nav class="main-nav">
        <ul>
          <li><a href="#projects">Projects <span class="chevron">▼</span></a></li>
          <li><a href="#approach">Approach & Expertise <span class="chevron">▼</span></a></li>
          <li><a href="#company">Company info</a></li>
          <li><a href="#contact">Contact us</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Hero -->
  <section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h1 class="hero-title">SPD Contracting</h1>
      <p class="hero-subtitle">Committed to your project</p>
      <div class="hero-buttons">
        <a href="#about" class="btn btn-primary">ABOUT US &gt;</a>
        <a href="#contact" class="btn btn-primary">CONTACT US &gt;</a>
      </div>
    </div>
  </section>

  <!-- Approach & Expertise -->
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

  <!-- Featured Projects -->
  <section class="featured-projects" id="projects">
    <div class="container">
      <div class="projects-intro">
        <div class="projects-text-box">
          <h2 class="section-label">Featured Projects</h2>
          <h3 class="projects-title">A vast portfolio of diverse projects</h3>
          <p>SPD Contracting, Inc. specializes in diverse sectors such as Education, Private Ventures, Municipal Projects, & Emergency Response-Oriented Endeavors.</p>
          <p>SPD is committed to delivering innovative solutions to meet the unique needs of each project.</p>
        </div>
        <a href="#all-projects" class="btn btn-dark">VIEW ALL PROJECTS &gt;</a>
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

  <!-- Services -->
  <section class="services">
    <div class="container">
      <div class="services-grid">
        <div class="services-intro">
          <h2 class="section-label">Approach & Expertise</h2>
          <p>At SPD Contracting, Inc., our comprehensive and integrated approach focuses on project delivery from conception through completion. Leveraging decades of industry experience, we offer specialized expertise and tailored solutions to meet diverse client needs across the D.C. region.</p>
          <a href="#all-services" class="btn btn-primary">VIEW ALL SERVICES &gt;</a>
        </div>
        <div class="service-feature">
          <div class="service-image"></div>
          <h3>Construction Manager At Risk</h3>
          <p>We proactively identify, evaluate, and mitigate project risks to deliver on time and on budget.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="cta-section">
    <div class="cta-overlay"></div>
    <div class="cta-content">
      <p class="cta-text">Reach out to us, and our team will respond promptly to assist you.</p>
      <a href="#contact" class="btn btn-primary">CONTACT US &gt;</a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="site-footer">
    <div class="container">
      <div class="footer-top">
        <a href="<?php echo esc_url( $home ); ?>" class="logo">
          <span class="logo-icon"></span>
          <span class="logo-text">SPD Contracting, Inc.</span>
        </a>
        <nav class="footer-nav">
          <a href="#projects">Projects</a>
          <a href="#approach">Approach & Expertise</a>
          <a href="#company">Company Info</a>
          <a href="#contact">Contact Us</a>
        </nav>
      </div>
      <div class="footer-bottom">
        <p class="copyright">Copyright © <?php echo esc_html( date( 'Y' ) ); ?> SPD Contracting, Inc.</p>
        <div class="footer-contact">
          <span>1018 Bladensburg Rd NE - Washington, DC 20002</span>
          <span>202-334-5222</span>
          <a href="mailto:admin@spdcon-inc.com">admin@spdcon-inc.com</a>
        </div>
      </div>
    </div>
  </footer>
