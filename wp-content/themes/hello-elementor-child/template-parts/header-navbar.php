<?php
/**
 * Navbar (mega menu) – SPD repo style. Requiere navbar.js y CSS base + navbar + components.
 * ID site-header para Navbar.init().
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$home             = home_url( '/' );
$projects_url     = home_url( '/projects/' );
$approach_url     = function_exists( 'spd_page_url_by_slug' ) ? spd_page_url_by_slug( 'approach-expertise' ) : home_url( '/approach-expertise/' );
/* Base for individual service subpages — child pages live under /expertise/ */
$service_base     = home_url( '/expertise/' );
$company_info_url = function_exists( 'spd_page_url_by_slug' ) ? spd_page_url_by_slug( 'company-info' ) : home_url( '/company-info/' );
$contact_url      = function_exists( 'spd_page_url_by_slug' ) ? spd_page_url_by_slug( 'contact-us-2' ) : home_url( '/contact-us-2/' );
$logo_url     = 'https://qmbqbrt0dq.wpdns.site/wp-content/uploads/2026/01/logo.webp';
?>
<header class="site-header" id="site-header" role="banner">
  <div class="layout__container">
    <a href="<?php echo esc_url( $home ); ?>" class="nav__logo navbar__logo" aria-label="SPD Contracting, Inc. – Home">
      <img src="<?php echo esc_url( $logo_url ); ?>" alt="SPD Contracting, Inc." class="navbar__logo-img" width="779" height="164">
    </a>

    <button type="button" class="nav__toggle" id="nav-toggle" aria-label="Open menu" aria-expanded="false" aria-controls="nav-list-wrap">
      <span class="nav__toggle-icon"></span>
    </button>

    <div class="nav__list-wrap" id="nav-list-wrap" aria-label="Main navigation">
      <ul class="nav__list" role="menubar">
        <li class="nav__item" role="none">
          <a href="<?php echo esc_url( $company_info_url ); ?>" class="nav__link" role="menuitem">Company Info</a>
        </li>
        <li class="nav__item" role="none" aria-expanded="false" aria-haspopup="true" aria-controls="nav-dropdown-approach">
          <a href="<?php echo esc_url( $approach_url ); ?>" class="nav__link" role="menuitem" id="nav-trigger-approach" aria-controls="nav-dropdown-approach" aria-expanded="false">
            Approach &amp; Expertise <span class="nav__chevron" aria-hidden="true">▼</span>
          </a>
          <div class="nav__dropdown" id="nav-dropdown-approach" role="menu" aria-label="Approach & Expertise" hidden>
            <div class="nav__dropdown-list">
              <a href="<?php echo esc_url( $service_base . 'preconstruction/' ); ?>">Preconstruction</a>
              <a href="<?php echo esc_url( $service_base . 'construction-management/' ); ?>">Construction Management</a>
              <a href="<?php echo esc_url( $service_base . 'project-management/' ); ?>">Project Management</a>
              <a href="<?php echo esc_url( $service_base . 'subcontracting/' ); ?>">Subcontracting</a>
              <a href="<?php echo esc_url( $service_base . 'design-build/' ); ?>">Design-Build</a>
              <a href="<?php echo esc_url( $service_base . 'construction-manager-at-risk/' ); ?>">Construction Manager at Risk</a>
              <a href="<?php echo esc_url( $service_base . 'self-perform/' ); ?>">Self-Perform</a>
            </div>
          </div>
        </li>
        <li class="nav__item" role="none" aria-expanded="false" aria-haspopup="true" aria-controls="nav-dropdown-projects">
          <a href="<?php echo esc_url( $projects_url ); ?>" class="nav__link" role="menuitem" id="nav-trigger-projects" aria-controls="nav-dropdown-projects" aria-expanded="false">
            Projects <span class="nav__chevron" aria-hidden="true">▼</span>
          </a>
          <div class="nav__dropdown nav__mega" id="nav-dropdown-projects" role="menu" aria-label="Projects submenu" hidden>
            <div class="nav__mega-cols">
              <button type="button" class="nav__mega-category is-active" data-nav-panel="education" role="menuitem">Educational Facilities<span class="nav__mega-arrow" aria-hidden="true">›</span></button>
              <button type="button" class="nav__mega-category" data-nav-panel="gov-buildings" role="menuitem">Government-Owned Buildings <span class="nav__mega-arrow" aria-hidden="true">›</span></button>
              <button type="button" class="nav__mega-category" data-nav-panel="municipal" role="menuitem">Municipal &amp; Healthcare <span class="nav__mega-arrow" aria-hidden="true">›</span></button>
              <button type="button" class="nav__mega-category" data-nav-panel="gov-housing" role="menuitem">Government Housing <span class="nav__mega-arrow" aria-hidden="true">›</span></button>
              <button type="button" class="nav__mega-category" data-nav-panel="recreational" role="menuitem">Recreational Facilities <span class="nav__mega-arrow" aria-hidden="true">›</span></button>
            </div>
            <div class="nav__mega-panel-wrap">
              <div class="nav__mega-panel">
                <div class="nav__mega-panel-inner"></div>
              </div>
            </div>
          </div>
        </li>
        <li class="nav__item" role="none">
          <a href="<?php echo esc_url( $contact_url ); ?>" class="nav__link" role="menuitem">Contact Us</a>
        </li>
      </ul>
    </div>
  </div>
</header>
