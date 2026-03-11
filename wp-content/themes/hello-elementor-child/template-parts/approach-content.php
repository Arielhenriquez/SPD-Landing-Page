<?php
/**
 * Contenido página Approach & Expertise: hero (igual que Company Info) + Government Owned Buildings + Related Projects.
 * Fuente de proyectos: inc/projects-data.php.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$projects_data = include get_stylesheet_directory() . '/inc/projects-data.php';
?>
<main id="main-content">
  <!-- Hero full-bleed (mismo markup y clases que Company Info) -->
  <section class="company-info-hero" aria-label="Approach & Expertise hero">
    <div class="company-info-hero__overlay" aria-hidden="true"></div>
    <div class="company-info-hero__content">
      <h1 class="company-info-hero__title">
        Approach
        <span class="company-info-hero__title-script">&amp; Expertise</span>
      </h1>
    </div>
  </section>

  <div class="container approach-page-body">
    <section class="content-section" aria-label="Intro">
      <p class="approach-intro">At SPD Contracting, Inc., our comprehensive and integrated approach focuses on project delivery from conception through completion. Leveraging decades of industry experience, we offer specialized expertise and tailored solutions to meet diverse client needs across the D.C. region.</p>
    </section>

    <section class="content-section" aria-label="Government Owned Buildings">
      <h2 class="section-title">Government Owned Buildings</h2>
      <div class="two-col-grid" style="margin-bottom: 3rem;">
        <div class="project-detail-img">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAKftn1FM49MrhtgBmDwmIOdNhWVGqoEpne48N-dmpk9mqgz-0aBbgVV0yAjhvDq1ystaPPqbk23-REg5REcZZ4-tfBMgXMKC5r3MkNiIelg81ksjPFt-byyTrO-46nX2rWMqyeHQ5qt-yB18Ww09RTgwe-D3XvQp71KbudhFclejx0R7q5KiqYk4ydiwkDbKFi1sGz4adUTXVMIfzUnXk4FfXSyt59DZtG0UZ45lghfUcJf2KLptaI1TX3OfCKqvvMQtNEKhDSZyh9"
               alt="The Wall at O Street SE">
        </div>
        <div class="project-detail">
          <h3>The Wall at O Street SE</h3>
          <p>The Design-Build Services for the O Street SE Retaining Wall Restoration project involve the structural rehabilitation and stabilization of the existing retaining wall to ensure long-term integrity and compliance with DGS standards.</p>
        </div>
      </div>
      <div class="two-col-grid">
        <div class="project-detail" style="order: 2;">
          <p>Coordination with utility providers will be required to address potential conflicts, and all work must adhere to local regulatory requirements and permitting processes.</p>
        </div>
        <div class="project-detail-img" style="order: 1;">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDx0nXc20MaAvkmgFWQ7tsuxf7FISaQhwRbt3xukoF2vLCPJD7_WiIJ3IQVbGdvVhGFa_t7pnRVrZ4sIcVJR-5Z_ACUvzof6Y2SLNl4mYqyfWvlYlIG9FyFVU3zxJ9MNw2youmRVi9StFpEt51Suvx2y1roGY1A8Hj0Pm3hcKq_ZFJcAkslrFLNP4WkPEoH5BmDXY_W88c-pB4Qj3f2-_uXLLCPKx_Jt9AMeLwsmqY4OFUSh7SzljvFzGHzgyS0EuFZkoN60as07RFC"
               alt="Blue Building Construction">
        </div>
      </div>
    </section>

    <section class="content-section ci-featured-work" aria-label="Related Projects">
      <h2 class="section-title">Related Projects</h2>
      <div class="ci-featured-work__grid">
        <?php foreach ( $projects_data as $p ) :
          $p_link = function_exists( 'spd_project_page_url' )
            ? spd_project_page_url( isset( $p['slug'] ) ? $p['slug'] : '' )
            : home_url( '/projects/' );
        ?>
          <article class="ci-work-card">
            <a href="<?php echo esc_url( $p_link ); ?>" class="ci-work-card__link">
              <div class="ci-work-card__img">
                <img src="<?php echo esc_url( $p['image'] ); ?>"
                     alt="<?php echo esc_attr( $p['title'] ); ?>">
              </div>
              <div class="ci-work-card__body">
                <p class="ci-work-card__cat"><?php echo esc_html( isset( $p['category_label'] ) ? $p['category_label'] : $p['category'] ); ?></p>
                <h3 class="ci-work-card__title"><?php echo esc_html( $p['title'] ); ?></h3>
                <p class="ci-work-card__excerpt"><?php echo esc_html( isset( $p['excerpt'] ) ? $p['excerpt'] : '' ); ?></p>
                <span class="ci-work-card__cta">Read more &rarr;</span>
              </div>
            </a>
          </article>
        <?php endforeach; ?>
      </div>
    </section>
  </div>
</main>
