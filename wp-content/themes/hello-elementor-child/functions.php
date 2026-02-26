<?php
/**
 * Hello Elementor Child - Navbar, footer y carrusel genérico (repo SPD-test/waldo).
 * Plantillas: Homepage, Projects. Assets compartidos para ambas.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Clase en body para que los estilos SPD (navbar/footer) ganen sobre Elementor y tema padre.
 */
function hello_elementor_child_body_class_spd( $classes ) {
	$classes[] = 'spd-theme';
	return $classes;
}
add_filter( 'body_class', 'hello_elementor_child_body_class_spd', 5 );

/**
 * Evitar que el tema padre encole header-footer.css (usamos nuestro navbar/footer).
 */
function hello_elementor_child_disable_parent_header_footer_css() {
	if ( is_admin() ) {
		return;
	}
	wp_dequeue_style( 'hello-elementor-header-footer' );
	wp_deregister_style( 'hello-elementor-header-footer' );
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_disable_parent_header_footer_css', 20 );

/**
 * CSS global del tema hijo (si existe).
 */
function hello_elementor_child_enqueue_styles() {
	$path = get_stylesheet_directory();
	$base = get_stylesheet_directory_uri();
	$custom_file = $path . '/css/custom.css';
	if ( file_exists( $custom_file ) ) {
		wp_enqueue_style(
			'hello-elementor-child-global',
			$base . '/css/custom.css',
			array(),
			filemtime( $custom_file )
		);
	}
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_styles', 20 );

/**
 * Forzar plantilla Contact Us cuando la página tiene slug contact-us-2,
 * para que se muestre hero, formulario, contact-info y related projects con los estilos del tema.
 */
function hello_elementor_child_force_contact_template( $template ) {
	if ( is_singular( 'page' ) ) {
		$slug = get_post_field( 'post_name', get_queried_object_id() );
		if ( $slug === 'contact-us-2' ) {
			$contact_template = get_stylesheet_directory() . '/template-contact-us.php';
			if ( file_exists( $contact_template ) ) {
				return $contact_template;
			}
		}
	}
	return $template;
}
add_filter( 'template_include', 'hello_elementor_child_force_contact_template', 5 );

/**
 * Navbar y footer SPD en todo el sitio: Inter, base, layout, components, navbar + navbar.js.
 * Se cargan en todas las páginas del front para que header.php y footer.php del tema hijo los muestren bien.
 * Se desencola el header-footer.css del tema padre para evitar que sus estilos globales pisen los nuestros.
 */
function hello_elementor_child_enqueue_spd_header_footer() {
	if ( is_admin() ) {
		return;
	}
	$path = get_stylesheet_directory();
	$uri  = get_stylesheet_directory_uri();

	wp_enqueue_style(
		'hello-child-inter-font',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	$header_footer_styles = array(
		'base'       => '/css/base.css',
		'layout'     => '/css/layout.css',
		'components' => '/css/components.css',
		'navbar'     => '/css/navbar.css',
	);
	$prev = 'hello-child-inter-font';
	foreach ( $header_footer_styles as $handle => $file ) {
		$full = $path . $file;
		if ( ! file_exists( $full ) ) {
			continue;
		}
		$dep = $handle === 'base' ? array( 'hello-child-inter-font' ) : array( $prev );
		wp_enqueue_style(
			'hello-child-' . $handle,
			$uri . $file,
			$dep,
			filemtime( $full )
		);
		$prev = 'hello-child-' . $handle;
	}

	$navbar_js = $path . '/js/navbar.js';
	if ( file_exists( $navbar_js ) ) {
		wp_enqueue_script(
			'hello-child-navbar',
			$uri . '/js/navbar.js',
			array(),
			filemtime( $navbar_js ),
			true
		);
		wp_add_inline_script(
			'hello-child-navbar',
			'window.projectPageBase="' . esc_js( home_url( '/projects/' ) ) . '";window.projectLinkSuffix="";',
			'before'
		);
		wp_add_inline_script(
			'hello-child-navbar',
			"document.addEventListener('DOMContentLoaded',function(){if(window.Navbar&&window.Navbar.init)window.Navbar.init();});",
			'after'
		);
	}

	/* Forzar navbar, mega menú Projects y footer por encima de Elementor/tema padre */
	$navbar_override = '
		body.spd-theme #site-header.site-header {
			position: fixed !important;
			top: 0 !important;
			left: 0 !important;
			right: 0 !important;
			width: 100% !important;
			max-width: 100% !important;
			min-width: 100% !important;
			height: 72px !important;
			background: #0d1b2a !important;
			z-index: 100 !important;
			display: flex !important;
			align-items: center !important;
			padding: 0 !important;
			box-sizing: border-box !important;
		}
		body.spd-theme #site-footer.site-footer {
			width: 100% !important;
			max-width: 100% !important;
			min-width: 100% !important;
			background: #1b263b !important;
			color: #ffffff !important;
			padding: 48px 0 32px !important;
			box-sizing: border-box !important;
		}
		/* Mega menú Projects: forzar estilos para que no los pise Elementor */
		body.spd-theme #site-header .nav__dropdown.nav__mega,
		body.spd-theme #site-header #nav-dropdown-projects {
			display: grid !important;
			grid-template-columns: 280px 1fr !important;
			min-width: 520px !important;
			max-width: 600px !important;
			background: rgba(13, 27, 42, 0.98) !important;
			border-radius: 0 0 8px 8px !important;
			box-shadow: 0 12px 32px rgba(0, 0, 0, 0.4) !important;
			padding: 0 !important;
		}
		body.spd-theme #site-header .nav__mega-cols,
		body.spd-theme #site-header #nav-dropdown-projects .nav__mega-cols {
			background: transparent !important;
			padding: 12px 0 !important;
		}
		body.spd-theme #site-header .nav__mega-category {
			background: transparent !important;
			color: rgba(255, 255, 255, 0.9) !important;
			border: none !important;
		}
		body.spd-theme #site-header .nav__mega-category:hover,
		body.spd-theme #site-header .nav__mega-category:focus {
			background: rgba(255, 255, 255, 0.06) !important;
			color: #ffffff !important;
		}
		body.spd-theme #site-header .nav__mega-category.is-active {
			background: rgba(224, 124, 36, 0.15) !important;
			color: #e07c24 !important;
		}
		body.spd-theme #site-header .nav__mega-panel-wrap {
			border-left: 1px solid rgba(255, 255, 255, 0.12) !important;
			background: transparent !important;
		}
		body.spd-theme #site-header .nav__mega-panel {
			background: rgba(0, 0, 0, 0.25) !important;
			border-radius: 8px !important;
			margin: 12px 12px 12px 0 !important;
			padding: 16px 20px !important;
		}
		body.spd-theme #site-header .nav__mega-panel-inner a {
			color: rgba(255, 255, 255, 0.92) !important;
			text-decoration: none !important;
		}
		body.spd-theme #site-header .nav__mega-panel-inner a:hover {
			color: #e07c24 !important;
		}
		/* Dropdown común (panel): Projects y Approach – fondo, sombra, esquinas */
		body.spd-theme #site-header .nav__dropdown,
		body.spd-theme #site-header #nav-dropdown-projects,
		body.spd-theme #site-header #nav-dropdown-approach {
			background: rgba(13, 27, 42, 0.98) !important;
			border-radius: 0 0 8px 8px !important;
			box-shadow: 0 12px 32px rgba(0, 0, 0, 0.4) !important;
			padding: 0 !important;
		}
		/* Approach & Expertise: lista de enlaces */
		body.spd-theme #site-header #nav-dropdown-approach .nav__dropdown-list,
		body.spd-theme #site-header .nav__dropdown:not(.nav__mega) .nav__dropdown-list {
			padding: 8px 0 !important;
		}
		body.spd-theme #site-header #nav-dropdown-approach .nav__dropdown-list a,
		body.spd-theme #site-header .nav__dropdown:not(.nav__mega) .nav__dropdown-list a {
			color: #ffffff !important;
			text-decoration: none !important;
			padding: 10px 20px !important;
		}
		body.spd-theme #site-header #nav-dropdown-approach .nav__dropdown-list a:hover,
		body.spd-theme #site-header .nav__dropdown:not(.nav__mega) .nav__dropdown-list a:hover {
			background: rgba(255, 255, 255, 0.1) !important;
			color: #e07c24 !important;
		}
	';
	wp_add_inline_style( 'hello-child-navbar', $navbar_override );
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_spd_header_footer', 999 );

/**
 * Assets solo para plantillas Homepage, Projects y Contact: carousel, pages, homepage.js, contact-us.css.
 */
function hello_elementor_child_enqueue_spd_template_assets() {
	$is_homepage = is_page_template( 'template-custom-homepage.php' );
	$is_projects = is_page_template( 'template-projects.php' );
	$is_contact_page_slug = is_page() && get_post_field( 'post_name', get_queried_object_id() ) === 'contact-us-2';
	$is_contact = is_page_template( 'template-contact-us.php' ) || $is_contact_page_slug;
	if ( ! $is_homepage && ! $is_projects && ! $is_contact ) {
		return;
	}
	$path = get_stylesheet_directory();
	$uri  = get_stylesheet_directory_uri();

	$carousel_css = $path . '/css/vendor/carousel.css';
	if ( file_exists( $carousel_css ) ) {
		wp_enqueue_style(
			'hello-child-carousel',
			$uri . '/css/vendor/carousel.css',
			array( 'hello-child-navbar' ),
			filemtime( $carousel_css )
		);
	}
	$pages_css = $path . '/css/pages.css';
	if ( file_exists( $pages_css ) ) {
		wp_enqueue_style(
			'hello-child-pages',
			$uri . '/css/pages.css',
			array( 'hello-child-navbar' ),
			filemtime( $pages_css )
		);
	}

	$carousel_js = $path . '/js/vendor/carousel.js';
	if ( file_exists( $carousel_js ) ) {
		wp_enqueue_script(
			'hello-child-carousel',
			$uri . '/js/vendor/carousel.js',
			array(),
			filemtime( $carousel_js ),
			true
		);
	}

	if ( $is_homepage ) {
		$homepage_js = $path . '/js/homepage.js';
		if ( file_exists( $homepage_js ) ) {
			wp_enqueue_script(
				'hello-child-homepage',
				$uri . '/js/homepage.js',
				array( 'hello-child-navbar' ),
				filemtime( $homepage_js ),
				true
			);
		}
	}

	if ( $is_contact ) {
		$contact_css = $path . '/css/pages/contact-us.css';
		if ( file_exists( $contact_css ) ) {
			wp_enqueue_style(
				'hello-child-contact-us',
				$uri . '/css/pages/contact-us.css',
				array( 'hello-child-pages' ),
				filemtime( $contact_css )
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_spd_template_assets', 16 );
