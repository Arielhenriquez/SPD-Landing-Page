<?php
/**
 * Contenido página Projects: Featured, Our Services, Government Owned Buildings, Gallery, Related.
 * Carruseles rellenados desde inc/projects-data.php. Requiere carousel.js + carousel.css.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$projects_data = include get_stylesheet_directory() . '/inc/projects-data.php';
?>
<main id="main-content">
  <div class="container" style="padding-top: 3rem; padding-bottom: 3rem;">
    <section class="featured-carousel content-section" aria-label="Featured projects">
      <h2 class="section-title">Featured Projects</h2>
      <div class="c-carousel" data-carousel data-carousel-loop="true" data-carousel-dots="false" data-carousel-breakpoints='{"0":1,"600":2,"900":3}' aria-label="Featured projects">
        <div class="c-carousel__viewport">
          <div class="c-carousel__track">
            <?php foreach ( $projects_data as $p ) :
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
                    <p class="c-carousel__card-category"><?php echo esc_html( $p['category_label'] ?: $p['category'] ); ?></p>
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
    </section>

    <section class="content-section" aria-label="Our Services">
      <h2 class="section-title">Our Services</h2>
      <div class="projects-services-strip">
        <div class="projects-service-item">
          <div class="thumb"><img src="https://lh3.googleusercontent.com/aida-public/AB6AXuD3JQg437_0B3vCiKfaxkuXxBr7tklMmMGSxQ6woYhPuddhZsLBcmmTGvvGZhmLS3FhrL3924HFxHy48fK8XJ1szlHbWnY1zsQc_cd1vRq1ijUkGx4C52oXROl0gerfp-KdD7G2KKKl72qJevoBAzp2cxAtE20nxUrixTTzeXwgsrm0b_7xgLrtgmqkgDw2d6S4mNtX2YNrR_Jzmd6ytXLT_iTUCcEItRUluEF7rOwYaMWcHUMSJ75-irwMa2yRA5nfGij4TxoFZEdx" alt="Preconstruction"/></div>
          <span>Preconstruction</span>
        </div>
        <div class="projects-service-item">
          <div class="thumb"><img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAjinhFGO_lpubKSzSNbZYr5cLxUWxBQyH1kgX1y86ydTaUrFRRiqfv8e9b-maCzhAjJsLkp1SgXDGKt5d_DlWn463L-IC6-FYk0Iam0EaycP5KEJeivYLvZRVMQnX6jMz2oLUNtn1TIR7haVa2kmXsKuW0UOdDpHsKlfAQcEx3qfkClxtVy54EECc09DIrYBUBE5mAa9YnwW9CjEU28S95nqb2PjIzJ71xhKOwP0XYR1mdjunBcHgMFpQjT6dYI8bHBJls_EHN4ckH" alt="Construction Management"/></div>
          <span>Construction Management</span>
        </div>
        <div class="projects-service-item">
          <div class="thumb"><img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBxD6bpHRp1-5Z_0rLDrrDMJnm7XdoncyHhlevv5od5R0GvJLyuwIGsRCepMMwbG6YqM97j_87lfRg7kJg0-DxWcnE3lwcz78tWxc_4FEsMo15UvSmsYMIxnaKT0JkvDXZBCo3aVIOgEHB6gexOnikQvzQdKQV1Yd_hO2U9MnXXy0nFhl1StivDu5RGXcNKZTOFoQlK101_hJG8_zyKC52tWNtvMSviLBe6VyjpfwkY2GJPBEUSGObBh6UweqP89ZIWDTO91wzVu0gz" alt="Project Management"/></div>
          <span>Project Management</span>
        </div>
        <div class="projects-service-item">
          <div class="thumb"><img src="https://lh3.googleusercontent.com/aida-public/AB6AXuA3F6jZ3DkPnziBg5BxFojepkLPpcfLWFG5LRvUWR-F8mjVIe-rrDjLjM7EFsb1B5ai1GusjXwflwN7kQnxet_G_zP-rRy8czEE_o8FRDiRGkQsOpXVZXi8VpjjhApFxNT5I31W9PkNAvhrgBmSCHGom4ud02WK8CD2rUdrB2EL46WBgSYuNXPndmQ27tBtDIKytIJdwUM06ugkWzYniW_9g1VG-JsprI2D7NynmD0_NxASpaFOlHTl_LJjgTMifvEa_e_ltPmOy0RM" alt="Subcontracting"/></div>
          <span>Subcontracting</span>
        </div>
        <div class="projects-service-item">
          <div class="thumb"><img src="https://lh3.googleusercontent.com/aida-public/AB6AXuApFjBuw1vvOBW0zWuPjFAIfMWDQNpoZ6rTs9LAUxf5pwUaJXp_WTpeBcd9t0uToTpAwQ8DzwdWDMRDbgtQiMOlyeFJLObYjuA9Fc37QeGW27OxXTheVVWEPTpe65PCyiQ_ko5UdjBEQZBFnYDKbsX5tnfToDHuwNyeHrKhzLH6Hh6yRJCRkxrm_pZXtcb94afcC_1ixMh4VEB96vZzyuJR2udGwSfPWS0yCVoFiv_SV5dKkHh84yuM9N3ZTgDSIMa5Uo0jwvmSRkx6" alt="Design-Build"/></div>
          <span>Design-Build</span>
        </div>
      </div>
    </section>

    <section class="content-section" aria-label="Government Owned Buildings">
      <h2 class="section-title">Government Owned Buildings</h2>
      <div class="two-col-grid" style="margin-bottom: 3rem;">
        <div class="project-detail-img">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAKftn1FM49MrhtgBmDwmIOdNhWVGqoEpne48N-dmpk9mqgz-0aBbgVV0yAjhvDq1ystaPPqbk23-REg5REcZZ4-tfBMgXMKC5r3MkNiIelg81ksjPFt-byyTrO-46nX2rWMqyeHQ5qt-yB18Ww09RTgwe-D3XvQp71KbudhFclejx0R7q5KiqYk4ydiwkDbKFi1sGz4adUTXVMIfzUnXk4FfXSyt59DZtG0UZ45lghfUcJf2KLptaI1TX3OfCKqvvMQtNEKhDSZyh9" alt="The Wall at O Street SE"/>
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
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDx0nXc20MaAvkmgFWQ7tsuxf7FISaQhwRbt3xukoF2vLCPJD7_WiIJ3IQVbGdvVhGFa_t7pnRVrZ4sIcVJR-5Z_ACUvzof6Y2SLNl4mYqyfWvlYlIG9FyFVU3zxJ9MNw2youmRVi9StFpEt51Suvx2y1roGY1A8Hj0Pm3hcKq_ZFJcAkslrFLNP4WkPEoH5BmDXY_W88c-pB4Qj3f2-_uXLLCPKx_Jt9AMeLwsmqY4OFUSh7SzljvFzGHzgyS0EuFZkoN60as07RFC" alt="Blue Building Construction"/>
        </div>
      </div>
    </section>

    <section class="content-section" aria-label="Gallery">
      <h2 class="section-title">Gallery</h2>
      <div class="c-carousel" data-carousel data-carousel-loop="true" data-carousel-dots="false" data-carousel-breakpoints='{"0":1,"600":2,"900":3}' aria-label="Gallery">
        <div class="c-carousel__viewport">
          <div class="c-carousel__track">
            <?php foreach ( $projects_data as $p ) :
              $p_link = function_exists( 'spd_project_page_url' ) ? spd_project_page_url( isset( $p['slug'] ) ? $p['slug'] : '' ) : home_url( '/projects/' );
            ?>
              <div class="c-carousel__slide">
                <a href="<?php echo esc_url( $p_link ); ?>" class="gallery-slide-img">
                  <img src="<?php echo esc_url( $p['image'] ); ?>" alt="<?php echo esc_attr( $p['title'] ); ?>">
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <button class="c-carousel__btn c-carousel__btn--prev" type="button" aria-label="Previous"></button>
        <button class="c-carousel__btn c-carousel__btn--next" type="button" aria-label="Next"></button>
        <div class="c-carousel__dots" aria-label="Pagination"></div>
      </div>
    </section>

  </div>
</main>
