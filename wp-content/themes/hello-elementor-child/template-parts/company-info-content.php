<?php
/**
 * Contenido página Company Info: hero, about, featured projects, services, story, leadership, partners, featured work.
 * Requiere carousel.js + carousel.css + pages.css.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$projects_data = include get_stylesheet_directory() . '/inc/projects-data.php';

$img_base = 'https://lh3.googleusercontent.com/aida-public/';
?>
<main id="main-content">

  <!-- ========== 1. HERO full-bleed ========== -->
  <section class="company-info-hero" aria-label="Company Info hero">
    <div class="company-info-hero__overlay" aria-hidden="true"></div>
    <div class="company-info-hero__content">
      <h1 class="company-info-hero__title">
        Company
        <span class="company-info-hero__title-script">Info</span>
      </h1>
    </div>
  </section>

  <div class="container ci-page-body">

    <!-- ========== 2. ABOUT SPD CONTRACTING ========== -->
    <section class="content-section approach-headline" aria-label="About SPD Contracting">
      <h2 class="section-title">About SPD Contracting</h2>
      <p class="approach-text">
        SPD Contracting, Inc. is a Washington, DC-based construction firm with over two decades of
        experience delivering high-quality projects for government and institutional clients. Our work
        spans educational facilities, government-owned buildings, municipal and healthcare projects,
        affordable housing, and recreational centers.
      </p>
      <p class="approach-text">
        As a certified Small Business Enterprise (SBE) and Disadvantaged Business Enterprise (DBE),
        we bring an owner's mindset to every engagement — mobilizing quickly, self-performing critical
        scope, and managing risk so our clients can focus on their mission.
      </p>
      <p class="approach-text">
        From preconstruction planning through design-build delivery and subcontracting, SPD partners
        with agencies like DCPS, DGS, DPR, and DCHA to build spaces that serve communities for
        generations to come.
      </p>
    </section>

    <!-- ========== 3. FEATURED PROJECTS carousel ========== -->
    <section class="featured-carousel content-section" aria-label="Featured projects">
      <h2 class="section-title">Featured Projects</h2>
      <div class="c-carousel" data-carousel data-carousel-loop="true" data-carousel-dots="false"
           data-carousel-breakpoints='{"0":1,"600":2,"900":3}' aria-label="Featured projects">
        <div class="c-carousel__viewport">
          <div class="c-carousel__track">
            <?php foreach ( $projects_data as $p ) :
              $p_link = function_exists( 'spd_project_page_url' )
                ? spd_project_page_url( isset( $p['slug'] ) ? $p['slug'] : '' )
                : home_url( '/projects/' );
            ?>
              <div class="c-carousel__slide">
                <article class="c-carousel__card">
                  <a href="<?php echo esc_url( $p_link ); ?>" class="c-carousel__card-link">
                    <div class="c-carousel__card-image">
                      <img src="<?php echo esc_url( $p['image'] ); ?>"
                           alt="<?php echo esc_attr( $p['title'] ); ?>">
                    </div>
                    <div class="c-carousel__card-body">
                      <p class="c-carousel__card-category"><?php echo esc_html( $p['category_label'] ?: $p['category'] ); ?></p>
                      <h3 class="c-carousel__card-title"><?php echo esc_html( $p['title'] ); ?></h3>
                    </div>
                  </a>
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

    <!-- ========== 4. OUR SERVICES (idéntico a Projects page) ========== -->
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

    <!-- ========== 5. OUR STORY ========== -->
    <section class="content-section company-story" aria-label="Our Story">
      <h2 class="section-title">Our Story</h2>
      <div class="company-story__grid">
        <div class="company-story__media">
          <img src="https://spd.adratech.click/images/our-company/rodolfo-gonzalez.webp"
               alt="SPD Contracting — Our Story">
        </div>
        <div class="company-story__content">
          <p>
            SPD Contracting was founded in Washington, DC with a single conviction: that small,
            community-rooted firms can deliver world-class construction for the institutions that matter
            most — schools, recreation centers, government offices, and affordable housing. What began
            as a lean team of dedicated tradespeople has grown into a full-service construction company
            trusted by DC's most demanding public agencies.
          </p>
          <p>
            Over two decades we have self-performed millions of dollars of work across DCPS, DGS, DPR,
            and DCHA portfolios. We earned our SBE and DBE certifications not as checkboxes but as
            commitments — commitments to mobilize faster, hire locally, and keep dollars circulating in
            the communities we serve.
          </p>
          <p>
            Today SPD Contracting operates across the full project lifecycle: preconstruction strategy,
            design-build delivery, construction management, and subcontracting partnerships. Every
            project, regardless of size, receives the same owner-mindset approach that has defined our
            reputation for two decades.
          </p>
        </div>
      </div>
    </section>

    <!-- ========== 6. EXECUTIVE LEADERSHIP ========== -->
    <section class="content-section" aria-label="Executive Leadership">
      <h2 class="section-title">Executive Leadership</h2>
      <div class="leadership-grid">

        <div class="leader-card">
          <div class="leader-card__img">
            <img src="<?php echo esc_url( $img_base . 'AB6AXuDvWOmeQ6Bf3RjXw7ObL4sEI8YMa8w6xV9nSzJksyZoOhCwZw2i-X7_AoISzmQOtD_2Wea9TpmldlcBisj4iZuqu_kc01t1mthTLTDHeYPKVRGagHE9kf0fz3CUVg-5QwInq5ItE3Rz7x9cq6wwHwGVXFUdJgZTtIY_FS1za2SyOV-jifU5wfcxJgRQIZNmUTZkTWx99GP4CLn0T1z_z5pKxOLb5gXtjyugqANg8ubrEi3VsSQKMj0Ovi3zI2ke8aXWagrTRCvQAprO' ); ?>"
                 alt="Marcus A. Williams">
          </div>
          <div class="leader-card__meta">
            <h3 class="leader-card__name">Marcus A. Williams</h3>
            <p class="leader-card__role">President &amp; CEO</p>
          </div>
        </div>

        <div class="leader-card">
          <div class="leader-card__img">
            <img src="<?php echo esc_url( $img_base . 'AB6AXuBxD6bpHRp1-5Z_0rLDrrDMJnm7XdoncyHhlevv5od5R0GvJLyuwIGsRCepMMwbG6YqM97j_87lfRg7kJg0-DxWcnE3lwcz78tWxc_4FEsMo15UvSmsYMIxnaKT0JkvDXZBCo3aVIOgEHB6gexOnikQvzQdKQV1Yd_hO2U9MnXXy0nFhl1StivDu5RGXcNKZTOFoQlK101_hJG8_zyKC52tWNtvMSviLBe6VyjpfwkY2GJPBEUSGObBh6UweqP89ZIWDTO91wzVu0gz' ); ?>"
                 alt="Denise T. Patterson">
          </div>
          <div class="leader-card__meta">
            <h3 class="leader-card__name">Denise T. Patterson</h3>
            <p class="leader-card__role">VP of Operations</p>
          </div>
        </div>

        <div class="leader-card">
          <div class="leader-card__img">
            <img src="<?php echo esc_url( $img_base . 'AB6AXuAiyGks4jyMLMwQ4wLCg4gl3XV06YIhes4x0BUYEXthHNtgMw2fBqZJgT0-BqEVFxAIDx6HYz4FuVTZIyDjPjMxauMVhEM6H1_NWMKxIxUYCINMhuDCagKB4yNnAlfnKEeR1knKXAQOBMfav_RIcLG0J3FD8UAH1nVL9kl0YMJ_04qZ7lnLfqTODSXJ7x3DHr5iAWP0aOIwETxQRqiPsET9jO6LdOUI1nEz8CbN8T2NRL_oDDPYaVCz6g1UBamiHYg3oxjUiphgbPy3' ); ?>"
                 alt="James R. Cole">
          </div>
          <div class="leader-card__meta">
            <h3 class="leader-card__name">James R. Cole</h3>
            <p class="leader-card__role">Project Executive</p>
          </div>
        </div>

        <div class="leader-card">
          <div class="leader-card__img">
            <img src="<?php echo esc_url( $img_base . 'AB6AXuC1v3a5oBzJoxE663tWsWIw_gVpwKXUDkGbSizQMB7vilUMkF7SzOssScNHnSGmITs5ZHbgYzNX4wkKGZiXuieiMpYQZK6tlcveLojm3DLxBsWGo2hf-KyuWbqLLCe6lP2X3ja1pHulCoWfoVBp7nPaF5HuvAbZSp8rRBi0yRDvbIJJh0g3XuLfeUl5hj25ebLLWV0L-yljbd0vy4CwiP-9rmQpPtzDKzicO019pN3pXo9Ur_hm40k2pOtrICxn7cgwV5b7bGQ5PSaF' ); ?>"
                 alt="Sandra L. Grant">
          </div>
          <div class="leader-card__meta">
            <h3 class="leader-card__name">Sandra L. Grant</h3>
            <p class="leader-card__role">Director of Preconstruction</p>
          </div>
        </div>

      </div>
    </section>

    <!-- ========== 7. PARTNERS & CLIENTS ========== -->
    <section class="content-section ci-partners" aria-label="Partners and Clients">
      <h2 class="section-title">Partners &amp; Clients</h2>
      <div class="ci-partners__pills" role="list">
        <span class="ci-partners__pill" role="listitem">DGS</span>
        <span class="ci-partners__pill" role="listitem">Turner Construction</span>
        <span class="ci-partners__pill" role="listitem">Keystone</span>
        <span class="ci-partners__pill" role="listitem">TPM Group</span>
        <span class="ci-partners__pill" role="listitem">Chiaramonte</span>
        <span class="ci-partners__pill" role="listitem">DCPS</span>
        <span class="ci-partners__pill" role="listitem">DPR</span>
        <span class="ci-partners__pill" role="listitem">DCHA</span>
      </div>
      <div class="ci-partners__logos">
        <div class="ci-partners__logo-item">
          <span>DGS</span>
          <small>DC Dept. of General Services</small>
        </div>
        <div class="ci-partners__logo-item">
          <span>Turner</span>
          <small>Turner Construction Co.</small>
        </div>
        <div class="ci-partners__logo-item">
          <span>DCPS</span>
          <small>DC Public Schools</small>
        </div>
        <div class="ci-partners__logo-item">
          <span>DPR</span>
          <small>Dept. of Parks &amp; Recreation</small>
        </div>
        <div class="ci-partners__logo-item">
          <span>DCHA</span>
          <small>DC Housing Authority</small>
        </div>
        <div class="ci-partners__logo-item">
          <span>Chiaramonte</span>
          <small>Chiaramonte Const.</small>
        </div>
      </div>
    </section>

    <!-- ========== 8. FEATURED WORK (grid, all projects from projects-data) ========== -->
    <section class="content-section ci-featured-work" aria-label="Featured Work">
      <h2 class="section-title">Featured Work</h2>
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
                <p class="ci-work-card__cat"><?php echo esc_html( $p['category_label'] ?: $p['category'] ); ?></p>
                <h3 class="ci-work-card__title"><?php echo esc_html( $p['title'] ); ?></h3>
                <p class="ci-work-card__excerpt"><?php echo esc_html( $p['excerpt'] ); ?></p>
                <span class="ci-work-card__cta">Read more &rarr;</span>
              </div>
            </a>
          </article>
        <?php endforeach; ?>
      </div>
    </section>

  </div><!-- .ci-page-body -->
</main>
