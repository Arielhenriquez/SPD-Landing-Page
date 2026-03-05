<?php
/**
 * Footer – SPD repo style. Clases .footer__* (components.css).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$home             = home_url( '/' );
$projects_url     = home_url( '/projects/' );
$approach_url     = function_exists( 'spd_page_url_by_slug' ) ? spd_page_url_by_slug( 'approach-expertise' ) : home_url( '/approach-expertise/' );
$company_info_url = function_exists( 'spd_page_url_by_slug' ) ? spd_page_url_by_slug( 'company-info' ) : home_url( '/company-info/' );
$contact_url      = function_exists( 'spd_page_url_by_slug' ) ? spd_page_url_by_slug( 'contact-us-2' ) : home_url( '/contact-us-2/' );
$logo_url         = 'https://qmbqbrt0dq.wpdns.site/wp-content/uploads/2026/01/logo.webp';
?>
<footer class="site-footer" id="site-footer" role="contentinfo">
  <div class="layout__container">
    <div class="footer__top">
      <a href="<?php echo esc_url( $home ); ?>" class="footer__logo" aria-label="SPD Contracting, Inc. – Home">
        <img src="<?php echo esc_url( $logo_url ); ?>" alt="SPD Contracting, Inc." class="footer__logo-img" width="779" height="164">
      </a>
      <nav class="footer__nav" aria-label="Footer navigation">
        <a href="<?php echo esc_url( $company_info_url ); ?>">Company Info</a>
        <a href="<?php echo esc_url( $approach_url ); ?>">Approach &amp; Expertise</a>
        <a href="<?php echo esc_url( $projects_url ); ?>">Projects</a>
        <a href="<?php echo esc_url( $contact_url ); ?>">Contact Us</a>
      </nav>
    </div>
    <div class="footer__bottom">
      <p class="footer__copyright">Copyright © <?php echo esc_html( date( 'Y' ) ); ?> SPD Contracting, Inc.</p>
      <div class="footer__contact">
        <span>1018 Bladensburg Rd NE - Washington, DC 20002</span>
        <span>202-334-5222</span>
        <a href="mailto:admin@spdcon-inc.com">admin@spdcon-inc.com</a>
      </div>
    </div>
  </div>
</footer>
